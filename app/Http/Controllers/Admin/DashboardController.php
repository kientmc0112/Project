<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $year = Carbon::now()->year;
        for ($i=1; $i <= 12 ; $i++) { 
            $users = User::whereMonth('created_at', '<=', date($i))
                ->where('role_id', 0)
                ->whereYear('created_at', '=', date($year))
                ->count();
            $userDelete = User::onlyTrashed()
                ->whereMonth('created_at', '=', date($i))
                ->where('role_id', 0)
                ->whereYear('created_at', '=', date($year))
                ->count();
            $count[] = $users + $userDelete;
        }

        return view('admin.dashboard.dashboard', compact('count'));
    }

    public function update(Request $request)
    {
        $year = $request->year;
        for ($i=1; $i <= 12 ; $i++) { 
            $users = User::whereMonth('created_at', '<=', date($i))
                ->where('role_id', 0)
                ->whereYear('created_at', '=', date($year))
                ->count();
            $userDelete = User::onlyTrashed()
                ->whereMonth('created_at', '=', date($i))
                ->where('role_id', 0)
                ->whereYear('created_at', '=', date($year))
                ->count();
            $count[] = $users + $userDelete;
        }

        return view('admin.dashboard.dashboard', compact('count'));
    }
}
