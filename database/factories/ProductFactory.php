<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name' => $this->faker->words,
        'price' => $this->faker->numberBetween(
            $min = 0,
            $max = 200
        ),
        'stock' => $this->faker->numberBetween(
            $min = 0,
            $max = 150
        ),
        'comment' => $this->faker->array,
        'img_path' => $this->faker->image
    ];
});
