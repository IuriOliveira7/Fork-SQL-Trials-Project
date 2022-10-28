<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login-page');
    }

    public function redirectToProvider($driverProvider)
    {
        return Socialite::driver($driverProvider)->redirect();
    }

    public function handleProviderCallback($driverProvider)
    {
        $userProvider = Socialite::driver($driverProvider)->user();

        /*
         * check if user hasPermission == Teacher
         * case user is Teacher attr permission == Teacher
         * case user don't hasPermission == Teacher check if user is a Student
         *
         */

        $user = User::firstOrCreate(['email' => $userProvider->getEmail()],
            [   'name' => $userProvider->getName() ?? $userProvider->getNickname(),
                'email' => $userProvider->getEmail(),
                'driverProvider_id' => $userProvider->getId(),
                'driverProvider' => $driverProvider
            ]);
        Auth::login($user);
        return redirect($this->redirectTo);
    }
}
