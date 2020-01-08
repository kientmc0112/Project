<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Enums\StatusUserCourse;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Notifications\TestNotification;
use App\Notifications\NotificationUser;
use DB;
use Pusher\Pusher;
use Auth;

class UserController extends Controller
{
    private $userRepository;
    private $categoryRepository;
    private $courseRepository;
    private $subjectRepository;
    private $taskRepository;

    public function __construct (
        UserRepositoryInterface  $userRepository,
        CategoryRepositoryInterface  $categoryRepository,
        CourseRepositoryInterface  $courseRepository,
        SubjectRepositoryInterface  $subjectRepository,
        TaskRepositoryInterface  $taskRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->courseRepository = $courseRepository;
        $this->subjectRepository = $subjectRepository;
        $this->taskRepository = $taskRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getPaginate();

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
            if ($request->hasFile('avatar')) {
                $avatar = $this->uploadAvatar($request);
            } else {
                $avatar = config('configuser.avatar_default');
            }
            $attributes = $request->only([
                'name',
                'email',
                'phone',
                'address',
                'role_id',
            ]);
            $attributes['avatar'] = $avatar;
            $attributes['password'] = bcrypt($request->get('password'));
            $this->userRepository->create($attributes);

            return redirect()->route('admin.users.index')->with('alert', trans('setting.add_user_success'));
        } else {
            return redirect()->route('admin.users.create')->with('alert', trans('setting.checkpassoword'));
        }
    }
    public function uploadAvatar(UserRequest $request)
    {
        $destinationDir = public_path(config('configuser.public_path'));
        $fileName = uniqid('avatar') . '.' . $request->avatar->extension();
        $request->avatar->move($destinationDir, $fileName);
        $avatar = config('configuser.avatar') . $fileName;
        return $avatar;
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
            $userDetail = $this->userRepository->find($id);
            $courses = $this->courseRepository->getAll();
            $subjects = $this->subjectRepository->getAll();
            $tasks = $this->taskRepository->getAll();
            $userCourse = $userDetail->courses;
            $userCourseDetail = DB::table('user_course')
                ->where('user_id', $id)
                ->get();
            $userSubject = $userDetail->subjects;
            $userSubjectDetail = DB::table('user_subject')
                ->where('user_id', $id)
                ->get();
            $userTask = $userDetail->tasks;
            $userTaskDetail = DB::table('user_task')
                ->where('user_id', $id)
                ->get();

            return view('admin.users.show', compact('userDetail', 'courses', 'userCourse', 'userCourseDetail',
                'userSubject', 'userSubjectDetail','userTask','userTaskDetail', 'subjects', 'tasks'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
    public function exportSubject($id)
    {
        $listSubject = DB::table('course_subject')
            ->where('course_id', '=', $id)
            ->get();

        return response()->json(['listSubject' => $listSubject], config('configuser.json'));
    }
    public function finishCourse(Request $request, $id)
    {
        $courseSubject = $this->courseRepository->find($request->course_id)->subjects;
        $count = config('configuser.count');
        foreach ($courseSubject as $value) {
            $check = DB::table('user_subject')
                ->where('user_id', $id)
                ->where('subject_id', $value->id)
                ->where('status', StatusUserCourse::Finished)
                ->get();
            if (count($check) >= config('configuser.check')) {
                $count++;
            }
        }
        if ($count == count($courseSubject)) {
            DB::table('user_course')
                ->where('course_id', $request->course_id)
                ->where('user_id', $id)
                ->update(['status' => StatusUserCourse::Finished, 'updated_at' => now()]);

            return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.finish_course_success'));
        } else {
            return redirect()->route('admin.users.show', $id)->with('error', trans('setting.error_course_fail'));
        }
    }
    public function finishSubject(Request $request, $id)
    {
        DB::table('user_subject')
            ->where('subject_id', $request->subject_id)
            ->where('user_id', $id)
            ->update(['status' => StatusUserCourse::Finished, 'updated_at' => now()]);
        $check = DB::table('user_course')
            ->where('user_id', $id)
            ->where('status', StatusUserCourse::Activity)
            ->get();
        foreach ($check as $value) {
            $process = $value->process;
            $course_id = $value->course_id;
        }
        DB::table('user_course')
            ->where('user_id', $id)
            ->where('course_id', $course_id)
            ->update(['process' => ++$process]);
        $notify = "You has completed subject " . $this->subjectRepository->find($request->subject_id)->name;
        $courses = $this->subjectRepository->find($request->subject_id)->courses;
        foreach($courses as $course) {
            foreach ($course->users as $user) {
                if($user->id == $id && $user->pivot->status == 0) {
                    $course_id = $course->id;
                }
            }
        }
        $data = [
            'title' => 'FTMS',
            'content' => $notify,
            'course_id' => $course_id,
        ];
        $user = $this->userRepository->find($id);
        $user->notify(new NotificationUser($data));
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true,
        );
        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );
        $pusher = new Pusher(
            '380b9393267e17a9b728',
            '9a7797050822c79bfc62',
            '924873',
            $options
        );
        $event = 'user' . $id;
        $pusher->trigger('NotificationEvent', $event, $data);

        return redirect()->route('admin.users.show', $id);
    }

    public function finishTask(Request $request, $id)
    {
        try {
            DB::table('user_task')
                ->where('task_id', $request->task_id)
                ->where('user_id', $id)
                ->update(['status' => StatusUserCourse::Finished, 'updated_at' => now()]);
            $subject = $this->taskRepository->find($request->task_id)->subject_id;
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


            $notify = "You has completed task " . $this->taskRepository->find($request->task_id)->name;
            $subject_id = $this->taskRepository->find($request->task_id)->subject_id;
            $courses = $this->subjectRepository->find($subject_id)->courses;
            foreach($courses as $course) {
                foreach ($course->users as $user) {
                    if($user->id == $id && $user->pivot->status == 0) {
                        $course_id = $course->id;
                    }
                }
            }
            $data = [
                'title' => 'FTMS',
                'content' => $notify,
                'course_id' => $course_id,
            ];
            $user = $this->userRepository->find($id);
            $user->notify(new NotificationUser($data));
            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true,
            );
            $pusher = new Pusher(
                '380b9393267e17a9b728',
                '9a7797050822c79bfc62',
                '924873',
                $options
            );
            $event = 'user' . $id;
            $pusher->trigger('NotificationEvent', $event, $data);

            return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_user_task_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
    public function addUserCourse(Request $request, $id)
    {
        try {
            $user = $this->userRepository->find($id);
            $check = DB::table('user_course')
                ->where('course_id', $request->course_id)
                ->where('user_id', $id)
                ->get();
            $checkStatusUser = DB::table('user_course')
                ->where('user_id', $id)
                ->where('status', StatusUserCourse::Finished)
                ->get();
            if (count($checkStatusUser) >= config('configuser.checkStatusUser')) {
                return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_status_user'));
            } else {
                if (count($check) >= config('configuser.check')) {
                    return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_user_course'));
                } else {
                    $user->courses()->attach($request->course_id);
                    $userSubject = DB::table('user_subject')
                        ->where('user_id', $id)
                        ->where('subject_id', $request->subject_id)
                        ->get();
                    if (count($userSubject) < config('configuser.userSubject')) {
                        $courseName = $this->courseRepository->find($request->course_id)->name;
                        $content = 'You has added to course ' . $courseName;
                        $courses = $this->subjectRepository->find($request->subject_id)->courses;
                        foreach($courses as $course) {
                            foreach ($course->users as $userC) {
                                if($userC->id == $id && $userC->pivot->status == 0) {
                                    $course_id = $course->id;
                                }
                            }
                        }
                        $data = [
                            'title' => "FTMS",
                            'content' => $content,
                            'course_id' => $course_id,
                        ];
                        $user->notify(new NotificationUser($data));
                        $options = array(
                            'cluster' => 'ap1',
                            'encrypted' => true,
                        );

                        $pusher = new Pusher(
                            '380b9393267e17a9b728',
                            '9a7797050822c79bfc62',
                            '924873',
                            $options
                        );
                        $notify = 'user' . $id;
                        $pusher->trigger('NotificationEvent', $notify, $data);
                        $user->subjects()->attach($request->subject_id);

                        return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.check_user_subject'));
                    }

                    return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_success'));
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
    public function addUserSubject(Request $request, $id)
    {
        try {
            $user = $this->userRepository->find($id);
            $check = DB::table('user_subject')
                ->where('subject_id', $request->subject_id)
                ->where('user_id', $id)
                ->get();
            $checkStatusUser = DB::table('user_subject')
                ->where('user_id', $id)
                ->where('status', StatusUserCourse::Activity)
                ->get();
            $course_id = $this->subjectRepository->find($request->subject_id)->courses;
            $count = config('configuser.count');
            foreach ($course_id as $course) {
                $checkUserCourse = DB::table('user_course')
                    ->where('user_id', $id)
                    ->where('course_id', $course->id)
                    ->get();
                if (count($checkUserCourse) >= config('configuser.checkUserCourse')) {
                    $count++;
                }
            }
            if ($count >= config('configuser.count_check')) {
                if (count($checkStatusUser) >= config('configuser.checkStatusUser')) {
                    return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_status_user'));
                } else {
                    if (count($check) >= config('configuser.count_check')) {
                        return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_user_course'));
                    } else {
                        $subjectName = $this->subjectRepository->find($request->subject_id)->name;
                        $content = 'You has added to subject ' . $subjectName;
                        $courses = $this->subjectRepository->find($request->subject_id)->courses;
                        foreach ($courses as $course) {
                            foreach ($course->users as $userC) {
                                if($userC->id == $id && $userC->pivot->status == 0) {
                                    $course_id = $course->id;
                                }
                            }
                        }
                        $data = [
                            'title' => "FTMS",
                            'content' => $content,
                            'course_id' => $course_id,
                        ];
                        $user->notify(new NotificationUser($data));
                        $options = array(
                            'cluster' => 'ap1',
                            'encrypted' => true,
                        );

                        $pusher = new Pusher(
                            '380b9393267e17a9b728',
                            '9a7797050822c79bfc62',
                            '924873',
                            $options
                        );
                        $notify = 'user' . $id;
                        $pusher->trigger('NotificationEvent', $notify, $data);
                        $user->subjects()->attach($request->subject_id);

                        return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_success'));
                    }
                }
            } else {
                return redirect()->route('admin.users.show', $id)->with('error', trans('setting.assign_user_task_fail'));
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
    public function addUserTask(Request $request, $id)
    {
        try {
            $user = $this->userRepository->find($id);
            $check = DB::table('user_task')
                    ->where('task_id', $request->task_id)
                    ->where('user_id', $id)
                    ->get();
            $checkStatusUser = DB::table('user_task')
                    ->where('user_id', $id)
                    ->where('status', StatusUserCourse::Activity)
                    ->get();
            $subject_id = $this->taskRepository->find($request->task_id)->subject_id;
            $checkUserSubject = DB::table('user_subject')
                    ->where('user_id', $id)
                    ->where('subject_id', $subject_id)
                    ->get();
            if (count($checkUserSubject) >= config('configuser.checkUserSubject')) {
                if (count($checkStatusUser) >= config('configuser.checkStatusUser')) {
                    return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_status_user'));
                }else {
                    if (count($check) >= config('configuser.count_check')) {
                        return redirect()->route('admin.users.show', $id)->with('error', trans('setting.check_user_course'));
                    } else {
                        $user->tasks()->attach($request->task_id);

                        return redirect()->route('admin.users.show', $id)->with('alert', trans('setting.assign_success'));
                    }
                }
            }else {
                return redirect()->route('admin.users.show', $id)->with('error', trans('setting.assign_user_task_fail'));
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
    public function deleteUserCourse(Request $request, $id)
    {
        try {
            $course = $this->courseRepository->find($id);
            $course->users()->detach($request->user_id);

            return redirect()->route('admin.users.show', $request->user_id)->with('alert', trans('setting.delete_user_course_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
    public function deleteUserSubject(Request $request, $id)
    {
        try {
            $subject = $this->subjectRepository->find($id);
            $user = $this->userRepository->find($request->user_id);
            $tasks = $subject->tasks;
            $user->tasks()->detach($tasks);
            $subject->users()->detach($request->user_id);

            return redirect()->route('admin.users.show', $request->user_id)->with('alert', trans('setting.delete_user_subject_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
    public function deleteUserTask(Request $request, $id)
    {
        try {
            $task = $this->taskRepository->find($id);
            $task->users()->detach($request->user_id);

            return redirect()->route('admin.users.show', $request->user_id)->with('alert', trans('setting.delete_user_task_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
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
        try{
            $user = $this->userRepository->find($id);

            return view('admin.users.edit', compact('user'));
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
    public function update(UserRequest $request, $id)
    {
        try {
            $password = $request->password;
            $repassword = $request->repassword;
            if ($password == $repassword) {
                $user = $this->userRepository->find($id);
                if ($request->hasFile('avatar')) {
                    $avatar = $this->uploadAvatar($request);
                } else {
                    $avatar = $user->avatar;
                }
                $attributes = $request->only([
                    'name',
                    'email',
                    'phone',
                    'address',
                    'role_id',
                ]);
                $attributes['avatar'] = $avatar;
                $attributes['password'] = bcrypt($request->get('password'));
                $this->userRepository->update($id, $attributes);

                return redirect()->route('admin.users.index')->with('alert', trans('setting.edit_user_success'));
            } else {
                return redirect()->route('admin.users.edit', $user->id)->with('alert', trans('setting.checkpassoword'));
            }
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
            $this->userRepository->delete($id);

            return redirect()->route('admin.users.index')->with('alert', trans('setting.delete_user_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
