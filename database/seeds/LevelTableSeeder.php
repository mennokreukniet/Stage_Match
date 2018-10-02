<?php

use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('level')->insert([
            'level' => 'Average',
        ]);

        DB::table('level')->insert([
            'level' => 'Good',
        ]);

        DB::table('level')->insert([
            'level' => 'Expert',
        ]);
    }
}
