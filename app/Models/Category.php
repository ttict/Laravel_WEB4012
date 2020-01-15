<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'user_id', 'alias', 'description', 'keywords', 'parent_id'];

    public function user () {
        return $this->belongsTo('App\Models\User');
    }
    public function posts () {
        return $this->belongsToMany('App\Models\Post', 'category_post', 'category_id', 'post_id')->withPivot('category_id','post_id');
    }
}
