<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public function photo()
    {
        return $this->hasOne('App\Photo');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
