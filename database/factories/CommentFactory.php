<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $post_id = Post::all()->pluck('id')->toArray();
    $user_id = User::all()->pluck('id')->toArray();
    return [
        'content' => $faker->text($maxNbChars = 20),
        'post_id' => $faker->randomElement($post_id),
        'user_id' => $faker->randomElement($user_id),
        'is_active' => $faker->boolean,
    ];
});
