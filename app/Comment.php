<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected  $fillable = [
        'post_id',
        'comment',
        'name',
        'email'
    ];

    protected function post(){
        return $this->belongsTo('App\Post');
    }
}
