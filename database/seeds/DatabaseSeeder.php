<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SkillsTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(Skill_CategoryTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(InternshipTableSeeder::class);
        $this->call(Internship_SkillsTableSeeder::class);
        $this->call(LevelTableSeeder::class);
        $this->call(Student_SkillTableSeeder::class);

    }
}
