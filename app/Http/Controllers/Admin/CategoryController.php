<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Http\Helpers\GeneralHelper;
use App\Http\Helpers\FileHelper;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Category::latest()->get();
        //$this->reGeneratePositions();
        return view('admin.categories.index',compact('records'));
    }


    public function getCategories(Request $request)
    {
        if ($request->ajax()) {

            $categories = Category::latest()->get();

            return DataTables::of($categories)
                ->addColumn('action', function ($category) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/categories/$category->id/edit").'" class="btn-sm btn-success action-button">
                                            Edit
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/categories/'.$category->id.'" data-tableid="mainTable"   data-id="'.$category->id.'">
                                            Delete
                                        </a>';
                })
                 ->editColumn('is_active', function($category) {
                    $status = GeneralHelper::getStatusLabel($category->is_active);
                    $label = $category->is_active == 1 ? 'Deactive' : 'Active';
                    $newStatus = $category->is_active == 1 ? 0 : 1;
                    return '<a href="#" data-status="'.$newStatus.'" data-status-type="is_active" data-status-label="'.$label.'" class="updateStatus" data-model-name="category" data-id="'.$category->id.'" title="Click to '.$label.'" >'.$status.'</a>';                    
                })    
                ->rawColumns(['action','is_active'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $property_types = config('constants.property_types');
        return view('admin.categories.create',compact('property_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',             
            'property_type' => 'required|max:255',
        ]);

        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,            
        ]);

        $data = $request->except(['_method','_token']);
        
       
                
        Category::Create($data);            

        return redirect('/admin/categories/')->with('success', 'Record saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $record = Category::find($id);
        $property_types = config('constants.property_types');
        if(!$record){
            return abort(404);
        }
        return view('admin.categories.edit',compact('record','property_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',            
            'property_type' => 'required|max:255',            
            
        ]);

        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
            
        ]);

        $data = $request->except(['_method','_token']);

             
        Category::Where('id',$id)
            ->update($data);         

        return redirect('/admin/categories')->with('success','Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = Category::find($id);
        
        if(!$record){
            return abort(404);
        }
        Category::Where('id',$id)->delete();
        
        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function updateStatus(Request $request){
       
        $record = Category::findOrFail($request->model_id);   

        $record->update([$request->status_type => $request->status]);
        

        return response()->json([
            'status' => 'success',
            'message' => 'Record updated successfully!'
        ]);
    }
}
