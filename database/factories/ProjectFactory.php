<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'project_name' => $faker->name,
        'city_id' => 1,
        'project_creator' => $faker->name,
        'project_latitud' => '-'.Str::random(2).'.'.Str::random(7),
        'project_longitud' => '-'.Str::random(2).'.'.Str::random(7),
    ];
});