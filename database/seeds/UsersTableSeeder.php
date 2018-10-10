<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash as Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultUsers = [
            [
                'email' => 'student@student.student',
                'name' => 'student',
                'role' => '1',
                'password' => Hash::make('123456')
            ],
            [
                'email' => 'company@company.company',
                'name' => 'company',
                'role' => '2',
                'password' => Hash::make('123456')
            ],
            [
                'email' => 'admin@admin.admin',
                'name' => 'admin',
                'role' => '3',
                'password' => Hash::make('123456')
            ]
        ];
        #where(['email' => $user['email']])){
        foreach ($defaultUsers as $user) {
            if (App\User::find(4) == null) {
                App\User::create($user); // ::createOrFirst should insert only if it isn't already in db. doesn't work:(
            }
        };

        factory(App\User::class, 20)->create()->each(function ($user) {
            $user->company()->save(factory(App\Company::class)->make());
        });
        factory(App\User::class, 40)->create()->each(function ($user) {
            $user->student()->save(factory(App\Student::class)->make());
        });

    }
}
