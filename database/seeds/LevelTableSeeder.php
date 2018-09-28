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
            'level' => 'Gemiddeld',
        ]);

        DB::table('level')->insert([
            'level' => 'Goed',
        ]);

        DB::table('level')->insert([
            'level' => 'Expert',
        ]);
    }
}
