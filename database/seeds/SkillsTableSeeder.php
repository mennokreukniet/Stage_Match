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
        $skills = [
            'PHP', 'Laravel', 'JavaScript', 'Vue.js', 'SQL',
            'Python', 'Ruby', 'C', 'C++', 'C#', 'Objective-C', 'Java',
            'Brainfuck', 'Chicken', 'LOLCODE'
        ];

        if (DB::table('skills')->count() < count($skills)) {
            foreach ($skills as $skill) {
                DB::table('skills')->insert(['name' => $skill]);
            }
        }
    }
}
