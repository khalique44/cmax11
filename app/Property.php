<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [        
    	'builder_id','project_id','city_id','property_title','description',
    	'property_type','category_id','purpose','progress','location','latitude',
    	'longitude','price','area','area_type','bedrooms','bathrooms','floor',
    	'is_intallment','installment_advance_amount','number_of_instalments',
    	'monthly_installment', 'utilities','is_lease','is_active','email','phone_number',
    	'listed_by','added_by'
    ];

    protected $casts = [
        'created_at' => 'date:Y-M-d'
    ];

    public function amenities()
	{
	    return $this->belongsToMany(Amenity::class, 'property_amunities', 'property_id', 'amenity_id');
	}

	public function category()
	{
	    return $this->belongsTo(Category::class,'category_id','id');
	}

	public function project()
	{
	    return $this->belongsTo(Project::class, 'project_id', 'id');
	}	

	public function registerMediaConversions(Media $media = null): void
	{
	    $this->addMediaConversion('thumb')
	        ->width(200)	        
	        ->sharpen(10);
	}

	public static function getAllProperties(){

		return Property::with('amenities', 'media')->where("project_id",0)->latest()->get();
	}

}
