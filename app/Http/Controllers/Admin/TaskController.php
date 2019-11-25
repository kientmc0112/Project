<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Subject;
use App\Models\User;
use DB;

class TaskController extends Controller
{
    const PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tasks = Task::latest('id')->with('subject')->paginate(self::PAGE);
        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('admin.tasks.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;
        $attr = [
            'subject_id' => $request->get('subject_id'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];
        $task->create($attr);

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
        $task = Task::findOrFail($id);
        $userTask = Task::find($id)->users()->get();
        $listUsers = User::all();
        $statusUser = DB::table('user_task')->where('task_id', $id)->get();
        $subjectTask = $task->subject()->get();
        return view('admin.tasks.show',compact('task','userTask','listUsers','statusUser','subjectTask'));
    }

    public function postShow(Request $request, $id)
    {
        
        $task = Task::findOrFail($id);
        $check = DB::table('user_task')->where('task_id', $id)->where('user_id', $request->user_id)->get();
        $checkStatusUser = DB::table('user_task')->where('user_id', $request->user_id)->where('status', 0)->get();
        if (count($checkStatusUser) >= 1) {
            return redirect()->route('admin.tasks.show', $task->id)->with('alert', 'K the dang ky nhieu hon 2 course!!!');
        }else {
            if (count($check) >= 1) {
                return redirect()->route('admin.tasks.show', $task->id)->with('alert', 'User Da hoc course nay r!');
            } else {
                Task::find($id)->users()->attach($request->user_id);
                return redirect()->route('admin.tasks.show', $task->id)->with('alert', 'Success');
            }
        }
    }

    public function finishCourse(Request $request, $id)
    {
        // DB::table('user_task')
        //         ->where('task_id', $id)
        //         ->where('user_id', $request->user_id)
        //         ->update(['status' => 1]);
        // return redirect()->route('admin.tasks.show', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $subjects = Subject::all();
        return view('admin.tasks.edit', compact('subjects','task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $attr = [
            'subject_id' => $request->get('subject_id'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];
        $task->update($attr);

        return redirect()->route('admin.tasks.index')->with('alert', trans('setting.edit_task_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.tasks.index')->with('alert', trans('setting.delete_task_success'));
    }
}
