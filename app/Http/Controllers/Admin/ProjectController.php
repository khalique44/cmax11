<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Project;
use App\Property;
use App\Amenity;
use App\Category;
use App\Builder;
use App\User;
use App\Feature;
use App\Area;
use App\SubArea;
use App\ProjectOffer;
use App\ProjectFloorPlan;
use App\Http\Controllers\Controller;
use App\Http\Helpers\GeneralHelper;
use App\Http\Helpers\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Yajra\DataTables\DataTables;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects.index');
    }

    public function getProjects(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::getAllProjects();

            return DataTables::of($projects)
                ->addColumn('action', function ($project) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/projects/$project->id/edit").'" >
                                            Edit
                                        </a>
                                        <a class="btn btn-sm btn-success" target="_blank" href="'.url("/project/$project->slug/").'" >
                                            View
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/projects/'.$project->id.'" data-tableid="projectsTable"   data-id="'.$project->id.'">
                                            Delete
                                        </a>';
                })
                
                

                ->editColumn('is_active', function($project) {
                    $status = GeneralHelper::getStatusLabel($project->is_active);
                    $label = $project->is_active == 1 ? 'Deactive' : 'Active';
                    $newStatus = $project->is_active == 1 ? 0 : 1;
                    return '<a href="#" data-status="'.$newStatus.'" data-status-type="is_active" data-status-label="'.$label.'" class="updateStatus" data-model-name="project" data-id="'.$project->id.'" title="Click to '.$label.'" >'.$status.'</a>';                    
                })
                /* ->editColumn('is_featured', function($project) {
                    $label = $project->is_featured == 1 ? 'Yes' : 'No';
                    $color = $project->is_featured == 1 ? 'success' : 'danger';
                    $statusHtml = GeneralHelper::getStatusLabel($label,$color);
                    $newLabel = $project->is_featured == 1 ? 'No' : 'Yes';
                    $newStatus = $project->is_featured == 1 ? 0 : 1;
                    return '<a href="#" data-status="'.$newStatus.'" data-status-type="is_featured" data-status-label="'.$newLabel.'" class="updateStatus" data-model-name="project" data-id="'.$project->id.'" title="Click to '.$newLabel.'" >'.$statusHtml.'</a>';                    
                }) */
                ->editColumn('refreshed_at', function($project) { 
                    if($project->is_refresh_expired === false)  {
                       $btnColor = 'btn-secondary remove_refresh_project';   
                       $title = $project->refresh_days_remaining." days remaining";                   
                    }else{
                       $btnColor = 'btn-primary refresh_project'; 
                       $title = "Click to Refresh";                      
                    }
                    
                    return '<a href="javascript:;" class="btn btn-sm '.$btnColor.' " data-project_id="'.$project->id.'" title="'.$title.'" ><i class="fa fa-refresh"></i>
                            </a>';                    
                })

                
                ->editColumn('is_popular', function($project) {
                    $label = $project->is_popular == 1 ? 'Yes' : 'No';
                    $color = $project->is_popular == 1 ? 'success' : 'danger';
                    $statusHtml = GeneralHelper::getStatusLabel($label,$color);
                    $newLabel = $project->is_popular == 1 ? 'No' : 'Yes';
                    $newStatus = $project->is_popular == 1 ? 0 : 1;
                    return '<a href="#" data-status="'.$newStatus.'" data-status-type="is_popular" data-status-label="'.$newLabel.'" class="updateStatus" data-model-name="project" data-id="'.$project->id.'" title="Click to '.$newLabel.'" >'.$statusHtml.'</a>';
                                        
                })->editColumn('project_title', function($project) {
                    return $project->project_title.'<br><div class="very-small-text text-muted"><i class="fa fa-map-marker"></i> '.$project->alt_location.'</div>';                    
                })
                ->rawColumns(['action','is_active','refreshed_at','is_popular','project_title'])
                ->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where(['status'=>1,'type'=> User::MEMBER])->orderBy('first_name','asc')->orderBy('last_name','asc')->get();
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $progress = config('constants.progress');
        $amenities = Amenity::where('is_active',1)->orderBy('name' , 'asc')->get();
        $categories = Category::where('is_active',1)->orderBy('name', 'asc')->get();
        $area_types = config('constants.area_types');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $bathrooms = config('constants.bathrooms');
        $purposes = config('constants.purpose');
        $cities = GeneralHelper::getCitiesByCountry(166);
        $price_types = config('constants.price_types');
        $offering = config('constants.offering');    
        $payment_plan_duration = config('constants.payment_plan_duration');    
        $areas = Area::orderBy('name' , 'asc')->get();
        $sub_areas = SubArea::orderBy('name' , 'asc')->get();
        $features = Feature::where('is_active',1)->orderBy('name' , 'asc')->get();
        $is_show_survey_fields = false;
        
        
        return view('admin.projects.create', compact('users','builders','progress','offering','area_types','bedrooms','bathrooms','cities','price_types','features','areas','sub_areas','is_show_survey_fields','payment_plan_duration'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $offering = config('constants.offering');

        $validated = $request->validate([

            'project_title' => [
                'required',
                //Rule::unique('projects', 'project_title'),
            ],                 
            'progress' => 'required',            
            'project_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'builder_id' => 'required',
            'city_id' => 'required',
            'location' => 'required',            
            //'payment_plan_duration' => 'required',            
            'images.*' => 'image|max:10240',
            'offering' => 'required|array|min:1|in:'.implode(",",$offering),
            'area_id' => 'required',
            'sub_area' => 'required',


            ],
            [                
                'project_logo.max' => 'The logo must not be larger than 10 MB.',
            ]
        );



        $rules = [];
        $messages = [];

        $offering = $request->has('offering') ? $request->offering : [];
        

        foreach ($offering as $offer) {
            if ($request->has($offer)) {
                $count = count($request->$offer['title'] ?? []);
                for ($i = 0; $i < $count; $i++) {
                    $rules["{$offer}.title.$i"] = 'required|string|max:255';
                    $rules["{$offer}.area.$i"] = 'required|string|min:0';
                    $rules["{$offer}.area_type.$i"] = 'required';
                    $rules["{$offer}.price_from.$i"] = 'required|numeric|min:0';
                    //$rules["{$offer}.price_to.$i"] = 'required|numeric|min:0';
                    $rules["{$offer}.price_type_from.$i"] = 'required';
                    //$rules["{$offer}.price_type_to.$i"] = 'required';
                    
                    // Flats might have bedrooms/bathrooms, plots might not
                    if (in_array($offer, ['flats', 'offices'])) {
                        $rules["{$offer}.bedrooms.$i"] = 'required|integer|min:0';
                        $rules["{$offer}.bathrooms.$i"] = 'required|integer|min:0';
                    }

                    if($request->filled('{$offer}.is_installment.$i')){
                        $rules["{$offer}.installment_advance_amount.$i"] = 'required';
                        $rules["{$offer}.number_of_instalments.$i"] = 'required';
                        $rules["{$offer}.monthly_installment.$i"] = 'required';
                    }
                }
            }
        }

        if ($request->has('floorplans')) {
            $count = count($request->floorplans['title'] ?? []);
            for ($i = 0; $i < $count; $i++) {
                $rules["floorplans.title.$i"] = 'required|string|max:255';
                $rules["floorplans.image.$i"] = 'required|image|max:10240';
                $messages["floorplans.image.$i.max"] = "Image $i must not be greater than 10 MB.";
            }
        }       


        $request->validate($rules, $messages);

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'offering' => $request->has('offering') ? implode(',', $request->offering) : '',            
            'is_active' => $request->has('is_active') ? 1 : 0,    
            'is_featured' => $request->has('is_featured') ? 1 : 0,        
            'is_popular' => $request->has('is_popular') ? 1 : 0,        
            'added_by' => auth('admin')->user()->id,
            //'featured_media_id' => ($request->has('featured_media_id')) ? $request->featured_media_id : 0,
            // Save featured image after project exists
    
        ]);

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

        $logoUrl = "";

        if ($request->hasFile('project_logo')) {

            $logoUrl = FileHelper::uploadImage($request->file('project_logo'), 'project_logos');
           
        }

        $request->merge([
            'logo_url' => $logoUrl,
            'sub_area_id' => $sub_area_id
        ]);

        $project = Project::create($request->except('project_logo','sub_area','project_gallery','payment_plan','_token'));
        $project->features()->sync($request->input('features', []));

        foreach ($offering as $offer) {
            if ($request->has($offer)) {
                $count = count($request->$offer['title'] ?? []);
                for ($i = 0; $i < $count; $i++) {

                     $project->offers()->create([
                        //'project_id' => $project->id,
                        'offer' => $offer,
                        'title' => $request->$offer['title'][$i],
                        'area' => $request->$offer['area'][$i],
                        'area_type' => $request->$offer['area_type'][$i],
                        'bedrooms' => ($request->has("{$offer}.bedrooms.{$i}")) ? $request->$offer['bedrooms'][$i] : 0,
                        'bathrooms' => ($request->has("{$offer}.bathrooms.{$i}")) ? $request->$offer['bathrooms'][$i] : 0,
                        'price_from' => $request->$offer['price_from'][$i],
                        'price_to' => $request->$offer['price_from'][$i],
                        'price_from_in_format' => $request->$offer['price_type_from'][$i],
                        'price_to_in_format' => $request->$offer['price_type_from'][$i],
                        'is_installment' => $request->has("{$offer}.is_installment.{$i}") ? 1 : 0,
                        'installment_advance_amount' => $request->$offer['installment_advance_amount'][$i],
                        'number_of_instalments' => $request->$offer['number_of_instalments'][$i],
                        'monthly_installment' => $request->$offer['monthly_installment'][$i],
       
                    ]);
                   
                }
            }
        }



        $folderName = 'project_floor_plans_images';
        $mediaUrl = '';

        if ($request->has('floorplans')) {
            $count = count($request->floorplans['title'] ?? []);
            for ($i = 0; $i < $count; $i++) {

                if(!empty($request->floorplans['image'][$i])){

                    $image = $request->floorplans['image'][$i];                    

                    $mediaUrl = FileHelper::uploadImage($image, 'project_floor_plans_images');
                }


                $project->floorPlan()->create([
                    //'project_id' => $project->id,
                    'title' => $request->floorplans['title'][$i],
                    'media_url' => $mediaUrl,
                    
                ]);
            }
        }


        if ($request->has('media_ids')) {
            if (!empty($request->media_ids['project_gallery'])) {
                foreach ($request->media_ids['project_gallery'] as $mediaId) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                    if ($media) {
                        $media->model_type = Project::class;
                        $media->model_id = $project->id;
                        $media->collection_name = 'project_gallery'; // move it to real collection
                        $media->save();
                    }
                }
            }
            if (!empty($request->media_ids['payment_plan'])) {
                foreach ($request->media_ids['payment_plan'] as $mediaId) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                    if ($media) {
                        $media->model_type = Project::class;
                        $media->model_id = $project->id;
                        $media->collection_name = 'payment_plan'; // move it to real collection
                        $media->save();
                    }
                }
            }
            if (!empty($request->media_ids['project_progress'])) {
                foreach ($request->media_ids['project_progress'] as $mediaId) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                    if ($media) {
                        $media->model_type = Project::class;
                        $media->model_id = $project->id;
                        $media->collection_name = 'project_progress'; // move it to real collection
                        $media->save();
                    }
                }
            }
        }


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



        return response()->json([
            'status' => 'success',
            'message' => 'Project created successfully!',
            'project' => $project
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $users = User::where(['status'=>1,'type'=> User::MEMBER])->orderBy('first_name','asc')->orderBy('last_name','asc')->get();
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $progress = config('constants.progress');
        $amenities = Amenity::where('is_active',1)->orderBy('name' , 'asc')->get();
        $categories = Category::where('is_active',1)->orderBy('name', 'asc')->get();
        $area_types = config('constants.area_types');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $bathrooms = config('constants.bathrooms');
        $purposes = config('constants.purpose');
        $cities = GeneralHelper::getCitiesByCountry(166);
        $price_types = config('constants.price_types');
        $offering = config('constants.offering');       
        $payment_plan_duration = config('constants.payment_plan_duration');
        $features = Feature::where('is_active',1)->orderBy('name' , 'asc')->get();   
        $areas = Area::orderBy('name' , 'asc')->get();
        $sub_areas = SubArea::orderBy('name' , 'asc')->get();   
        $is_show_survey_fields = GeneralHelper::showSurveyFileds($project);
        
        
        return view('admin.projects.create', compact('project','users','builders','progress','offering','area_types','bedrooms','bathrooms','cities','price_types','features','areas','sub_areas','is_show_survey_fields','payment_plan_duration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $offering = config('constants.offering');

        $validated = $request->validate([

            'project_title' => [
                'required',
                Rule::unique('projects', 'project_title')->ignore($project->id)->whereNull('deleted_at'),
            ],               
            'progress' => 'required',            
            'project_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'builder_id' => 'required',
            'city_id' => 'required',
            'location' => 'required',            
            //'payment_plan_duration' => 'required',            
            'images.*' => 'image|max:2048',
            'offering' => 'required|array|min:1|in:'.implode(",",$offering),
            'area_id' => 'required',
            'sub_area_id' => 'required',

            ],
            [                
                'project_logo.max' => 'The logo must not be larger than 10 MB.',
            ]
        );



        $rules = [];
        $messages = [];

        $offering = $request->has('offering') ? $request->offering : [];
        $features = $request->has('features') ? $request->features : [];
        


        foreach ($offering as $offer) {
            if ($request->has($offer)) {
                $count = count($request->$offer['title'] ?? []);

                for ($i = 0; $i < $count; $i++) {

                    $offer_id = $request->$offer['offer_id'][$i] ?? null;
                    // Skip validation for existing records (if you want to ignore these)
                    if (!empty($offer_id)) {
                        //continue; // Skip validation for this existing record
                    }

                    $rules["{$offer}.title.$i"] = 'required|string|max:255';
                    $rules["{$offer}.area.$i"] = 'required|string|min:0';
                    $rules["{$offer}.area_type.$i"] = 'required';
                    $rules["{$offer}.price_from.$i"] = 'required|numeric|min:0';
                    //$rules["{$offer}.price_to.$i"] = 'required|numeric|min:0';
                    $rules["{$offer}.price_type_from.$i"] = 'required';
                    //$rules["{$offer}.price_type_to.$i"] = 'required';
                    
                    // Flats might have bedrooms/bathrooms, plots might not
                    if (in_array($offer, ['flats', 'offices'])) {
                        $rules["{$offer}.bedrooms.$i"] = 'required|integer|min:0';
                        $rules["{$offer}.bathrooms.$i"] = 'required|integer|min:0';
                    }

                    if($request->filled('{$offer}.is_installment.$i')){
                        $rules["{$offer}.installment_advance_amount.$i"] = 'required';
                        $rules["{$offer}.number_of_instalments.$i"] = 'required';
                        $rules["{$offer}.monthly_installment.$i"] = 'required';
                    }

                    $messages["{$offer}.price_from.$i.required"] = "Price field at row {$i} in {$offer} is required.";
                    $messages["{$offer}.price_from.$i.numeric"]  = "Price field at row {$i} in {$offer} must be a number.";
                    $messages["{$offer}.price_from.$i.min"]      = "Price field at row {$i} in {$offer} must be at least 0.";
                }
            }
        }

        if ($request->has('floorplans')) {
            $count = count($request->floorplans['title'] ?? []);
            for ($i = 0; $i < $count; $i++) {

                $floorplansId = $request->floorplans['id'][$i] ?? null;

                    // Skip validation for existing records (if you want to ignore these)
                    if (!empty($floorplansId)) {
                        //continue; // Skip validation for this existing record
                    }
                $rules["floorplans.title.$i"] = 'required|string|max:255';
                $rules["floorplans.image.$i"] = 'nullable|image|max:10240';
                $messages["floorplans.image.$i.max"] = "Image $i must not be greater than 10 MB.";
            }
        }

        $request->validate($rules, $messages);

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'offering' => $request->has('offering') ? implode(',', $request->offering) : '',            
            'is_active' => $request->has('is_active') ? 1 : 0,            
            'is_featured' => $request->has('is_featured') ? 1 : 0,            
            'is_popular' => $request->has('is_popular') ? 1 : 0,            
            'added_by' => auth('admin')->user()->id,
            
        ]);
       
        $sub_area_id = 0;
        $logoUrl = '';

        if(!empty($request->sub_area)){

            $subArea = SubArea::firstOrCreate(
                [
                    'name' => $request->sub_area,
                    'area_id' => $request->area_id,
                ]
            );

            $sub_area_id = $subArea->id ?? 0;

            $request->merge([
                
                'sub_area_id' => $sub_area_id
            ]);
        }
 
        
        if ($request->hasFile('project_logo')) {

            $logoUrl = FileHelper::uploadImage($request->file('project_logo'), 'project_logos');
            
            // Merge into request
            $request->merge([
                'logo_url' => $logoUrl,
            ]);
        }


        $project->update($request->except('project_logo','project_gallery','payment_plan'));
        if ($request->has('features')) {
            $project->features()->sync($request->input('features'));
        }


        foreach ($offering as $offer) {
            if ($request->has($offer)) {
                $count = count($request->$offer['title'] ?? []);

                for ($i = 0; $i < $count; $i++) {
                    $offerId = $request->$offer['offer_id'][$i] ?? null;

                    $project->offers()->updateOrCreate(
                        ['id' => $offerId],
                        [
                        'project_id' => $project->id,
                        'offer' => $offer,
                        'title' => $request->$offer['title'][$i],
                        'area' => $request->$offer['area'][$i],
                        'area_type' => $request->$offer['area_type'][$i],
                        'bedrooms' => ($request->has("{$offer}.bedrooms.{$i}")) ? $request->$offer['bedrooms'][$i] : 0,
                        'bathrooms' => ($request->has("{$offer}.bathrooms.{$i}")) ? $request->$offer['bathrooms'][$i] : 0,
                        'price_from' => $request->$offer['price_from'][$i],
                        'price_to' => $request->$offer['price_from'][$i],
                        'price_from_in_format' => $request->$offer['price_type_from'][$i],
                        'price_to_in_format' => $request->$offer['price_type_from'][$i],
                        'is_installment' => $request->has("{$offer}.is_installment.{$i}") ? 1 : 0,
                        'installment_advance_amount' => $request->$offer['installment_advance_amount'][$i],
                        'number_of_instalments' => $request->$offer['number_of_instalments'][$i],
                        'monthly_installment' => $request->$offer['monthly_installment'][$i],
       
                    ]);
                   
                }
            }
        }     


        $folderName = 'project_floor_plans_images';
        $mediaUrl = '';

        if ($request->has('floorplans')) {
            $count = count($request->floorplans['title'] ?? []);
            for ($i = 0; $i < $count; $i++) {
                $floorplansId = $request->floorplans['id'][$i] ?? null;
                if(!empty($request->floorplans['image'][$i])){
                    $image = $request->floorplans['image'][$i];
                    $mediaUrl = FileHelper::uploadImage($image, 'project_floor_plans_images');

                    $project->floorPlan()->updateOrCreate(
                        ['id' => $floorplansId],
                        [
                    
                        'media_url' => $mediaUrl,
                        
                        ]
                    );
                }

                $project->floorPlan()->updateOrCreate(
                    ['id' => $floorplansId],
                    [
                    'project_id' => $project->id,
                    'title' => $request->floorplans['title'][$i],                  
                    
                ]);
            }
        }


        if ($request->has('media_ids')) {
            if (!empty($request->media_ids['project_gallery'])) {
                foreach ($request->media_ids['project_gallery'] as $mediaId) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                    if ($media) {
                        $media->model_type = Project::class;
                        $media->model_id = $project->id;
                        $media->collection_name = 'project_gallery'; // move it to real collection
                        $media->save();
                    }
                }
            }
            if (!empty($request->media_ids['payment_plan'])) {
                foreach ($request->media_ids['payment_plan'] as $mediaId) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                    if ($media) {
                        $media->model_type = Project::class;
                        $media->model_id = $project->id;
                        $media->collection_name = 'payment_plan'; // move it to real collection
                        $media->save();
                    }
                }
            }
            if (!empty($request->media_ids['project_progress'])) {
                foreach ($request->media_ids['project_progress'] as $mediaId) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($mediaId);
                    if ($media) {
                        $media->model_type = Project::class;
                        $media->model_id = $project->id;
                        $media->collection_name = 'project_progress'; // move it to real collection
                        $media->save();
                    }
                }
            }
        }


        // Remove deleted images
        $deletedFiles = $request->input('deleted_files', []);
        $deletedOffers = $request->input('deleted-offer', []);
        $deletedFloorPlans = $request->input('deleted-floor-plan', []);

       if (!empty($deletedFiles)) {            
            foreach ($deletedFiles as $id) {
                if($id){
                    $id = (json_decode($id));
                    Media::whereIn('id', $id)->delete();
                }
                
            }
        }

        if (!empty($deletedOffers)) {            
            foreach ($deletedOffers as $id) {
                if($id){
                    $id = (json_decode($id));

                    $isDeleted = ProjectOffer::whereIn('id', $id)->delete();

                }
                
            }
        }

         if (!empty($deletedFloorPlans)) {            
            foreach ($deletedFloorPlans as $id) {
                if($id){
                    $id = (json_decode($id));
                    ProjectFloorPlan::whereIn('id', $id)->delete();
                }
                
            }
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Project updated successfully!',
            'project' => $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project = Project::with('media')->findOrFail($project->id);

        foreach ($project->media as $media) {
            //Storage::disk('public')->delete('/assets/'.$media->file_name);
        }

        $project->delete();
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function addProperty(Request $request){

        $project = Project::findOrFail($request->id);
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

        return view('admin.projects.add-property', compact('project','users','builders','amenities','categories','area_types','property_types','bedrooms','bathrooms','purposes','cities'));
        
    }


    public function editProperty(Request $request){

        $project = Project::findOrFail($request->id);
        $property = Property::findOrFail($request->property_id);
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

        return view('admin.projects.add-property', compact('project','property','users','builders','amenities','categories','area_types','property_types','bedrooms','bathrooms','purposes','cities'));
        
    }

    public function getSubAreas($area_id){

        $subAreas = SubArea::where('area_id',$area_id)->orderBy('name','asc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Sub areas found',
            'subAreas' => $subAreas
        ]);
    }


    public function updateStatus(Request $request){
       
        $project = Project::findOrFail($request->model_id);   

        $project->update([$request->status_type => $request->status]);
        

        return response()->json([
            'status' => 'success',
            'message' => 'Record updated successfully!'
        ]);
    }

    public function updatePosition(Request $request)
    { 
        
        $rows = ($request->all());        
        Project::updatePosition($rows);
        $response = array( 'status' => 'success', 'message' => __('Position Updated Successfully!') );
            
        return response()->json($response);
    }

    public function reGeneratePositions(){
        $records = Project::getRecordsWihPosition();
        foreach ($records as $key => $record) {
            $record->position = $key + 1;
            $record->save();
        }
    }

    public function refresh(Project $project)
    {

        $project->update([
            'refreshed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Project refreshed successfully and will stay on top for 1 month!');
        //return response()->json($response);
    }

}
