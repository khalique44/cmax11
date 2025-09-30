<?php
namespace App\MediaLibrary;

use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

class CustomPathGenerator extends DefaultPathGenerator
{
    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media) . '/conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media) . '/responsive-images/';
    }

    public function getConversionFile(string $conversionName, Media $media): string
    {
        // Get the extension from conversion format
        $conversion = $media->getGeneratedConversions()->firstWhere('name', $conversionName);
        $extension = $conversion?->getManipulations()->getManipulationArgument(Manipulations::FORMAT) ?? 'jpg';

        $nameWithoutExtension = pathinfo($media->file_name, PATHINFO_FILENAME);

        return "{$nameWithoutExtension}-{$conversionName}.{$extension}";
    }
}
