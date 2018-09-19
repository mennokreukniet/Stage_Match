<?php

use Illuminate\Database\Seeder;

class Internship_SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('internship_skills')->insert([
            'internship_id' => '1',
            'skill_id' => '1',
        ]);
    }
}
