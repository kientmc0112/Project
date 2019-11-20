<?php

use Illuminate\Database\Seeder;

class InitSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('subjects')->insert([
                'name' => 'Subject '.$i,
                'description' => 'Subject '.$i,
                'status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
