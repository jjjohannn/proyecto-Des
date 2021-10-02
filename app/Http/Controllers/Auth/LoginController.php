<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

<<<<<<< HEAD
=======
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;



>>>>>>> e95563c711dc270faf150be3592dab67142219f9
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

<<<<<<< HEAD
=======
    protected function authenticated(Request $request, $user)
    {
        if ($user->status === 0) {
            Auth::logout();
            throw ValidationException::withMessages([$this->username() => __('Usted no está autorizado para acceder al sistema. Contacte al administrador.')]);
        }
    }

>>>>>>> e95563c711dc270faf150be3592dab67142219f9
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
<<<<<<< HEAD
=======

    public function username()
    {
        return 'rut';
    }
>>>>>>> e95563c711dc270faf150be3592dab67142219f9
}
