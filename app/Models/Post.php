<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'avatar', 'alias', 'keywords', 'description', 'user_id'];
    //public $timestamps = false;

    public function categories () {
        return $this->belongsToMany('App\Models\Category', 'category_post', 'post_id', 'category_id')->withPivot('category_id','post_id');
    }

    public function user () {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public static function postSearch($keyword, $paginate){
        return Post::where('title', 'like', '%' . $keyword . '%')->paginate($paginate, ['*'], 'pp');
    }
}
