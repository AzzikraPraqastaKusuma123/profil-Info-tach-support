<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'name',
        'last_login_at',
        'last_logout_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'last_login_at'  => 'datetime',
        'last_logout_at' => 'datetime',
    ];
}
