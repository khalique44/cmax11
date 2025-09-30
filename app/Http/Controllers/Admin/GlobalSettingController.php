<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\RosenHelper;

class GlobalSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header_logo = RosenHelper::getOption('header_logo');
        $footer_logo = RosenHelper::getOption('footer_logo');
        $footer_text_under_logo = RosenHelper::getOption('footer_text_under_logo');
        $facebook_url = RosenHelper::getOption('facebook_url');
        $footer_center_column_heading = RosenHelper::getOption('footer_center_column_heading');
        $footer_last_column_heading = RosenHelper::getOption('footer_last_column_heading');
        $copy_right_text = RosenHelper::getOption('copy_right_text');
        $global_date_format = RosenHelper::getOption('global_date_format');
        
        return view('admin.global_settings.edit',compact('header_logo','footer_logo','footer_text_under_logo','facebook_url','footer_center_column_heading','footer_last_column_heading','copy_right_text','global_date_format'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            
            'header_logo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=316,max_height=85',
            'footer_logo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=316,max_height=85',
        ]);

        
        
        RosenHelper::setOption('footer_text_under_logo',$request->footer_text_under_logo);
        RosenHelper::setOption('facebook_url',$request->facebook_url);
        RosenHelper::setOption('footer_center_column_heading',$request->footer_center_column_heading);
        RosenHelper::setOption('footer_last_column_heading',$request->footer_last_column_heading);
        RosenHelper::setOption('copy_right_text',$request->copy_right_text);
        RosenHelper::setOption('global_date_format',$request->global_date_format);
        

        if(!empty($request->header_logo)){
            $folderName = 'header_logo';
            $fileName = pathinfo($request->header_logo->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->header_logo->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->header_logo->move(public_path('assets/'.$folderName), $fullFileName);
            $header_logo = 'assets/'.$folderName.'/'.$fullFileName;
            RosenHelper::setOption('header_logo',$header_logo);
        }

        if(!empty($request->footer_logo)){
            $folderName = 'footer_logo';
            $fileName = pathinfo($request->footer_logo->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->footer_logo->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->footer_logo->move(public_path('assets/'.$folderName), $fullFileName);
            $footer_logo = 'assets/'.$folderName.'/'.$fullFileName;
            RosenHelper::setOption('footer_logo',$header_logo);
        }
        

        return redirect('/admin/global-settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
