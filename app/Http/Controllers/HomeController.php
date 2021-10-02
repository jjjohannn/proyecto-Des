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
        return view('home');
    }
<<<<<<< HEAD
=======

    public function customRegistration(){
        return view('usuario.register');
    }

    public function customLogin(){
        return view('usuario.login');
    }
>>>>>>> e95563c711dc270faf150be3592dab67142219f9
}
