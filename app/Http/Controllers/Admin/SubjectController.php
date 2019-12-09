<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use App\Http\Requests\SubjectRequest;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use DB;

class SubjectController extends Controller
{
    private $courseRepository;
    private $subjectRepository;
    private $userRepository;

    public function __construct (
        CourseRepositoryInterface  $courseRepository,
        SubjectRepositoryInterface  $subjectRepository,
        UserRepositoryInterface  $userRepository
    )
    {
        $this->courseRepository = $courseRepository;
        $this->subjectRepository = $subjectRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseRepository->getAll();
        $subjects = $this->subjectRepository->getLatest()->with('courses')->paginate(config('configsubject.page_paginate'));

        return view('admin.subjects.index', compact('courses', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = $this->courseRepository->getAll();

        return view('admin.subjects.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $attributes = $request->only([
            'name',
            'status',
            'description',
        ]);
        $subject = $this->subjectRepository->create($attributes);
        $subject_id = $subject->id;
        try {
            $subject = $this->subjectRepository->find($subject_id);
            if ($request->course_id) {
                $subjectName = $subject->name;
                $subject->courses()->attach($request->course_id, ['subject_name' => $subjectName]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
        
        return redirect()->route('admin.subjects.index')->with('alert', trans('setting.add_subject_success'));
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
            $subject = $this->subjectRepository->find($id);
            $users = $subject->users;
            $tasks = $subject->tasks;
            $listUser = $this->userRepository->getAll();
            $statusUser = DB::table('user_subject')
                ->where('subject_id', $id)
                ->get();

            return view('admin.subjects.show', compact('subject', 'users', 'listUser', 'tasks', 'statusUser'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }

    }

    public function assignTraineeSubject(Request $request, $id)
    {
        try {
            $subject = $this->subjectRepository->find($id);
            $check = DB::table('user_subject')
                ->where('subject_id', $id)
                ->where('user_id', $request->user_id)
                ->get();
            $checkStatusUser = DB::table('user_subject')
                ->where('user_id', $request->user_id)
                ->where('status', config('configsubject.status_user_activity'))
                ->get();
            $course_id = $subject->courses;
            $count = config('configsubject.count_default');
            foreach ($course_id as $course) {
                $checkUserCourse = DB::table('user_course')
                    ->where('user_id', $request->user_id)
                    ->where('course_id', $course->id)
                    ->get();
                if (count($checkUserCourse) >= config('configsubject.count_check')) {
                    $count++;
                }
            }
            if ($count >= config('configsubject.count_check')) {
                if (count($checkStatusUser) >= config('configsubject.count_check')) {
                    return redirect()->route('admin.subjects.show', $subject->id)->with('error', trans('setting.error_join_subject'));
                }else {
                    if (count($check) >= config('configsubject.count_check')) {
                        return redirect()->route('admin.subjects.show', $subject->id)->with('error', trans('setting.error_subject_exist'));
                    } else {
                        $subject->users()->attach($request->user_id);

                        return redirect()->route('admin.subjects.show', $subject->id)->with('alert', trans('setting.assign_trainee_success'));
                    }
                }
            } else {
                return redirect()->route('admin.subjects.show', $subject->id)->with('error', trans('setting.error_do_not_course'));
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function finishTraineeSubject(Request $request, $id)
    {
        DB::table('user_subject')
            ->where('subject_id', $id)
            ->where('user_id', $request->user_id)
            ->update(['status' => config('configsubject.status_user_finished'), 'updated_at' => now()]);
        $check = DB::table('user_course')
            ->where('user_id', $request->user_id)
            ->where('status', config('configsubject.status_user_activity'))
            ->get();
        foreach ($check as $check) {
            $process = $check->process;
            $course_id = $check->course_id;
        }
        DB::table('user_course')
            ->where('user_id', $request->user_id)
            ->where('course_id', $course_id)
            ->update(['process' => ++$process]);

        return redirect()->route('admin.subjects.show', $id);
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
            $subject = $this->subjectRepository->find($id);
            $courses = $this->courseRepository->getAll();
            $course = $subject->courses;

            return view('admin.subjects.edit', compact('subject', 'courses', 'course'));
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
    public function update(SubjectRequest $request, $id)
    {
        try {
            $attributes = $request->only([
                'name',
                'status',
                'desciption',
            ]);
            $subject = $this->subjectRepository->update($id, $attributes);
            $subject->courses()->detach();
            $subject->courses()->attach($request->course_id, ['subject_name' => $subject->name]);

            return redirect()->route('admin.subjects.index')->with('alert', trans('setting.edit_subject_success'));
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
            $this->subjectRepository->delete($id);

            return redirect()->route('admin.subjects.index')->with('alert', trans('setting.delete_subject_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
