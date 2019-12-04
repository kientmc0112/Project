<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Course;
use App\Models\User;
use App\Models\Subject;
use App\Models\Task;
use Illuminate\Http\Request;
use Auth;

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
        $tasks = $subject->tasks()->with('users')->get();
        $subject->users()->get();

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

    public function history($id) {
        $user_id = Auth::User()->id;
        $tasks = DB::table('user_task')->where([
            ['user_id', $user_id],
            ['task_id', $id],
        ])->orderBy('created_at', 'DESC');
        // $subject = Subject::find($id);
        // $tasks = $subject->tasks()->pivot->orderBy('updated_at', 'DESC')->get();

        return view('client.history.tasks', compact('tasks'));
    }
}
