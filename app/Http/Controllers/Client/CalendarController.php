<?php

namespace App\Http\Controllers\Client;

use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class CalendarController extends Controller
{
    protected $subjectRepository;
    protected $userRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository,
        UserRepositoryInterface $userRepository)
    {
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
    public function show()
    {
        // $tasks = DB::table('user_task')->where('user_id', Auth::User()->id)->get();
        // $taskCalendar = collect();
        // foreach($tasks as $task) {
        //     $task1['updated_at'] = $task->updated_at;
        //     $task1['created_at'] = $task->created_at;
        //     $task1['name'] = Task::find($task->task_id)->name;
        //     $taskCalendar->push($task1);
        // }

        // $courses = DB::table('user_course')->where('user_id', Auth::User()->id)->get();
        // $courseCalendar = collect();
        // foreach($courses as $course) {
        //     $course1['updated_at'] = $course->updated_at;
        //     $course1['created_at'] = $course->created_at;
        //     $course1['name'] = Course::find($course->course_id)->name;
        //     $courseCalendar->push($course1);
        // }

        // $subjects = DB::table('user_subject')->where('user_id', Auth::User()->id)->get();
        // $subjectCalendar = collect();
        // foreach($subjects as $subject) {
        //     $subject1['updated_at'] = $subject->updated_at;
        //     $subject1['created_at'] = $subject->created_at;
        //     $subject1['name'] = $this->subjectRepository->find($subject->subject_id)->name;
        //     $subjectCalendar->push($subject1);
        // }
        $user_id = Auth::user()->id;
        $user = $this->userRepository->find($user_id);
        $subjectCalendar = array();
        foreach ($user->subjects as $subject) {
            if($subject->pivot->status == 1) {
                $subject1['created_at'] = $subject->pivot->created_at;
                $subject1['updated_at'] = $subject->pivot->updated_at;
                $subject1['name'] = $subject->name;
                $subject1['color'] = '#00e600';
            }
            else if($subject->pivot->status == 0) {
                $subject1['created_at'] = $subject->pivot->created_at;
                $duration = strtotime($subject->pivot->created_at) + $subject->duration*3600;
                $subject1['updated_at'] = date('Y-m-d h:m:s', $duration);
                $subject1['name'] = $subject->name;
                $day = strtotime(date('Y-m-d'));
                if($duration <= $day) {
                    $subject1['color'] = 'red';
                } else {
                    $subject1['color'] = '#f5f242';
                }
            }
            $subjectCalendar[] = $subject1;
        }

        return view('client.calendar.index', compact('subjectCalendar'));
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
}
