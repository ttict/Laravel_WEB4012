<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];
	public function users()
	{
		// return $this->belongsToMany('App\Models\User', 'role_user');
		return $this->belongsToMany('App\Models\User', 'role_user', 'role_id', 'user_id');
	}
}
