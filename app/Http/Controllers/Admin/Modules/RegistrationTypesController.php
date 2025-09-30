<?php

namespace App\Http\Controllers\Admin\Modules;

use App\District;
use App\RegistrationType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationTypesController extends Controller
{
    public function index()
    {
        $registration_types = RegistrationType::orderBy('name')->get();
        return view('admin.modules.registration_types.index',compact('registration_types'));
    }

    public function create()
    {
        return view('admin.modules.registration_types.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120|unique:registration_types'
        ]);

        RegistrationType::create($request->all());
        return redirect('/admin/modules/registration_types');
    }

    public function show()
    {
    }

    public function edit($id)
    {
        $registration_type = RegistrationType::find($id);
        if(!$registration_type){
            return abort(404);
        }
        return view('admin.modules.registration_types.edit',compact('registration_type'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required|max:120|unique:registration_types,name,'.$id,
        ]);

        $registration_type = RegistrationType::find($id);
        if(!$registration_type){
            return abort(404);
        }

        RegistrationType::Where('id',$id)->update($request->except(['_token','_method']));

        return redirect('/admin/modules/registration_types');

    }
    public function destroy($id)
    {
        $registration_type = RegistrationType::find($id);
        if(!$registration_type){
            return abort(404);
        }

        $registration_type->delete();
        return redirect('/admin/modules/registration_types');
    }
}
