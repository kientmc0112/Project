<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Task;
use App\Http\Requests\UserRequest;
use DB;

class UserController extends Controller
{
    const PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest('role_id')->paginate(self::PAGE);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password = $request->password;
        $repassword = $request->repassword;
        if ($password == $repassword) {
            $user = new User;
            $attr = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'role_id' => $request->get('role_id')
            ];
            if ($request->hasFile('avatar')) {  
                $destinationDir = public_path('images/avatar');
                $fileName = uniqid('avatar').'.'.$request->avatar->extension();
                $request->avatar->move($destinationDir, $fileName);
                $attr['avatar'] = '/images/avatar/'.$fileName;
            } else {
                $attr['avatar'] = '/images/avatar.jpg';
            }
            
            $user->create($attr);

            return redirect()->route('admin.users.index')->with('alert', trans('setting.add_user_success'));    
        } else {
            return redirect()->route('admin.users.create')->with('alert', trans('setting.checkpassoword'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userDetail = User::findOrFail($id);
        $courses = Course::all();
        $subjects = Subject::all();
        $tasks = Task::all();
        $userCourse = User::find($id)->courses()->get();
        $userCourseDetail = DB::table('user_course')
                ->where('user_id', $id)
                ->get();
        $userSubject = User::find($id)->subjects()->get();
        $userSubjectDetail = DB::table('user_subject')
                ->where('user_id', $id)
                ->get();
        $userTask = User::find($id)->tasks()->get();
        $userTaskDetail = DB::table('user_task')
                ->where('user_id', $id)
                ->get();

        return view('admin.users.show', compact('userDetail', 'courses', 'userCourse', 'userCourseDetail', 
                        'userSubject', 'userSubjectDetail','userTask','userTaskDetail', 'subjects', 'tasks'));
    }

    public function finishCourse(Request $request, $id)
    {
        $attr = DB::table('user_course')
                ->where('course_id', $request->course_id)
                ->where('user_id', $id)
                ->update(['status' => 1, 'updated_at' => now()]);

        return redirect()->route('admin.users.show', $id);
    }

    public function finishSubject(Request $request, $id)
    {
        DB::table('user_subject')
                ->where('subject_id', $request->subject_id)
                ->where('user_id', $id)
                ->update(['status' => 1, 'updated_at' => now()]);
        $check = DB::table('user_course')
                ->where('user_id', $id)
                ->where('status', 0)
                ->get();
        foreach ($check as $check) {
            $process = $check->process;
            $course_id = $check->course_id;
        }
        DB::table('user_course')
                ->where('user_id', $id)
                ->where('course_id', $course_id)
                ->update(['process' => ++$process]);

        return redirect()->route('admin.users.show', $id);
    }

    public function finishTask(Request $request, $id)
    {
        DB::table('user_task')
                ->where('task_id', $request->task_id)
                ->where('user_id', $id)
                ->update(['status' => 1, 'updated_at' => now()]);
        $subject = Task::find($request->task_id)->subject_id;
        $check = DB::table('user_subject')
                ->where('subject_id', $subject)
                ->where('user_id', $id)
                ->get();

        foreach ($check as $check) {
            $process = $check->process;
        }
        DB::table('user_subject')
                ->where('subject_id', $subject)
                ->where('user_id', $id)
                ->update(['process' => ++$process]);

        return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_user_task_success'));
    }

    public function addUserCourse(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $check = DB::table('user_course')
                ->where('course_id', $request->course_id)
                ->where('user_id', $id)
                ->get();
        $checkStatusUser = DB::table('user_course')
                ->where('user_id', $id)
                ->where('status', 0)
                ->get();
        if (count($checkStatusUser) >= 1) {
            return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_status_user'));
        }else {
            if (count($check) >= 1) {
                return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_user_course'));
            } else {
                User::find($id)->courses()->attach($request->course_id);
                return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_success'));
            }
        }    
    }

    public function addUserSubject(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $check = DB::table('user_subject')
                ->where('subject_id', $request->subject_id)
                ->where('user_id', $id)
                ->get();
        $checkStatusUser = DB::table('user_subject')
                ->where('user_id', $id)
                ->where('status', 0)
                ->get();
        $course_id = Subject::find($request->subject_id)->courses()->get();
        $count = 0;
        foreach ($course_id as $course) {
            $checkUserCourse = DB::table('user_course')
                    ->where('user_id', $id)
                    ->where('course_id', $course->id)
                    ->get();
            if (count($checkUserCourse) >= 1) {
                $count = ++$count;
            }
        }
        if ($count >= 1) {
            if (count($checkStatusUser) >= 1) {
                return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_status_user'));
            } else {
                if (count($check) >= 1) {
                    return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_user_course'));
                } else {
                    User::find($id)->subjects()->attach($request->subject_id);
                    return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_success'));
                }
            }
        } else {
            return redirect()->route('admin.users.show', $id)->with('error', trans('setting.assign_user_task_fail'));
        }
    }

    public function addUserTask(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $check = DB::table('user_task')
                ->where('task_id', $request->task_id)
                ->where('user_id', $id)
                ->get();
        $checkStatusUser = DB::table('user_task')
                ->where('user_id', $id)
                ->where('status', 0)
                ->get();
        $subject_id = Task::find($request->task_id)->subject_id;
        $checkUserSubject = DB::table('user_subject')
                ->where('user_id', $id)
                ->where('subject_id', $subject_id)
                ->get();
        if (count($checkUserSubject) >= 1) {
            if (count($checkStatusUser) >= 1) {
                return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_status_user'));
            }else {
                if (count($check) >= 1) {
                    return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_user_course'));
                } else {
                    User::find($id)->tasks()->attach($request->task_id);
                    return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_success'));
                }
            }    
        }else {
            return redirect()->route('admin.users.show', $id)->with('error', trans('setting.assign_user_task_fail'));
        }
    }

    public function deleteUserCourse(Request $request, $id)
    {
        $user_id = $request->id;
     
    }

    public function deleteUserSubject(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $user = User::findOrFail($request->user_id);
        $tasks = $subject->tasks()->get();
        $user->tasks()->detach($tasks);
        $subject->users()->detach($request->user_id);

        return redirect()->route('admin.users.show', $request->user_id)->with('alert', trans('setting.delete_user_task_success'));
    }

    public function deleteUserTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->users()->detach($request->user_id);

        return redirect()->route('admin.users.show', $request->user_id)->with('alert', trans('setting.delete_user_task_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $password = $request->password;
        $repassword = $request->repassword;
        if ($password == $repassword) {
            $user = User::findOrFail($id);
            $attr = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'role_id' => $request->get('role_id')
            ];
            if ($request->hasFile('avatar')) {  
                $destinationDir = public_path('images/avatar');
                $fileName = uniqid('avatar').'.'.$request->avatar->extension();
                $request->avatar->move($destinationDir, $fileName);
                $attr['avatar'] = '/images/avatar/'.$fileName;
            } else {
                $attr['avatar'] = $user->avatar;
            }
            $user->update($attr);

            return redirect()->route('admin.users.index')->with('alert', trans('setting.edit_user_success'));    
        } else {
            return redirect()->route('admin.users.edit', $user->id)->with('alert', trans('setting.checkpassoword'));
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
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('alert', trans('setting.delete_user_success'));
    }
}
