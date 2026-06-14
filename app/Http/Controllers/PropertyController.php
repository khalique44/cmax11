<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\GeneralHelper;
use App\Property;
use App\Project;
use App\Builder;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Property::where('is_active', true)->paginate(3);
        $builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        $progress = config('constants.progress');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');        
        $searchedData    = '';

        //$projects = $projects->paginate(3);

        
        return view('property-search-results',compact('builders','progress','property_types','bedrooms','projects','searchedData'));
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
    public function show(string $slug)
    {
        $property = Property::where('slug',$slug)->firstOrFail();        
        $progress = config('constants.progress');  
        $furnishing = config('constants.furnishing');  
        $purpose = config('constants.purpose');  
        $listing_types = config('constants.listing_types');  
        $related_properties = Property::where('area',$property->area)->where('area_type',$property->area_type)->where('id','<>',$property->id)->take(3)->get();

        $sessionKey = 'property_viewed_' . $property->id;
        if (!session()->has($sessionKey)) {
            $property->increment('views');
            session()->put($sessionKey, true);
        }
       

        return view('properties.details', compact('property','progress','related_properties','furnishing','purpose','listing_types'));
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

    public function searchResults(Request $request){

        $searchArea      = $request->input('search-area');
        //$builderId       = $request->input('builder_id');
        $monthly_installment   = $request->input('monthly_installment');
        $progress        = $request->input('progress');
        $propertyType    = $request->input('property_type');
        $priceFrom       = $request->input('price_from');
        $priceTo         = $request->input('price_to');
        $bedrooms        = $request->input('bedrooms');
        $offer           = $request->input('offer');
        //$payment_plan_duration           = $request->input('payment_plan_duration');
        //$priceFrom       = GeneralHelper::detectNumberUnit($priceFrom);
        //$priceTo         = GeneralHelper::detectNumberUnit($priceTo);
        $searchedData    = $request->all();    
        $installment    = $monthly_installment ? explode(':', $monthly_installment) : [];      
       
        
        \DB::enableQueryLog();

        $searchArea = explode(' - ', $searchArea);
        $area = $searchArea[0] ?? '';
        $subArea = $searchArea[1] ?? '';

        $properties = Property::query()

        // Search area (assuming 'location' field)
        /*->when($searchArea, function ($query, $searchArea) {
            $query->where('location', 'like', "%$searchArea%");
        })*/

        ->when($area, function ($query, $searchArea) {
            $query->whereHas('area', function ($q) use ($searchArea) {
                $q->where('name', 'like', '%' . $searchArea . '%');
            });
            
        })

        ->when($subArea, function ($query, $searchArea) {
            $query->orWhereHas('subArea', function ($q) use ($searchArea) {
                $q->where('name', 'like', '%' . $searchArea . '%');
            });
            
        })
        

        /*// Is Installment (assuming 'is_installment' field)
        ->when($monthly_installment && $monthly_installment != 'Select', function ($query) use ($isInstallment) {
            $query->where('is_installment', $isInstallment);
        })*/

        // Progress (e.g., under-construction, completed)
        /* ->when($progress && $progress != 'Select', function ($query) use ($progress) {
            $query->where('progress', $progress);
        }) */

        /* ->when($payment_plan_duration && $payment_plan_duration != 'Select', function ($query) use ($payment_plan_duration) {
            $query->whereJsonContains('payment_plan_duration', $payment_plan_duration);
        }) */

        // Property Type
        ->when($propertyType, function ($query, $propertyType) {
            $query->whereIn('property_type', explode(",",$propertyType));
        })
        

        ->when($installment, function ($query, $installment) {
            //$query->whereHas('offers', function ($q) use ($installment) {
                $installment_from = $installment[0] ?? '';
                $installment_to = $installment[1] ?? '';
                $query->whereBetween('monthly_installment', [$installment_from, $installment_to]);
                $query->where('is_installment', 1);
            //});
        })

        // Bedrooms (assuming 'bedrooms' field in project_offers table)
        ->when($bedrooms, function ($query, $bedrooms) {
            
                $query->where('bedrooms', $bedrooms);
            
        })
        
        // Price Range (in related project_offers table)
        
        ->when(($priceFrom && $priceTo), function ($query) use ($priceFrom, $priceTo) {
           
                if(!empty($priceFrom) && !empty($priceTo)){
                    $query->whereBetween('price', [$priceFrom, $priceTo]);
                    //$query->where('price_from_in_format', [$priceFrom['unit']]);
                   // $q->orWhere('price_to_in_format', [$priceTo['unit']]);
                }
                //$q->where('offer', [$propertyType]);
           
        });


       
        $properties = $properties->with(['Area', 'subArea'])
        ->where('is_active', true)
        //->orderByRaw("CASE WHEN refreshed_at >= ? THEN 0 ELSE 1 END", [now()->subMonth()])
        //->orderBy('position', 'asc')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
       //dd(\DB::getQueryLog());
        //$builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
        //$progress = config('constants.progress');
        $property_types = config('constants.property_types');
        $bedrooms = config('constants.bedrooms');
        
        

        if ($request->ajax()) {
            return view('properties.partials.property_list', compact('property_types','bedrooms','properties','searchedData'))->render();
        }

        

        
        return view('property-search-results',compact('property_types','bedrooms','properties','searchedData'));

    }
}
