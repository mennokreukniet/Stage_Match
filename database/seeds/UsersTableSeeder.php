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
        $defaultUsers = [
            [
                'email' => 's@s.s',
                'name' => 'student',
                'city' => 'Dordrecht',
                'street' => 'Dordrecht',
                'house_number' => 12,
                'role' => 1,
                'password' => '$2y$10$XssWkV9qLq/tceJESzggHe8urDnDkqwqukcUJ44m7lnNNGuukYAFW' # password: 123456
            ],
            [
                'email' => 'c@c.c',
                'name' => 'company',
                'city' => 'Dordrecht',
                'street' => 'Dordrecht',
                'house_number' => 12,
                'role' => 2,
                'password' => '$2y$10$XssWkV9qLq/tceJESzggHe8urDnDkqwqukcUJ44m7lnNNGuukYAFW' # password: 123456
            ],
            [
                'email' => 'a@a.a',
                'name' => 'admin',
                'city' => 'Dordrecht',
                'street' => 'Dordrecht',
                'house_number' => 12,
                'role' => 3,
                'password' => '$2y$10$XssWkV9qLq/tceJESzggHe8urDnDkqwqukcUJ44m7lnNNGuukYAFW' # password: 123456
            ]
        ];
        if (DB::table('users')->count() <= count($defaultUsers)) {
            foreach ($defaultUsers as $user) {

                $user = App\User::create($user);

                if ($user->role == USER_ROLES['student']) {

                    $user->student()->save(
                        factory(App\Student::class)->make()
                    );

                } else if ($user->role == USER_ROLES['company']) {

                    $user->company()->save(
                        factory(App\Company::class)->make()
                    );
                    factory(App\Internship::class, rand(50,100))->create();

                }
            }
        };

        factory(App\User::class, 100)->make()->each(function ($user, $i) {
            if ($i < 50) {
                $user->role = USER_ROLES['student'];
                $user->save();

                $user->student()->save(
                    factory(App\Student::class)->make()
                );
            } else {
                $user->role = USER_ROLES['company'];
                $user->save();

                $user->company()->save(
                    factory(App\Company::class)->make()
                );

            }

        });


    }
}
