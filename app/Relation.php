<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $fillable = ['user_1', 'user_2'];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_2', 'id');
    }
}
