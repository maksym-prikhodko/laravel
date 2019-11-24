<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->defineAs(Product::class, 'product', function (Faker $faker) {
    return [
        'sku'=>$faker->randomNumber(8)
    ];
});
