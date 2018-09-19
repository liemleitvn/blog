<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];

    public function posts() {
    	return $this->hasMany(\App\Models\Post::class);
    }

    public function users() {
    	return $this->belongsToMany(\App\Models\User::class,'posts')->withPivot('id','title','content');
    }
}
