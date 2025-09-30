<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;



class TemporaryUpload extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'temporary_uploads'; // Not used

    public $timestamps = false;

    public function registerMediaConversions(Media $media = null): void
    {
        //dd($media);
       $format = 'jpg'; // default fallback

        if ($media) {
            $format = $media->extension; // returns 'png', 'webp', etc.
        }
        
        
        $this->addMediaConversion('thumb')              // Better compression and quality
        //->fit('contain', 300)    // Preserves aspect ratio inside bounds
        ->format($format)
        ->width(200)
        ->quality(85)                 // 80–90 is usually perfect
        ->optimize()
        ->nonQueued();

        $this->addMediaConversion('webp')
        ->format('webp')
        ->quality(85)   // lower = smaller size
        ->nonQueued()
        ->optimize();

       
    }

    // This tricks Spatie into allowing us to upload without a real DB record
    public function getKey()
    {
        return 0;
    }

    public function getKeyName()
    {
        return 'id';
    }

}

