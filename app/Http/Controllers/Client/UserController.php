<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Task;
use DB;

class UserController extends Controller
{
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
        $user = User::find($id);
        $courses = DB::table('user_course')
            ->where('user_id', $id)
            ->get();
        $listCourse = Course::all();
        $subjects = DB::table('user_subject')
            ->where('user_id', $id)
            ->get();
        $listSubject = Subject::all();
        $tasks = DB::table('user_task')
        ->where('user_id', $id)
        ->get();
        $listTask = Task::all();
        return view('client.user.profile', compact('user', 'courses', 'listCourse', 'subjects', 'listSubject', 'tasks', 'listTask'));
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
    public function update(ClientRequest $request, $id)
    {
        // $data = $request->all();
        // $user = User::find($id);
        // $user->name = $data['name'];
        // $user->phone = $data['phone'];
        // $user->address = $data['address'];
        // $user->avatar =  '/images/avatar/'.$data['avatar'];
        // $user->save();

        // return redirect(route('user.show', $id));

        // $validator = Validator::make($request->input(), array(
        //     'name' => 'required|min:3|max:50',
        //     'phone' => 'required|min:10|numeric',
        //     'address' => 'required',
        // ));

        $validator = $request->validated();
        if (is_object($validator)) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], config('user.422-UE'));
        }
        try {
            $user = User::findOrFail($id);
            $attr = [
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'avatar' => $request->get('avatar'),
            ];
            $user->update($attr);

            return response()->json(['user' => $user], config('user.200-OK'));
        } catch (Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
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
