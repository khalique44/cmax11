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
use App\Feature;
use App\Area;
use App\SubArea;
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
                                        <a class="btn btn-sm btn-success" target="_blank" href="'.url("/property/$property->slug/").'" >
                                            View
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/properties/'.$property->id.'" data-tableid="propertiesTable"   data-id="'.$property->id.'">
                                            Delete
                                        </a>';
                })->editColumn('property_title', function($property) {
                    return $property->property_title.'<br><div class="very-small-text text-muted"><i class="fa fa-map-marker"></i> '.$property->alt_location.'</div>';                    
                })
                ->editColumn('is_active', function($property) {
                    $status = GeneralHelper::getStatusLabel($property->is_active);
                    $label = $property->is_active == 1 ? 'Deactive' : 'Active';
                    $newStatus = $property->is_active == 1 ? 0 : 1;
                    return '<a href="#" data-status="'.$newStatus.'" data-status-type="is_active" data-status-label="'.$label.'" class="updateStatus" data-model-name="property" data-id="'.$property->id.'" title="Click to '.$label.'" >'.$status.'</a>';                    
                })
                ->rawColumns(['action','property_title','is_active'])
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
        $areas = Area::orderBy('name' , 'asc')->get();
        $furnishing = config('constants.furnishing');
        $listing_types = config('constants.listing_types');

        return view('admin.properties.create', compact('users','builders','amenities','categories','area_types','property_types','bedrooms','bathrooms','purposes','cities','areas','furnishing','listing_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // Change StorePropertyRequest to Request to prevent auto-validation
    {
        // 1. Define your rules
        $rules = [ 
            'property_title' => 'sometimes|required',
            //'project_id'     => 'sometimes|required',
            //'builder_id'     => 'sometimes|required|numeric',
            'property_type'  => 'sometimes|required',
            'purpose'        => 'sometimes|required',
            'location'       => 'sometimes|required',
            'price'          => 'sometimes|required|numeric',
            'is_installment' => 'nullable',
            'area'           => 'sometimes|required|numeric',
            'email'          => 'sometimes|required|email',
            'phone_number'   => 'sometimes|required',
            'bedrooms'       => 'required',
            'bathroom'       => 'required',
            'description'    => 'required',
            'email'          => 'required',
            'images.*'       => 'sometimes|image|max:2048',
        ];

        // 2. Add conditional rules for installments
        if ($request->filled('is_installment')) {
            $rules['installment_advance_amount'] = 'required|numeric';
            $rules['number_of_instalments']      = 'required|numeric';
            $rules['monthly_installment']        = 'required|numeric';
        }

        // 3. Run the Validator manually
        $validator = Validator::make($request->all(), $rules);
        $isDraft = $validator->fails();

        // 5. Handle Sub Area & Logo (Logic remains same)
        $sub_area_id = 0;
        if(!empty($request->sub_area)){
            $subArea = SubArea::firstOrCreate([
                'name' => $request->sub_area,
                'area_id' => $request->area_id,
            ]);
            $sub_area_id = $subArea->id ?? 0;
        }

        // 4. Merge additional data
        // Note: I fixed a typo in your 'is_installment' merge key below
        $request->merge([
            'sub_area_id'    => $sub_area_id,
            'is_active'      => $request->has('is_active') ? 1 : 0,
            'is_verified'    => $request->has('is_verified') ? 1 : 0,
            'is_featured'    => $request->has('is_featured') ? 1 : 0,
            'ready_for_possession' => $request->has('ready_for_possession') ? 1 : 0, 
            'is_installment' => $request->has('is_installment') ? 1 : 0, // Fixed typo: 'is_installemnt' -> 'is_installment'
            'added_by'       => auth('admin')->user()->id,
            'status'         => $isDraft ? 'draft' : 'published', // Handy for tracking record state
        ]);

        // Handle empty installment fields if not active
        if (!$request->filled('is_installment')) {
            $request->merge([
                'installment_advance_amount' => null,
                'number_of_instalments'      => null,
                'monthly_installment'        => null,                
            ]); 
        }


        

        // 5. Create Record
        // Explicitly grab all inputs after merge, excluding what we don't want in the table
        $data = $request->except(['amenities', 'images', '_token', 'media_ids', 'deleted_files']);
        $property = Property::create($data);

        // 6. Sync amenities
        if ($request->has('amenities')) {
            $property->amenities()->sync($request->input('amenities'));
        }

        // 7. Handle Media (Spatie)
        if ($request->has('media_ids')) {
            foreach ($request->media_ids['property_gallery'] as $mediaId) {
                $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                if ($media) {
                    $media->model_type = Property::class;
                    $media->model_id = $property->id;
                    $media->collection_name = 'images'; // move it to real collection
                    $media->save();
                }                
            }
        }

        // 8. Remove deleted images
        if ($request->filled('deleted_files')) {            
            foreach ($request->input('deleted_files') as $id) {
                if ($id) {
                    $decodedIds = is_array($id) ? $id : json_decode($id, true);
                    \Spatie\MediaLibrary\MediaCollections\Models\Media::whereIn('id', (array)$decodedIds)->delete();
                }
            }
        }

        return response()->json([
            'status'      => $isDraft ? 'draft_saved' : 'success',
            'message'     => $isDraft ? 'Validation failed. Progress saved as draft.' : 'Property created successfully!',
            'errors'      => $isDraft ? $validator->errors() : null,
            'property'    => $property,
            'property_id' => $property->id
        ], $isDraft ? 200 : 201); // Use 200 even for drafts so AJAX 'success' callback triggers
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
        $areas = Area::orderBy('name' , 'asc')->get();
        $furnishing = config('constants.furnishing');
        $listing_types = config('constants.listing_types');

        return view('admin.properties.create', compact('property','users','builders','amenities','categories','area_types','property_types','bedrooms','bathrooms','purposes','cities','areas','furnishing','listing_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {


        $validated = $request->validate(array_merge([
            //'property_title' => 'required',
            //'builder_id' => 'required|numeric',
            'property_type'  => 'sometimes|required',
            'purpose'        => 'sometimes|required',
            'location'       => 'sometimes|required',
            'price'          => 'sometimes|required|numeric',
            'is_installment' => 'nullable',
            'area'           => 'sometimes|required|numeric',
            'email'          => 'sometimes|required|email',
            'phone_number'   => 'sometimes|required',
            'bedrooms'       => 'required',
            'bathrooms'       => 'required',
            'description'    => 'required',
            'email'          => 'required',
            'images.*'       => 'sometimes|image|max:2048',
            'video_url'      => 'nullable|url|active_url',
            ], $request->filled('is_installment') ? [
                'installment_advance_amount' => 'required|numeric',
                'number_of_instalments' => 'required|numeric|',
                'monthly_installment' => 'required|numeric',
                ] : [])
        );


        $sub_area_id = 0;

        if(!empty($request->sub_area)){

            $subArea = SubArea::firstOrCreate(
                [
                    'name' => $request->sub_area,
                    'area_id' => $request->area_id,
                ]
            );

            $sub_area_id = $subArea->id ?? 0;

        }

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_installment' => $request->has('is_installment') ? 1 : 0,
            'is_verified'    => $request->has('is_verified') ? 1 : 0,
            'is_featured'    => $request->has('is_featured') ? 1 : 0,
            'ready_for_possession' => $request->has('ready_for_possession') ? 1 : 0, 
            'sub_area_id' => $sub_area_id, 
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
            if (!empty($request->media_ids['property_gallery'])) {
                foreach ($request->media_ids['property_gallery'] as $mediaId) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                    if ($media) {
                        $media->model_type = Property::class;
                        $media->model_id = $property->id;
                        $media->collection_name = 'property_gallery'; // move it to real collection
                        $media->save();
                    }
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


    public function updateStatus(Request $request){
       
        $record = Property::findOrFail($request->model_id);   

        $record->update([$request->status_type => $request->status]);
        

        return response()->json([
            'status' => 'success',
            'message' => 'Record updated successfully!'
        ]);
    }
}
