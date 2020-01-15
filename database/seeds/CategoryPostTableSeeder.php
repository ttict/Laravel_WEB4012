<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CategoryPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$categories = Category::all();
        $posts = Post::all();
        $categories->each(function (App\Models\Category $category) use ($posts) {
            $category->posts()->attach(
                Post::select('id')->inRandomOrder()->first()
            );
        });*/
        $categories = Category::all();
        $posts = Post::all();
        $posts->each(function (App\Models\Post $post) use ($categories) {
            $post->categories()->attach(
                Category::select('id')->inRandomOrder()->first()
            );
        });
    }
}
