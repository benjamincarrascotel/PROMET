<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public $login_error = null;

    public function login(Request $request)
    {
        
        $input = $request->all();
        $credentials = $request->only('email', 'password');
        

        $user = User::where('email', $input["email"])->first();
        
        if(empty($user))
            return $this->auth_failure();
        
        if($user->password ==  hash_pbkdf2('haval256,5', $input["password"], $user->salt, 5, false, false))
        {
            Auth::login($user, isset($input["remember"]) ? true : false);
            return redirect()->intended('/');
        }
        else
            return $this->auth_failure();
    }

    public function logout(Request $request)
    {
        // flash('Sesión cerrada con éxito.');
        Auth::logout();
        return redirect('/login');
    }

    public function auth_failure()
    {
        //flash('Correo o contraseña incorrectos.')->error();
        $this->login_error = 'Contraseña inválida, por favor reintente.';
        return $this->showLoginForm();
    }

    public function showLoginForm()
    {
        if($this->login_error != null){
            return view('auth.login')->with('login_error', $this->login_error);
        }else{
            $login_error = null;
            return view('auth.login')->with('login_error', $login_error);
        }
    }

}
