<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Subject;
use App\Models\Task;
use Illuminate\Http\Request;
use Auth;
use DB;

class SubjectController extends Controller
{
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
    public function show(Request $request, $id)
    {

        // $subject->tasks()->get();
        // $a = $subject->courses;
        // dd($a);

        // $course = Course::find($subject->courses->id);
        // $course->subjects()->get();
        //
        // return view('client.subject.abc', compact('course', 'subject'));


        // dd($subject);
        // return response()->json(array('success' => true, 'subject' => $subject));
        $course_id = $request->course_id;
        $user_id = Auth::User()->id;
        $permiss = DB::table('user_course')->where([
            ['user_id', $user_id],
            ['course_id', $course_id],
        ])->get('status');
        // $permiss = 0;
        // $course = Course::find($course_id);
        // $course->users()->get();
        // foreach($course->users as $user) {
        //     if($user->id == $user_id) $permiss = $user->pivot->status;
        // }

        $subject = Subject::find($id);
        $tasks = $subject->tasks;

        return view('client.subject.subject', compact('subject', 'tasks', 'permiss'));
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
    public function update(Request $request, $id)
    {
        //
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

    public function history1($id) {
        // $subject = Subject::find($id);
        // $tasks = $subject->tasks()->pivot->orderBy('updated_at', 'DESC')->get();

        // $user_id = Auth::User()->id;
        // $tasks = DB::table('user_task')->where([
        //     ['user_id', $user_id],
        //     ['task_id', $id],
        // ])->orderBy('created_at', 'DESC');

        // return view('client.history.tasks', compact('tasks'));
        $tasksSubject = Subject::find($id)->tasks()->get();

        $tasks = DB::table('user_task')->where('user_id', Auth::User()->id)->get();
        // $tasksHistory = collect();
        $tasksHistory = [];
        foreach($tasks as $task) {
            $task1['time'] = strtotime($task->created_at);
            $task1['date'] = $task->created_at;
            $task1['task_id'] = $task->task_id;
            $task1['content'] = 'You started ' . Task::find($task->task_id)->name;
            // $tasksHistory->push($task1);
            $tasksHistory[] = $task1;
        }
        foreach($tasks as $task) {
            if($task->status == 1) {
                $task2['time'] = strtotime($task->updated_at);
                $task2['date'] = $task->updated_at;
                $task2['task_id'] = $task->task_id;
                $task2['content'] = 'You completed ' . Task::find($task->task_id)->name;
            } else {
                $task2['time'] = strtotime($task->updated_at);
                $task2['date'] = $task->updated_at;
                $task2['task_id'] = $task->task_id;
                $task2['content'] = 'You sent a report for ' . Task::find($task->task_id)->name;
            }
            $tasksHistory[] = $task2;
        }
        $columns = array_column($tasksHistory, 'time');
        array_multisort($columns, SORT_ASC, $tasksHistory);
        $tasksHistory = array_reverse($tasksHistory);
        return view('client.history.tasks', compact('tasksHistory', 'tasksSubject'));
    }

    public function history($id) {
        $tasks = Subject::find($id)->tasks()->get('id');
        $tasksSubject = Task::with('users')->whereIn('id', $tasks)->get();
        $tasksHistory = collect();
        foreach ($tasksSubject as $task) {
            foreach ($task->users as $user) {
                if($user->id == Auth::User()->id) {
                    $task1['time'] = strtotime($user->pivot->created_at);
                    $task1['date'] = $user->pivot->created_at;
                    $task1['task_id'] = $user->pivot->task_id;
                    $task1['content'] = 'You started ' . Task::find($user->pivot->task_id)->name;
                    $tasksHistory->push($task1);
                }
            }
        }

        foreach($tasksSubject as $task) {
            foreach ($task->users as $user) {
                if($user->id == Auth::User()->id) {
                    if($user->pivot->status == 1) {
                        $task2['time'] = strtotime($user->pivot->updated_at);
                        $task2['date'] = $user->pivot->updated_at;
                        $task2['task_id'] = $user->pivot->task_id;
                        $task2['content'] = 'You completed ' . Task::find($user->pivot->task_id)->name;
                    } else {
                        if($user->pivot->created_at != $user->pivot->updated_at) {
                            $task2['time'] = strtotime($user->pivot->updated_at);
                            $task2['date'] = $user->pivot->updated_at;
                            $task2['task_id'] = $user->pivot->task_id;
                            $task2['content'] = 'You sent a report for ' . Task::find($user->pivot->task_id)->name;
                        }
                    }
                    $tasksHistory->push($task2);
                }
            }
        }
        $tasksHistory = $tasksHistory->sortByDesc('time');
        return view('client.history.tasks', compact('tasksHistory'));
    }
}
