<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;

class Post extends Model
{
    //
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'user_id', 'category_id', 'slug'];

     protected $appends = ['category','user'];


     public function getCategoryAttribute() {
         return Category::find($this->category_id)->name;
     }

     public function getUserAttribute() {
         return User::find($this->user_id)->name;
     }

    public function categorie() {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function user () {
        return $this->belongsTo(\App\Models\User::class);
    }

}


