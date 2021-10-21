<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Province;
use Faker\Generator as Faker;

$factory->define(Province::class, function (Faker $faker) {
    return [
        'province_name' => $faker->name,
        'country_id' => 1,
    ];
});
