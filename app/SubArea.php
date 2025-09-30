<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubArea extends Model
{
    use HasFactory;

    protected $fillable = ['area_id', 'name'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    // One sub area has many projects
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
