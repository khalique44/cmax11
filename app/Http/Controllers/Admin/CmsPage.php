<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\GeneralHelper;

class CmsPage extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function aboutUs(){

        $aboutus_title = GeneralHelper::getOption('aboutus_title');
        $aboutus_header_image = GeneralHelper::getOption('aboutus_header_image');

        $aboutus_section1_title1 = GeneralHelper::getOption('aboutus_section1_title1');
        $aboutus_section1_title2 = GeneralHelper::getOption('aboutus_section1_title2');
        $aboutus_section1_description1 = GeneralHelper::getOption('aboutus_section1_description1');

        $aboutus_section2_title1 = GeneralHelper::getOption('aboutus_section2_title1');
        $aboutus_section2_title2 = GeneralHelper::getOption('aboutus_section2_title2');
        $aboutus_section2_description1 = GeneralHelper::getOption('aboutus_section2_description1');

        $aboutus_section3_title1 = GeneralHelper::getOption('aboutus_section3_title1');
        $aboutus_section3_title2 = GeneralHelper::getOption('aboutus_section3_title2');
        $aboutus_section3_description1 = GeneralHelper::getOption('aboutus_section3_description1');
        $aboutus_section3_description2 = GeneralHelper::getOption('aboutus_section3_description2');
        $aboutus_section3_image1 = GeneralHelper::getOption('aboutus_section3_image1');
        $aboutus_section3_image2 = GeneralHelper::getOption('aboutus_section3_image2');

        $aboutus_meta_title = GeneralHelper::getOption('aboutus_meta_title');
        $aboutus_meta_description = GeneralHelper::getOption('aboutus_meta_description');
        $aboutus_meta_keywords = GeneralHelper::getOption('aboutus_meta_keywords');

