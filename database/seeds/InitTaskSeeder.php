<?php

use Illuminate\Database\Seeder;

class InitTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('tasks')->insert([
                'subject_id' => '1',
                'name' => 'Task '.$i,
                'description' => 'Task '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            DB::table('tasks')->insert([
                'subject_id' => '2',
                'name' => 'Task '.$i,
                'description' => 'Task '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            DB::table('tasks')->insert([
                'subject_id' => '3',
                'name' => 'Task '.$i,
                'description' => 'Task '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            DB::table('tasks')->insert([
                'subject_id' => '4',
                'name' => 'Task '.$i,
                'description' => 'Task '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            DB::table('tasks')->insert([
                'subject_id' => '5',
                'name' => 'Task '.$i,
                'description' => 'Task '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
