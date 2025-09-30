<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = ['name','city_id'];

    public function subAreas()
    {
        return $this->hasMany(SubArea::class);
    }

    // One area has many projects
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
