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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'usuario'        =>  $faker->unique()->userName,
        'password'       => '$10$s8JpcKDYBC6Bw21/ws29gepT9xwDj8rVThIGLw299h.vKOW./Bl0.', // 123
        'condicion'      =>  1,
        'remember_token' =>  str_random(10),
    ];
});
