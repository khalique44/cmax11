<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Helpers\RosenHelper;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/dashboard';

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
         $data = [
                  'title' => RosenHelper::getOption('login_title'), 
                  'description' => RosenHelper::getOption('login_description'),                    
                  
               ];
        
        $header_image = RosenHelper::getOption('login_header_image');
        
    

        if(!empty($header_image)){
            
          if(file_exists( public_path().'/'.$header_image )){
            $header_image = url('public') .'/'.$header_image;
          } else {
            $header_image = url('public/assets/images').'/header-bg.jpg';
          }
        }
        return view('auth.login',compact('data','header_image'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->forget('session_password');

        $request->session()->invalidate();

        return redirect('/');
    }

    protected function credentials(Request $request)
    {
        return [$this->username() => $request->{$this->username()}, 'password' => $request->password];
    }

    /*public function showLoginForm(Request $request)
    {
        $session_password = $request->session()->get('session_password');
        if($session_password && $session_password === "responsivaltesting123"){
            return view('auth.login');
        }else{
            return redirect()->route('/');
        }
    }*/

    public function username()
    {
        return $this->username;
    }

    public function findUsername()
    {
        $login = request()->input('username');
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;
    }

    public function redirectTo()
    {
        \LogActivity::addToLog('Logged In');
        return route('dashboard');
       
    }
}
