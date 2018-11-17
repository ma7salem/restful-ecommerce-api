<?php

use Faker\Generator as Faker;
use App\Models\Category;
use App\Models\Brand;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name'    => $faker->word,
        'slug'	  => str_slug($faker->word) . '-' . rand(1, 585858),
        'details' => $faker->paragraph,
        'status'  => rand(0,1),
        'price'	  => $faker->randomFloat(2, 0, 50),
        'brand_id'=> function(){
        	return Brand::all()->random();
        },
        'category_id' => function(){
        	return Category::all()->random();
        }

    ];
});
