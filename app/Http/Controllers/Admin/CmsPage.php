<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\GeneralHelper;
use App\Http\Helpers\FileHelper;

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

        if ($request->hasFile('aboutus_header_image')) {

            $url = FileHelper::uploadImage($request->file('aboutus_header_image'), 'about_us_images');
            
            GeneralHelper::setOption('aboutus_header_image',$url);
        }

        if ($request->hasFile('aboutus_section3_image1')) {

            $url = FileHelper::uploadImage($request->file('aboutus_section3_image1'), 'about_us_images');

            GeneralHelper::setOption('aboutus_section3_image1',$url);
        }

        if ($request->hasFile('aboutus_section3_image2')) {

            $url = FileHelper::uploadImage($request->file('aboutus_section3_image2'), 'about_us_images');

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

        if ($request->hasFile('career_header_image')) {

            $url = FileHelper::uploadImage($request->file('career_header_image'), 'career_images');

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
            'contact_header_image' => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
           
        ]);        
        
        GeneralHelper::setOption('contact_title',$request->contact_title);
        GeneralHelper::setOption('contact_phone_number',$request->contact_phone_number);
        GeneralHelper::setOption('contact_email_address',$request->contact_email_address);        
        GeneralHelper::setOption('contact_address',$request->contact_address);
        GeneralHelper::setOption('contact_embed_map',$request->contact_embed_map);
        
        
        GeneralHelper::setOption('contact_meta_title',$request->contact_meta_title);
        GeneralHelper::setOption('contact_meta_description',$request->contact_meta_description);
        GeneralHelper::setOption('contact_meta_keywords',$request->contact_meta_keywords);

        if(!empty($request->contact_header_image)){
            
            $url = FileHelper::uploadImage($request->file('contact_header_image'), 'contact_us_images');
            
            GeneralHelper::setOption('contact_header_image',$url);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Settings Saved Successfully!',
            
        ]);
    }

    public function ourAgents(){

        $our_agents_title = GeneralHelper::getOption('our_agents_title');
        $our_agents_description = GeneralHelper::getOption('our_agents_description');
        $our_agents_header_image = GeneralHelper::getOption('our_agents_header_image');
        
        $our_agents_meta_title = GeneralHelper::getOption('our_agents_meta_title');
        $our_agents_meta_description = GeneralHelper::getOption('our_agents_meta_description');
        $our_agents_meta_keywords = GeneralHelper::getOption('our_agents_meta_keywords');

        return view('admin.cms_pages.our_agents.edit',compact(
            'our_agents_title',
            'our_agents_header_image',
            'our_agents_description',
                        
            'our_agents_meta_title',
            'our_agents_meta_description',
            'our_agents_meta_keywords',
        

            ));
    }

    public function saveOurAgents(Request $request){

        $request->validate([
            'our_agents_title' => 'required|max:255',
            'our_agents_header_image' => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
           
        ]);        
        
        GeneralHelper::setOption('our_agents_title',$request->our_agents_title);
        GeneralHelper::setOption('our_agents_description',$request->our_agents_description);    
        
        GeneralHelper::setOption('our_agents_meta_title',$request->our_agents_meta_title);
        GeneralHelper::setOption('our_agents_meta_description',$request->our_agents_meta_description);
        GeneralHelper::setOption('our_agents_meta_keywords',$request->our_agents_meta_keywords);        

        if(!empty($request->our_agents_header_image)){
            
            $url = FileHelper::uploadImage($request->file('our_agents_header_image'), 'our_agents_images');
            
            GeneralHelper::setOption('our_agents_header_image',$url);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Settings Saved Successfully!',
            
        ]);
    }

    public function faqs(){

        $faqs_title = GeneralHelper::getOption('faqs_title');
        $faqs_header_image = GeneralHelper::getOption('faqs_header_image');        
        $faqs_description = GeneralHelper::getOption('faqs_description');        
       
        $faqs_meta_title = GeneralHelper::getOption('faqs_meta_title');
        $faqs_meta_description = GeneralHelper::getOption('faqs_meta_description');
        $faqs_meta_keywords = GeneralHelper::getOption('faqs_meta_keywords');

        return view('admin.cms_pages.faqs.edit',compact(
            'faqs_title',
            'faqs_header_image',
            'faqs_description',
                          
            'faqs_meta_title',
            'faqs_meta_description',
            'faqs_meta_keywords',
        

            ));
    }

    public function saveFaqs(Request $request){

        $request->validate([
            'faqs_title' => 'required|max:255',            
            'faqs_header_image' => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
           
        ]);        
        
        GeneralHelper::setOption('faqs_title',$request->faqs_title);
        GeneralHelper::setOption('faqs_description',$request->faqs_description);       
        
        GeneralHelper::setOption('faqs_meta_title',$request->faqs_meta_title);
        GeneralHelper::setOption('faqs_meta_description',$request->faqs_meta_description);
        GeneralHelper::setOption('faqs_meta_keywords',$request->faqs_meta_keywords);        

        if(!empty($request->faqs_header_image)){
            
            $url = FileHelper::uploadImage($request->file('faqs_header_image'), 'faqs_images');
            
            GeneralHelper::setOption('faqs_header_image',$url);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Settings Saved Successfully!',
            
        ]);
    }

    public function privacyPolicy(){

        $privacy_policy_title = GeneralHelper::getOption('privacy_policy_title');
        $privacy_policy_header_image = GeneralHelper::getOption('privacy_policy_header_image');        
        $privacy_policy_description = GeneralHelper::getOption('privacy_policy_description');        
       
        $privacy_policy_meta_title = GeneralHelper::getOption('privacy_policy_meta_title');
        $privacy_policy_meta_description = GeneralHelper::getOption('privacy_policy_meta_description');
        $privacy_policy_meta_keywords = GeneralHelper::getOption('privacy_policy_meta_keywords');

        return view('admin.cms_pages.privacy_policy.edit',compact(
            'privacy_policy_title',
            'privacy_policy_header_image',
            'privacy_policy_description',
                          
            'privacy_policy_meta_title',
            'privacy_policy_meta_description',
            'privacy_policy_meta_keywords',
        

            ));
    }

    public function savePrivacyPolicy(Request $request){

        $request->validate([
            'privacy_policy_title' => 'required|max:255',            
            'privacy_policy_header_image' => 'mimes:jpeg,png,jpg,gif,svg|max:5000|dimensions:max_width=1920,max_height=915',
           
        ]);        
        
        GeneralHelper::setOption('privacy_policy_title',$request->privacy_policy_title);
        GeneralHelper::setOption('privacy_policy_description',$request->privacy_policy_description);       
        
        GeneralHelper::setOption('privacy_policy_meta_title',$request->privacy_policy_meta_title);
        GeneralHelper::setOption('privacy_policy_meta_description',$request->privacy_policy_meta_description);
        GeneralHelper::setOption('privacy_policy_meta_keywords',$request->privacy_policy_meta_keywords);        

        if(!empty($request->privacy_policy_header_image)){
            
            $url = FileHelper::uploadImage($request->file('privacy_policy_header_image'), 'privacy_policy_images');
            
            GeneralHelper::setOption('privacy_policy_header_image',$url);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Settings Saved Successfully!',
            
        ]);
    }

    public function termsAndConditions(){

        $terms_and_conditions_title = GeneralHelper::getOption('terms_and_conditions_title');
        $terms_and_conditions_header_image = GeneralHelper::getOption('terms_and_conditions_header_image');        
        $terms_and_conditions_description = GeneralHelper::getOption('terms_and_conditions_description');        
       
        $terms_and_conditions_meta_title = GeneralHelper::getOption('terms_and_conditions_meta_title');
        $terms_and_conditions_meta_description = GeneralHelper::getOption('terms_and_conditions_meta_description');
        $terms_and_conditions_meta_keywords = GeneralHelper::getOption('terms_and_conditions_meta_keywords');

        return view('admin.cms_pages.terms_and_conditions.edit',compact(
            'terms_and_conditions_title',
            'terms_and_conditions_header_image',
            'terms_and_conditions_description',
                          
            'terms_and_conditions_meta_title',
            'terms_and_conditions_meta_description',
            'terms_and_conditions_meta_keywords',
        

            ));
    }

    public function saveTermsAndConditions(Request $request){

        $request->validate([
            'terms_and_conditions_title' => 'required|max:255',            
            'terms_and_conditions_header_image' => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
           
        ]);        
        
        GeneralHelper::setOption('terms_and_conditions_title',$request->terms_and_conditions_title);
        GeneralHelper::setOption('terms_and_conditions_description',$request->terms_and_conditions_description);       
        
        GeneralHelper::setOption('terms_and_conditions_meta_title',$request->terms_and_conditions_meta_title);
        GeneralHelper::setOption('terms_and_conditions_meta_description',$request->terms_and_conditions_meta_description);
        GeneralHelper::setOption('terms_and_conditions_meta_keywords',$request->terms_and_conditions_meta_keywords);        

        if(!empty($request->terms_and_conditions_header_image)){
            
            $url = FileHelper::uploadImage($request->file('terms_and_conditions_header_image'), 'terms_and_conditions_images');
            
            GeneralHelper::setOption('terms_and_conditions_header_image',$url);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Settings Saved Successfully!',
            
        ]);
    }


    public function whyChooseUs(){

        $why_choose_us_title1 = GeneralHelper::getOption('why_choose_us_title1');
        $why_choose_us_title2 = GeneralHelper::getOption('why_choose_us_title2');
        $why_choose_us_description = GeneralHelper::getOption('why_choose_us_description');        
       
        
        return view('admin.home_page.why_choose_us.edit',compact(
            'why_choose_us_title1',
            'why_choose_us_title2',
            'why_choose_us_description',                          

            ));
    }
    
    public function saveWhyChooseUs(Request $request){

        $request->validate([
            'why_choose_us_title1' => 'max:255',            
            'why_choose_us_title2' => 'max:255',   
           
        ]);        
        
        GeneralHelper::setOption('why_choose_us_title1',$request->why_choose_us_title1);
        GeneralHelper::setOption('why_choose_us_title2',$request->why_choose_us_title2);
        GeneralHelper::setOption('why_choose_us_description',$request->why_choose_us_description);       
        
        return response()->json([
            'status' => 'success',
            'message' => 'Settings Saved Successfully!',
            
        ]);
    }
    
}
