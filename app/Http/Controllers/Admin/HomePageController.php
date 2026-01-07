<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\GeneralHelper;
use App\Http\Helpers\FileHelper;
use App\Area;

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
            'first_box_offer_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'second_box_offer_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'third_box_offer_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fourth_box_offer_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);

        if($request->hasFile('first_box_offer_image')){           

            $fileUrl = FileHelper::uploadImage($request->file('first_box_offer_image'), 'home_section_project_types');           
            GeneralHelper::setOption('first_box_offer_image',$fileUrl);
        }

        if($request->hasFile('second_box_offer_image')){           

            $fileUrl = FileHelper::uploadImage($request->file('second_box_offer_image'), 'home_section_project_types');           
            GeneralHelper::setOption('second_box_offer_image',$fileUrl);
        }

        if($request->hasFile('third_box_offer_image')){           

            $fileUrl = FileHelper::uploadImage($request->file('third_box_offer_image'), 'home_section_project_types');           
            GeneralHelper::setOption('third_box_offer_image',$fileUrl);
        }

        if($request->hasFile('fourth_box_offer_image')){           

            $fileUrl = FileHelper::uploadImage($request->file('fourth_box_offer_image'), 'home_section_project_types');           
            GeneralHelper::setOption('fourth_box_offer_image',$fileUrl);
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePopularLocations(Request $request)
    {
        $request->validate([
            'home_section_popular_location' => 'required',
            'first_box_location' => 'required',
            'second_box_location' => 'required',
            'third_box_location' => 'required',
            'fourth_box_location' => 'required',
            'fifth_box_location' => 'required',
            'sixth_box_location' => 'required',
            'first_box_location_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'second_box_location_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'third_box_location_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fourth_box_location_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fifth_box_location_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sixth_box_location_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);

        if($request->hasFile('first_box_location_image')){           

            $fileUrl = FileHelper::uploadImage($request->file('first_box_location_image'), 'home_section_popluar_locations');           
            GeneralHelper::setOption('first_box_location_image',$fileUrl);
        }

        if($request->hasFile('second_box_location_image')){           

            $fileUrl = FileHelper::uploadImage($request->file('second_box_location_image'), 'home_section_popluar_locations');           
            GeneralHelper::setOption('second_box_location_image',$fileUrl);
        }

        if($request->hasFile('third_box_location_image')){           

            $fileUrl = FileHelper::uploadImage($request->file('third_box_location_image'), 'home_section_popluar_locations');           
            GeneralHelper::setOption('third_box_location_image',$fileUrl);
        }

        if($request->hasFile('fourth_box_location_image')){           

            $fileUrl = FileHelper::uploadImage($request->file('fourth_box_location_image'), 'home_section_popluar_locations');           
            GeneralHelper::setOption('fourth_box_location_image',$fileUrl);
        }

        if($request->hasFile('fifth_box_location_image')){           

            $fileUrl = FileHelper::uploadImage($request->file('fifth_box_location_image'), 'home_section_popluar_locations');           
            GeneralHelper::setOption('fifth_box_location_image',$fileUrl);
        }

        if($request->hasFile('sixth_box_location_image')){           

            $fileUrl = FileHelper::uploadImage($request->file('sixth_box_location_image'), 'home_section_popluar_locations');           
            GeneralHelper::setOption('sixth_box_location_image',$fileUrl);
        }
       
        
        GeneralHelper::setOption('home_section_popular_location',$request->home_section_popular_location);
        GeneralHelper::setOption('first_box_location',$request->first_box_location);
        GeneralHelper::setOption('second_box_location',$request->second_box_location);
        GeneralHelper::setOption('third_box_location',$request->third_box_location);
        GeneralHelper::setOption('fourth_box_location',$request->fourth_box_location);        
        GeneralHelper::setOption('fifth_box_location',$request->fifth_box_location);        
        GeneralHelper::setOption('sixth_box_location',$request->sixth_box_location);        

        return redirect('/admin/home-page/popular-locations')->with('success', 'Data saved successfully!');
    }

    public function sectionPopularLocations(){

        $areas = Area::orderBy('name' , 'asc')->get();
        $home_section_popular_location = GeneralHelper::getOption('home_section_popular_location');
        $first_box_location = GeneralHelper::getOption('first_box_location');
        $first_box_location_image = GeneralHelper::getOption('first_box_location_image');

        $second_box_location = GeneralHelper::getOption('second_box_location');
        $second_box_location_image = GeneralHelper::getOption('second_box_location_image');

        $third_box_location = GeneralHelper::getOption('third_box_location');
        $third_box_location_image = GeneralHelper::getOption('third_box_location_image');

        $fourth_box_location = GeneralHelper::getOption('fourth_box_location');
        $fourth_box_location_image = GeneralHelper::getOption('fourth_box_location_image');

        $fifth_box_location = GeneralHelper::getOption('fifth_box_location');
        $fifth_box_location_image = GeneralHelper::getOption('fifth_box_location_image');        

        $sixth_box_location = GeneralHelper::getOption('sixth_box_location');
        $sixth_box_location_image = GeneralHelper::getOption('sixth_box_location_image');

        /* $seventh_box_location = GeneralHelper::getOption('seventh_box_location');
        $seventh_box_location_image = GeneralHelper::getOption('seventh_box_location_image');

        $eighth_box_location = GeneralHelper::getOption('eighth_box_location');
        $eighth_box_location_image = GeneralHelper::getOption('eighth_box_location_image'); */

        return view('admin.home_page.home_page_sections.popular_locations.edit',compact('areas','home_section_popular_location','first_box_location','first_box_location_image','second_box_location','second_box_location_image','third_box_location','third_box_location_image','fourth_box_location','fourth_box_location_image','fifth_box_location','fifth_box_location_image','sixth_box_location','sixth_box_location_image'));
    }
}
