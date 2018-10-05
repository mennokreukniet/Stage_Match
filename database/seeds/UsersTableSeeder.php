<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'role' => '3',
            'password' => 'welkom01',
            'city' => 'Dordrecht',
            'street' => 'Marienbornstraat',
            'house_number' => '58',
        ]);

        DB::table('users')->insert([
            'name' => 'student',
            'email' => 'student@student.student',
            'role' => '1',
            'password' => 'welkom01',
            'city' => 'Dordrecht',
            'street' => 'Marienbornstraat',
            'house_number' => '58',
        ]);

        DB::table('users')->insert([
            'name' => 'company',
            'email' => 'company@company.company',
            'role' => '2',
            'password' => 'welkom01',
            'city' => 'Dordrecht',
            'street' => 'Marienbornstraat',
            'house_number' => '58',
        ]);

    }
}
