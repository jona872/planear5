<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Relevamiento;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Relevamiento::class, function (Faker $faker) {
    return [
        'relevamiento_creator' => $faker->unique()->name,
        'project_id' => 1,
        'tool_id' => 1,
        'user_id' => 1,
        'relevamiento_latitud' => Str::random(10),
        'relevamiento_longitud' => Str::random(10),
    ];
});
