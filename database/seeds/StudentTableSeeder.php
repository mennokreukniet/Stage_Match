<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student')->insert([
            'user_id' => '1',
            'school' => 'Da Vinci College',
            'date_of_birth' => '1999-08-10',
            'gender' => 'male',
        ]);

        DB::table('student')->insert([
            'user_id' => '2',
            'school' => 'Da Vinci College',
            'date_of_birth' => '1999-10-07',
            'gender' => 'male',
        ]);
    }
}
