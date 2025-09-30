<?php

namespace App\Http\Controllers;

use App\ImportUsers;
use App\Registration_fee;
use App\User;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use App\IpRestriction;
use App\ReportedIssues;
use App\Message;
use App\MessageReceiver;
use App\Http\Helpers\RosenHelper;

class UsersController extends Controller
{
    public function verifyEmail(){
        $user = auth()->user();
        return view('verify-email',compact('user'));
    }

    public function verifyUser($token)
    {
        $user = User::Where(["remember_token" => $token])->first();

        if(!$user){
            return redirect('/')->with('warning', "Sorry your email cannot be identified.");
        }

        if($user->is_verified == false)
        {
            $user->is_verified = true;
            $user->save();

            $to = $user->email;
            $subject = 'Email Verified Successfully!';
            $view = (string)view('email.email_successfully_payment', compact('user'));
            $this->sendEmail($to,$subject,$view);

            if($user->type == "pro-athlete"){
                return redirect('checkout/'.$user->id)->with('success',"Your e-mail is verified successfully.");
            } else {
                return redirect('/')->with('success','You are successfully registered, now you can login');
            }

        } else {
            return redirect('/')->with('success',"Your e-mail is already verified. You can now login.");
        }

    }

    public function resendEmailVerifyMail(){
        // $user = auth()->user();
        $user = User::find(6826);
        if(!$user){
            return abort(404);
        }
        /*$token = str_random(60).time();
        $user->remember_token = $token;
        $user->save();*/

        $to =  $user->email;
        $subject = 'Verify E-Mail';
        $view = (string)view('email.email_verify', compact('user'));
        $response = $this->sendEmail($to,$subject,$view);
        return redirect()->back()->with('message','Mail sent successfully!');

        /*if($response){
            return redirect()->back()->with('message','Mail sent successfully!');
        } else {
            return redirect()->back()->with('error','Failed mail did not send!');
        }*/
    }

