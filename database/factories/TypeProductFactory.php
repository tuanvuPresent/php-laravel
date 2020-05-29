<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\TypeProduct::class, function (Faker $faker) {
    return [
        'name' => $faker->text(32),
    ];
});
