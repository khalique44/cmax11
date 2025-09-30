<?php

namespace App\Http\Controllers\Admin\Modules;

use App\IpRestriction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class IpRestrictionController extends Controller
{
    public function index()
    {
        $ip_restriction_data = IpRestriction::all();
        return view('admin.modules.ip_restrictions.index',compact('ip_restriction_data'));
    }

    public function create()
    {
        return view('admin.modules.ip_restrictions.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'ip' => 'required|ip'
        ]);


        if ($validator->fails()) {            
            return back()->withErrors($validator)->exceptInput();
        }
        
        $ip_restriction = new IpRestriction;

        $ip_restriction->ip = $request->input('ip');
        $ip_restriction->type = $request->input('type');
        $ip_restriction->mode = $request->input('mode');

        $ip_restriction->save();

        return redirect('/admin/modules/ip_restrictions');
    }


    public function edit($id)
    {
        $ip_restriction = IpRestriction::find($id);
        if(!$ip_restriction){
            return abort(404);
        }
        return view('admin.modules.ip_restrictions.edit',compact('ip_restriction'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
        'ip' => 'required|ip'
        ]);


        if ($validator->fails()) {            
            return back()->withErrors($validator)->exceptInput();
        }

        $ip = $request->input('ip');
        $type = $request->input('type');
        $mode = $request->input('mode');

        $data = array(
            'ip' => $ip,
            'type' => $type,
            'mode' => $mode,

        );
        IpRestriction::Where('id',$id)
            ->update($data);

        return redirect('/admin/modules/ip_restrictions');
    }

    public function destroy($id)
    {
        $ip_restriction = IpRestriction::find($id);
        if(!$ip_restriction){
            return abort(404);
        }
        IpRestriction::Where('id',$id)->delete();
        return redirect('/admin/modules/ip_restrictions');
    }
}
