<?php

namespace App\Http\Controllers\Admin;

use App\Amenity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Helpers\GeneralHelper;
use App\Http\Helpers\FileHelper;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Amenity::latest()->get();
        //$this->reGeneratePositions();
        return view('admin.amenities.index',compact('records'));
    }


    public function getAmenities(Request $request)
    {
        if ($request->ajax()) {

            $amenities = Amenity::latest()->get();

            return DataTables::of($amenities)
                ->addColumn('action', function ($amenity) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/amenities/$amenity->id/edit").'" class="btn-sm btn-success action-button">
                                            Edit
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/amenities/'.$amenity->id.'" data-tableid="mainTable"   data-id="'.$amenity->id.'">
                                            Delete
                                        </a>';
                })
                 ->editColumn('is_active', function($amenity) {
                    $status = GeneralHelper::getStatusLabel($amenity->is_active);
                    $label = $amenity->is_active == 1 ? 'Deactive' : 'Active';
                    $newStatus = $amenity->is_active == 1 ? 0 : 1;
                    return '<a href="#" data-status="'.$newStatus.'" data-status-type="is_active" data-status-label="'.$label.'" class="updateStatus" data-model-name="amenity" data-id="'.$amenity->id.'" title="Click to '.$label.'" >'.$status.'</a>';                    
                })
                ->editColumn('icon', function($amenity) {                    
                    return '<i class="fa '.$amenity->icon.'" ></i> '.$amenity->icon;                    
                })
                ->editColumn('file_url', function($amenity) { 
                   
                    if(!empty($amenity->file_url)){
                        $fileUrl =  asset($amenity->file_url);
                        return '<img src="'.$fileUrl.'" width="50">'; 
                    }else{
                        return 'N/A'; 
                    }
                })
                ->rawColumns(['action','is_active','icon','file_url'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.amenities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',            
            'file_url' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
            'icon' => (!empty($request->icon)) ? $request->icon : 'fa-check',
        ]);

        $data = $request->except(['_method','_token']);
        
        if(!empty($request->file_url)){
            $file_url = FileHelper::uploadImage($request->file('file_url'), 'amenity_images');
            $data['file_url'] = $file_url;
        }
                
        Amenity::Create($data);            

        return redirect('/admin/amenities/')->with('success', 'Record saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Amenity $amenity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $record = Amenity::find($id);
        if(!$record){
            return abort(404);
        }
        return view('admin.amenities.edit',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',            
            
        ]);

        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
            'icon' => (!empty($request->icon)) ? $request->icon : 'fa-check',
        ]);

        $data = $request->except(['_method','_token']);

        if(!empty($request->file_url)){

            $request->validate([
                     
                'file_url' =>  'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            
            $file_url = FileHelper::uploadImage($request->file('file_url'), 'feature_images');
            $data['file_url'] = $file_url;     

        }else{

             $data = $request->except(['_method','_token','file_url']);
        }

   
        
        Amenity::Where('id',$id)
            ->update($data);         

        return redirect('/admin/amenities')->with('success','Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = Amenity::find($id);
        
        if(!$record){
            return abort(404);
        }
        Amenity::Where('id',$id)->delete();
        
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function updateStatus(Request $request){
       
        $amenity = Amenity::findOrFail($request->model_id);   

        $amenity->update([$request->status_type => $request->status]);
        

        return response()->json([
            'status' => 'success',
            'message' => 'Record updated successfully!'
        ]);
    }
}
