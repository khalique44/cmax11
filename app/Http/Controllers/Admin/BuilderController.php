<?php

namespace App\Http\Controllers\Admin;

use App\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;



class BuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.builder.index');
    }

    public function getBuilders(Request $request)
    {
        if ($request->ajax()) {

            $builders = Builder::latest()->get();

            return DataTables::of($builders)
                ->addColumn('action', function ($builder) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/builders/$builder->id/edit").'" class="btn-sm btn-success action-button">
                                            Edit
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/builders/'.$builder->id.'" data-tableid="mainTable"   data-id="'.$builder->id.'">
                                            Delete
                                        </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.builder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'builder_name' => 'required',          
            'email' => 'required|email',
            'mobile_number' => 'required',
            'address' => 'required',
            'images.*' => 'image|max:2048',
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $builder = Builder::create($request->except('images','_token'));

        if ($request->has('media_ids')) {
            
            foreach ($request->media_ids['default'] as $mediaId) {
                $media = Media::find($mediaId);
                if ($media) {
                    $media->model_type = Builder::class;
                    $media->model_id = $builder->id;
                    $media->collection_name = 'images'; // move it to real collection
                    $media->save();
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Builder created successfully!',
            'builder' => $builder
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Builder $builder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $record = Builder::find($id);
        if(!$record){
            return abort(404);
        }
        return view('admin.builder.edit',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Builder $builder)
    {

        $validator = Validator::make($request->all(), [
            'builder_name' => 'required',          
            'email' => 'required|email',
            'mobile_number' => 'required',
            'address' => 'required',
            'images.*' => 'image|max:2048',
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $builder->update($request->except('images','_token','builder_id'));
        // Remove deleted images
        $deletedFiles = $request->input('deleted_files', []);

       if (!empty($deletedFiles)) {            
            foreach ($deletedFiles as $id) {
                if($id){
                    $id = (json_decode($id));
                    Media::whereIn('id', $id)->delete();
                }
                
            }
        }

        
        if ($request->has('media_ids')) {
            foreach ($request->media_ids['default'] as $mediaId) {
                $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                if ($media) {
                    $media->model_type = Builder::class;
                    $media->model_id = $builder->id;
                    $media->collection_name = 'images'; // move it to real collection
                    $media->save();
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Builder updated successfully!',
            'builder' => $builder
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $builder = Builder::findOrFail($id);
        $builder->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
