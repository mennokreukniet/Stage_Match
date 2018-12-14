<?php

use Illuminate\Database\Seeder;

class InternshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 200 random internships with a random related company

        factory(App\Internship::class, 200)->create();
    }
}
