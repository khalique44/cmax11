<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\CareerFormMail;
use App\Mail\PropertyInquiryMail;
use App\Mail\ProjectInquiryMail;


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


    public function showAboutUs(){
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

        $meta_title = GeneralHelper::getOption('aboutus_meta_title');
        $meta_description = GeneralHelper::getOption('aboutus_meta_description');
        $meta_keywords = GeneralHelper::getOption('aboutus_meta_keywords');

        return view('cms_pages.about_us',compact(
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

            'meta_title',
            'meta_description',
            'meta_keywords',
        

            ));
    }

    public function showCareer(){
        $career_title = GeneralHelper::getOption('career_title');
        $career_header_image = GeneralHelper::getOption('career_header_image');
        $career_description = GeneralHelper::getOption('career_description');        

        $meta_title = GeneralHelper::getOption('career_meta_title');
        $meta_description = GeneralHelper::getOption('career_meta_description');
        $meta_keywords = GeneralHelper::getOption('career_meta_keywords');

        return view('cms_pages.career',compact(
            'career_title',
            'career_header_image',
            'career_description',            

            'meta_title',
            'meta_description',
            'meta_keywords',
        

            ));
    }

    public function submitCareerForm(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'area_of_interest' => 'required|string',
        ]);

        // Send email
        Mail::to(config('constants.admin_email'))->send(new CareerFormMail($data));

        $dataToBitrix = [
            'fields' => [
                'TITLE' => 'New Career Form submitted!',
                'NAME'  => $request->name,
                'LAST_NAME' => '',
                'EMAIL' => $request->email,
                'PHONE' => $request->phone,
                'COMMENTS' => $request->area_of_interest,
            ],
            
        ];
        $dataToBitrix = [
            'fields' => [
                'TITLE' => 'New Career Form submitted!',
                'NAME'  => $request->name,
                'LAST_NAME' => '',
                'EMAIL' => [["VALUE"=>$request->email,"VALUE_TYPE"=>"WORK"]],
                'PHONE' => [["VALUE"=>$request->phone,"VALUE_TYPE"=>"WORK"]],
                'COMMENTS' => 'Area of Interest: '.$request->area_of_interest,                
            ],
            
        ];

        GeneralHelper::sendBitrixRequest($dataToBitrix);

        return response()->json(['message' => 'Thank you! Your message has been sent.']);

    }

    public function showContactUs(){

        $contact_title = GeneralHelper::getOption('contact_title');
        $contact_header_image = GeneralHelper::getOption('contact_header_image');
        $contact_phone_number = GeneralHelper::getOption('contact_phone_number');
        $contact_email_address = GeneralHelper::getOption('contact_email_address');        
        $contact_address = GeneralHelper::getOption('contact_address');
        $contact_embed_map = GeneralHelper::getOption('contact_embed_map');
        
        $meta_title = GeneralHelper::getOption('contact_meta_title');
        $meta_description = GeneralHelper::getOption('contact_meta_description');
        $meta_keywords = GeneralHelper::getOption('contact_meta_keywords');

        return view('cms_pages.contact_us',compact(
            'contact_title',
            'contact_header_image',
            'contact_phone_number',
            'contact_email_address',
            'contact_address',
            'contact_embed_map',
              
            'meta_title',
            'meta_description',
            'meta_keywords',
        

            ));
    }

    public function submitContactUs(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Send email
        Mail::to(config('constants.admin_email'))->send(new ContactFormMail($data));

        $dataToBitrix = [
            'fields' => [
                'TITLE' => 'New Contact Query submitted!',
                'NAME'  => $request->name,
                'LAST_NAME' => '',
                'EMAIL' => [["VALUE"=>$request->email,"VALUE_TYPE"=>"WORK"]],
                'PHONE' => [["VALUE"=>$request->phone,"VALUE_TYPE"=>"WORK"]],
                'COMMENTS' => $request->message,                
            ],
            
        ];

        GeneralHelper::sendBitrixRequest($dataToBitrix);

        return response()->json(['message' => 'Thank you! Your message has been sent.']);

    }


    public function submitInquiryForm(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email',
            'phone'         => 'required|string|max:20',
            'property_type' => 'required|string',
            'budget'        => 'nullable|string|max:255',
            'location'      => 'nullable|string|max:255',
            'message'       => 'nullable|string',
        ]);

        Mail::to(config('constants.admin_email'))->send(new PropertyInquiryMail($data));

        $comments = 'Property Type: '.$request->property_type;
        $comments .= 'Budget: '.$request->budget;
        $comments .= 'Location: '.$request->location;
        $comments .= 'Message: '.$request->message;

        $dataToBitrix = [
            'fields' => [
                'TITLE' => 'New Inquery Form submitted!',
                'NAME'  => $request->name,
                'LAST_NAME' => '',
                'EMAIL' => [["VALUE"=>$request->email,"VALUE_TYPE"=>"WORK"]],
                'PHONE' => [["VALUE"=>$request->phone,"VALUE_TYPE"=>"WORK"]],
                'COMMENTS' => $comments,
                'ADDRESS' => $request->location,
            ],
            
        ];

        GeneralHelper::sendBitrixRequest($dataToBitrix);

        return response()->json(['message' => 'Your inquiry has been sent successfully!']);
    }

    public function submitProjectInquiryForm(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email',
            'phone'         => 'required|string|max:20',
            'address'       => 'nullable|string',
            'unit_type'     => 'nullable|string|max:255',            
            'message'       => 'nullable|string',
        ]);

        Mail::to(config('constants.admin_email'))->send(new ProjectInquiryMail($request->all()));
        
        $project_title = $request->project_title ?? '';
        $comments = 'Project Title: '.$project_title.'<br>';       
        $comments .= 'Unit Type: '.$request->unit_type.'<br>';       
        $comments .= 'Message: '.$request->message;
        

        $dataToBitrix = [
            'fields' => [
                'TITLE' => 'New Project Inquery Form submitted! ',
                'NAME'  => $request->name,
                'LAST_NAME' => '',
                'EMAIL' => [["VALUE"=>$request->email,"VALUE_TYPE"=>"WORK"]],
                'PHONE' => [["VALUE"=>$request->phone,"VALUE_TYPE"=>"WORK"]],
                'COMMENTS' => $comments,
                'ADDRESS' => $request->address,
            ],
            
        ];
        $data["fields"]["PHONE"][]=array("VALUE"=>"+923360321068","VALUE_TYPE"=>"WORK");

               //[
                       // [
                        //    'VALUE'      => '555888',
                        //    'VALUE_TYPE' => 'WORK',
                     //   },


         $data["fields"]["EMAIL"][]=array("VALUE"=>"hzafar2010@gmail.com","VALUE_TYPE"=>"WORK");

        GeneralHelper::sendBitrixRequest($dataToBitrix);

        return response()->json(['message' => 'Your inquiry has been sent successfully!']);
    }


    public function showOurAgents(){
        $our_agents_title = GeneralHelper::getOption('our_agents_title');
        $our_agents_header_image = GeneralHelper::getOption('our_agents_header_image');
        $our_agents_description = GeneralHelper::getOption('our_agents_description');        

        $meta_title = GeneralHelper::getOption('our_agents_meta_title');
        $meta_description = GeneralHelper::getOption('our_agents_meta_description');
        $meta_keywords = GeneralHelper::getOption('our_agents_meta_keywords');

        return view('cms_pages.our_agents',compact(
            'our_agents_title',
            'our_agents_header_image',
            'our_agents_description',            

            'meta_title',
            'meta_description',
            'meta_keywords',
        

            ));
    }

    public function showFaqs(){
        $faqs_title = GeneralHelper::getOption('faqs_title');
        $faqs_header_image = GeneralHelper::getOption('faqs_header_image');
        $faqs_description = GeneralHelper::getOption('faqs_description');        

        $meta_title = GeneralHelper::getOption('faqs_meta_title');
        $meta_description = GeneralHelper::getOption('faqs_meta_description');
        $meta_keywords = GeneralHelper::getOption('faqs_meta_keywords');

        return view('cms_pages.faqs',compact(
            'faqs_title',
            'faqs_header_image',
            'faqs_description',            

            'meta_title',
            'meta_description',
            'meta_keywords',
        

            ));
    }

    public function showPrivacyPolicy(){
        $privacy_policy_title = GeneralHelper::getOption('privacy_policy_title');
        $privacy_policy_header_image = GeneralHelper::getOption('privacy_policy_header_image');
        $privacy_policy_description = GeneralHelper::getOption('privacy_policy_description');        

        $meta_title = GeneralHelper::getOption('privacy_policy_meta_title');
        $meta_description = GeneralHelper::getOption('privacy_policy_meta_description');
        $meta_keywords = GeneralHelper::getOption('privacy_policy_meta_keywords');

        return view('cms_pages.privacy_policy',compact(
            'privacy_policy_title',
            'privacy_policy_header_image',
            'privacy_policy_description',            

            'meta_title',
            'meta_description',
            'meta_keywords',
        

            ));
    }

    public function showTermsAndConditions(){
        $terms_and_conditions_title = GeneralHelper::getOption('terms_and_conditions_title');
        $terms_and_conditions_header_image = GeneralHelper::getOption('terms_and_conditions_header_image');
        $terms_and_conditions_description = GeneralHelper::getOption('terms_and_conditions_description');        

        $meta_title = GeneralHelper::getOption('terms_and_conditions_meta_title');
        $meta_description = GeneralHelper::getOption('terms_and_conditions_meta_description');
        $meta_keywords = GeneralHelper::getOption('terms_and_conditions_meta_keywords');

        return view('cms_pages.terms_and_conditions',compact(
            'terms_and_conditions_title',
            'terms_and_conditions_header_image',
            'terms_and_conditions_description',            

            'meta_title',
            'meta_description',
            'meta_keywords',
        

            ));
    }
}
