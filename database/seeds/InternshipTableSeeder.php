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
        DB::table('internship')->insert([
            'company_id' => '1',
            'mentor' => 'Dhr. Visser',
            'period' => '16 sept - 38 dec',
        ]);
    }
}
