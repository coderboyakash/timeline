<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $fillable = ['user_id', 'friend_id'];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
