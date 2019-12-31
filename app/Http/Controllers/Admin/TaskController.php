<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Subject;
use App\Models\User;
use App\Http\Requests\TaskRequest;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use DB;

class TaskController extends Controller
{
    private $taskRepository;
    private $subjectRepository;
    private $userRepository;

    public function __construct(
        TaskRepositoryInterface  $taskRepository,
        SubjectRepositoryInterface  $subjectRepository,
        UserRepositoryInterface  $userRepository
    )
    {
        $this->taskRepository = $taskRepository;
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
        $tasks = $this->taskRepository->getPaginate();

        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = $this->subjectRepository->getAll();
        
        return view('admin.tasks.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $attributes = $request->only([
            'subject_id',
            'name',
            'description',
        ]);
        $this->taskRepository->create($attributes);

        return redirect()->route('admin.tasks.index')->with('alert', trans('setting.add_task_success'));
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
            $task = $this->taskRepository->find($id);
            $userTask = $task->users;
            $listUsers = $this->userRepository->getAll();
            $statusUser = DB::table('user_task')
                ->where('task_id', $id)
                ->get();
            
            return view('admin.tasks.show', compact('task', 'userTask', 'listUsers', 'statusUser', 'subjectTask'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function assignTraineeTask(Request $request, $id)
    {
        try {
            $task = $this->taskRepository->find($id);
            $check = DB::table('user_task')
                ->where('task_id', $id)
                ->where('user_id', $request->user_id)
                ->get();
            $checkStatusUser = DB::table('user_task')
                ->where('user_id', $request->user_id)
                ->where('status', config('configtask.status_user_activity'))
                ->get();
            $subject_id = $this->taskRepository->find($id)->subject_id;
            $checkUserSubject = DB::table('user_subject')
                ->where('user_id', $request->user_id)
                ->where('subject_id', $subject_id)
                ->get();
            if (count($checkUserSubject) >= config('configtask.check_user_subject')) {
                if (count($checkStatusUser) >= config('configtask.check_status_user')) {
                    return redirect()->route('admin.tasks.show', $task->id)->with('error', trans('setting.error_join_task'));
                }else {
                    if (count($check) >= config('configtask.check_user_task')) {
                        return redirect()->route('admin.tasks.show', $task->id)->with('error', trans('setting.error_task_exist'));
                    } else {
                        $this->taskRepository->find($id)->users()->attach($request->user_id);

                        return redirect()->route('admin.tasks.show', $task->id)->with('alert', trans('setting.alert_assign_task'));
                    }
                }    
            } else {
                return redirect()->route('admin.tasks.show', $task->id)->with('error', trans('setting.error_do_not_subject'));
            }
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function finishTraineeTask(Request $request, $id)
    {
        DB::table('user_task')
            ->where('task_id', $id)
            ->where('user_id', $request->user_id)
            ->update(['status' => config('configtask.status_user_finished')]);
        $subject = $this->taskRepository->find($id)->subject_id;
        $check = DB::table('user_subject')
            ->where('subject_id', $subject)
            ->where('user_id', $request->user_id)
            ->get();
        foreach ($check as $check) {
            $process = $check->process;
        }
        DB::table('user_subject')
            ->where('subject_id', $subject)
            ->where('user_id', $request->user_id)
            ->update(['process' => ++$process]);
        
        return redirect()->route('admin.tasks.show', $id)->with('alert', trans('setting.finish_task_success'));
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
            $task = $this->taskRepository->find($id);
            $subjects = $this->subjectRepository->getAll();
            
            return view('admin.tasks.edit', compact('subjects', 'task'))->with('alert', trans('setting.edit_task_success'));
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
    public function update(TaskRequest $request, $id)
    {

        try {
            $attributes = $request->only([
                'subject_id',
                'name',
                'description',
            ]);
            $this->taskRepository->update($id, $attributes);
            
            return redirect()->route('admin.tasks.index')->with('alert', trans('setting.edit_task_success'));
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
            $this->taskRepository->delete($id);

            return redirect()->route('admin.tasks.index')->with('alert', trans('setting.delete_task_success'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }
}