    public function waitingForApprovalProUser(Request $request, $token){
        $user = User::Where(["remember_token" => $token])->first();
        if(!$user){
            return redirect('/')->with('warning', "Sorry your email cannot be identified.");
        }
        if($user->status == 0){
            $user->status = 1;
            $user->save();
            //return redirect('resend-verification-mail/'.auth()->user()->remember_token);
        }/*else{
            //return redirect('waiting-for-approval/'.auth()->user()->remember_token);
            \Auth::logout();
            return redirect('/');
        }*/
        return view('pro-athlete-thank-you',compact('user'));
    }
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (Hash::check($request->old_password, $user->password)){
            $user->fill([
                'password' => \Hash::make($request->password)
            ])->save();
            return 1;
        } else {
            return 0;
        }
    }

    public function updateAddress(Request $request)
    {
        //'password'      => \Hash::make($request->password),
        $user = auth()->user();

        if($request->address_1 != '') {
            $user->fill([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'phone'         => $request->phone_number,
                'address_1'     => $request->address_1,
                'address_2'     => $request->address_2,
                'city'          => $request->city,
                'country'       => $request->country,
                'state'         => $request->state,
                'date_of_birth' => date('Y-m-d',strtotime($request->date_of_birth))
            ])->save();

            return 1;
        } else {
            return 0;
        }
    }

    public function Judge(Request $request){
        $this->validate($request,[
           'contest_ids' => 'required|array'
        ]);

        $user = auth::User()->where('type','pro-athlete')->first();
        $cnt = $user->contestJudges()->count();
        if($cnt > 0){
            $user->contestJudges()->sync($request->contest_ids);
        }else{
            $user->contestJudges()->attach($request->contest_ids);
        }

        return redirect()->back()->with('success','successfully create judge!');
    }

    public function importUsers(){
        //$url  = url('public/assets/import_users/121020A.csv');
        $url  = url('public/assets/import_users/121020B.csv');
        $fh = fopen($url, 'r');

        while(($row = fgetcsv($fh)) !== false) {

            if(!is_null($row)){
                foreach($row as $email){
                    ImportUsers::create(['email'=>$email]);
                }
            }
        }

        return 'success!';
    }

    public function updateUsersInPaymentsTable(){
        $users = User::select('id','email','first_name','last_name','address_1','city','country','state','created_at')->get();

        $userPayment = [];
        foreach ($users as $index => $user){

            $transaction_expiry_date = ( $user->country == 173 ) ? '2022-12-31' : '2022-12-31';

            $userPayment = [
                //'id' => $user->id,
                //'email' => $user->email,
                'first_name' => @$user->first_name,
                'last_name' => @$user->last_name,
                'address' => @$user->address_1,
                'city' => @$user->city,
                'country_id' => @$user->country,
                'state_id' => @$user->state,
                'transaction_created_date' => @$user->created_at
            ];

            $is_user_expiry_change = ImportUsers::where('email',$user->email)->first();

            if(($user->country == 30 && date('Y-m-d',strtotime($user->created_at)) >= '2020-10-01' && date('Y-m-d',strtotime($user->created_at)) <= '2020-12-31') ||
                ($user->country == 181 && date('Y-m-d',strtotime($user->created_at)) >= '2020-10-25') || $is_user_expiry_change){
                $userPayment['transaction_expiry_date'] = '2021-12-31 00:00:00';
            }else{
                $userPayment['is_expire'] = true;
                $userPayment['transaction_expiry_date'] = $transaction_expiry_date;
            }

            $user->payments()->create($userPayment);

            echo '<pre>';
            print_r($userPayment);
        }
        exit;

    }


    public function validateMemberShipId(Request $request){

        $data = $request->all();
        $return = [];

        if(!empty($data['membership_id'])){

            $subscriber = User::join('subscriptions', 'users.id', '=', 'subscriptions.user_id')
            ->where('subscription_id', $data['membership_id'])->first();

           
            $firstName = !empty($subscriber->first_name) ? $subscriber->first_name : "";
            $lastName = !empty($subscriber->last_name) ? $subscriber->last_name : "";
            $fullName = trim($firstName.' '.$lastName);
            $email = !empty($subscriber->email) ? $subscriber->email : "";
            $isActive = !empty($subscriber->is_active) ? 'active' : 'inactive';
            $cardEpiryDate = !empty($subscriber->card_expiry_date) ? $subscriber->card_expiry_date : '';

            if(!empty($subscriber)){
                
                $return = [
                                    'id'=> !empty($subscriber->subscription_id) ? $subscriber->subscription_id : "",
                                    'valid' => !empty($subscriber->subscription_id) ? true : false,
                                    'name' => $fullName,
                                    'email' => $email,
                                    'status' => $isActive,
                                    'member_validity' => $cardEpiryDate
                                ];

                return response()->json($return, 200);
            }

        }else{

             return response()->json($return, 400);
        }
    }

    /**
     * api for getting susbcribers details from ids added by KHL
     *
     */
    public function validateMemberShipIds(Request $request){

        $data = $request->all();

        $is_allowed_api = IpRestriction::where([
            ['mode', '=', 'allowed'],
            ['type', '=', 'api'],
            ['ip', '=', $request->ip()]])->count();

        $restrictedIps = [];
        $defaultResponse = [['error' => false, 'msg' => 'No record found!']];    

       
        $whitelist = array(
            '127.0.0.1',
            '::1'
        );

        if($is_allowed_api < 1 && !in_array($request->ip(), $whitelist)){

            $defaultResponse = [['req_status' => 'Error', 'msg' => 'You are not authorized to access.']];
            return response()->json( $defaultResponse, 401);
        }
        

        if(empty($data['membership_ids'])){

            $defaultResponse = [['req_status' => 'Error', 'msg' => 'Missing membership_ids param!']];
            return response()->json( $defaultResponse, 400); 

        }else if(!is_array($data['membership_ids'])){

            $defaultResponse = [['req_status' => 'Error', 'msg' => 'membership_ids param must be array type!']];
            return response()->json( $defaultResponse, 400); 

        } else if (!\App\Http\Helpers\NpcHelper::arrayHasOnlyInts($data['membership_ids'])){

            $defaultResponse = [['req_status' => 'Error', 'msg' => 'Only numeric value allowed in membership_ids param!']];
            return response()->json( $defaultResponse, 400);
        }

         $subscribers = User::with('latestPayment')->leftjoin('countries', 'payments.country_id', '=', 'countries.id')
            ->select('users.id','users.membership_token', 'users.first_name', 'users.last_name', 'users.email', 'users.date_of_birth'
             ,'payments.user_id','payments.transaction_expiry_date' , 'payments.country_id', 'countries.name')
            ->whereIn('membership_token', $data['membership_ids'])
            //->orderBy('transaction_expiry_date', 'desc')
            ->get();

            //$subscribers = Subscription::whereIn('subscription_id', $data['membership_ids'])->get(['users.*','subscriptions.card_expiry_date,subscriptions.subscription_id']);

            if(!empty($subscribers)){ 

                foreach($subscribers as $subscriber){
                    
                    $is_user_transaction_expired = \App\Http\Helpers\NpcHelper::isUserTransactionExpired($subscriber->user_id);
                    $paid_user = \App\Http\Helpers\NpcHelper::userPaymentInfo($subscriber->user_id);
                    $firstName = !empty($subscriber->first_name) ? $subscriber->first_name : "";
                    $lastName = !empty($subscriber->last_name) ? $subscriber->last_name : "";
                    $dob      = !empty($subscriber->date_of_birth) ? $subscriber->date_of_birth : "";
                    //$fullName = trim($firstName.' '.$lastName);
                    $email = !empty($subscriber->email) ? $subscriber->email : "";
                    $country = !empty($subscriber->name) ? $subscriber->name : "";
                    $membsershipExpired= ($paid_user) ? $is_user_transaction_expired : 'true';
                    $cardEpiryDate = !empty($subscriber->transaction_expiry_date) ? $subscriber->transaction_expiry_date : '';

                    $return[] = [
                                        'membership_id'=> !empty($subscriber->membership_token) ? $subscriber->membership_token : "",
                                        'first_name' => $firstName,
                                        'last_name' => $lastName,
                                        'email' => $email,
                                        'dob'   => $dob,
                                        'country' => $country,
                                        'paid_user' => !empty($paid_user) ? true : false,
                                        'membsership_expired' => $membsershipExpired,
                                        'member_validity' => $cardEpiryDate
                                    ];
                    
                }

                $return = !empty($return) ? $return : $defaultResponse;

                return response()->json( $return, 200); 
            }


         return response()->json($defaultResponse, 200);
    }

    public function dashboard(){

        $data = [
                  'title' => RosenHelper::getOption('what_title'), 
                  'description' => RosenHelper::getOption('what_description'),                    
                  
               ];
        
        $header_image = RosenHelper::getOption('what_header_image');
        
    

        if(!empty($header_image)){
            
          if(file_exists( public_path().'/'.$header_image )){
            $header_image = url('public') .'/'.$header_image;
          } else {
            $header_image = url('public/assets/images').'/header-bg.jpg';
          }
        }
        
        $user = auth()->user();
        $unreadCommentsCount = ReportedIssues::totalUnreadComments();        
        $unreadMessagesCount = Message::totalUnreadMessages();
        $view = (User::isVendor()) ? 'account.dashboard_vendor' : 'account.dashboard';
        return view($view,compact('user','unreadCommentsCount','unreadMessagesCount','data','header_image'));
    }


    public function getMessages(){

        $messages = Message::getMessages();                

        $returnHTML = view('account.messages')->with(['messages' => $messages])->render();

        MessageReceiver::where(['is_read' => 0,'send_to' => auth()->user()->id])->update(["is_read" => 1]);

        return response()->json(array('success' => true, 'html' => $returnHTML));
    }
    
}


