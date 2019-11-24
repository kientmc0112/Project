<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use DB;

class SubjectController extends Controller
{
    const PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $subjects = Subject::latest('id')->with('courses')->paginate(self::PAGE);

        return view('admin.subjects.index', compact('courses', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = new Subject;
        $attr= [
            'name' => $request->get('name'),
            'status' => $request->get('status'),
            'description' => $request->get('description'),
        ];
        $subject->create($attr);

        return redirect()->route('admin.subjects.index')->with('alert', trans('setting.add_subject_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        $users = Subject::find($id)->users()->get();
        $tasks = Subject::find($id)->tasks()->get();
        $listUser = User::all();
        return view('admin.subjects.show', compact('subject','users','listUser','tasks'));
    }

    public function postShow(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $user_id = $request->user_id;
        $check = DB::table('user_subject')->where('subject_id', $id)->where('user_id', $user_id)->get();
        if (count($check) >= 1) {
            return redirect()->route('admin.subjects.show', $subject->id)->with('alert', 'User dang hoc tai course nay!');    
        } else {
            Subject::find($id)->users()->attach($request->user_id);
            return redirect()->route('admin.subjects.show', $subject->id)->with('Assign User to Course success!');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('admin.subjects.edit', compact('subject'));
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
        $subject = Subject::findOrFail($id);
        $attr = [
            'name' => $request->get('name'),
            'status' => $request->get('status'),
            'description' => $request->get('description'),
        ];
        $subject->update($attr);

        return redirect()->route('admin.subjects.index')->with('alert', trans('setting.edit_subject_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('alert', trans('setting.delete_subject_success'));
    }
}
