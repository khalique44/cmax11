<?php

namespace App\Http\Controllers\Admin\Modules;

use App\MembershipYearColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class YearColorController extends Controller
{
    public function index()
    {
        $year_color = MembershipYearColor::all();
        return view('admin.modules.year_color.index',compact('year_color'));
    }

    public function create()
    {
        return view('admin.modules.year_color.create');
    }

    public function store(Request $request)
    {
        $membership_color = new MembershipYearColor;

        $membership_color->year = $request->input('txt_year');
        $membership_color->color = $request->input('txt_color');
        $membership_color->active = $request->input('radio_active');

        $membership_color->save();

        return redirect('/admin/modules/membership_year_color');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $membership_year_color = MembershipYearColor::find($id);
        if(!$membership_year_color){
            return abort(404);
        }
        return view('admin.modules.year_color.edit',compact('membership_year_color'));

    }

    public function update(Request $request, $id)
    {
        $membership_color_year = $request->input('txt_year');
        $membership_color_color = $request->input('txt_color');
        $membership_color_active = $request->input('radio_active');

        $data = array(
            'year' => $membership_color_year,
            'color' => $membership_color_color,
            'active' => $membership_color_active

        );
        MembershipYearColor::Where('id',$id)
            ->update($data);
        return redirect('/admin/modules/membership_year_color');

    }

    public function destroy($id)
    {
        $membership_year_color = MembershipYearColor::find($id);
        if(!$membership_year_color){
            return abort(404);
        }
        MembershipYearColor::Where('id',$id)->delete();
        return redirect('/admin/modules/membership_year_color');
    }
}
