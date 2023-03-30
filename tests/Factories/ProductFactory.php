<?php

use Faker\Generator as Faker;
use Rezkonline\LaravelMetaPixel\Tests\Models\Product;

/* @var ModelFactory $factory */

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->title(),
        'category' => $faker->word,
        'price' => $faker->numberBetween(1500, 6000),
        'currency' => $faker->currencyCode(),
    ];
});
