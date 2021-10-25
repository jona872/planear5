<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Project::class, function (Faker $faker) {

    $latitude = (float) -31.7694011;
    $longitude = (float) -60.4544414;

    $radius = rand(1, 6); // in miles

    $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
    $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
    $lat_min = $latitude - ($radius / 69);
    $lat_max = $latitude + ($radius / 69);

    $lngProm = ($lng_min + $lng_max)/2;
    $latProm = ($lat_min + $lat_max)/2;
    // $lngProm = $lng_min;
    // $latProm = $lat_min;

    return [
        'project_name' => $faker->name,
        'city_id' => 1,
        'project_creator' => $faker->name,
        'project_latitud' => $latProm,
        'project_longitud' => $lngProm,
    ];
});
