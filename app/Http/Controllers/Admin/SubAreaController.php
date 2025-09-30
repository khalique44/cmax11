<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Area;
use App\SubArea;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class SubAreaController extends Controller
{
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
}