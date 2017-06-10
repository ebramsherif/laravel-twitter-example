<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    public function tweet(){
        return $this->hasMany('App\Tweet');
    }
    public function likes(){
        $this->belongsToMany('App\Tweet');
    }
    
    public function follows(){
        return $this->belongsToMany('App\User', 'user_user', 'follower_id', 'followed_id');
    }
    public function followers(){
        return $this->belongsToMany('App\User', 'user_user', 'followed_id', 'follower_id');
    }
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
}
