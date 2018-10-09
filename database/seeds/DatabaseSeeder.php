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
        $this->call([
            UsersTableSeeder::class,
            SkillsTableSeeder::class,
            InternshipTableSeeder::class
            /*
            SkillsTableSeeder::class,
            CategoryTableSeeder::class,
            Skill_CategoryTableSeeder::class,
            StudentTableSeeder::class,
            InternshipTableSeeder::class,
            Internship_SkillsTableSeeder::class,
            LevelTableSeeder::class,
            Student_SkillTableSeeder::class,*/
        ]);


    }
}
