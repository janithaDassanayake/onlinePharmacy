<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\product;
use Faker\Generator as Faker;

$factory->define(product::class, function (Faker $faker) {
    return [


        'name' => $faker->sentence(2),
        'description' => $faker->sentence(10),
        'price' => $faker->numberBetween(100,700),


    ];
});
