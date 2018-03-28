<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = "comments";

    public function post() {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}
