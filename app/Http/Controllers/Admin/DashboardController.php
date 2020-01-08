<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Repositories\Course\CourseRepositoryInterface;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $userLastYear = User::where('role_id', 0)
            ->whereYear('created_at', '<', date($year))
            ->count();
        for ($i=1; $i <= 12 ; $i++) {
            if ($month >= $i) {
                 $users = User::whereMonth('created_at', '<=', date($i))
                    ->where('role_id', 0)
                    ->whereYear('created_at', '=', date($year))
                    ->count();
                $userDelete = User::onlyTrashed()
                    ->whereMonth('created_at', '=', date($i))
                    ->where('role_id', 0)
                    ->whereYear('created_at', '=', date($year))
                    ->count();
                $count[] = $users + $userDelete + $userLastYear;
            }
        }
        $courses = $this->courseRepository->groupCourseByYear();
        $data = array();
        foreach ($courses as $key => $course) {
            $data[$key] = $course->count();
        }

        return view('admin.dashboard.dashboard', compact('count', 'data'));
    }

    public function update(Request $request)
    {
        $year = $request->year;
        $userLastYear = User::where('role_id', 0)
            ->whereYear('created_at', '<', date($year))
            ->count();
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
            $count[] = $users + $userDelete + $userLastYear;
        }
        $courses = $this->courseRepository->groupCourseByYear();
        $data = array();
        foreach ($courses as $key => $course) {
            $data[$key] = $course->count();
        }

        return view('admin.dashboard.dashboard', compact('count', 'data'));
    }
    public function chart()
    {
        $user = User::all();

        return response()->json(['user' => $user], 200);
    }
}
