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
        for ($i = 1; $i <= 18; $i++) {
            DB::table('courses')->insert([
                'category_id' => $i,
                'name' => 'Course '.$i,
                'description' => 'Course '.$i,
                'status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 18; $i++) {
            DB::table('courses')->insert([
                'category_id' => $i,
                'name' => 'Course '.(18+$i),
                'description' => 'Course '.(18+$i),
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
