<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DataAnswer;
use Faker\Generator as Faker;

$factory->define(DataAnswer::class, function (Faker $faker) {
    return [
        'data_id' => 1,
        'answer_id' => 1,
        'relevamiento_id' => 1,
    ];
});
