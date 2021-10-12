<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;

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
    public function customRegistration(){
        $carrera = Carrera::all();
        return view('usuario.register')->with('carreras', $carrera);

    }

    public function customLogin(){
        return view('usuario.login');
    }


}
