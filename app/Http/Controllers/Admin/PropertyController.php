<?php

namespace App\Http\Controllers\Admin;

use App\Property;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Helpers\GeneralHelper;
use App\Amenity;
use App\Category;
use App\Builder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.properties.index');
    }

    public function getProperties(Request $request)
    {
        if ($request->ajax()) {
            $properties = Property::getAllProperties();

            return DataTables::of($properties)
                ->addColumn('action', function ($property) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/properties/$property->id/edit").'" class="btn-sm btn-success action-button">
                                            Edit
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/properties/'.$property->id.'" data-tableid="propertiesTable"   data-id="'.$property->id.'">
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
        $users = User::where(['status'=>1,'type'=> User::MEMBER])->orderBy('first_name','asc')->orderBy('last_name','asc')->get();
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $amenities = Amenity::where('is_active',1)->orderBy('name' , 'asc')->get();
        $categories = Category::where('is_active',1)->orderBy('name', 'asc')->get();
        $area_types = config('constants.area_types');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $bathrooms = config('constants.bathrooms');
        $purposes = config('constants.purpose');
        $cities = GeneralHelper::getCitiesByCountry(166);

        return view('admin.properties.create', compact('users','builders','amenities','categories','area_types','property_types','bedrooms','bathrooms','purposes','cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        

        $validated = $request->validate(array_merge([
            'property_title' => 'required',
            'project_id' => 'sometimes|required',
            'builder_id' => 'required|numeric',
            'property_type' => 'required',
            'purpose' => 'required',
            'location' => 'required',
            'price' => 'required|numeric',
            'is_installment' => 'nullable',
            'area' => 'required|numeric',
            'email' => 'required|email',
            'phone_number' => 'required',
            'images.*' => 'image|max:2048',
            ], $request->filled('is_installment') ? [
                'installment_advance_amount' => 'required|numeric',
                'number_of_instalments' => 'required|numeric|',
                'monthly_installment' => 'required|numeric',
                ] : [])
        );

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_installemnt' => $request->has('is_installemnt') ? 1 : 0,
            'added_by' => auth('admin')->user()->id,
        ]);

        if(!$request->filled('is_installment')){
           $request->merge([
                'installment_advance_amount' => '',
                'number_of_instalments' => '',
                'monthly_installment' => '',                
            ]); 
        }

        $property = Property::create($request->except('amenities', 'images','_token'));

        // Sync amenities
        if ($request->has('amenities')) {
            $property->amenities()->sync($request->input('amenities'));
        }


        if ($request->has('media_ids')) {
            foreach ($request->media_ids as $mediaId) {
                $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                if ($media) {
                    $media->model_type = Property::class;
                    $media->model_id = $property->id;
                    $media->collection_name = 'images'; // move it to real collection
                    $media->save();
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Property created successfully!',
            'property' => $property,
            'project_id' => $request->has('project_id') ? $request->project_id : ''
        ]);        

    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //$property = Property::with('amenities', 'media')->findOrFail($id);
        //return view('admin.properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        // $property = Property::with('amenities', 'media')->findOrFail($id);
        $users = User::where(['status'=>1,'type'=> User::MEMBER])->orderBy('first_name','asc')->orderBy('last_name','asc')->get();
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $amenities = Amenity::where('is_active',1)->orderBy('name' , 'asc')->get();
        $categories = Category::where('is_active',1)->orderBy('name', 'asc')->get();
        $area_types = config('constants.area_types');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $bathrooms = config('constants.bathrooms');
        $purposes = config('constants.purpose');
        $cities = GeneralHelper::getCitiesByCountry(166);

        return view('admin.properties.create', compact('property','users','builders','amenities','categories','area_types','property_types','purposes','bedrooms','bathrooms','cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {


        $validated = $request->validate(array_merge([
            //'property_title' => 'required',
            'builder_id' => 'required|numeric',
            'property_type' => 'required',
            'purpose' => 'required',
            //'progress' => 'required',
            'location' => 'required',
            'price' => 'required|numeric',
            'is_installment' => 'nullable',
            'area' => 'required|numeric',
            'email' => 'required|email',
            'phone_number' => 'required',
            'images.*' => 'image|max:2048',
            ], $request->filled('is_installment') ? [
                'installment_advance_amount' => 'required|numeric',
                'number_of_instalments' => 'required|numeric|',
                'monthly_installment' => 'required|numeric',
                ] : [])
        );

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_installemnt' => $request->has('is_installemnt') ? 1 : 0,
            'added_by' => auth('admin')->user()->id,
        ]);

        if(!$request->filled('is_installment')){
           $request->merge([
                'installment_advance_amount' => '',
                'number_of_instalments' => '',
                'monthly_installment' => '',                
            ]); 
        }

        $property->update($request->except('amenities', 'images'));
        $property->amenities()->sync($request->input('amenities', []));   

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
            foreach ($request->media_ids as $mediaId) {
                $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                if ($media) {
                    $media->model_type = Property::class;
                    $media->model_id = $property->id;
                    $media->collection_name = 'images'; // move it to real collection
                    $media->save();
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Property updated successfully!',
            'property' => $property
        ]);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
  
        $property = Property::with('media')->findOrFail($id);

        foreach ($property->media as $media) {
            Storage::disk('public')->delete($media->file_path);
        }

        $property->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
