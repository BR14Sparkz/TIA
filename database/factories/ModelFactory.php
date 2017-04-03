<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->word,
        'dob' => Carbon\Carbon::parse('July 6th 1993'),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'title' => $faker->word(2),
        'image' => 'https://placehold.it/400x200',
        'content' => $faker->paragraph(5),
        'post_on' => Carbon\Carbon::parse('+1 week'),
        'live' => $faker->boolean(), 
    ];
});