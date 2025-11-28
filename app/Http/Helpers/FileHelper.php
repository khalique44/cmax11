<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Support\Str;

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

     /**
     * Upload only non-image documents (CSV, Excel, PDF)
     * Stores in storage/app/public/{folder} by default (disk = 'public')
     *
     * @param UploadedFile $file
     * @param string $folder  // default 'document' (will be storage/app/public/document)
     * @param string $disk    // default 'public' (change to 'local' if you want storage/app/{folder})
     * @return string         // stored path (e.g. document/filename.ext)
     * @throws \Exception
     */
    public static function uploadDocument($file, string $folder = 'document', string $disk = 'public'): string
    {
        $allowedExtensions = ['csv', 'xls', 'xlsx', 'pdf'];
        $allowedMimeTypes = [
            'text/csv',
            'text/plain', // some CSVs upload as text/plain
            'application/vnd.ms-excel', // xls
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
            'application/pdf',
            'application/octet-stream', // fallback for some clients
        ];

        $extension = strtolower($file->getClientOriginalExtension());
        $clientMime = $file->getClientMimeType() ?? $file->getMimeType();

        if (!in_array($extension, $allowedExtensions) || !in_array($clientMime, $allowedMimeTypes)) {
           throw new \Exception("Invalid file type. Only CSV, Excel (xls/xlsx) and PDF files are allowed.");
        }

        // build unique file name
        $fileName = now()->format('YmdHis') . '_' . Str::random(8) . '.' . $extension;

        

        // store using Laravel Storage (disk 'public' -> storage/app/public)
        $storedPath = $file->storeAs($folder, $fileName, $disk); // returns "document/filename.ext"       

        if (!$storedPath) {
            throw new \Exception("Failed to store the file.");
        }

        return 'storage/'.$storedPath;
    }

    /**
     * Delete a stored file (works with Storage disk)
     *
     * @param string|null $path e.g. 'document/filename.pdf'
     * @param string $disk
     * @return bool
     */
    public static function deleteFile(?string $path, string $disk = 'public'): bool
    {
        
        if (!$path) return false;
        $path = str_replace("storage/","",$path);
        return Storage::disk($disk)->delete($path);
    }

    /**
     * Download a stored file (returns a Response for controller)
     *
     * @param string $path e.g. 'document/filename.pdf'
     * @param string $disk
     * @param string|null $downloadName optional friendly file name for download
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public static function downloadFile(string $path, string $disk = 'public', ?string $downloadName = null)
    {
        $path = str_replace("storage/","",$path);
        if (!$path || !Storage::disk($disk)->exists($path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk($disk)->download($path, $downloadName ?? basename($path));
    }

    public static function viewFile(string $path, string $disk = 'public')
    {
        $path = str_replace("storage/", "", $path);

        if (!Storage::disk($disk)->exists($path)) {
            abort(404, 'File not found.');
        }

        $fullPath = Storage::disk($disk)->path($path);
        $mimeType = Storage::disk($disk)->mimeType($path);

        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="'.basename($path).'"'
        ]);
    }

    public static function isPdf($path)
    {
        return strtolower(pathinfo($path, PATHINFO_EXTENSION)) === 'pdf';
    }



}
