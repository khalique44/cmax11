<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name','icon','file_url','is_active','property_type'

    ];

    protected $casts = [
        'created_at' => 'date:Y-M-d'
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_amunities', 'amenity_id', 'property_id');
    }

    public function getIconImageAttribute()
	{
        $fileUrl = asset($this->file_url);
        return (!empty($this->file_url)) ? '<img src="'.$fileUrl .'" class="feature-image-icon" width="30">' : '<i class="fa '.$this->icon .'"></i>';
	    
	}
}
