<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::latest('id')->paginate(config('course.PagePaginate'));
        $users = User::where('role_id', 1)->get();

        return view('client.index', compact('courses', 'users'));
    }
}
