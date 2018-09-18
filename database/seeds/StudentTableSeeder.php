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
            'name' => 'Menno',
            'last_name' => 'Kreukniet',
            'age' => '19',
            'gender' => 'male',
            'phone_number' => '0687063340',
            'email' => 'menno.kreukniet@hotmail.com',
            'current_education' => 'applicatieontwikkeling',
            'education_level' => 'mbo4',
            'finished_education' => 'insula college mavo',
        ]);

        DB::table('student')->insert([
            'name' => 'Dylan',
            'last_name' => 'de Leeuw',
            'age' => '18',
            'gender' => 'male',
            'phone_number' => '064432853',
            'email' => 'dylandeleeuw@isgay.com',
            'current_education' => 'applicatieontwikkeling',
            'education_level' => 'mbo4',
            'finished_education' => 'insula college mavo',
        ]);
    }
}
