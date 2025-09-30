<?php

namespace App\Http\Controllers\Admin;

use App\category;
use App\Country;
use App\District;
use App\RegistrationType;
use App\State;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscription;
use App\User;
use App\LaundryBooking;
use App\ReportedIssues;
use Illuminate\Support\Str;
use Yajra\DataTables\Contracts\DataTable;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function welcome(){
        return redirect()->route('admin.dashboard');
    }

    public function dashboard(Request $request)
    {
        
        return view('admin.welcome');

    }

    public function getUsers(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");

        $rowperpage = $request->get("length"); // Rows display per page

        if($rowperpage == -1){
            $rowperpage = 20000;
        }

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = 'desc';//$order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        //dd($columnSortOrder);

        if($request->has('is_imported_user_view') && $request->get('is_imported_user_view') == true){
            $records = User::orderBy($columnName,$columnSortOrder)->where('is_imported',true);
            $totalRecords = User::select('count(*) as allcount')->where('is_imported',true);
            $totalRecordswithFilter = User::select('count(*) as allcount')->where('is_imported',true);
        }else{
            $records = User::orderBy($columnName,$columnSortOrder);
            $totalRecords = User::select('count(*) as allcount');
            $totalRecordswithFilter = User::select('count(*) as allcount');
        }

        if($request->get('sel_country') || $request->get('sel_state') || $request->get('sel_category') || $request->get('sel_year') || $request->get('sel_option')){

            if($request->has('sel_country') && ($request->get('sel_country'))){
                $records = $records->where('country',$request->get('sel_country'));
                $totalRecords->where('users.country',$request->get('sel_country'));
                $totalRecordswithFilter->where('users.country',$request->get('sel_country'));
            }
            if($request->has('sel_state') && ($request->get('sel_state'))){
                $records = $records->where('state',$request->get('sel_state'));
                $totalRecords->where('users.state',$request->get('sel_state'));
                $totalRecordswithFilter->where('users.state',$request->get('sel_state'));
            }
            if($request->has('sel_category') && ($request->get('sel_category'))){
                $records->where('users.category',$request->get('sel_category'));
                $totalRecords->where('users.category',$request->get('sel_category'));
                $totalRecordswithFilter->where('users.category',$request->get('sel_category'));
            }
            if($request->has('sel_year') && ($request->get('sel_year'))){
                $records->where('users.registration_year',$request->get('sel_year'));
                $totalRecords->where('users.registration_year',$request->get('sel_year'));
                $totalRecordswithFilter->where('users.registration_year',$request->get('sel_year'));
            }
            if($request->has('sel_option') && ($request->get('sel_option'))){

                if($request->get('sel_option') === "active") {
                    $records->where('users.status',1);
                    $totalRecords->where('users.status',1);
                    $totalRecordswithFilter->where('users.status',1);
                }
                else if($request->get('sel_option') === "inactive") {
                    $records->where('users.status',0);
                    $totalRecords->where('users.status',0);
                    $totalRecordswithFilter->where('users.status',0);
                }
                else{
                    $records->where('users.status',1)->orWhere('users.status',0);
                    $totalRecords->where('users.status',1)->orWhere('users.status',0);
                    $totalRecordswithFilter->where('users.status',1)->orWhere('users.status',0);
                }
            }
            $records = $records->where(function($query){
                            $query->where('is_paid',true)->orWhere('is_admin_user',true);
                        });
            $totalRecords = $totalRecords->where(function($query){
                            $query->where('is_paid',true)->orWhere('is_admin_user',true);
                        });
            $totalRecordswithFilter = $totalRecordswithFilter->where(function($query){
                            $query->where('is_paid',true)->orWhere('is_admin_user',true);
                        });


        }
        if($searchValue){

            $totalRecordswithFilter = $totalRecordswithFilter
                ->where(function($query){
                    $query->where('is_paid',true)->orWhere('is_admin_user',true);
                })
                ->whereHas('usercountry',function($query) use($searchValue){
                    $query->where('name', 'like', '%' .$searchValue . '%');
                })->orWhereHas('userstate',function($query) use($searchValue){
                    $query->where('name', 'like', '%' .$searchValue . '%');
                })
                ->orWhere('users.first_name', 'like', '%' .$searchValue . '%')
                ->orWhere('users.last_name', 'like', '%' .$searchValue . '%')
                ->orWhere('users.email', 'like', '%' .$searchValue . '%')
                ->orWhere('users.type', 'like', '%' .$searchValue . '%')
                ->orWhere('users.city', 'like', '%' .$searchValue . '%')
                ->orWhere('users.address_1', 'like', '%' .$searchValue . '%')
                ->orWhere('users.is_verified', 'like', '%' .$searchValue . '%');

            $records = $records->where(function($query){
                $query->where('is_paid',true)->orWhere('is_admin_user',true);
            })->whereHas('usercountry',function($query) use($searchValue){
                    $query->where('name', 'like', '%' .$searchValue . '%');
                })->orWhereHas('userstate',function($query) use($searchValue){
                    $query->where('name', 'like', '%' .$searchValue . '%');
                })
                ->orWhere('users.first_name', 'like', '%' .$searchValue . '%')
                ->orWhere('users.last_name', 'like', '%' .$searchValue . '%')
                ->orWhere('users.email', 'like', '%' .$searchValue . '%')
                ->orWhere('users.type', 'like', '%' .$searchValue . '%')
                ->orWhere('users.city', 'like', '%' .$searchValue . '%')
                ->orWhere('users.address_1', 'like', '%' .$searchValue . '%')
                ->orWhere('users.is_verified', 'like', '%' .$searchValue . '%');
        }

        // Fetch records

        $records = $records->select('users.*')
            ->skip($start)
            ->take($rowperpage)
            ->orderBy('users.id','desc')->get();
        $totalRecords = $totalRecords->count();
        $totalRecordswithFilter = $totalRecordswithFilter->count();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $first_name = $record->first_name;
            $last_name = $record->last_name;
            $email = $record->email;
            $paid_status = "Pending";
            $state_name = '---';
            $city = $record->city;
            $address_1 = $record->address_1;

            $is_paid = Subscription::where('user_id',$record->id)->select('user_id')->first();

            //$user->is_paid for admin side to make user's paid/unpaid
            if ($is_paid || $record->is_paid == 1){
                $paid_status = "Paid";
            }

            $country = Country::where('id',$record->country)->select('name')->first(); //$recordcountry;
            $country_name = $country ? $country->name : '';

            if(is_numeric($record->state)){
                $state = State::where('id',$record->state)->select('name')->first(); //$recordstate;
                $state_name = $state ? $state->name : '';
            }

            $registration_type = $record->registration_type;
            $user_registration_type = $registration_type ? implode(' ', array_map('ucfirst', explode('_', $registration_type))) : '--' ;

            $created_by = $record->is_admin_user == 1 ? 'Admin' : '--';
            $type = implode(' ', array_map('ucfirst', explode('-', $record->type)));
            $is_verified = $record->is_verified == 1 ? 'Yes' : 'No';

            $button = '<a type="button" href="'.route('users.show',$record->id).'" class="btn-sm btn-primary" >View</a>';
            $button .= '<a type="submit" href="'.url("admin/users/{$record->id}/edit").'" class="btn-sm btn-success action-button">Update</a>';
            $button .= '<a type="button" href="#" class="btn-sm btn-danger btn_user_delete" onclick="deleteUser('.$record->id.')" data-toggle="modal" data-target="#DeleteConfirmationModal" data-delete-id="'.$record->id.'">Delete</a>';
            if($record->is_active == 1){
                $button .= '<a type="button" href="#" class="btn-sm btn-danger btn_user_inactive" onclick="inactiveUser('.$record->id.')" data-toggle="modal" data-target="#UserInactiveConfirmationModal" data-inactive-id="'.$record->id.'">Disable</a>';
            }else{
                $button .= '<a type="button" href="#" class="btn-sm btn-success btn_user_active" onclick="activeUser('.$record->id.')" data-toggle="modal" data-target="#UserActiveConfirmationModal" data-active-id="'.$record->id.'">Enable</a>';
            }

            if($record->is_verified === 0){
                $button .= '<a style="white-space: nowrap;" type="button" href="#" class="btn-sm btn-primary btn_user_verification_email" onclick="sendVerificationEmailUser('.$record->id.')" data-toggle="modal" data-target="#UserVerifyEmailConfirmationModal" data-verification-mail-id="'.$record->id.'">Resend Verification Email </a>';
                $button .= '<a type="button" href="#" class="btn-sm btn-success btn_user_verify" onclick="verifyUser('.$record->id.')" data-toggle="modal" data-target="#UserVerifyConfirmationModal" data-verify-id="'.$record->id.'">Verify</a>';
            }

            $data_arr[] = array(
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email,
                "paid_status" => $paid_status,
                "state_name" => $state_name,
                "country_name" => $country_name,
                "city" => $city,
                "address_1" => $address_1,
                "user_registration_type" => $user_registration_type,
                "created_by" => $created_by,
                "type" => $type,
                "is_verified" => $is_verified,
                "action" => $button
            );
        }


        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }


    public function showDashboard($id){
        $user = User::find($id);
        if(!$user){
            return abort(404);
        }
        $paid_status = Subscription::where('user_id',$user->id)->first();
        //$user->is_paid for admin side to make user's paid/unpaid
        if ($paid_status || $user->is_paid == 1){
            $user->paid_status = true;
        }else{
            $user->paid_status = false;
        }
        return view('admin.show',compact('user'));
    }

    public function getNextWeekLaundryBookingCounts($onlyCounts = true){

        $startDate = Carbon::tomorrow()->format("Y-m-d"); 
        $endDate = Carbon::today()->addDays(6)->format("Y-m-d");
        $nextSevenDaysBookings = LaundryBooking::select(
            DB::raw('COUNT(id) as counts'),
            DB::raw('DATE_FORMAT(booking_date_format, "%a") AS day_name')
        )
            ->whereRaw('DAYNAME(booking_date_format) <> ""')
            ->whereBetween('booking_date_format', [$startDate,  $endDate])

            ->groupBy(DB::raw('DAYNAME(booking_date_format)'))
            ->orderByRaw('WEEKDAY(booking_date_format)')
            ->get()->toArray();
            ;
            //dd($nextSevenDaysBookings->toSql(),$nextSevenDaysBookings->getBindings());
        
        if($onlyCounts){
            return $nextSevenDaysBookings;
        }

        $nextSevenDaysBookingsIds = LaundryBooking::select(
            DB::raw('id')
        )
            ->whereRaw('DAYNAME(booking_date_format) <> ""')
            ->whereBetween('booking_date_format', [$startDate,  $endDate])
            ->get()->toArray();

        return $nextSevenDaysBookingsIds;
    }

    public function getReportedIssuesCounts($onlyCounts = true){

        $startDate = Carbon::today()->format("Y-m-d"); 
        $oneMonthBefore = Carbon::now()->subMonth()->format("Y-m-d");

        $records = ReportedIssues::select(
            DB::raw('COUNT(reported_issues.id) as counts'),
            DB::raw('title')
        )   ->leftJoin('issue_reasons','reported_issues.reason_id','=','issue_reasons.id')        
            ->whereBetween('reported_issues.created_at', [$oneMonthBefore,  $startDate])
            ->whereNull('issue_reasons.deleted_at')
            ->groupBy('title')
            ->get()->toArray();
            
        
        if($records){
            return $records;
        }

        $records = ReportedIssues::select(
            DB::raw('id')
        )            
            ->whereBetween('created_at', [$oneMonthBefore,  $startDate])
            ->get()->toArray();

        return $records;

    }



    public function getReportedIssuesExpenseCounts($onlyCounts = true){

        $startDate = Carbon::today()->format("Y-m-d"); 
        $startOfYear = Carbon::now()->startOfYear()->format("Y-m-d");
        $oneMonthBefore = Carbon::now()->subMonth()->format("Y-m-d");

        $records = ReportedIssues::select(
            DB::raw('SUM(expense) as expense'),
            DB::raw('DATE_FORMAT(reported_issues.created_at, "%M") AS month_name')
        )   ->leftJoin('issue_reasons','reported_issues.reason_id','=','issue_reasons.id')        
            ->whereBetween('reported_issues.created_at', [$startOfYear,  $startDate])
            ->whereNull('issue_reasons.deleted_at')
            ->groupBy(DB::raw('MONTHNAME(reported_issues.created_at)'))
            ->orderByRaw('WEEKDAY(reported_issues.created_at)')
            ->get()->toArray();
            
        
        if($records){
            return $records;
        }

        $records = ReportedIssues::select(
            DB::raw('id')
        )            
            ->whereBetween('created_at', [$oneMonthBefore,  $startDate])
            ->get()->toArray();

        return $records;

    }

    public function adjustWeeklyCounts($weeklyData){
        
        $weekData = [];
        if(!empty($weeklyData)){
            foreach ($weeklyData as $keys => $value) {

                $weekData[$value['day_name']] = $value['counts'];
            }
        }

        $days =  ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
        $dataCount = [];
        foreach ($days as $key => $value) {

            if (in_array($value, array_keys($weekData))){

                $dataCount[$value] = ($weekData[$value])??0;
            }else{
                $dataCount[$value] =  0;
            }
        }

        return $dataCount;
    }


    public function adjustYearlyCounts($yearlyData){
        
        $yearData = [];
        if(!empty($yearlyData)){
            foreach ($yearlyData as $keys => $value) {

                $yearData[$value['month_name']] = $value['expense'];
            }
        }

        $months =  ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"];
        $dataCount = [];
        foreach ($months as $key => $value) {

            if (in_array($value, array_keys($yearData))){

                $dataCount['month_name'][] = $value;
                $dataCount['expense'][] =   ($yearData[$value])??0;
            }else{
                $dataCount['month_name'][] =  $value;
                $dataCount['expense'][] =     0;
            }
        }

        return $dataCount;
    }
}
