<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'user_name' => $faker->name,
        'company_name' => $faker->company,
        'street_address' => $faker->streetAddress,
        'representative_name' => $faker->name
    ];
});
