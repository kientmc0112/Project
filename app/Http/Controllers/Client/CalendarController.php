<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $events = [];
        // $data = DB::table('user_task');
        // if($data->count())
        //  {
        //     foreach ($data as $key => $value)
        //     {
        //         $events[] = Calendar::event(
        //             $value->id,
        //             true,
        //             new \DateTime($value->created_at),
        //             new \DateTime($value->updated_at.'+1 day'),
        //             null,
        //             // Add color
        //             [
        //                 'color' => '#000000',
        //                 'textColor' => '#008000',
        //             ]
        //         );
        //     }
        // }
        // $calendar = Calendar::addEvents($events);
        // return view('client.calender.index', compact('calendar'));

        $tasks = DB::table('user_task');
        return view('client.calender.index', compact('tasks'));
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
}
