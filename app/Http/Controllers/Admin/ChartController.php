<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Carbon\Carbon;
use Auth;
use DB;

class ChartController extends Controller
{
    public function chart()
    {
        $month = Carbon::now()->month;
        $listCourse = Course::all();
        foreach ($listCourse as $value) {
            $userCourse = DB::table('user_course')
                ->whereMonth('created_at', $month)
                ->where('course_id', $value->id)
                ->get();
            $count[] = count($userCourse);
            $courseName[] = $value->name;
        }
        
        return response()->json(['count' => $count , 'courseName' => $courseName], 200);
    }

    public function update(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $listCourse = Course::all();
        foreach ($listCourse as $value) {
            $userCourse = DB::table('user_course')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->where('course_id', $value->id)
                ->get();
            $count[] = count($userCourse);
            $courseName[] = $value->name;
        }
        
        return response()->json(['count' => $count , 'courseName' => $courseName], 200);
    }
}
