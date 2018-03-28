<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = "posts";

    public function comment() {
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'cat_id', 'id');
    }
}
