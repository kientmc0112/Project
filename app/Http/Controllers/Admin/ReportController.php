<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use DB;
use Mail;
use App\Jobs\SendReportJob;
use Carbon\Carbon;
use Auth;

class ReportController extends Controller
{
    public function index()
    {
        $userTask= DB::table('user_task')
        ->whereNull('comment')
        ->whereNotNull('report')
        ->paginate(5);
        $users = User::all();
        $tasks = Task::all();

        return view('admin.reports.index', compact('userTask', 'users', 'tasks'));
    }
    public function store(Request $request, $id)
    {
        DB::table('user_task')
            ->where('id', $id)
            ->update(['comment' => $request->comment]);
        $taskUser = DB::table('user_task')
            ->where('id', $id)
            ->get();
        foreach ($taskUser as  $value) {
            $comment = $value->comment;
        }
        $user = Auth::User();
        $job = (new SendReportJob($comment, $user))->delay(Carbon::now()->addSeconds(5));
        dispatch($job);

        return redirect()
            ->route('admin.reports.index')
            ->with('alert', trans('commented'));
    }

    public function showComment()
    {
        $userTask= DB::table('user_task')
            ->whereNotNull('comment')
            ->paginate(5);
        $users = User::all();
        $tasks = Task::all();
        return view('admin.reports.show_comment', compact('userTask', 'users', 'tasks'));
    }

    public function finish($id)
    {
        $check = DB::table('user_task')
        ->where('id', $id)
        ->update(['status' => 1]);

        return redirect()->route('admin.reports.show_comment')->with('alert', trans('commented'));
    }
}
