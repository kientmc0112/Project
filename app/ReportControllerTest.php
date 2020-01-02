<?php

namespace Tests\Unit\Controllers\Client;

use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\Client\ReportController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

class ReportControllerTest extends TestCase
{
    protected $userRepository;

    public function setUp(): void
    {
        $this->userRepository = Mockery::mock(UserRepositoryInterface::class);
        parent::setUp();
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStore()
    {
        $this->assertTrue(true);
    }

    public function testShow()
    {

    }
}
