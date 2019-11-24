<?php

use Illuminate\Database\Seeder;

class InitCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 15; $i++) {
            DB::table('courses')->insert([
                'category_id' => $i,
                'name' => 'Course '.$i,
                'description' => 'Course '.$i,
                'status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
