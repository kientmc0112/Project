<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class UserController extends Controller
{
    protected $courseRepository;
    protected $subjectRepository;
    protected $taskRepository;
    protected $userRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository, TaskRepositoryInterface $taskRepository, CourseRepositoryInterface $courseRepository, UserRepositoryInterface $userRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->subjectRepository = $subjectRepository;
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);
        $courses = $user->courses;
        $subjects = $user->subjects;
        $tasks = $user->tasks;
        // $courses = DB::table('user_course')
        //     ->where('user_id', $id)
        //     ->get();
        // $listCourse = $this->courseRepository->getAll();
        // $subjects = DB::table('user_subject')
        //     ->where('user_id', $id)
        //     ->get();
        // $listSubject = $this->subjectRepository->getAll();
        // $tasks = DB::table('user_task')
        // ->where('user_id', $id)
        // ->get();
        // $listTask = $this->taskRepository->getAll();

        // return view('client.user.profile', compact('user', 'courses', 'listCourse', 'subjects', 'listSubject', 'tasks', 'listTask'));

        return view('client.user.profile', compact('user', 'courses', 'subjects', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        // $data = $request->all();
        // $user = User::find($id);
        // $user->name = $data['name'];
        // $user->phone = $data['phone'];
        // $user->address = $data['address'];
        // $user->avatar =  '/images/avatar/'.$data['avatar'];
        // $user->save();

        // return redirect(route('user.show', $id));

        // $validator = Validator::make($request->input(), array(
        //     'name' => 'required|min:3|max:50',
        //     'phone' => 'required|min:10|numeric',
        //     'address' => 'required',
        // ));

        $validator = $request->validated();
        if (is_object($validator)) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], config('client.user.fail'));
        }
        try {
            $attr = [
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'avatar' => $request->get('avatar'),
            ];
            $user = $this->userRepository->update($id, $attr);

            return response()->json(['user' => $user], config('client.user.network'));
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
        //
    }

    public function markAsRead(Request $request)
    {
        foreach (Auth::user()->notifications as $notification) {
            if ($notification->id == $request->id) {
                $notification->markAsRead();
            }
        }

        return response()->json('OK', config('client.user.network'));
    }

    public function markAll(Request $request)
    {
        foreach (Auth::user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return response()->json('OK', config('client.user.network'));
    }
}
