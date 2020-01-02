<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Course;

class CourseMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    // public $course;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('kien.112.98@gmail.com', 'FTMS')
                    ->subject('List course & member')
                    ->markdown('client.mail.example');
    }
}
