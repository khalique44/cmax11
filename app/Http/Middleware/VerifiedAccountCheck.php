<?php

namespace App\Http\Middleware;

use App\Payment;
use App\Registration_fee;
use App\Subscription;
use Closure;

class VerifiedAccountCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

//    public function handleOld($request, Closure $next)
//    {
//
//        $paid_status = Subscription::where('user_id',auth()->user()->id)->first();
//
//        if(auth()->user()->is_verified == true){
//            if(auth()->user()->is_active == 0){
//                $request->session()->forget('session_password');
//
//                $request->session()->invalidate();
//                return back()->with('error','Your account has been blocked');
//            }
//            //auth()->user()->is_paid for admin side to make user's paid/unpaid
//            if(auth()->user()->is_paid == 1 || $paid_status ){
//                return $next($request);
//            }else{
//
//            //if (!$paid_status || ( auth()->user()->is_admin_user==1 && auth()->user()->is_paid == 0)){
//			//	dd( "aaa=".$paid_status);
//			//	return 'here';
//
//                $request->session()->forget('session_password');
//
//                $request->session()->invalidate();
//                return redirect('checkout/'.auth()->user()->remember_token);
//            }
//            if(auth()->user()->type === 'pro-athlete'){
//
//                if(auth()->user()->status == 0){
//                    return redirect('resend-verification-mail/'.auth()->user()->remember_token);
//                }elseif(auth()->user()->status == 1){
//
//                    /* in case of free registration_fee*/
//                    $registration_fee = Registration_fee::where('year',auth()->user()->registration_year)
//                                        ->where('country_id',auth()->user()->country)
//                                        ->first();
//                    if($registration_fee){
//                        $pro_athlete_fee = $registration_fee->pro_athlete_fee;
//                        if($pro_athlete_fee && $pro_athlete_fee == 0){
//                            return redirect('/')->with('success','You are successfully registered, now you can login');
//                        }
//                    }else{
//                        if(auth()->user()->subscriptions()->count() == 0){
//                            return redirect('checkout/'.auth()->user()->remember_token);
//                        }
//                    }
//                }
//                else{
//                    \Auth::logout();
//                    return redirect('/');
//                }
//            }
//            return $next($request);
//        }
//        elseif(auth()->user()->type === "pro-athlete"){
//            if(auth()->user()->is_active == 0){
//                return back()->with('error','Your account has been blocked');
//            }
//            if(auth()->user()->status == false){
//                return redirect()->route('verify_email');
//            }else{
//                return redirect('waiting-for-approval/'.auth()->user()->remember_token);
//            }
//        }else{
//            /*if(auth()->user()->is_verified == false && auth()->user()->type == 'athlete'){
//                return redirect('checkout/'.auth()->user()->remember_token);
//            }*/
//            $request->session()->forget('session_password');
//
//            $request->session()->invalidate();
//            return redirect()->route('verify_email');
//        }
//    }

    public function handle($request, Closure $next)
    {
//        $paid_status = Payment::where('user_id',auth()->user()->id)
//            ->where(function ($query) {
//                $query->where('is_expire',false)->orWhere('is_paid_by_admin',true);
//            })->latest()->first();

        $is_paid = Payment::where('user_id',auth()->user()->id)->latest()->first();

        if(auth()->user()->is_verified == true){
            if(auth()->user()->is_active == 0){
                $request->session()->forget('session_password');
                $request->session()->invalidate();
                return  redirect()->route('login')->with('error','Your account has been blocked');
            }
            //auth()->user()->is_paid for admin side to make user's paid/unpaid
            if($is_paid){
//                if($is_paid->is_expire == 0 || $is_paid->is_paid_by_admin == 1){
//                    return $next($request);
//                }else if($is_paid->is_expire == 1){
//                    $request->session()->forget('session_password');
//                    $request->session()->invalidate();
//
//                    return  redirect()->route('login')
//                        ->with('error','Your account has been expired!')
//                        ->with('expired',auth()->user()->remember_token)
//                        ->with('refTransId',@$is_paid->transaction_id);
//                }else{
//                    $request->session()->forget('session_password');
//                    $request->session()->invalidate();
//
//                    return redirect('checkout/'.auth()->user()->remember_token);
//                }
                return $next($request);
            }else{

                $request->session()->forget('session_password');
                $request->session()->invalidate();

                return redirect('checkout/'.auth()->user()->remember_token);
            }
        } else{
            $request->session()->forget('session_password');
            $request->session()->invalidate();

            return redirect()->route('verify_email');
        }
    }
}
