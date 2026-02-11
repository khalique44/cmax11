<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Area;
use App\SubArea;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Http\Helpers\GeneralHelper;

class SubAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $records = SubArea::latest()->get();
        //$this->reGeneratePositions();
        return view('admin.subareas.index',compact('records'));
    }

    public function getSubAreas(Request $request)
    {
        if ($request->ajax()) {

            $records = SubArea::latest()->get();

            return DataTables::of($records)
                ->addColumn('action', function ($record) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/subareas/$record->id/edit").'" class="btn-sm btn-success action-button">
                                            Edit
                                        </a>';
                })
                ->editColumn('area_id', function($record) {                    
                    return $record->area->name;                    
                })
                ->rawColumns(['action'])
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
        $areas = Area::latest()->get();
        return view('admin.subareas.create',compact('areas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = SubArea::find($id);
        $areas = Area::latest()->get();
        if(!$record){
            return abort(404);
        }
        return view('admin.subareas.edit',compact('record','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'area_id' => 'required',            
            'name' => 'required|max:255',            
            
        ]);
       

        $data = $request->except(['_method','_token']);  
        
        SubArea::Where('id',$id)
            ->update($data);         

        return redirect('/admin/subareas')->with('success','Record updated successfully!');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_areas', 'name')->where(function ($query) use ($request) {
                    return $query->where('area_id', $request->area_id);
                }),
            ],
            'area_id' => 'required|exists:areas,id',
        ],[                
                'area_id.required' => 'Main area field is required. Please select main area first',
            ]);

        $subArea = SubArea::create([
            'name' => $request->name,
            'area_id' => $request->area_id, // Karachi ID in DB cities table
        ]);

        return response()->json([
            'status' => 'success',
            'subarea' => $subArea
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubArea  $subarea
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = SubArea::find($id);
        
        if(!$record){
            return abort(404);
        }
        SubArea::Where('id',$id)->delete();
        
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}