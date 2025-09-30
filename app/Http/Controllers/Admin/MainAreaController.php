<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Area;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class MainAreaController extends Controller
{
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
}