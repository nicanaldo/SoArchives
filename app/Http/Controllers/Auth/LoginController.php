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
    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }



    // Show the admin login form
    public function showAdminLoginForm()
    {
        return view('auth.adminlogin');

    }

    // Handle admin login
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'usertypeID' => 1])) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('error', 'Invalid credentials or you are not authorized to access this page.');
        }
    }

    // Handle seller/buyer login
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
                return redirect()->intended('/home');
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

    // Redirect after authentication
    protected function authenticated(Request $request, $user)
    {
        if ($user->usertypeID === 1) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->usertypeID === 2) {
            return redirect()->route('welcome');
        } elseif ($user->usertypeID === 3) {
            return redirect()->route('welcome');
        } else {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Invalid credentials.');
        }
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
