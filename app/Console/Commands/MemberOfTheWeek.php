<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Jobs\JobMail;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class MemberOfTheWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:weekend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a email in Friday every weekend to admin with all courses & members';
    protected $courseRepository;
    protected $userRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CourseRepositoryInterface $courseRepository,UserRepositoryInterface $userRepository)
    {
        parent::__construct();
        $this->courseRepository = $courseRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = $this->courseRepository->getAll();
        $users = $this->userRepository->getAll();
        $emailJob = new JobMail($data, $users);
        dispatch($emailJob);
    }
}
