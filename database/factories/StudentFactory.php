<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Student::class, function (Faker $faker) {
    $schools = [ 'ROC Da Vinci College', 'Zadkine', 'Albeda' ];
    return [
        'date_of_birth' => $faker->date(),
        'gender' => rand(0,1) ? "male" : "female",
        'school' => $schools[array_rand($schools)]
    ];
});

