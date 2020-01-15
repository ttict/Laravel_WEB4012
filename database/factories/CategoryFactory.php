<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $user_id = User::all()->pluck('id')->toArray();
    return [
        'name' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'user_id' => $faker->randomElement($user_id),
        'parent_id' => Category::count() ? Category::pluck('id')->random() : 0,
    ];
});
