<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    const PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest('role_id')->paginate(self::PAGE);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password = $request->password;
        $repassword = $request->repassword;
        if ($password == $repassword) {
            $user = new User;
            $attr = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'role_id' => $request->get('role_id')
            ];
            if ($request->hasFile('avatar')) {  
                $destinationDir = public_path('images/avatar');
                $fileName = uniqid('avatar').'.'.$request->avatar->extension();
                $request->avatar->move($destinationDir, $fileName);
                $attr['avatar'] = '/images/avatar/'.$fileName;
            } else {
                $attr['avatar'] = '/images/avatar.jpg';
            }
            
            $user->create($attr);

            return redirect()->route('admin.users.index')->with('alert', trans('setting.add_user_success'));    
        } else {
            return redirect()->route('admin.users.create')->with('alert', trans('setting.checkpassoword'));
        }
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
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $password = $request->password;
        $repassword = $request->repassword;
        if ($password == $repassword) {
            $user = User::findOrFail($id);
            $attr = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'role_id' => $request->get('role_id')
            ];
            if ($request->hasFile('avatar')) {  
                $destinationDir = public_path('images/avatar');
                $fileName = uniqid('avatar').'.'.$request->avatar->extension();
                $request->avatar->move($destinationDir, $fileName);
                $attr['avatar'] = '/images/avatar/'.$fileName;
            } else {
                $attr['avatar'] = $user->avatar;
            }
            
            $user->update($attr);

            return redirect()->route('admin.users.index')->with('alert', trans('setting.edit_user_success'));    
        } else {
            return redirect()->route('admin.users.edit', $user->id)->with('alert', trans('setting.checkpassoword'));
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
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('alert', trans('setting.delete_user_success'));
    }
}
