<?php

namespace App\Traits;

use Spatie\ImageOptimizer\OptimizerChainFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait OptimizesMedia
{
    /**
     * Optimize the original uploaded file.
     */
    public function optimizeOriginal(Media $media): void
    {
        try {
            $optimizer = OptimizerChainFactory::create();
            $optimizer->optimize($media->getPath());
        } catch (\Exception $e) {
            \Log::warning("Image optimization failed: " . $e->getMessage());
        }
    }

    /**
     * Boot method to automatically optimize images after adding.
     */
    public static function bootOptimizesMedia(): void
    {
        static::saved(function ($model) {
            if (method_exists($model, 'media')) {
                $model->media->each(function (Media $media) use ($model) {
                    $model->optimizeOriginal($media);
                });
            }
        });
    }
}
