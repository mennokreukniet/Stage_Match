<?php

use Illuminate\Database\Seeder;

class Student_SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_skill')->insert([
            'student_id' => '1',
            'skill_id' => '1',
        ]);

        DB::table('student_skill')->insert([
            'student_id' => '2',
            'skill_id' => '1',
        ]);
    }
}
