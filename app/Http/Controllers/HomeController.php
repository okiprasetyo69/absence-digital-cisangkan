<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd(auth()->user()->hasRole('user'));

        //return view('home'); //For login
        return view('auth.login');
    }

    public function IndexSuperAdmin()
    {
        return view('superadmin.index');
    }

    public function IndexAdmin()
    {
        return view('admin.index');
    }

    public function IndexSpvManAdmin()
    {
        return view('spv_man_admin.index');
    }

    public function IndexEmployee()
    {
        return view('employee.index');
    }

    public function IndexHead()
    {
        return view('head.index');
    }

    public function IndexSecurity()
    {
        return view('security.index');
    }

    public function IndexUser()
    {
        return view('users.index');
    }

    public function userView(){
        return view('users.homepage_user');
    }
}
