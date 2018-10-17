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
            'id' => '1',
            'name' => 'JavaScript',
        ]);
        DB::table('skills')->insert([
            'id' => '2',
            'name' => 'PHP',
        ]);
    }
}
