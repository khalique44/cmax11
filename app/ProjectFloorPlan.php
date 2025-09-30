<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFloorPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [        
    	'project_id','title','media_url'
    ];

    public function project()
	{
	    return $this->belongsTo(Project::class);
	}
}
