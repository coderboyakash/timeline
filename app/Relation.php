<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_2', 'id');
    }
}
