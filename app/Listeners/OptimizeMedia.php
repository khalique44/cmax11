<?php
namespace App\Listeners;

use App\Events\Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OptimizeMedia
{
    public function handle(MediaHasBeenAdded $event): void
    {
        $media = $event->media;
        \Log::info("Optimizinggggggggggg: {$media->file_name}");
        try {            
            $optimizer = OptimizerChainFactory::create();
            $optimizer->optimize($media->getPath());
        } catch (\Exception $e) {
            \Log::warning("Image optimization failed for {$media->file_name}: " . $e->getMessage());
        }
    }
}
