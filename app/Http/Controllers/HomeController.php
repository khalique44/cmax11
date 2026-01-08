<?php

namespace App\Http\Controllers;
use App\Http\Helpers\RosenHelper;
use App\HomeSetting;
use App\AboutSection;
use App\Testimonial;
use App\TeamMember;
use App\Project;
use App\Builder;
use App\Post;
use App\Area;
use App\SubArea;
use App\ProjectOffer;
use Illuminate\Http\Request;
use App\Http\Helpers\GeneralHelper;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = HomeSetting::find(1);
       
        $testimonials = Testimonial::where('status','yes')->get(); 
        $header_image = url('public/assets/images').'/header-bg.jpg';
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $progress = config('constants.progress');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        $offering = config('constants.offering');
        $payment_plan_duration = config('constants.payment_plan_duration');
        $popular_projects = Project::with('offers','floorPlan','builder')->where('is_popular',true)->take(3)->orderBy('position', 'asc')->get();
        $latestPosts = Post::where('status', 'yes')
        ->latest()  // created_at DESC
        ->take(3)
        ->get();
        $compare        = session()->get('compare', []);
        $first_box_offer = GeneralHelper::getOption('first_box_offer');
        $second_box_offer = GeneralHelper::getOption('second_box_offer');
        $third_box_offer = GeneralHelper::getOption('third_box_offer');
        $fourth_box_offer = GeneralHelper::getOption('fourth_box_offer');

        $first_box_offer_count = Project::whereHas('offers', function ($q) use ($first_box_offer) {
            $q->where('offer', strtolower($first_box_offer));
        })->count();
        $second_box_offer_count = Project::whereHas('offers', function ($q) use ($second_box_offer) {
            $q->where('offer', strtolower($second_box_offer));
        })->count();
        $third_box_offer_count = Project::whereHas('offers', function ($q) use ($third_box_offer) {
            $q->where('offer', strtolower($third_box_offer));
        })->count();
        $fourth_box_offer_count = Project::whereHas('offers', function ($q) use ($fourth_box_offer) {
            $q->where('offer', strtolower($fourth_box_offer));
        })->count();

        /* $first_box_offer_count = ProjectOffer::where('offer', strtolower($first_box_offer))->count();
        $second_box_offer_count = ProjectOffer::where('offer', strtolower($second_box_offer))->count();
        $third_box_offer_count = ProjectOffer::where('offer', strtolower($third_box_offer))->count();
        $fourth_box_offer_count = ProjectOffer::where('offer', strtolower($fourth_box_offer))->count(); */

        $first_box_area_id = GeneralHelper::getOption('first_box_location');
        $second_box_area_id = GeneralHelper::getOption('second_box_location');
        $third_box_area_id = GeneralHelper::getOption('third_box_location');
        $fourth_box_area_id = GeneralHelper::getOption('fourth_box_location');
        $fifth_box_area_id = GeneralHelper::getOption('fifth_box_location');
        $sixth_box_area_id = GeneralHelper::getOption('sixth_box_location');

        $first_box_location = Area::where('id', $first_box_area_id)->value('name');                
        $second_box_location = Area::where('id', $second_box_area_id)->value('name');        
        $third_box_location = Area::where('id', $third_box_area_id)->value('name');
        $fourth_box_location = Area::where('id', $fourth_box_area_id)->value('name');        
        $fifth_box_location = Area::where('id', $fifth_box_area_id)->value('name');       
        $sixth_box_location = Area::where('id', $sixth_box_area_id)->value('name');
      

        $first_box_location_count = Project::whereHas('area', function ($q) use ($first_box_area_id) {
            $q->where('area_id', strtolower($first_box_area_id));
        })->count();
        $second_box_location_count = Project::whereHas('area', function ($q) use ($second_box_area_id) {
            $q->where('area_id', strtolower($second_box_area_id));
        })->count();
        $third_box_location_count = Project::whereHas('area', function ($q) use ($third_box_area_id) {
            $q->where('area_id', strtolower($third_box_area_id));
        })->count();
        $fourth_box_location_count = Project::whereHas('area', function ($q) use ($fourth_box_area_id) {
            $q->where('area_id', strtolower($fourth_box_area_id));
        })->count();
        $fifth_box_location_count = Project::whereHas('area', function ($q) use ($fifth_box_area_id) {
            $q->where('area_id', strtolower($fifth_box_area_id));
        })->count();
        $sixth_box_location_count = Project::whereHas('area', function ($q) use ($sixth_box_area_id) {
            $q->where('area_id', strtolower($sixth_box_area_id));
        })->count();

        if(!empty($data->header_image)){
            
          if(file_exists( public_path().'/'.$data->header_image )){
            $header_image = url('public') .'/'.$data->header_image;
          } 
        }
        return view('home',compact('data','header_image','testimonials','builders','progress','property_types','bedrooms','offering','popular_projects','latestPosts','compare','first_box_offer_count','second_box_offer_count','third_box_offer_count','fourth_box_offer_count','payment_plan_duration','first_box_location','second_box_location','third_box_location','fourth_box_location','fifth_box_location','sixth_box_location','first_box_location_count','second_box_location_count','third_box_location_count','fourth_box_location_count','fifth_box_location_count','sixth_box_location_count'));
        
        //return '<H2>Coming Soon</H2';
    }

    /*public function searchArea(Request $request){

        $query = $request->get('query');

        $results = Project::where('location', 'like', '%' . $query . '%')
                ->pluck('location') // Only fetch 'location' column
                ->unique()          // Remove duplicates (if any)
                ->take(50);         // Limit results (optional)
        $results = collect($results)->values(); // resets keys        
        return response()->json($results);
    }*/


    public function searchArea(Request $request)
    {
        $query = trim($request->get('query'));

        // Split query if contains hyphen
        $searchArea = explode('-', $query, 2);
        $areaPart = trim($searchArea[0] ?? '');
        $subAreaPart = trim($searchArea[1] ?? '');

        $results = Area::with(['subAreas' => function ($q) use ($subAreaPart, $query) {
                // Filter subareas only if searching specifically for them
                if ($subAreaPart) {
                    $q->where('name', 'like', '%' . $subAreaPart . '%');
                }
                $q->orderBy('name', 'asc');
            }])
            ->when($subAreaPart, function ($q) use ($areaPart, $subAreaPart) {
                // If hyphen present → search both Area + SubArea parts
                $q->where('name', 'like', '%' . $areaPart . '%')
                ->orWhereHas('subAreas', function ($sub) use ($subAreaPart) {
                    $sub->where('name', 'like', '%' . $subAreaPart . '%');
                });
            }, function ($q) use ($query) {
                // If no hyphen → search only Area but will include all its SubAreas
                $q->where('name', 'like', '%' . $query . '%')
                ->orWhereHas('subAreas', function ($sub) use ($query) {
                    $sub->where('name', 'like', '%' . $query . '%');
                });
            })
            ->orderBy('name', 'asc')
            ->get()
            ->flatMap(function ($area) use ($query, $subAreaPart) {
                $list = collect();

                // Always include matching Area name
                if (stripos($area->name, $query) !== false || !$subAreaPart) {
                    $list->push($area->name);
                }

                // Always include *all* subareas for a matching area
                foreach ($area->subAreas->sortBy('name') as $subArea) {
                    $list->push($area->name . ' - ' . $subArea->name);
                }

                return $list;
            })
            ->unique()
            ->take(50)
            ->values();

        return response()->json($results);
    }







   
}
