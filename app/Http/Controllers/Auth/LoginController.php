<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


    // Added: Login validation
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        // Attempt to find the user by email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Check if the password matches
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->intended('/panel');
            } else {
                // Password does not match
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['password' => 'The password you entered is incorrect. Please try again.']);
            }
        } else {
            // Email not found or other errors
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'These credentials do not match our records.']);
        }
    }
}
