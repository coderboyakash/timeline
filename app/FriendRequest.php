<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $fillable= ['user_id', 'sender_id', 'token'];
    
    public function sender()
    {
        return $this->hasOne('App\User', 'id', 'sender_id');
    }
}
