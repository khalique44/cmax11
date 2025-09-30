<?php

namespace App\Http\Controllers\Admin;

use App\category;
use App\Country;
use App\District;
use App\Payment;
use App\Registration_fee;
use App\RegistrationType;
use App\State;
use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Admin;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        /*$users = User::orderBy('id','desc');
        $countries = Country::OrderBy('name')->get();
        $categories = category::OrderBy('name')->get();

        $sel_state          = $request->sel_state;
        $sel_country        = $request->sel_country;
        $sel_district       = $request->sel_district;
        $sel_category       = $request->sel_category;
        $sel_year           = $request->sel_year;
        $sel_option         = $request->sel_option;

        if($sel_state){
            $users->where('state',$sel_state);
        }
        if($sel_country){
            $users->where('country',$sel_country);
        }
        if($sel_district){
            $users->where('district_id',$sel_district);
        }
        if($sel_category){
            $users->where('category',$sel_category);
        }
        if($sel_year){
            $users->where('registration_year',$sel_year);
        }
        if($sel_option){
            if($sel_option == "active") {
                $users->where('status',1);
            }
            else if($sel_option == "inactive") {
                $users->where('status',0);
            }
            else{
                $users->where('status',1)->orWhere('status',0);
            }
        }

        $users = $users->paginate(20);

        $search_country  = Country::where('id',$sel_country)->first();
        $search_state    = State::where('id',$sel_state)->first();
        $search_district = District::where('id',$sel_district)->first();
        $search_category = category::where('id',$sel_category)->first();

        return view('admin.users.index',compact('users','countries','categories',
            'sel_state','sel_country','sel_district','sel_category','sel_year','sel_option',
            'search_country','search_state','search_district','search_category'));*/
            return view('admin.users.index'); // The blade file for displaying users
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::orderBy('id','desc');
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return '<a class="btn btn-sm btn-primary" href="'.url("admin/users/$user->id/edit").'" class="btn-sm btn-success action-button">
                                            Edit
                                        </a>
                                        <a type="button" href="#" class="delete-rec btn-sm btn-danger" data-route="/admin/users/'.$user->id.'" data-tableid="usersTable"   data-id="'.$user->id.'">
                                            Delete
                                        </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {   
        
        $countries = Country::OrderBy('name')->get();
       

        return view('admin.users.create_users',compact('countries'));
    }

    public function createUsers($user_type){
        $countries = Country::OrderBy('name')->get();
        $registration_types = RegistrationType::where('is_payment_active','yes')->OrderBy('name')->get();
        $registration_fees = Registration_fee::where('active','yes')->get();

        return view('admin.users.create_users',compact('countries','registration_types','user_type','registration_fees'));
    }

    public function store(Request $request)
    {
        //
    }

    public function storeUsers(Request $request){

        $request->validate([
            //'username'      => 'required|string|regex:/\w*$/|max:255|unique:users,username',
            'email'         => 'required|string|max:150|unique:users,email',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone'         => 'required',
            //'address_1'     => 'required',
            //'city'          => 'required',
            //'gender'        => 'required',
            //'country'       => 'required',
            //'state'         => 'required',
            //'registration_year'         => 'required',
            'password'      => 'required|string|min:8|confirmed',
        ]);

        $token = str_random(60).time();

        $request->merge([
            'date_of_birth' => date('Y-m-d',strtotime($request->date_of_birth)),
            'password' => Hash::make($request->password),
            'remember_token' => $token,
            'qr_code' => str_random(60).time().$token,
            'is_admin_user' => 1,
            //'membership_token' => $membership_token
        ]);

        // if type admin then add admin 
        $adminUser = [
                        'email' => $request->email,
                        'password' => $request->password,
                        'name' => $request->first_name.' '.$request->last_name,
                    ];
        if(empty($request->username)){
            $request->merge(['username' => $request->email]);
        }


        $user = User::create($request->all());
        if(!$user){
            return redirect()->back('error','User not created');
        }

        if($request->type == User::ADMIN){
            $adminUser['user_id'] = $user->id;
            Admin::create($adminUser);
        }

        return redirect()->route('users.index')->with('success','Record has been saved successfully');
    }

    public function show(User $user)
    {
        if(!$user){
            return abort(404);
        }
        
        return view('admin.users.show',compact('user'));
    }

    public function edit($id)
    {

        $user = User::find($id);
        if(!$user){
            return abort(404);
        }        
        

        return view('admin.users.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {

		 
        $user = User::find($id);
        if(!$user){
            return abort(404);
        }

        $password = $request->password;
       
        $pass_val = '';
        $expiry_date_validate = '';
        if($password != '') {
            $pass_val = 'sometimes|string|min:8|confirmed';
        }


        $request->validate([
            //'username'      => 'required|string|regex:/\w*$/|max:255|unique:users,username,'.$user->id,
            'email'         => 'required|string|max:150|unique:users,email,'.$user->id,
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone'         => 'required',
            //'address_1'     => 'required',
            //'city'          => 'required',
            //'gender'        => 'required',
            //'country'       => 'required',
            //'state'         => 'required',
            //'registration_year'         => 'required',
            'password' => $pass_val,
            //'card_expiry_date' => 'required',
        ]);

        /*$request->merge([
            'date_of_birth' => date('Y-m-d',strtotime($request->date_of_birth))
        ]);*/

        /*if($request->type == "athlete" || $request->type == "pro-athlete" ){
            $request->merge(['registration_type_id' => null]);
        } else{
            if($request->registration_type){
                $request->merge(['registration_type_id' => $request->registration_type]);
            }
        }*/

        if($password) {
            $request->merge(['password' => Hash::make($password)]);

        } else{
            $request->merge(['password' => $user->password]);

        }

        /*if($request->is_paid == '1'){
            $request->merge(['is_admin_user' => true]);
        }*/       

		$user->update($request->all());

        // if type admin then add admin 
        $adminUser = [
                        'email' => $request->email,
                        'user_id' => $user->id
                        
                    ];
        if($request->type == User::ADMIN){
            $admin = Admin::updateOrCreate($adminUser);

            $updateAdmin = [
                                'password' => $request->password,
                                'name' => $request->first_name.' '.$request->last_name,
                            ];

            if($admin){
               $admin->update($updateAdmin);
            }               
            
        }

        return redirect()->route('users.index')->with('success','Record has been updated successfully');

   }

    /*public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            return abort(404);
        }
        User::Where('id',$id)->delete();
        return redirect()->route('users.index')->with('success','Record has been deleted successfully');
    }*/

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }

    public function usersActiveUpdate($id)
    {
        $user = User::find($id);
        if(!$user){
            return abort(404);
        }
        User::Where('id',$id)->update(['is_active' => true]);
        return redirect()->route('users.index')->with('success','Record has been updated successfully');
    }

    public function usersInActiveUpdate($id)
    {
        $user = User::find($id);
        if(!$user){
            return abort(404);
        }
        User::Where('id',$id)->update(['is_active' => false]);
        return redirect()->route('users.index')->with('success','Record has been updated successfully');
    }

    public function usersVerifyUpdate($id)
    {
        $user = User::find($id);
        if(!$user){
            return abort(404);
        }
        User::Where('id',$id)->update(['is_verified' => true]);
        return redirect()->route('users.index')->with('success','Record has been updated successfully');
    }

    public function usersVerificationMailSend($id)
    {
        $user = User::find($id);
        if(!$user){
            return abort(404);
        }

        $to =  $user->email;
        $subject = 'Verify E-Mail';
        $view = (string)view('email.email_verify', compact('user'));
        $this->sendEmail($to,$subject,$view);
        return redirect()->route('admin.dashboard')->with('success','Mail sent successfully!');
    }

    public function importUsers(){
        return view('admin.users.import-users');
    }

    public function importUsersStore(Request $request){

        $fileName = $_FILES["file"]["tmp_name"];
        $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
        if($ext !== 'csv'){
            return redirect()->back()->with('error','Only csv file allowed!');
        }

        $count = 0;
        $row = 0;
        $data=[];
        $columns=[];
        if ($_FILES["file"]["size"] > 0) {

            $file = fopen($fileName, "r");

            while (($row = fgetcsv($file, 10000, ",")) !== FALSE) {

                $data[] = $row;
                if($count < 1){
                    $columns[] = $row;
                }
            }
        }

        $myCols = $columns[0];
        $final_data = [];
        $aSkipLines = array(0);
            foreach ($data as $i => $da) {
                $mydata = [];
                if (!in_array($i, $aSkipLines, true)) {
                    $count = 0;
                    foreach ($da as $j => $d){
                        $mydata[$myCols[$count]] = $d;
                        $count ++;
                    }
                }

                $final_data[] = $mydata;
            }

            if(count($final_data) > 0){
                foreach($final_data as $final_d){
                    if($final_d){

                        $is_user_exist = User::where('email',$final_d['email'])->first();
                        $token = str_random(60).time().$count;
                        // $password = rand().$count;
                        $password = 'NPCww07192021';

                        if(!$is_user_exist){
                            $user = User::create($this->getUsersDataToInsert($final_d,$token,$password));
                            if($user){
                                //$payment = Payment::insert($this->getPaymentsDataToInsert($user));
                                // if($payment){
                                // $to =  $user->email;
                                // $subject = 'Account Created';
                                // $view = (string)view('email.import-users-email', compact('user','password'));
                                //  $this->sendEmail($to,$subject,$view);
                                // }
                            }
                        }
                    }
                }
            }

        return redirect()->route('admin.imported-users')->with('success','Users import successfully!');

    }

    public function getUsersDataToInsert($column,$token,$password){
        $data = [
            'first_name' => $column['first_name'],
            'last_name' => $column['last_name'],
            'email' => $column['email'],
            'date_of_birth' => date('Y-m-d',strtotime($column['date_of_birth'])),
            'gender' => $column['gender'] === 'M' ? 'male' : 'female',
            'phone' => $column['phone'],            
            'address_1' => $column['address_1'], 
            'is_verified' => true,
            'is_imported' => true,            
            'is_admin_user' => true,
            'type' => 'member',
            'remember_token' => $token,
            'qr_code' => str_random(60).time().$token,           
            'password' => Hash::make($password),

        ];

        return $data;
    }

    public function getPaymentsDataToInsert($user){
        $payments_data = [
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'address' => $user->address_1,
            'city' => $user->city,
            'country_id' => $user->country,
            'state_id' => $user->state,
            'transaction_created_date' => date('Y-m-d H:i:s'),
            'transaction_expiry_date' => ($user->country == 173) ? '2022-12-31' : date('2022-12-31'),
            'is_paid_by_admin' => true,
        ];

        return $payments_data;
    }

    public function getMembershipToken(){
        $user = User::orderBy('membership_token','DESC')->first();
        if(!$user){
            $membership_token =  '10000';
        } else {
            $membership_token = $user->membership_token + 1;
        }

        return $membership_token;
    }

    public function getCountryByName($country_name){
        $is_country = Country::where('name', 'like', '%'.$country_name.'%')->first();
        $country = '';
        if($is_country){
            $country = $is_country->id;
        }
        return $country;
    }

    public function getStateByName($state_name){
        $is_state = State::where('name', $state_name)->first();
        $state = '';
        if($is_state){
            $state = $is_state->id;
        }
        return $state;
    }

    public function getCategoryByName($category_name){
        $is_category = category::where('name',$category_name)->first();
        $category = '';
        if($is_category){
            $category = $is_category->id;
        }
        return $category;
    }
}
