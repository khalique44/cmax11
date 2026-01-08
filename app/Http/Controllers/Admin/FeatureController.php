<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Helpers\GeneralHelper;
use App\Http\Helpers\FileHelper;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $records = Feature::latest()->get();
        //$this->reGeneratePositions();
        return view('admin.features.index',compact('records'));
    }

    public function getFeatures(Request $request)
    {
        if ($request->ajax()) {

            $features = Feature::latest()->get();

            return DataTables::of($features)
                ->addColumn('action', function ($feature) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/features/$feature->id/edit").'" class="btn-sm btn-success action-button">
                                            Edit
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/features/'.$feature->id.'" data-tableid="mainTable"   data-id="'.$feature->id.'">
                                            Delete
                                        </a>';
                })
                 ->editColumn('is_active', function($feature) {
                    $status = GeneralHelper::getStatusLabel($feature->is_active);
                    $label = $feature->is_active == 1 ? 'Deactive' : 'Active';
                    $newStatus = $feature->is_active == 1 ? 0 : 1;
                    return '<a href="#" data-status="'.$newStatus.'" data-status-type="is_active" data-status-label="'.$label.'" class="updateStatus" data-model-name="feature" data-id="'.$feature->id.'" title="Click to '.$label.'" >'.$status.'</a>';                    
                })
                ->editColumn('icon', function($feature) {                    
                    return '<i class="fa '.$feature->icon.'" ></i> '.$feature->icon;                    
                })
                ->editColumn('file_url', function($feature) { 
                   
                    if(!empty($feature->file_url)){
                        $fileUrl =  asset($feature->file_url);
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
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.features.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
            $file_url = FileHelper::uploadImage($request->file('file_url'), 'feature_images');
            $data['file_url'] = $file_url;
        }
                
        Feature::Create($data);            

        return redirect('/admin/features/')->with('success', 'Record saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Feature::find($id);
        if(!$record){
            return abort(404);
        }
        return view('admin.features.edit',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
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

   
        
        Feature::Where('id',$id)
            ->update($data);         

        return redirect('/admin/features')->with('success','Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Feature::find($id);
        
        if(!$record){
            return abort(404);
        }
        Feature::Where('id',$id)->delete();
        
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function updateStatus(Request $request){
       
        $feature = Feature::findOrFail($request->model_id);   

        $feature->update([$request->status_type => $request->status]);
        

        return response()->json([
            'status' => 'success',
            'message' => 'Record updated successfully!'
        ]);
    }

}
