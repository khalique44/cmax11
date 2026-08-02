<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\OptimizesMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Http\Helpers\GeneralHelper;
use Carbon\Carbon;


class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, OptimizesMedia;

    protected $fillable = [        
    	'builder_id','user_id','city_id','area_id','sub_area_id','project_title','description','progress','area','location','latitude','longitude','logo_url','offering','is_lease','is_active','added_by','rate_per_square','development_charges','utility_charges','distance','project_floors','project_start_date', 'is_featured','is_popular','position','featured_media_id','refreshed_at','payment_plan_duration','bitrix_project_id','head_scripts'
    ];

	protected $casts = [
        'created_at' => 'date:Y-M-d',
		'refreshed_at' => 'datetime',
		'payment_plan_duration' => 'array',
    ];

	protected $appends = ['alt_location'];

    protected static function boot()
	{
	    parent::boot();

	    static::saving(function ($project) {
	        $slug = Str::slug($project->project_title);

	        // Check if slug already exists excluding the current project (if it's being updated)
	        $query = Project::withTrashed()->where('slug', "{$slug}");

	        // Exclude self on update
	        if ($project->exists) {
	            $query->where('id', '!=', $project->id);
	        }

	        $count = $query->count();

	        $project->slug = $count ? "{$slug}-{$count}" : $slug;
	    });
	}


    public function properties()
	{
	    return $this->hasMany(Property::class,'project_id', 'id');
	}

    public static function getAllProjects(){

		$projects = Project::with('offers', 'floorPlan', 'media')
		->orderByRaw("CASE WHEN refreshed_at >= ? THEN 0 ELSE 1 END", [now()->subMonth()])
		->orderBy('position', 'asc')
		->orderBy('created_at', 'desc')
		->get();
		return $projects;
	}

	public function offers()
	{
	    return $this->hasMany(ProjectOffer::class);
	}

	public function floorPlan()
	{
	    return $this->hasMany(ProjectFloorPlan::class);
	}

	public function features()
	{
	     return $this->belongsToMany(Feature::class, 'project_features', 'project_id', 'feature_id');
	}

	
    public function builder()
	{
	    return $this->belongsTo(Builder::class);
	}

	public function user()
	{
	    return $this->belongsTo(User::class);
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

	public function getPriceRangeAttribute()
	{
	    return GeneralHelper::formatPriceRange($this->offers);
	}

	public function getMinMaxAttribute()
	{
	    $price_range = GeneralHelper::formatPriceRange($this->offers);
	    $min_amount = $price_range['min']['amount'] ?? 'N/A';
	    $max_amount = $price_range['max']['amount'] ?? 'N/A';
	    $min_unit = $price_range['min']['unit'] ?? '';
	    $max_unit = $price_range['max']['unit'] ?? '';

	    return $min_amount .' '. $min_unit .' to '. $max_amount .' '. $max_unit;
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


    public static function updatePosition($rows){        

        try {

            foreach($rows as $row){
                foreach($row as $r){

                    $id = $r['id'];
                    $position = $r['position'];
                    self::whereId($id)->update(['position' => $position]);
                }
            }

        } catch (Exception $e) {

            return $e->getMessage();
        }
        
    }


    public static function getRecordsWihPosition(){
        return self::orderBy('position','asc')->get();
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


	public function featuredImage(){
		return $this->belongsTo(\Spatie\MediaLibrary\MediaCollections\Models\Media::class, 'featured_media_id');
	}

	public function getIsRefreshExpiredAttribute()
	{
		return $this->refreshed_at?->lt(now()->subMonth());
	}

	public function getRefreshDaysRemainingAttribute()
	{
		$expiryDate = $this->refreshed_at?->copy()->addMonth();
		return floor(now()->diffInDays($expiryDate, false));
	}
}