        return view('admin.cms_pages.about_us.edit',compact(
            'aboutus_title',
            'aboutus_header_image',

            'aboutus_section1_title1',
            'aboutus_section1_title2',
            'aboutus_section1_description1',

            'aboutus_section2_title1',
            'aboutus_section2_title2',
            'aboutus_section2_description1',

            'aboutus_section3_title1',
            'aboutus_section3_title2',
            'aboutus_section3_description1',
            'aboutus_section3_description2',
            'aboutus_section3_image1',
            'aboutus_section3_image2',

            'aboutus_meta_title',
            'aboutus_meta_description',
            'aboutus_meta_keywords',
        

            ));
    }

    public function saveAboutUs(Request $request){

        $request->validate([
            'aboutus_title' => 'required|max:255',
            'aboutus_header_image' => 'mimes:jpeg,png,jpg,gif,svg|max:5000|dimensions:max_width=1920,max_height=915',
            'aboutus_section3_image1' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=64,max_height=64',
            'aboutus_section3_image2' => 'mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=64,max_height=64',
            'aboutus_section1_title1' => 'required|max:255',
            'aboutus_section1_title2' => 'required|max:255',
            //'aboutus_section1_description1' => '',
            'aboutus_section2_title1' => 'required|max:255',
            'aboutus_section2_title1' => 'required|max:255',

            'aboutus_section3_title1' => 'required|max:255',
            'aboutus_section3_title1' => 'required|max:255',
        ]);

        
        
        GeneralHelper::setOption('aboutus_title',$request->aboutus_title);

        GeneralHelper::setOption('aboutus_section1_title1',$request->aboutus_section1_title1);
        GeneralHelper::setOption('aboutus_section1_title2',$request->aboutus_section1_title2);
        GeneralHelper::setOption('aboutus_section1_description1',$request->aboutus_section1_description1);

        GeneralHelper::setOption('aboutus_section2_title1',$request->aboutus_section2_title1);
        GeneralHelper::setOption('aboutus_section2_title2',$request->aboutus_section2_title2);
        GeneralHelper::setOption('aboutus_section2_description1',$request->aboutus_section2_description1);

        GeneralHelper::setOption('aboutus_section3_title1',$request->aboutus_section3_title1);
        GeneralHelper::setOption('aboutus_section3_title2',$request->aboutus_section3_title2);
        GeneralHelper::setOption('aboutus_section3_description1',$request->aboutus_section3_description1);
        GeneralHelper::setOption('aboutus_section3_description2',$request->aboutus_section3_description2);
        
        GeneralHelper::setOption('aboutus_meta_title',$request->aboutus_meta_title);
        GeneralHelper::setOption('aboutus_meta_description',$request->aboutus_meta_description);
        GeneralHelper::setOption('aboutus_meta_keywords',$request->aboutus_meta_keywords);

        $folderName = 'about_us_images';

        if(!empty($request->aboutus_header_image)){
            
            $fileName = pathinfo($request->aboutus_header_image->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->aboutus_header_image->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->aboutus_header_image->move(public_path('uploads/'.$folderName), $fullFileName);
            $url = 'uploads/'.$folderName.'/'.$fullFileName;
            GeneralHelper::setOption('aboutus_header_image',$url);
        }

        if(!empty($request->aboutus_section3_image1)){
            
            $fileName = pathinfo($request->aboutus_section3_image1->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->aboutus_section3_image1->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->aboutus_section3_image1->move(public_path('uploads/'.$folderName), $fullFileName);
            $url = 'uploads/'.$folderName.'/'.$fullFileName;
            GeneralHelper::setOption('aboutus_section3_image1',$url);
        }

        if(!empty($request->aboutus_section3_image2)){
            
            $fileName = pathinfo($request->aboutus_section3_image2->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->aboutus_section3_image2->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->aboutus_section3_image2->move(public_path('uploads/'.$folderName), $fullFileName);
            $url = 'uploads/'.$folderName.'/'.$fullFileName;
            GeneralHelper::setOption('aboutus_section3_image2',$url);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Settings Saved Successfully!',
            
        ]);
    }


    public function career(){

        $career_title = GeneralHelper::getOption('career_title');
        $career_header_image = GeneralHelper::getOption('career_header_image');        
        $career_description = GeneralHelper::getOption('career_description');
        
        $career_meta_title = GeneralHelper::getOption('career_meta_title');
        $career_meta_description = GeneralHelper::getOption('career_meta_description');
        $career_meta_keywords = GeneralHelper::getOption('career_meta_keywords');

        return view('admin.cms_pages.career.edit',compact(
            'career_title',
            'career_header_image',
            'career_description',
            
            'career_meta_title',
            'career_meta_description',
            'career_meta_keywords',
        

            ));
    }

    public function saveCareer(Request $request){

        $request->validate([
            'career_title' => 'required|max:255',
            'career_header_image' => 'mimes:jpeg,png,jpg,gif,svg|max:5000|dimensions:max_width=1920,max_height=915',
           
        ]);        
        
        GeneralHelper::setOption('career_title',$request->career_title);
        GeneralHelper::setOption('career_description',$request->career_description);
        
        
        GeneralHelper::setOption('career_meta_title',$request->career_meta_title);
        GeneralHelper::setOption('career_meta_description',$request->career_meta_description);
        GeneralHelper::setOption('career_meta_keywords',$request->career_meta_keywords);

        $folderName = 'career_images';

        if(!empty($request->career_header_image)){
            
            $fileName = pathinfo($request->career_header_image->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->career_header_image->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->career_header_image->move(public_path('uploads/'.$folderName), $fullFileName);
            $url = 'uploads/'.$folderName.'/'.$fullFileName;
            GeneralHelper::setOption('career_header_image',$url);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Settings Saved Successfully!',
            
        ]);
    }


    public function contactUs(){

        $contact_title = GeneralHelper::getOption('contact_title');
        $contact_header_image = GeneralHelper::getOption('contact_header_image');
        $contact_phone_number = GeneralHelper::getOption('contact_phone_number');
        $contact_email_address = GeneralHelper::getOption('contact_email_address');        
        $contact_address = GeneralHelper::getOption('contact_address');
        $contact_embed_map = GeneralHelper::getOption('contact_embed_map');
        
        $contact_meta_title = GeneralHelper::getOption('contact_meta_title');
        $contact_meta_description = GeneralHelper::getOption('contact_meta_description');
        $contact_meta_keywords = GeneralHelper::getOption('contact_meta_keywords');

        return view('admin.cms_pages.contact_us.edit',compact(
            'contact_title',
            'contact_header_image',
            'contact_phone_number',
            'contact_email_address',
            'contact_address',
            'contact_embed_map',
              
            'contact_meta_title',
            'contact_meta_description',
            'contact_meta_keywords',
        

            ));
    }

    public function saveContactUs(Request $request){

        $request->validate([
            'contact_title' => 'required|max:255',
            'contact_phone_number' => 'required|max:15',
            'contact_email_address' => 'required|email|max:255',
            'contact_address' => 'required|max:255',
            'contact_embed_map' => 'required|max:510',
            'contact_header_image' => 'mimes:jpeg,png,jpg,gif,svg|max:5000|dimensions:max_width=1920,max_height=915',
           
        ]);        
        
        GeneralHelper::setOption('contact_title',$request->contact_title);
        GeneralHelper::setOption('contact_phone_number',$request->contact_phone_number);
        GeneralHelper::setOption('contact_email_address',$request->contact_email_address);        
        GeneralHelper::setOption('contact_address',$request->contact_address);
        GeneralHelper::setOption('contact_embed_map',$request->contact_embed_map);
        
        
        GeneralHelper::setOption('contact_meta_title',$request->contact_meta_title);
        GeneralHelper::setOption('contact_meta_description',$request->contact_meta_description);
        GeneralHelper::setOption('contact_meta_keywords',$request->contact_meta_keywords);

        $folderName = 'contact_us_images';

        if(!empty($request->contact_header_image)){
            
            $fileName = pathinfo($request->contact_header_image->getClientOriginalName(), PATHINFO_FILENAME);           
            $fullFileName = $fileName."-".time().'.'.$request->contact_header_image->getClientOriginalExtension();
            $fullFileName = str_replace(" ","_",$fullFileName);
            $request->contact_header_image->move(public_path('uploads/'.$folderName), $fullFileName);
            $url = 'uploads/'.$folderName.'/'.$fullFileName;
            GeneralHelper::setOption('contact_header_image',$url);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Settings Saved Successfully!',
            
        ]);
    }
}
