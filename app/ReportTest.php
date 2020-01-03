<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class CourseTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_show_report()
    {
        $this->browse(function (Browser $browse) {
            $browse->visit('http://127.0.0.1:8000/courses/1/show')
                ->type('email', 'kientmc0112@gmail.com')
                ->type('password', '12345678')
                ->click('#login')
                ->waitFor('#course1')
                ->click('#course1')
                ->assertUrlIs('http://127.0.0.1:8000/courses/1/show');
        });
    }
}
