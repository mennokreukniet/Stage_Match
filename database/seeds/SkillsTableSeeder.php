<?php

use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            'name' => 'php',
        ]);

        DB::table('skills')->insert([
            'name' => 'lua',
        ]);

        DB::table('skills')->insert([
            'name' => 'mysql',
        ]);

        DB::table('skills')->insert([
            'name' => 'javascript',
        ]);

        DB::table('skills')->insert([
            'name' => 'laravel',
        ]);
    }
}
