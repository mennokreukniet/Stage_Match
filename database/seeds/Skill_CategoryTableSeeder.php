<?php

use Illuminate\Database\Seeder;

class Skill_CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skill_category')->insert([
            'skill_id' => '1',
            'category_id' => '1',
        ]);

        DB::table('skill_category')->insert([
            'skill_id' => '2',
            'category_id' => '1',
        ]);

        DB::table('skill_category')->insert([
            'skill_id' => '3',
            'category_id' => '1',
        ]);

        DB::table('skill_category')->insert([
            'skill_id' => '4',
            'category_id' => '1',
        ]);

        DB::table('skill_category')->insert([
            'skill_id' => '5',
            'category_id' => '1',
        ]);
    }
}
