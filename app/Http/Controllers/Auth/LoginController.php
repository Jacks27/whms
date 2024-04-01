<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    public function redirectTo() {
        $user = auth()->user();
        if ($user) {
            $roles = $user->getRoleNames();
            $user = auth()->user();
            if ($user) {
                $roles = $user->getRoleNames();
                // Check roles to ensure they are retrieved correctly
                if ($roles->contains('Super-Admin')|| $roles->contains('cos')|| $roles->contains('hdoc')) {
                    return $redirectTo = '/whms/booking';
                } elseif ($roles->contains(null)) {
                    return redirect('whms/profile');
                }
            }else{
                return redirect()->route('login');
            }

        }
    }
    protected $redirectTo = '/whms/profile/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
