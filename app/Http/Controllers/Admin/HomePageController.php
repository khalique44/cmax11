<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\GeneralHelper;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
            'home_section_project_type' => 'required|max:255',
            'first_box_offer' => 'required|max:255',
            'second_box_offer' => 'required|max:255',
            'third_box_offer' => 'required|max:255',
            'fourth_box_offer' => 'required|max:255',
            'first_box_offer_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=600,max_height=830',
            'second_box_offer_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=600,max_height=830',
            'third_box_offer_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=600,max_height=830',
            'fourth_box_offer_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=600,max_height=830',
            
        ]);

        if(!empty($request->first_box_offer_image)){
            $folderName = 'home_section_project_types';
            $fileName = pathinfo($request->first_box_offer_image->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->first_box_offer_image->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->first_box_offer_image->move(public_path('assets/'.$folderName), $fullFileName);
            $first_box_offer_image = 'assets/'.$folderName.'/'.$fullFileName;
            GeneralHelper::setOption('first_box_offer_image',$first_box_offer_image);
        }

        if(!empty($request->second_box_offer_image)){
            $folderName = 'home_section_project_types';
            $fileName = pathinfo($request->second_box_offer_image->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->second_box_offer_image->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->second_box_offer_image->move(public_path('assets/'.$folderName), $fullFileName);
            $second_box_offer_image = 'assets/'.$folderName.'/'.$fullFileName;
            GeneralHelper::setOption('second_box_offer_image',$second_box_offer_image);
        }

        if(!empty($request->third_box_offer_image)){
            $folderName = 'home_section_project_types';
            $fileName = pathinfo($request->third_box_offer_image->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->third_box_offer_image->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->third_box_offer_image->move(public_path('assets/'.$folderName), $fullFileName);
            $third_box_offer_image = 'assets/'.$folderName.'/'.$fullFileName;
            GeneralHelper::setOption('third_box_offer_image',$third_box_offer_image);
        }


        if(!empty($request->fourth_box_offer_image)){
            $folderName = 'home_section_project_types';
            $fileName = pathinfo($request->fourth_box_offer_image->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->fourth_box_offer_image->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->fourth_box_offer_image->move(public_path('assets/'.$folderName), $fullFileName);
            $fourth_box_offer_image = 'assets/'.$folderName.'/'.$fullFileName;
            GeneralHelper::setOption('fourth_box_offer_image',$fourth_box_offer_image);
        }

        
        
        GeneralHelper::setOption('home_section_project_type',$request->home_section_project_type);
        GeneralHelper::setOption('first_box_offer',$request->first_box_offer);
        GeneralHelper::setOption('second_box_offer',$request->second_box_offer);
        GeneralHelper::setOption('third_box_offer',$request->third_box_offer);
        GeneralHelper::setOption('fourth_box_offer',$request->fourth_box_offer);

        

        return redirect('/admin/home-page/project-types')->with('success', 'Data saved successfully!');
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


    public function sectionProjectTypes(){


        $offering = config('constants.offering');
        $home_section_project_type = GeneralHelper::getOption('home_section_project_type');
        $first_box_offer = GeneralHelper::getOption('first_box_offer');
        $first_box_offer_image = GeneralHelper::getOption('first_box_offer_image');

        $second_box_offer = GeneralHelper::getOption('second_box_offer');
        $second_box_offer_image = GeneralHelper::getOption('second_box_offer_image');

        $third_box_offer = GeneralHelper::getOption('third_box_offer');
        $third_box_offer_image = GeneralHelper::getOption('third_box_offer_image');

        $fourth_box_offer = GeneralHelper::getOption('fourth_box_offer');
        $fourth_box_offer_image = GeneralHelper::getOption('fourth_box_offer_image');

        return view('admin.home_page.home_page_sections.edit',compact('offering','home_section_project_type','first_box_offer','first_box_offer_image','second_box_offer','second_box_offer_image','third_box_offer','third_box_offer_image','fourth_box_offer','fourth_box_offer_image'));
    }
}
