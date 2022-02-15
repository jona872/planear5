<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ToolData;
use Faker\Generator as Faker;

$factory->define(ToolData::class, function (Faker $faker) {
    return [
        'tool_id' => 1,
        'data_id' => 1
    ];
});
