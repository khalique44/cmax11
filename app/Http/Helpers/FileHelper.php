<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class FileHelper
{
    public static function uploadImage($file, $folderName = 'uploads')
    {
        $fileName   = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName   = str_replace(" ", "_", $fileName);
        $timestamp  = time();
        $extension  = $file->getClientOriginalExtension();
        $fullName   = "{$fileName}-{$timestamp}.{$extension}";

        // Save into storage/app/public/{folderName}
        $relativePath = "{$folderName}/{$fullName}";
        Storage::disk('public')->putFileAs($folderName, $file, $fullName);

        $absolutePath = Storage::disk('public')->path($relativePath);

        // Also copy to public/storage for WAMP (symlink fallback)
        $publicStoragePath = public_path("storage/{$relativePath}");
        if (!file_exists(dirname($publicStoragePath))) {
            mkdir(dirname($publicStoragePath), 0777, true);
        }
        copy($absolutePath, $publicStoragePath);

        // Optimize original
        $optimizer = OptimizerChainFactory::create();
        $optimizer->optimize($absolutePath);

        // Check size
        $fileSizeKB = filesize($absolutePath) / 1024;

        if ($fileSizeKB > 100) {
            // Convert to WebP
            $manager = new ImageManager(new Driver());
            $image = $manager->read($absolutePath);

            $webpFileName = "{$fileName}-{$timestamp}.webp";
            $webpRelative = "{$folderName}/{$webpFileName}";
            $webpAbsolute = Storage::disk('public')->path($webpRelative);

            // Save WebP inside storage/app/public
            $image->toWebp(85)->save($webpAbsolute);

            // Copy WebP to public/storage as well
            $publicWebpPath = public_path("storage/{$webpRelative}");
            copy($webpAbsolute, $publicWebpPath);

            return 'storage/'.$webpRelative; // ✅ return clean relative path
        }

        return 'storage/'.$relativePath; // ✅ return clean relative path
    }

    /**
     * Retrieve image URL, prefers WebP if available.
     *
     * @param string $path
     * @return string
     */
    public static function getImageUrl($path)
    {
        $absolutePath = Storage::disk('public')->path($path);

        if (!file_exists($absolutePath)) {
            return asset('images/no-image.png'); // fallback
        }

        // Try WebP alternative
        $webpPath = preg_replace('/\.[^.]+$/', '.webp', $absolutePath);
        if (file_exists($webpPath)) {
            $relativeWebp = str_replace(Storage::disk('public')->path(''), '', $webpPath);
            return Storage::url($relativeWebp);
        }

        return Storage::url($path);
    }
}
