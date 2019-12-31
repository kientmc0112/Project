<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::all()->random()->id,
        'course_id' => App\Models\Course::all()->random()->id,
        'status' => '0',
        'process' => '1/8',
        'created_at' => now(),
        'updated_at' => now(),
    ];
});

