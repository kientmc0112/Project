<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Jobs\JobMail;
use Carbon\Carbon;

class MailController extends Controller
{
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
        // $times = now()->addMinutes(1);
        // $course_id = 1;
        // $course = Course::find($course_id);
        // Mail::to('kien.112.1998@gmail.com')
        //     ->later($times, new CourseMail($course));
        // $jobmail = new JobMail($course);
        $emailJob = (new JobMail())->delay(Carbon::now()->addMinutes(5));
        dispatch($emailJob);
        // JobMail::dispatch()
        //     ->delay(now()->addMinutes(1));
    }
}
