<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Country;
use App\Registration_fee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationFeeController extends Controller
{
    public function index(Request $request)
    {
        $registration_fee = Registration_fee::orderBy('id','desc');
        $registration_years = \DB::table('registration_fees')->distinct()->get(['year']);
        $registration_year          = $request->registration_year;
        $search_year = '';
        if($registration_year){
            $search_year = $request->registration_year;
            $registration_fee = $registration_fee->where('year',$registration_year);
        }

        $registration_fee = $registration_fee->get();

        return view('admin.modules.registration_fees.index',compact('registration_fee','registration_years','search_year'));
    }

    public function create()
    {
        $countries = Country::OrderBy('name')->get();
        return view('admin.modules.registration_fees.create',compact('countries'));
    }

    public function addYear(){
        return view('admin.modules.registration_fees.add_year');
    }

    public function storeYear(Request $request){

        $this->validate($request, [
            'year' => 'required'
        ]);

        $country_ids = Country::orderBy('name')->pluck('id');

        foreach ($country_ids as $country_id){
            $year = $request->year;

            $registration = Registration_fee::where('year', $year)->where('country_id',$country_id)->count();
            if($registration > 0){
                return redirect()->back()->withInput()->with('error','The year for this country already existed.');
            }else{
                Registration_fee::create([
                    'country_id' => $country_id,
                    'name' => $year,
                    'year' => $year,
                    'athlete_fee' => 0,
                    'non_athlete_fee' => 0,
                    'pro_athlete_fee' => 0
                ]);
            }
        }
        return redirect('/admin/modules/registration_fee');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'country_id' => 'required',
            'name' => 'required|max:120',
            'year' => 'required',
            'athlete_fee' => 'required',
            'non_athlete_fee' => 'required',
            'pro_athlete_fee' => 'required'
        ]);
        $year = $request->year;

        if($request->athlete_fee){
            $registration = Registration_fee::where('year', $year)->where('country_id',$request->country_id)->count();
            if($registration > 0){
                return redirect()->back()->withInput()->with('error','This year charge sheet for athlete already existed.');
            }
        }

        if($request->non_athlete_fee){
            $registration = Registration_fee::where('year', $year)->where('country_id',$request->country_id)->where('non_athlete_fee','<>',null)->count();
            if($registration > 0){
                return redirect()->back()->withInput()->with('error','This year charge sheet for non athlete already existed.');
            }
        }

        if($request->pro_athlete_fee){
            $registration = Registration_fee::where('year', $year)->where('country_id',$request->country_id)->where('pro_athlete_fee','<>',null)->count();
            if($registration > 0){
                return redirect()->back()->withInput()->with('error','This year charge sheet for pro athlete already existed.');
            }
        }

        Registration_fee::create($request->all());
        return redirect('/admin/modules/registration_fee');
    }

    public function show()
    {
    }
    public function edit($id)
    {
        $countries = Country::OrderBy('name')->get();
        $Registration_fee = Registration_fee::find($id);

        if(!$Registration_fee){
            return abort(404);
        }

        return view('admin.modules.registration_fees.edit',compact('Registration_fee','countries'));
    }

    public function update(Request $request, $id)
    {
        $registration_fee = Registration_fee::find($id);
        if(!$registration_fee){
            return abort(404);
        }

        $this->validate($request, [
            'athlete_fee' => 'required',
            'non_athlete_fee' => 'required',
            'pro_athlete_fee' => 'required'
        ]);

        //'year'=>'required|unique:registration_fees,year,'.$registration_fee->id,
        /*$year = $request->year;

        if($request->athlete_fee != ""){
            $registration = Registration_fee::where('year', $year)->where('country_id',$request->country_id)->where('id','!=',$id)->count();
            if($registration > 0){
                return redirect()->back()->withInput()->with('error','This year charge sheet for athlete already existed.');
            }
        }if($request->non_athlete_fee != ""){
            $registration = Registration_fee::where('year', $year)->where('country_id',$request->country_id)->where('id','!=',$id)->count();
            if($registration > 0){
                return redirect()->back()->withInput()->with('error','This year charge sheet for non-athlete already existed.');
            }
        }if($request->pro_athlete_fee != ""){
            $registration = Registration_fee::where('year', $year)->where('country_id',$request->country_id)->where('id','!=',$id)->count();
            if($registration > 0){
                return redirect()->back()->withInput()->with('error','This year charge sheet for pro-athlete already existed.');
            }
        }*/

        Registration_fee::Where('id',$id)->update($request->except(['_token','_method']));

        return redirect('/admin/modules/registration_fee');

    }
    public function destroy($id)
    {
        $registration_fee = Registration_fee::find($id);
        if(!$registration_fee){
            return abort(404);
        }

        $registration_fee->delete();
        return redirect('/admin/modules/registration_fee');
    }

    public function importRegistrationFees(){
        $url  = url('public/assets/import_registration_fees/registration_fee.csv');
        $fh = fopen($url, 'r');
        $row = 0;
        while(($data = fgetcsv($fh)) !== false) {

            if ($row > 0) {
                unset($data[7]);
                unset($data[8]);
                unset($data[9]);

                $arr = [
                    'name' => isset($data[1]) ? $data[1] : '',
                    'year' => isset($data[2]) ? $data[2] : '',
                    'athlete_fee' => isset($data[3]) ? $data[3] : '',
                    'non_athlete_fee' => isset($data[4]) ? $data[4] : '',
                    'pro_athlete_fee' => isset($data[5]) ? $data[5] : '',
                    'active' => isset($data[6]) ? $data[6] : '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'country_id' => isset($data[10]) ? $data[10] : ''
                ];
                if(isset($data[1])){
//                    echo '<pre>';
//                    print_r($arr);
                    Registration_fee::insert($arr);
                }
            }

            $row++;
        }

        return 'success!';
    }
}
