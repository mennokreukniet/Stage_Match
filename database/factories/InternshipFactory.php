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

$factory->define(App\Internship::class, function (Faker $faker) {
    $offset = rand(1,6);
    return [
        'company_id' => App\Company::inRandomOrder()->first()->id,
        'mentor' => $faker->name,
        'start' => $start = $faker->date(),
        'end' => date('Y-m-d', strtotime("+$offset months", strtotime($start)))
    ];
});
