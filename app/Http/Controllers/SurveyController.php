<?php

namespace App\Http\Controllers;

use App\Http\Helpers\GeneralHelper;
use App\Http\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\AreaSurvey;
use Carbon\Carbon;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $uniqueAreaSurveys = AreaSurvey::with(['area', 'subArea'])
        ->select('area_id', 'sub_area_id')
        ->groupBy('sub_area_id')
        ->get();    
        //$years = GeneralHelper::getYears(3,0);
        //$months = GeneralHelper::getMonths();
        $years = $uniqueAreaSurveys
        ->map(fn($s) => Carbon::parse($s->survey_date)->year)
        ->unique()
        ->sortDesc()
        ->values();

        $months = $uniqueAreaSurveys
        ->map(fn($s) => Carbon::parse($s->survey_date)->month)
        ->unique()
        ->sort()
        ->values();
        
        return view('survey-listing',compact('uniqueAreaSurveys','years','months'));
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
        //
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

    public function downloadDocument($id)
    {
        $record = AreaSurvey::findOrFail($id);       
        return FileHelper::downloadFile($record->file_url);
    }

    public function viewDocument($id)
    {
        $record = AreaSurvey::findOrFail($id);  

        return FileHelper::viewFile($record->file_url);
    }


    public function filterData(Request $request)
    {
         \DB::enableQueryLog();
        $full_area = $request->full_area;        
        $year = $request->year;
        $month = $request->month;
        $full_area = explode("|",$full_area);

        $areaId = $full_area[0] ?? 0;
        $subAreaId = $full_area[1] ?? 0;
    
        // Base query
        $query = AreaSurvey::query();

        if ($areaId) {
            $query->where('area_id', $areaId);
        }

        if ($subAreaId) {
            $query->where('sub_area_id', $subAreaId);
        }

        if ($year) {
            $query->whereYear('survey_date', $year);
        }

        if ($month) {
            $query->whereMonth('survey_date', $month);
        }

        $surveys = $query->with(['area', 'subArea'])->get();
        //dd(\DB::getQueryLog());
        $years = AreaSurvey::when($areaId, fn($q) => $q->where('area_id', $areaId))
            ->when($subAreaId, fn($q) => $q->where('sub_area_id', $subAreaId))
            ->selectRaw('YEAR(survey_date) as year')->distinct()->pluck('year');

        $months = AreaSurvey::when($areaId, fn($q) => $q->where('area_id', $areaId))
            ->when($subAreaId, fn($q) => $q->where('sub_area_id', $subAreaId))
            ->when($year, fn($q) => $q->whereYear('survey_date', $year))
            ->selectRaw('MONTH(survey_date) as month')->distinct()->pluck('month');

        $surveyHtml = view('layouts.partials.survey_results', compact('surveys'))->render();

        return response()->json([            
            'years' => $years,
            'months' => $months,
            'html' => $surveyHtml
        ]);
    }

}
