<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Subject;
use App\Http\Requests\CourseRequest;

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
        $courses = Course::latest('id')->with('category')->paginate(self::PAGE);
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
        return view('admin.courses.create',compact('categories','subjects'));
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
        $course = Course::findOrFail($id);
        $subject = Course::find($id)->subjects()->orderBy('name')->get();
        return view('admin.courses.show', compact('course','subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $course = Course::findOrFail($id);
        $categories = Category::all();
        $subjects = Subject::all();
        return view('admin.courses.edit', compact('course','categories','subjects'));
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

        return redirect()->route('admin.courses.index')->with('alert', trans('setting.edit_course_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('admin.courses.index')->with('alert', trans('setting.delete_course_success'));
    }
}
