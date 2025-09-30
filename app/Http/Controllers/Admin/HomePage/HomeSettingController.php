<?php

namespace App\Http\Controllers\Admin\HomePage;

use App\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class HomeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home_settings = HomeSetting::find(1);
        return view('admin.home_page.general_settings.edit',compact('home_settings'));
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
     * @param  \App\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function show(HomeSetting $homeSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeSetting $homeSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'header_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=1920,max_height=915',
        ]);

        $data = $request->except(['_method','_token']);
        
        if(!empty($request->header_image)){
            $imageName = $request->header_image->getClientOriginalName();
            $request->header_image->move(public_path('assets/header_images'), $imageName);
            $data['header_image'] = 'assets/header_images/'.$imageName;
        }
       
        
        HomeSetting::Where('id',$id)
            ->update($data);

        return redirect('/admin/home_page/home_settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeSetting $homeSetting)
    {
        //
    }
}
