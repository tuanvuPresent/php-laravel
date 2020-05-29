<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->text(32),
        'price' => $faker->numberBetween(10, 1000),
        'quantity' => $faker->numberBetween(10, 1000),
        'image' => 'none',
        'type_products_id' => function () {
            return App\TypeProduct::inRandomOrder()->first()->id;
        }
    ];
});
