<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function photo()
    {
        return $this->hasOne('App\Photo');
    }

    public function posts()
    {
        return $this->hasMany('App\Post')->orderBy('id', 'DESC');
    }
    public function relations(){
        return $this->hasMany('App\Relation', 'user_1');
    }
    public function requests(){
        return $this->hasMany('App\FriendRequest');
    }
}
