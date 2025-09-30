<?php

namespace App\Http\Controllers\Admin\Modules;

use App\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = \DB::select("SELECT * , CONCAT(zip_code_from,'-', zip_code_to) AS zip_code_range,
                                (
                                    SELECT name
                                    From countries c 
                                    WHERE c.id = d.country
                                )as country_name,
                                (
                                    SELECT name
                                    From states s 
                                    WHERE s.id = d.state
                                )as state_name

                                FROM districts d
                                WHERE d.deleted_at is null
                               ");


        return view('admin.modules.districts.index',compact('districts'));
    }

    public function create()
    {
        $countries = \DB::table('countries')->OrderBy('name')->get();
        return view('admin.modules.districts.create',compact('countries'));

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'district_name' => 'required|max:120',
            'district_number' => 'required',
            'chairman_name' => 'required|max:120',
            'country'       => 'required',
            'zip_code_from' => 'required',
            'zip_code_to' => 'required'
        ]);

        District::create($request->all());

        return redirect('/admin/modules/districts');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $district = District::find($id);
        if(!$district){
            return abort(404);
        }
        $countries = \DB::table('countries')->OrderBy('name')->get();
        return view('admin.modules.districts.edit',compact('district','countries'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'district_name' => 'required|max:120',
            'district_number' => 'required',
            'chairman_name' => 'required|max:120',
            'country'       => 'required',
            'zip_code_from' => 'required',
            'zip_code_to' => 'required'
        ]);

        $district = District::find($id);
        if(!$district){
            return abort(404);
        }

        $district->update($request->all());

        return redirect('/admin/modules/districts');
    }

    public function destroy($id)
    {
        $district = District::find($id);
        if(!$district){
            return abort(404);
        }

        $district->delete();
        return redirect('/admin/modules/districts');
    }
}
