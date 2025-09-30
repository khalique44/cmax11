<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\OptimizesMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class Builder extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, OptimizesMedia;

    protected $fillable = [
        'builder_name','mobile_number','email','address','is_active'

    ];

    protected $casts = [
        'created_at' => 'date:Y-M-d'
    ];

    public function project()
    {
        return $this->hasOne(Project::class);
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

    
}
