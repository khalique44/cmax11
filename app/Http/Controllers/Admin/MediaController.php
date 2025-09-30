<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Property;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Controllers\Controller;
use App\TemporaryUpload;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $mediaKey = 'filepond';

        if($request->has('project_gallery')){
            $mediaKey = 'project_gallery';
        }else if($request->has('payment_plan')){
            $mediaKey = 'payment_plan';
        }else if($request->has('project_logo')){
            $mediaKey = 'project_logo';
        }else if($request->has('project_progress')){
            $mediaKey = 'project_progress';
        }
        // Temporarily assign media to a dummy model (or no model at all)
        $tempModel = new TemporaryUpload(); // or just any placeholder model
        $tempModel->id = 0;
        $tempModel->exists = true;

        $media = $tempModel
            ->addMediaFromRequest($mediaKey)
            ->toMediaCollection('temp'); // Use a temp collection
        $optimizer = OptimizerChainFactory::create();
        $optimizer->optimize($media->getPath());

        return response()->json([
            'id' => $media->id,
            'url' => $media->getUrl('thumb'),
            'path' => $media->getPath(), // important for revert!
            'name' => $media->name, // important for revert!
            'size' => $media->size, // important for revert!
            'mime' => $media->mime_type, // important for revert!
            'mediaKey' => $mediaKey, // important for revert!
        ]);
    }

    public function list()
    {
        $media = Media::where('collection_name', 'images')->latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'url' => $item->getUrl('thumb'),
            ];
        });

        return response()->json($media);
    }

    public function delete($id)
    {
        Media::findOrFail($id)->delete();
        return response()->json(['status' => 'deleted']);
    }

    public function setFeatured(Media $media)
    {
        $model = $media->model; // the parent (e.g. Project)

        $model->featured_media_id = $media->id;
        $model->save();

        return response()->json(['success' => true, 'message' => 'Featured image set successfully']);
    }
}
