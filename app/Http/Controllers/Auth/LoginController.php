<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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

    public $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        if (request()->get('error')) {
            return redirect()->route('login');
        }

        $user = Socialite::driver('google')->user();
        $this->user = $user;

        $finduser = User::where('google_id', $user->id)->first();

        // Usuario registrado
        if ($finduser) {
            Auth::login($finduser);

            if (Auth::user()->role->name == 'profesor') {
                return redirect('/profesor/' . Auth::user()->id);
            }
            if (Auth::user()->role->name == 'alumno') {
                return redirect('/alumno/' . Auth::user()->id);
            }
            // Nuevo usuario
        } else {
            return view('auth.rol', compact('user'));
        }
    }

    /**
     * Create a new user instance.
     *
     */
    public function createAlumno($name, $email, $id)
    {
        $newUser = User::create([
            'role_id' => 2,
            'name' => $name,
            'email' => $email,
            'google_id' => $id
        ]);
        Auth::login($newUser);
        return redirect('/alumno/' . Auth::user()->id);
    }

    /**
     * Create a new user instance.
     *
     */
    public function createProfesor($name, $email, $id)
    {
        User::create([
            'role_id' => 1,
            'name' => $name,
            'email' => $email,
            'google_id' => $id,
        ]);

        return redirect(url('/send-mail-confirmacion/' . $name . '/' . $email));
    }

    public function createFail($name, $email)
    {
        return redirect(url('/send-mail-fail/' . $name . '/' . $email));
    }
}
