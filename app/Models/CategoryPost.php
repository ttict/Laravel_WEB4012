<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
	protected $table = 'category_post';
    protected $primaryKey = ['category_id', 'post_id'];
	public $incrementing = false;
}
