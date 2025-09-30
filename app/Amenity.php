<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_amunities', 'amenity_id', 'property_id');
    }
}
