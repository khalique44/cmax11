<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Area;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Http\Helpers\GeneralHelper;

class MainAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $records = Area::latest()->get();
        //$this->reGeneratePositions();
        return view('admin.areas.index',compact('records'));
    }

    public function getAreas(Request $request)
    {
        if ($request->ajax()) {

            $records = Area::latest()->get();

            return DataTables::of($records)
                ->addColumn('action', function ($record) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/areas/$record->id/edit").'" class="btn-sm btn-success action-button">
                                            Edit
                                        </a>';
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
        return view('admin.areas.create');
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
        $record = Area::find($id);
        if(!$record){
            return abort(404);
        }
        return view('admin.areas.edit',compact('record'));
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
            'name' => 'required|max:255',            
            
        ]);

        $request->merge([
            'city_id' => 31594 // Karachi ID
        ]);

        $data = $request->except(['_method','_token']);  
        
        Area::Where('id',$id)
            ->update($data);         

        return redirect('/admin/areas')->with('success','Record updated successfully!');
    }

    public function store(Request $request)
    {
         $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('areas', 'name')->where(function ($query) use ($request) {
                    return $query->where('city_id', 31594);
                }),
            ],
            //'city_id' => 'required|exists:cities,id',
        ]);

        $area = Area::create([
            'name' => $request->name,
            'city_id' => 31594, // Karachi ID in DB cities table
        ]);

        return response()->json([
            'status' => 'success',
            'area' => $area
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Area::find($id);
        
        if(!$record){
            return abort(404);
        }
        Area::Where('id',$id)->delete();
        
        return response()->json(['success' => 'Record deleted successfully.']);
    }
}