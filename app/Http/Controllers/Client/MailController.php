<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Jobs\JobMail;
use Carbon\Carbon;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use Auth;

class MailController extends Controller
{
    protected $courseRepository;
    protected $taskRepository;

    public function __construct(CourseRepositoryInterface $courseRepository, TaskRepositoryInterface $taskRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->taskRepository = $taskRepository;
    }

    public function basic()
    {
        $data = array('name' => "Trần Kiên");
        Mail::send(['text' => 'client.mail.form'], $data, function ($message) {
            $message->to('kien.112.1998@gmail.com')->subject('Hello Kitty');
            $message->from('kien.112.98@gmail.com', 'Chính Kiên');
        });
        echo "Sent basic email.";
    }

    public function html()
    {
        $data = array('name' => "Trần Kiên");
        Mail::send('client.mail.form', $data, function ($message) {
            $message->to('kien.112.1998@gmail.com')->subject('Hello Kitty');
            $message->from('kien.112.98@gmail.com', 'Chính Kiên');
        });
        echo "HTML Email Sent. Check your inbox.";
    }

    public function attach()
    {
        $data = array('name' => "Trần Kiên");
        Mail::send('client.mail.form', $data, function ($message) {
            $message->to('kien.112.1998@gmail.com')->subject('Hello Kitty');
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('kien.112.98@gmail.com', 'Chính Kiên');
        });
        echo "Sent email with attachment.";
    }

    public function more()
    {
        $data = Course::find(1)->toArray();
        Mail::send('client.mail.form', $data, function ($message) {
            $message->to('kien.112.1998@gmail.com')->subject('Hello Kitty');
            // $message->cc('cupid.psyche.9x@gmail.com')->subject('Hello Kitty');
            // $message->bcc('kientmc0112@gmail.com')->subject('Hello Kitty');
            // $message->from('kien.112.98@gmail.com', 'Chính Kiên');
        });
        echo "Sent email for more people.";
    }

    public function queue()
    {
        $data = $this->courseRepository->getAll();
        // $times = now()->addMinutes(1);
        // $course_id = 1;
        // $course = Course::find($course_id);
        // Mail::to('kien.112.1998@gmail.com')
        //     ->later($times, new CourseMail($course));
        // $jobmail = new JobMail($course);
        $emailJob = (new JobMail($data))->delay(Carbon::now()->addMinutes(1));
        dispatch($emailJob);
        // JobMail::dispatch()
        //     ->delay(now()->addMinutes(1));
    }

    public function test()
    {
        // $cate = Category::find(2)->with('categories');
        // $user = User::find(2);
        // $user1 = User::find(2)->with('courses.pivot.status');
        // $user1 = User::with('courses.pivot.status')->first();
        // dd($user1);

        // $course_id = 1;
        // $user_id = Auth::user()->id;
        // $user = User::with('courses.pivot.status')->find($user_id);
        // foreach ($user->courses as $course) {
        //     if($course->id == $course_id) {
        //         $permiss = $course->pivot->status;
        //     }
        // }
        // dd($permiss);
        $date1 = date('Y-m-d');
        $date1 = strtotime($date1);
        echo $date1;
        $date = "2020-01-05 17:32:35";
        $date = strtotime($date) + 48*60*60;
        $date = date('Y-m-d', $date);
        if($date == $date1) {
            echo 1;
        }
        // dd($date);
    }
}
