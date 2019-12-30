<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $year = Carbon::now()->year;
        for ($i=1; $i <= 12 ; $i++) { 
            $users = DB::table('users')
                ->where('role_id', 0)
                ->whereMonth('created_at', '<=', $i)
                ->whereYear('created_at', $year)
                ->count();
            $userDelete = DB::table('users')
                ->where('role_id', 0)
                ->whereMonth('deleted_at', '<' ,  $i)
                ->whereYear('created_at', $year)
                ->count();
            $count[] = $users + $userDelete;
        }
        return view('admin.dashboard.dashboard', compact('count'));
    }

    public function next(Request $request)
    {
        dd($request);
        for ($i=1; $i <= 12 ; $i++) { 
            $users = DB::table('users')
                ->where('role_id', 0)
                ->whereMonth('created_at', '<=', $i)
                ->whereYear('created_at', $year)
                ->count();
            $userDelete = DB::table('users')
                ->where('role_id', 0)
                ->whereMonth('deleted_at', '<' ,  $i)
                ->whereYear('created_at', $year)
                ->count();
            $count[] = $users + $userDelete;
        }
        return view('admin.dashboard.dashboard', compact('count'));
    }

    public function pre(Request $request)
    {
        
    }
}
