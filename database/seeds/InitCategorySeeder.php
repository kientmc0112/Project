<?php

use Illuminate\Database\Seeder;

class InitCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            DB::table('categories')->insert([
                'parent_id' => '0',
                'name' => 'Category '.$i,
                'description' => 'Category '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 3; $i++) {
            DB::table('categories')->insert([
                'parent_id' => '1',
                'name' => 'Category 1-'.$i,
                'description' => 'Category 1-'.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 3; $i++) {
            DB::table('categories')->insert([
                'parent_id' => '2',
                'name' => 'Category 2-'.$i,
                'description' => 'Category 2-'.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 3; $i++) {
            DB::table('categories')->insert([
                'parent_id' => '3',
                'name' => 'Category 3-'.$i,
                'description' => 'Category 3-'.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 3; $i++) {
            DB::table('categories')->insert([
                'parent_id' => '4',
                'name' => 'Category 4-'.$i,
                'description' => 'Category 4-'.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 3; $i++) {
            DB::table('categories')->insert([
                'parent_id' => '5',
                'name' => 'Category 5-'.$i,
                'description' => 'Category 5-'.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
