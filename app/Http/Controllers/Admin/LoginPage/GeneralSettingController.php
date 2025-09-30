<?php

namespace App\Http\Controllers\Admin\LoginPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\RosenHelper;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $login_title = RosenHelper::getOption('login_title');
        $login_description = RosenHelper::getOption('login_description');
        $login_header_image = RosenHelper::getOption('login_header_image');
        
        return view('admin.login_page.general_settings.edit',compact('login_title','login_description','login_header_image'));
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
            'login_title' => 'required|max:255',
            'login_header_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=1920,max_height=920',
        ]);

        
        
        RosenHelper::setOption('login_title',$request->login_title);
        RosenHelper::setOption('login_description',$request->login_description);
        

        if(!empty($request->login_header_image)){
            $folderName = 'login_header_images';
            $fileName = pathinfo($request->login_header_image->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->login_header_image->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->login_header_image->move(public_path('assets/'.$folderName), $fullFileName);
            $login_header_image = 'assets/'.$folderName.'/'.$fullFileName;
            RosenHelper::setOption('login_header_image',$login_header_image);
        }
        

        return redirect('/admin/login_page/general_settings');
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
