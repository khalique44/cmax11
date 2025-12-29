<?php

namespace App\Http\Controllers;

use App\Project;
use App\Builder;
use Illuminate\Http\Request;

class ProjectCompareController extends Controller
{
    public function add($id)
    {
        $compare = session()->get('compare', []);

        if (!in_array($id, $compare)) {
            if (count($compare) >= config('constants.compare_project_limit')) {
                return back()->with('error', 'You can only compare up to '.config('constants.compare_project_limit').' projects.');
            }
            $compare[] = $id;
            session()->put('compare', $compare);
        }

        return back()->with('success', 'Project added to comparison.');
    }

    public function remove($id)
    {
        $compare = session()->get('compare', []);
        $compare = array_diff($compare, [$id]);
        session()->put('compare', $compare);

        return back()->with('success', 'Project removed from comparison.');
    }

    public function index()
    {
        $compare = session()->get('compare', []);

        if(count($compare) > config('constants.compare_project_limit')){
            session()->forget('compare');
        }

        $allProjects = Project::with(['Offers','Area', 'subArea','Builder'])->where('is_active', true)->orderBy('position','asc')->get();
        $projects = Project::with('offers','floorPlan','builder')->whereIn('id', $compare)->get();
		$offering = config('constants.offering');
		$bedrooms = config('constants.bedrooms');
		$builders = Builder::where('is_active',1)->orderBy('builder_name','asc')->get();
		$progress = config('constants.progress');

        return view('projects.compare', compact('projects','allProjects','compare','offering','bedrooms','builders','progress'));
    }


    public function ajaxAdd(Request $request)
	{
	    $id = $request->id;
	    $compare = session()->get('compare', []);

	    if (!in_array($id, $compare)) {
	        if (count($compare) >= config('constants.compare_project_limit')) {
	            return response()->json(['status' => 'error', 'message' => 'You can only compare up to '.config('constants.compare_project_limit').' projects.']);
	        }
	        $compare[] = $id;
	        session()->put('compare', $compare);
	 
	    }

	    $projects = Project::whereIn('id', $compare)->get(['id', 'project_title']);
	    return response()->json(['status' => 'success', 'projects' => $projects]);
	}


	public function ajaxAddMultiple(Request $request)
    {
        $ids = (array) $request->ids; // dropdown may send single or multiple
        $compare = session()->get('compare', []);

        if(count($compare) > config('constants.compare_project_limit')){
            session()->forget('compare');
        }

        foreach ($ids as $id) {

            // If already exists → remove it (so it can be re-added as latest)
            if (in_array($id, $compare)) {
                $compare = array_values(array_diff($compare, [$id]));
            }

            // If already 2 items → remove oldest
            if (count($compare) >= 2) {
                array_shift($compare); // removes first (oldest)
            }

            // Add new project
            $compare[] = $id;
        }

        session()->put('compare', $compare);

        $projects = Project::with('offers','floorPlan','builder')
            ->whereIn('id', $compare)
            ->get();

        $html = view('projects.partials.compare_list', compact('projects'))->render();

        return response()->json([
            'status' => 'success',
            'project_count' => count($projects),
            'html' => $html
        ]);
    }


	public function ajaxRemove(Request $request)
	{
	    $id = $request->id;

	    $compare = session()->get('compare', []);
	    $compare = array_diff($compare, [$id]);
	    session()->put('compare', $compare);

	    $projects = Project::whereIn('id', $compare)->get();
	    return response()->json(['status' => 'success', 'projects' => $projects]);
	}

	public function ajaxClear()
	{
	    session()->forget('compare');
	    return response()->json(['status' => 'success', 'projects' => []]);
	}


	 public function searchProject(Request $request){

        $searchArea      = $request->input('search_area');
        $builderId       = $request->input('builder_id');        
        $progress        = $request->input('progress');
        $propertyType    = $request->input('property_type');        
        $bedrooms        = $request->input('bedrooms');
        //$offer           = $request->input('offer');         
        $searchedData    = $request->all();               
        $compare        = session()->get('compare', []);  
        
        \DB::enableQueryLog();

        $searchArea = explode(' - ', $searchArea);
        $area = $searchArea[0] ?? '';
        $subArea = $searchArea[1] ?? '';

        $projects = Project::query()
        

        ->when($area || $subArea, function ($query) use ($area, $subArea) {
			$query->where(function ($q) use ($area, $subArea) {
				if ($area) {
					$q->whereHas('area', function ($qa) use ($area) {
						$qa->where('name', 'like', '%' . $area . '%');
					});
				}

				if ($subArea) {
					$q->whereHas('subArea', function ($qs) use ($subArea) {
						$qs->where('name', 'like', '%' . $subArea . '%');
					});
				}
			});
		})        

        // Builder ID
        ->when($builderId && $builderId != 'Select', function ($query) use ($builderId) {
            $query->whereIn('builder_id', $builderId);
        })        

        // Progress (e.g., under-construction, completed)
        ->when($progress && $progress != 'Select', function ($query) use ($progress) {
            $query->where('progress', $progress);
        }) 
		
		/* ->when($propertyType, function ($query, $propertyType) {
			$types = explode(",", $propertyType);
			$query->where(function ($q) use ($types) {
				foreach ($types as $type) {
					$q->orWhereRaw("FIND_IN_SET(?, offering)", [$type]);
				}
			});
		}) */

        // Bedrooms (assuming 'bedrooms' field in project_offers table)
        ->when($bedrooms, function ($query, $bedrooms) {
            $query->whereHas('offers', function ($q) use ($bedrooms) {
                $q->where('bedrooms', $bedrooms);
            });
        })
        
        ->when($propertyType, function ($query, $offer) {
            $query->whereHas('offers', function ($q) use ($offer) {
                $q->where('offer', $offer);
            });
        });      
		

        $projects = $projects->with(['Area', 'subArea','Builder'])
        ->where('is_active', true)
        //->orderByRaw("CASE WHEN refreshed_at >= ? THEN 0 ELSE 1 END", [now()->subMonth()])
        ->orderBy('position', 'asc')
        ->orderBy('created_at', 'desc')
        ->get();
        //dd(\DB::getQueryLog());
        

        if ($request->ajax()) {
            return response()->json($projects);
        }

    }

}

