<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // The attributes that are mass assignable.
    protected $fillable = [
        'name', 'username', 'email', 'password', 'added_by',
    ];

    // Hidden Atrributes.
    protected $hidden = [
        'password', 'remember_token',
    ];
}
