<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Subject;
use App\Enums\StatusUserCourse;
use App\Http\Requests\CourseRequest;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\User;
use DB;

class CourseController extends Controller
{
    private $courseRepository;
    private $subjectRepository;
    private $userRepository;
    private $categoryRepository;

    public function __construct (
        CourseRepositoryInterface  $courseRepository,
        SubjectRepositoryInterface  $subjectRepository,
        UserRepositoryInterface  $userRepository,
        CategoryRepositoryInterface  $categoryRepository
    )
    {
        $this->courseRepository = $courseRepository;
        $this->subjectRepository = $subjectRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseRepository->getLatest()->with('category')->paginate(config('configcourse.PagePaginate'));

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
        $subjects = $this->subjectRepository->getAll();
        $categories = $this->getSubCategories(config('configcourse.subcategories'));

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
        if ($request->hasFile('image')) {
            $image = $this->uploadImage($request);
        } else {
            $image = config('configcourse.image_default');
        }
        $attributes = $request->only([
            'category_id',
            'name',
            'description',
            'status',
        ]);
        $attributes['image'] = $image;
        $course = $this->courseRepository->create($attributes);
        try {
            $course = $this->courseRepository->find($course->id);
            if ($request->subject_id) {
                foreach ($request->subject_id as $value) {
                    $subjectName = $this->subjectRepository->find($value)->name;
                    $course->subjects()->attach($value, ['subject_name' => $subjectName]);
                }        
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }

        return redirect()->route('admin.courses.index')->with('alert', trans('setting.add_course_success'));
    }

    private function uploadImage(CourseRequest $request)
    {
        $destinationDir = public_path(config('configcourse.public_path'));
        $fileName = uniqid('course') . '.' . $request->image->extension();
        $request->image->move($destinationDir, $fileName);
        return $image = config('configcourse.image_course').$fileName;
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
            $course = $this->courseRepository->find($id);
            $listSubject = $course->subjects;
            $userCourse = $course->users;
            $listUser = $this->userRepository->getAll();
            $statusUser = DB::table('user_course')
                ->where('course_id', $id)
                ->get();

            return view('admin.courses.show', compact('course', 'listSubject', 'userCourse', 'listUser', 'statusUser'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function assignTraineeCourse(Request $request, $id)
    {
        try {
            $course = $this->courseRepository->find($id);
            $check = DB::table('user_course')
                ->where('course_id', $id)
                ->where('user_id', $request->user_id)
                ->get();
            $checkStatusUser = DB::table('user_course')
                ->where('user_id', $request->user_id)
                ->where('status', StatusUserCourse::Activity)
                ->get();
            $checkUserSubject = DB::table('user_subject')
                ->where('user_id', $request->user_id)
                ->where('subject_id', $request->subject_id)
                ->get();
            if (count($checkStatusUser) >= config('configcourse.checkStatusUser')) {
                return redirect()->route('admin.courses.show', $course->id)->with('error', trans('setting.check_status_user'));
            }else {
                if (count($check) >= config('configcourse.check')) {
                    return redirect()->route('admin.courses.show', $course->id)->with('error', trans('setting.check_user_course'));
                } else {
                    if (count($checkUserSubject) < config('configcourse.check')) {
                        $course->users()->attach($request->user_id);
                        $this->subjectRepository->find($request->subject_id)->users()->attach($request->user_id);

                        return redirect()->route('admin.courses.show', $course->id)->with('alert', trans('setting.assign_success'));    
                    } else {
                        return redirect()->route('admin.courses.show', $course->id)->with('alert', trans('setting.user_subject_exist'));    
                    }  
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function finishTraineeCourse(Request $request, $id)
    {
        $courseSubject = $this->courseRepository->find($id)->subjects;
        $count = config('configcourse.count');
        foreach ($courseSubject as $value) {
            $check = DB::table('user_subject')
                ->where('user_id', $id)
                ->where('subject_id', $value->id)
                ->where('status', StatusUserCourse::Finished)
                ->get();
            if (count($check) >= config('configcourse.check')) {
                $count++;
            }
        }
        if ($count == count($courseSubject)) {
            DB::table('user_course')
                ->where('course_id', $id)
                ->where('user_id', $request->user_id)
                ->update(['status' => StatusUserCourse::Finished, 'updated_at' => now()]);
                
            return redirect()->route('admin.courses.show', $id)->with('alert', trans('setting.finish_course_success'));
        } else {
            return redirect()->route('admin.courses.show', $id)->with('error', trans('setting.error_course_fail'));
        }

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
            $course = $this->courseRepository->find($id);
            $categories = $this->categoryRepository->getAll();
            $subject = $course->subjects;
            $subjects = $this->subjectRepository->getAll();

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
            $course = $this->courseRepository->find($id);
            if ($request->hasFile('image')) {
                $image = $this->uploadImage($request);
            } else {
                $image = $course->image;
            }
            $attributes = $request->only([
                'category_id',
                'name',
                'description',
                'status',
            ]);
            $attributes['image'] = $image;
            $this->courseRepository->update($id, $attributes);
            $course->subjects()->detach();
            foreach ($request->subject_id as $value) {
                $subjectName = $this->subjectRepository->find($value)->name;
                $course->subjects()->attach($value, ['subject_name' => $subjectName]);
            }

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
            $this->courseRepository->find($id)->subjects()->detach();
            $this->courseRepository->delete($id);

            return redirect()->route('admin.courses.index')->with('alert', trans('setting.delete_course_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
