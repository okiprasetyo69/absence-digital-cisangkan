<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
       // dd(Auth::user()->role_id);
        
        if ($user->hasRole('admin')) {
            return redirect()->route('admin');
        } else if ($user->hasRole('superadmin')) {
            return redirect()->route('superadmin');
        } else if ($user->hasRole('spv_man_admin')) {
            return redirect()->route('spv');
        } else if ($user->hasRole('employee')) {
            return redirect()->route('employee');
        } else if ($user->hasRole('head')) {
            return redirect()->route('head');
        } else if ($user->hasRole('security')) {
            return redirect()->route('security');
        } else if($user->hasRole('user')){
            return redirect()->route('user');
        } 
        else{
            return redirect()->guest('auth/login');
            //return redirect()->route('auth/login');
        }
        
        //return redirect()->route('home');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}
