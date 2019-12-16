<?php

namespace Tests\Unit\Controllers\Client;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;
use App\Repositories\User\UserRepositoryInterface;

class ReportControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private $userRepo;
    public function setUp(): void
    {
        $this->userRepo = Mockery::mock(UserRepositoryInterface::class);
        parent::setup();
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
