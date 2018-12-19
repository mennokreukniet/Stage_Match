<?php

use Illuminate\Database\Seeder;

class User_LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_location')->insert([
            'user_id' => '2',
            'location_id' => '1920',
        ]);

        DB::table('user_location')->insert([
            'user_id' => '1',
            'location_id' => '1920',
        ]);
    }
}
