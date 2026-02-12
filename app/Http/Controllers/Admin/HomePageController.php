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
            'home_section_project_type' => 'max:255',
            'home_section_project_type2' => 'max:255',
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
        GeneralHelper::setOption('home_section_project_type2',$request->home_section_project_type2);
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
        $home_section_project_type2 = GeneralHelper::getOption('home_section_project_type2');
        $first_box_offer = GeneralHelper::getOption('first_box_offer');
        $first_box_offer_image = GeneralHelper::getOption('first_box_offer_image');

        $second_box_offer = GeneralHelper::getOption('second_box_offer');
        $second_box_offer_image = GeneralHelper::getOption('second_box_offer_image');

        $third_box_offer = GeneralHelper::getOption('third_box_offer');
        $third_box_offer_image = GeneralHelper::getOption('third_box_offer_image');

        $fourth_box_offer = GeneralHelper::getOption('fourth_box_offer');
        $fourth_box_offer_image = GeneralHelper::getOption('fourth_box_offer_image');

        return view('admin.home_page.home_page_sections.edit',compact('offering','home_section_project_type','home_section_project_type2','first_box_offer','first_box_offer_image','second_box_offer','second_box_offer_image','third_box_offer','third_box_offer_image','fourth_box_offer','fourth_box_offer_image'));
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
            'popular_location_title' => 'max:255',
            'home_section_popular_location' => 'required|max:255',
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
       
        
        GeneralHelper::setOption('popular_location_title',$request->popular_location_title);
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
        $popular_location_title = GeneralHelper::getOption('popular_location_title');
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

        return view('admin.home_page.home_page_sections.popular_locations.edit',compact('areas','popular_location_title','home_section_popular_location','first_box_location','first_box_location_image','second_box_location','second_box_location_image','third_box_location','third_box_location_image','fourth_box_location','fourth_box_location_image','fifth_box_location','fifth_box_location_image','sixth_box_location','sixth_box_location_image'));
    }

    public function sectionDreamProperty(){

        $dream_property_title1 = GeneralHelper::getOption('dream_property_title1');
        $dream_property_title2 = GeneralHelper::getOption('dream_property_title2');
        $section_dream_property = GeneralHelper::getOption('section_dream_property');       


        return view('admin.home_page.home_page_sections.dream_property.edit',compact('dream_property_title1','dream_property_title2','section_dream_property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDreamProperty(Request $request)
    {
        $request->validate([
            'dream_property_title1' => 'max:255',
            'dream_property_title2' => 'max:255',
            'section_dream_property' => 'required',
            
            
        ]);       
        
        GeneralHelper::setOption('dream_property_title1',$request->dream_property_title1);
        GeneralHelper::setOption('dream_property_title2',$request->dream_property_title2);
        GeneralHelper::setOption('section_dream_property',$request->section_dream_property);
            

        return redirect('/admin/home-page/dream-property')->with('success', 'Data saved successfully!');
    }


    public function sectionPopularProjects(){

        $popular_projects_title1 = GeneralHelper::getOption('popular_projects_title1');
        $popular_projects_title2 = GeneralHelper::getOption('popular_projects_title2');


        return view('admin.home_page.home_page_sections.popular_projects.edit',compact('popular_projects_title1','popular_projects_title2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePopularProjects(Request $request)
    {
        $request->validate([
            'popular_projects_title1' => 'max:255',
            'popular_projects_title2' => 'max:255',        
                        
        ]);       
        
        GeneralHelper::setOption('popular_projects_title1',$request->popular_projects_title1);
        GeneralHelper::setOption('popular_projects_title2',$request->popular_projects_title2);
                  
        return redirect('/admin/home-page/popular-projects')->with('success', 'Data saved successfully!');
    }

    public function sectionInquiryForm(){

        $inquiry_form_title1 = GeneralHelper::getOption('inquiry_form_title1');
        $inquiry_form_title2 = GeneralHelper::getOption('inquiry_form_title2');


        return view('admin.home_page.home_page_sections.inquiry_form.edit',compact('inquiry_form_title1','inquiry_form_title2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateInquiryForm(Request $request)
    {
        $request->validate([
            'inquiry_form_title1' => 'max:255',
            'inquiry_form_title2' => 'max:255',        
                        
        ]);       
        
        GeneralHelper::setOption('inquiry_form_title1',$request->inquiry_form_title1);
        GeneralHelper::setOption('inquiry_form_title2',$request->inquiry_form_title2);
                  
        return redirect('/admin/home-page/inquiry-form')->with('success', 'Data saved successfully!');
    }


    public function sectionLatestBlogs(){

        $latest_blog_title = GeneralHelper::getOption('latest_blog_title');
        

        return view('admin.home_page.home_page_sections.our_latest_blogs.edit',compact('latest_blog_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLatestBLogs(Request $request)
    {
        $request->validate([
            'latest_blog_title' => 'max:255',            
                        
        ]);       
        
        GeneralHelper::setOption('latest_blog_title',$request->latest_blog_title);
        
                  
        return redirect('/admin/home-page/latest-blogs')->with('success', 'Data saved successfully!');
    }


    public function sectionHomePage(){

        $home_page_title = GeneralHelper::getOption('home_page_title');
        $home_page_description = GeneralHelper::getOption('home_page_description');
        $home_page_header_image = GeneralHelper::getOption('home_page_header_image');        
        $home_page_meta_title = GeneralHelper::getOption('home_page_meta_title');
        $home_page_meta_description = GeneralHelper::getOption('home_page_meta_description');
        $home_page_meta_keywords = GeneralHelper::getOption('home_page_meta_keywords');

        return view('admin.home_page.general_settings.edit',compact('home_page_title','home_page_description','home_page_header_image','home_page_meta_title','home_page_meta_description','home_page_meta_keywords'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateHomePage(Request $request)
    {
        $request->validate([
           'home_page_title' => 'max:255',
           'home_page_header_image' => 'mimes:jpeg,png,jpg,gif,svg|max:5000|dimensions:max_width=1920',       
                        
        ]);       

        if ($request->hasFile('home_page_header_image')) {

            $url = FileHelper::uploadImage($request->file('home_page_header_image'), 'home_page_header_image');
            
            GeneralHelper::setOption('home_page_header_image',$url);
        }
        
        GeneralHelper::setOption('home_page_title',$request->home_page_title);
        GeneralHelper::setOption('home_page_description',$request->home_page_description);
        GeneralHelper::setOption('home_page_meta_title',$request->home_page_meta_title);
        GeneralHelper::setOption('home_page_meta_description',$request->home_page_meta_description);
        GeneralHelper::setOption('home_page_meta_keywords',$request->home_page_meta_keywords);
        
                  
        return redirect('/admin/home-page/home-settings')->with('success', 'Data saved successfully!');
    }
}
