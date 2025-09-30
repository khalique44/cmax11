<?php

namespace App\Http\Controllers\Admin\Modules;

use App\RegistrationYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationYearController extends Controller
{
    public function index()
    {
        $registration_years = RegistrationYear::orderBy('year')->get();
        return view('admin.modules.registration_years.index',compact('registration_years'));
    }

    public function create()
    {
        return view('admin.modules.registration_years.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'year' => 'required|max:4|unique:registration_years'
        ]);

        RegistrationYear::create($request->all());
        return redirect('/admin/modules/registration_years');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $registration_year = RegistrationYear::find($id);
        if(!$registration_year){
            return abort(404);
        }
        return view('admin.modules.registration_years.edit',compact('registration_year'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'year' => 'required|max:4|unique:registration_years,year,'.$id,
        ]);

        $registration_year = RegistrationYear::find($id);
        if(!$registration_year){
            return abort(404);
        }

        RegistrationYear::Where('id',$id)->update($request->except(['_token','_method']));

        return redirect('/admin/modules/registration_years');
    }

    public function destroy($id)
    {
        $registration_year = RegistrationYear::find($id);
        if(!$registration_year){
            return abort(404);
        }

        $registration_year->forceDelete();
        return redirect('/admin/modules/registration_years');
    }
}
