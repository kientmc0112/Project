<?php

namespace App\Http\Controllers\Client;

use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ReportController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
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
        // $result = DB::table('user_task');
        // $attr = [
        //     'user_id' => Auth::User()->id,
        //     'report' => $request->get('report'),
        //     'task_id' => $request->get('task_id'),
        //     'status' => 0,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ];
        // $result->insert($attr);

        $user_id = Auth::User()->id;
        $task_id = $request->get('task_id');
        $user = $this->userRepository->find($user_id);
        $user->tasks()->attach($task_id, [
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
            'report' => $request->get('report'),
        ]);

        return response()->json('OK', config('client.user.network'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user_id = Auth::user()->id;
        $task_id = $request->task_id;
        $user = $this->userRepository->find($user_id);
        foreach ($user->tasks as $task) {
            if($task->id == $task_id) {
                $result = $task->pivot->report;
            }
        }
        // $result = DB::table('user_task')->where([
        //     ['user_id', '=', $user_id],
        //     ['task_id', '=', $task_id],
        // ])->get();

        return response()->json(['result' => $result], config('client.user.network'));
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
