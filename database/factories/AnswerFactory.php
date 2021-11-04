<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'answer_name' => $faker->sentence(2),
    ];
});
