<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Course\CourseRepositoryInterface;

class ChartController extends Controller
{
    protected $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
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
    public function show($id)
    {
        //
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

    public function month(Request $request)
    {
        if($request->status == 0) {
            $year = $request->year;
            $data = array();
            for ($i = 1; $i <= 12; $i++) {
                if ($i < 10) $i = '0' . $i;
                $courses = $this->courseRepository->groupCourseByMonth($year, $i);
                $data[] = $courses;
            }
        } else {
            $courses = $this->courseRepository->groupCourseByYear();
            $data = array();
            foreach ($courses as $key => $course) {
                $data[$key] = $course->count();
            }
        }

        return response()->json(['data' => $data], config('client.user.network'));
    }

    public function year()
    {
        $courses = $this->courseRepository->groupCourseByYear();
        $data = array();
        foreach ($courses as $key => $course) {
            $data[$key] = $course->count();
        }

        return view('client.chart.bar', compact('data'));
    }
}
