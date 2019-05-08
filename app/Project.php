<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = [
        'name'
    ];

    public function user()
	{
	    return $this->belongsTo(User::class);
	}

	public function job()
    {
        return $this->hasMany(Job::class);
    }
}
