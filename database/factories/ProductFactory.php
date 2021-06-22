<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //
        'title'=>$faker->Sentence(6),
        'price'=>$faker->numberBetween(50,300),
        'image'=>$faker->imageUrl($width=640,$haight=480),
    ];
});
