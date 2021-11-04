<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tool;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Tool::class, function (Faker $faker) {
    return [
        'tool_name' => $faker->unique()->name,
        'user_id' => 1
    ];
});
