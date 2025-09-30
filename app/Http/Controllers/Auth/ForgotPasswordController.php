<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use PHPMailer\PHPMailer\PHPMailer;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request,[
           'email' => ['required','email',function($attribute, $value, $fail){
                if(!User::where('email',$value)->first())
                    $fail('No account found related to this '.$attribute);
           }
        ]]);

        $user = \App\User::where('email', request()->input('email'))->first();
        $token = \Password::getRepository()->create($user);
        //$user->sendPasswordResetNotification($token);

        $to = $user->email;
        $subject = 'NPC Rest Password';
        $view = (string)view('email.reset_password', compact('request','token','user'));
        $this->sendEmail($to,$subject,$view);

        return redirect()->back()->with('message','Mail sent successfully');

        /*if(!$mail->send()) {
            return redirect()->back()->with('error','Failed');
        } else {
            return redirect()->back()->with('message','Mail sent successfully');
        }*/
    }
}
