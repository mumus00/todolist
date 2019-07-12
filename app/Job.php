<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	protected $fillable = [
        'name', 'status', 'project_id', 'user_id','dateline'
    ];

    public function user()
	{
	    return $this->belongsTo(User::class);
	}

	public function project()
	{
	    return $this->belongsTo(Project::class);
	}
}
