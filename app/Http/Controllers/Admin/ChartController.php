<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use DB;

class ChartController extends Controller
{
    public function chart()
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
        
        return response()->json(['count' => $count], 200);
    }

    public function update(Request $request)
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
        
        return response()->json(['count' => $count], 200);
    }
}
