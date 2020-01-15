<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $category_id = Category::all()->pluck('id')->toArray();
    $user_id = User::all()->pluck('id')->toArray();
    return [
        'title' => $faker->sentence($nbWords = 8, $variableNbWords = true),
        'content' => $faker->text($maxNbChars = 100),
        'user_id' => $faker->randomElement($user_id),
        'avatar' => $faker->image('public\storage\upload\images',80,80,null,false),
    ];
});
