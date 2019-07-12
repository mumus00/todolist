<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'photo'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function job()
    {
        return $this->hasMany(Job::class);
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function isAdmin()
    {
        return $this->role == 1;
    }

    public function isProgrammer()
    {
        return $this->role == 0;
    }
}
