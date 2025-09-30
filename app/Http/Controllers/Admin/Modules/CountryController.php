<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin.modules.countries.index',compact('countries'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $country = Country::find($id);
        if(!$country){
            return abort(404);
        }
        return view('admin.modules.countries.edit',compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country_name = $request->input('txt_country_name');
        $country_status = $request->input('country_status');

        Country::Where('id',$id)
            ->update(['active' => $country_status]);

        return redirect('/admin/modules/countries');
    }

    public function destroy($id)
    {
        //
    }
}
