<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;

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
    public function show(Request $request)
    {
        $courses = Course::all();
        $subjects = Subject::with('courses')->get();
        foreach ($subjects->courses as $course) {
            $course->id;
        }
        dd($course);
        // return view('admin.subjects.show', compact('subjects','courses'));
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
