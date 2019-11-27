<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Subject;
use App\Http\Requests\CourseRequest;
use App\Models\User;
use DB;

class CourseController extends Controller
{
    const PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest('id')
                        ->with('category')
                        ->paginate(self::PAGE);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Get the sub categories.
     * 
     * @param int $parent_id
     * @return mix
     */
    private function getSubCategories($parent_id, $ignore_id=null)
    {
        $categories = Category::where('parent_id', $parent_id)
                                ->where('id', '<>', $ignore_id)
                                ->get()
                                ->map(function($query) use($ignore_id){
                                    $query->sub = $this->getSubCategories($query->id, $ignore_id);
                                    return $query;
                                });
        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        $categories = $this->getSubCategories(0);
        return view('admin.courses.create', compact('categories','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $attr = [
            'category_id' => $request->get('category_id'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'status' => $request->get('status'),
        ];
        if ($request->hasFile('image')) {  
            $destinationDir = public_path('images/course');
            $fileName = uniqid('course').'.'.$request->image->extension();
            $request->image->move($destinationDir, $fileName);
            $attr['image'] = '/images/course/'.$fileName;
        } else {
            $attr['image'] = '/images/courses.png';
        }
        $course = Course::create($attr);
        $course_id = $course->id;
        $course = Course::find($course_id);
        $course->subjects()->attach($request->subject_id);
        
        return redirect()->route('admin.courses.index')->with('alert', trans('setting.add_course_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $course = Course::findOrFail($id);
            $listSubject = Course::find($id)->subjects()->orderBy('name')->get();
            $userCourse = Course::find($id)->users()->get();
            $listUser = User::all();
            $statusUser = DB::table('user_course')->where('course_id', $id)->get();

            return view('admin.courses.show', compact('course', 'listSubject', 'userCourse', 'listUser', 'statusUser'));    
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function postShow(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $check = DB::table('user_course')
                        ->where('course_id', $id)
                        ->where('user_id', $request->user_id)
                        ->get();
            $checkStatusUser = DB::table('user_course')
                        ->where('user_id', $request->user_id)
                        ->where('status', 0)
                        ->get();
            if (count($checkStatusUser) >= 1) {
                return redirect()->route('admin.courses.show', $course->id)->with('error', trans('setting.check_status_user'));
            }else {
                if (count($check) >= 1) {
                    return redirect()->route('admin.courses.show', $course->id)->with('error', trans('setting.check_user_course'));
                } else {
                    Course::find($id)->users()->attach($request->user_id);
                    return redirect()->route('admin.courses.show', $course->id)->with('alert', trans('setting.assign_success'));
                }
            }    
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function finishCourse(Request $request, $id)
    {
        DB::table('user_course')
                ->where('course_id', $id)
                ->where('user_id', $request->user_id)
                ->update(['status' => 1, 'updated_at' => now()]);
        return redirect()->route('admin.courses.show', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $course = Course::findOrFail($id);
            $categories = Category::all();
            $subject = Course::find($id)->subjects()->orderBy('name')->get();
            $subjects = Subject::all();
            return view('admin.courses.edit', compact('course','categories','subject','subjects'));    
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $attr = [
                'category_id' => $request->get('category_id'),
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'status' => $request->get('status'),
            ];
            if ($request->hasFile('image')) {  
                $destinationDir = public_path('images/course');
                $fileName = uniqid('course').'.'.$request->image->extension();
                $request->image->move($destinationDir, $fileName);
                $attr['image'] = '/images/course/'.$fileName;
            } else {
                $attr['image'] = $course->image;
            }
            $course->update($attr);
            $course->subjects()->detach();
            $course->subjects()->attach($request->subject_id);

            return redirect()->route('admin.courses.index')->with('alert', trans('setting.edit_course_success'));    
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();
            return redirect()->route('admin.courses.index')->with('alert', trans('setting.delete_course_success'));    
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
