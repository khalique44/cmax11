<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyMedia extends Model
{
    use HasFactory;

    protected $fillable = ['property_listing_id', 'file_path'];

    public function listing()
	{
	    return $this->belongsTo(Property::class);
	}

}
