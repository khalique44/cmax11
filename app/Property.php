<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Http\Helpers\GeneralHelper;
use Carbon\Carbon;

class Property extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [        
    	'builder_id','project_id','city_id','property_title','description',
    	'property_type','category_id','purpose','progress','location','latitude',
    	'longitude','price','area','area_type','bedrooms','bathrooms','floor',
    	'is_installment','installment_advance_amount','number_of_instalments',
    	'monthly_installment', 'utilities','is_lease','is_active','contact_name','email','phone_number',
    	'listed_by','added_by','area_id','sub_area_id','featured_media_id','total_floors','furnish','ready_for_possession','video_url','mobile_number','whatsapp_number','landline_number','listing_type','company_name','project_name','is_featured','is_verified'
    ];

    protected $casts = [
        'created_at' => 'date:Y-M-d'
    ];

    protected $appends = ['alt_location'];

    protected static function boot()
	{
	    parent::boot();

	    static::saving(function ($property) {
	        $slug = Str::slug($property->property_title);

	        // Check if slug already exists excluding the current property (if it's being updated)
	        $query = Property::withTrashed()->where('slug', "{$slug}");

	        // Exclude self on update
	        if ($property->exists) {
	            $query->where('id', '!=', $property->id);
	        }

	        $count = $query->count();

	        $property->slug = $count ? "{$slug}-{$count}" : $slug;
	    });
	}

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
		$this
            ->addMediaConversion('thumb')
            ->width(200)
            //->height(300)
            ->sharpen(10)
            ->optimize();

        $this
            ->addMediaConversion('webp')
            ->format('webp')
            ->optimize();
	}

	public static function getAllProperties(){

		return Property::with('amenities', 'media')->where("project_id",0)->latest()->get();
	}


	// Area relation (each project belongs to one area)
    public function Area()
    {
        return $this->belongsTo(Area::class);
    }

    // SubArea relation (each project belongs to one sub area)
    public function subArea()
    {
        return $this->belongsTo(SubArea::class);
    }

    public function getAreaSizeAttribute()
    {
        return rtrim(rtrim(number_format($this->area, 2, '.', ''), '0'), '.') . ' ' . $this->area_type;
    }

    public function getCustomPriceAttribute()
    {
        return GeneralHelper::detectNumberUnit($this->price);
    }

    public function getInstallmentAdvanceAttribute()
    {
        $price = (GeneralHelper::detectNumberUnit($this->installment_advance_amount));
        return $price['amount'].' '.$price['unit'];
    }

    public function getMonthlyInstallmentAmountAttribute()
    {
         $price = (GeneralHelper::detectNumberUnit($this->monthly_installment));
        return $price['amount'].' '.$price['unit'];
        
    }

    public function getAltLocationAttribute(){

    	$areaName =  $this->Area->name ??  ''; 
    	$subAreaName =  $this->subArea->name ??  ''; 
    	$subAreaName = $subAreaName ? ', '.$subAreaName : '';
    	$location =  $this->location ??  ''; 

    	if(empty($areaName) && empty($subAreaName)){
    		 return $location;
    	}else{
    		 return $areaName.$subAreaName;
    	}
    }

}
