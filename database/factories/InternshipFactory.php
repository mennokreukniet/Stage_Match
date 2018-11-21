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
    $offset = rand(2,8);
    return [
        'company_id' => App\Company::inRandomOrder()->first()->id,
        'mentor' => $faker->name,
        'title' => $faker->jobTitle,
        'body' => $faker->realText(256),
        'start_date' => $start = $faker->date(),
        'end_date' => date('Y-m-d', strtotime("+$offset months", strtotime($start)))
    ];
});
