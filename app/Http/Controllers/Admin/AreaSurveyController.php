<?php

namespace App\Http\Controllers\Admin;

use App\AreaSurvey;
use App\Area;
use App\SubArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Helpers\FileHelper;


class AreaSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.area_survey.index');
    }

    public function getSurveys(Request $request)
    {
        if ($request->ajax()) {

            $records = AreaSurvey::latest()->get();

            return DataTables::of($records)
                ->addColumn('action', function ($record) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/surveys/$record->id/edit").'" class="btn-sm btn-success action-button">
                                            Edit
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/surveys/'.$record->id.'" data-tableid="mainTable"   data-id="'.$record->id.'">
                                            Delete
                                        </a>';
                })
                ->addColumn('area', function($record) {
                    $area = Area::find($record->area_id);
                    $subArea = SubArea::find($record->sub_area_id);
                    $subAreaName = (!empty($subArea->name)) ? ' - '.$subArea->name : '';
                   
                    return $area->name.$subAreaName;                    
                })
                ->editColumn('file_url', function($record) {                                      
                   
                    return '<a class="btn btn-sm btn-success" href="'.route('file.download',$record->id).'" class="btn-sm btn-success action-button">
                                            Download
                                        </a>';                    
                })
                ->rawColumns(['action','area','file_url'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = $this->getAreas();

        return view('admin.area_survey.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->file_url);
        $validator = Validator::make($request->all(), [
            'area' => 'required',          
            'survey_date' => 'required',
            //'file_url' => 'required|file|mimes:csv,xls,xlsx,pdf|max:10240',     
            'file_url' =>'required|max:10240|mimetypes:application/csv,application/excel,application/vnd.ms-excel,application/vnd.msexcel,text/csv,text/anytext,text/plain,text/x-c',      
            'thumbnail_url' => 'image|max:2048',
        ]);     
        

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $searchArea = explode(' - ', $request->area);
        $areaKey = $searchArea[0] ?? '';
        $subAreaKey = $searchArea[1] ?? '';

        $area = Area::where('name',$areaKey)->first('id');
        $subArea = SubArea::where('name',$subAreaKey)->first('id');

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
            'area_id' => $area->id ?? 0,
            'sub_area_id' => $subArea->id ?? 0,
        ]);
                
        $record = AreaSurvey::create($request->except('_token'));

        if ($request->hasFile('file_url')) {

            $file_path = FileHelper::uploadDocument($request->file('file_url'), 'survey_docs');
            
           $record->update([
                'file_url' => $file_path,                
            ]);
        }

        if ($request->hasFile('thumbnail_url')) {

            $thumbnail_path = FileHelper::uploadImage($request->file('thumbnail_url'), 'survey_thumbs');
            
            $record->update([
                'thumbnail_url' => $thumbnail_path,                
            ]);
        }

        return response()->json([
            'status' => 'success',
            'action' => 'created',
            'message' => 'Record created successfully!',
            'record' => $record,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AreaSurvey $area_survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $record = AreaSurvey::findOrFail($id);
        $areas = $this->getAreas();
        $area = Area::find($record->area_id);
        $subArea = SubArea::find($record->sub_area_id);
        
        $areaName = $area->name ?? '';
        $subAreaName = $subArea->name ?? '';
        $subAreaName = (!empty($subAreaName)) ? ' - '.$subAreaName : '';
        $areaFullName = $areaName.$subAreaName;

        if(!$record){
            return abort(404);
        }
        return view('admin.area_survey.edit',compact('record','areas','areaFullName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AreaSurvey $survey)
    {

        $validator = Validator::make($request->all(), [
            'area' => 'required',          
            'survey_date' => 'required',
            'file_url' =>'required|max:10240|mimetypes:application/csv,application/excel,application/vnd.ms-excel,application/vnd.msexcel,text/csv,text/anytext,text/plain,text/x-c,application/pdf',        
            'thumbnail_url' => 'image|max:2048',
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $searchArea = explode(' - ', $request->area);
        $areaKey = $searchArea[0] ?? '';
        $subAreaKey = $searchArea[1] ?? '';

        $area = Area::where('name',$areaKey)->first('id');
        $subArea = SubArea::where('name',$subAreaKey)->first('id');

        // Using bootstrap switcher which return on/off text
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
            'area_id' => $area->id ?? 0,
            'sub_area_id' => $subArea->id ?? 0,
        ]); 
        
        $isUpdated = $survey->update($request->except('_token','survey_id'));

        if ($request->hasFile('file_url')) {

            $file_path = FileHelper::uploadDocument($request->file('file_url'), 'survey_docs');
            
            $survey->update([
                'file_url' => $file_path,                
            ]);
        }

        if ($request->hasFile('thumbnail_url')) {

            $thumbnail_path = FileHelper::uploadImage($request->file('thumbnail_url'), 'survey_thumbs');
            
            $survey->update([
                'thumbnail_url' => $thumbnail_path,                
            ]);
        }
       
        return response()->json([
            'status' => 'success',
            'action' => 'updated',
            'message' => 'Record updated successfully!',
            'survey' => $survey
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $area_survey = AreaSurvey::findOrFail($id);
        $area_survey->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function getAreas(){      

      $results = Area::with('subAreas')
          //->where('name', 'like', '%' . $query . '%')
          ->orderBy('name', 'asc') // Order areas alphabetically
          ->get()
          ->flatMap(function ($area) {
              $list = collect([$area->name]); // Add area name first
              foreach ($area->subAreas->sortBy('name') as $subArea) { // Order sub-areas alphabetically
                  $list->push($area->name . ' - ' . $subArea->name);
                  
              }
              return $list;
          });

      return $results;
    }


    public function removeFile($id){

        $record = AreaSurvey::findOrFail($id);   
            
        $isRemoved = FileHelper::deleteFile($record->file_url);
        if($isRemoved){
            $record->update(['file_url' => '']);
        }

        return redirect()->back()->with('success', 'File removed successfully.');
    }
}
