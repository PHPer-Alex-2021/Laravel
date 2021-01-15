<?php

use Faker\Generator as Faker;

$factory->define(\App\Http\Model\Category::class, function (Faker $faker) {
    return [
        'cate_name' => $faker->text(6),
        'cate_title' =>  $faker->text(8), // secret
        'cate_keywords' => $faker->text(10),
        'cate_description' => $faker->text(50),
        'cate_view' => $faker->randomElement([1,2,3,4,5,6]),
        'cate_order' => $faker->randomElement([1,2,3,4,5,6]),
        'cate_pid' =>$faker->randomElement([1,2,3,4,5,6]),
    ];
});
