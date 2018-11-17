<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Brand::class, function (Faker $faker) {
    return [
        'name'    => $faker->word,
        'slug'	  => str_slug($faker->word) . '-' . rand(1, 585858),
        'details' => $faker->paragraph,
        'status'  => rand(0,1),
    ];
});
