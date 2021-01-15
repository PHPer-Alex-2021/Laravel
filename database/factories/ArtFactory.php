<?php

use Faker\Generator as Faker;

$factory->define(\App\Http\Model\Art::class, function (Faker $faker) {
    return [
        //
        'user_id' => $faker->randomElement([1,2,3]),
        'title' => $faker->text(100),//标题
        'click' => $faker->randomElement([1,2,3,4,5,6]),//点击
    ];
});
