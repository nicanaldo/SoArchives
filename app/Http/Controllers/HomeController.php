<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifyToken;
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

        if (auth()->check()) {
            $user = auth()->user();
    
            // Check if user exists and is activated
            if ($user && $user->is_activated == 1) {
                return view('home');
            } else {
                return redirect('/verify-account');
            }
        } else {
            // Handle case where user is not authenticated
            // Redirect to login page or any other appropriate action
            return redirect('/login');
        }
        
    }

    public function verifyaccount(){
        return view('opt_verification');
    }

    public function useractivation (Request $request){

        $token = $request->token; // Assuming the OTP is submitted via form input named 'otp'
        $token = VerifyToken::where('token', $token)->first();

        if($token) {
            $token->is_activated = 1;
            $token->save();
            $user = User::where('email', $token->email)->first();
            $user->is_activated = 1;
            $user->save();
            $getting_token = VerifyToken::where('token', $token->token)->first();
            $getting_token->delete();
                // Redirect the user to the home page after successful activation
                    auth()->login($user); // Log in the user
                    if ($user->usertypeID === 1) {
                        return redirect('/admin/dashboard')->with('activated', 'Your Account has been activated successfully.'); //recheck later
                    } else {
                        return redirect('/home')->with('activated', 'Your Account has been activated successfully.');
                    }
                }else {
                    return redirect('/verify-account')->with('incorrect', 'Your OTP is invalid, please check your email.');
                }

            


        // $otp = $request->token; // Assuming the OTP is submitted via form input named 'otp'

        // $token = VerifyToken::where('token', $otp)->first();

        // if ($token) {
        //     $user = User::where('email', $token->email)->first();
            
        //     if ($user) {
        //         $user->is_activated = 1;
        //         //$user->remember_token = Str::random(100);
        //         $user->save();

        //         // Delete the token from the table since it has been used
        //         $token->delete();

        //         // Redirect the user to the home page after successful activation
        //         auth()->login($user); // Log in the user
        //         if ($user->usertypeID === 1) {
        //             return redirect('/admin/dashboard')->with('activated', 'Your Account has been activated successfully.'); //recheck later
        //         } else {
        //             return redirect('/home')->with('activated', 'Your Account has been activated successfully.');
        //         }
        //     }
        // }

        // return redirect('/verify-account')->with('incorrect', 'Your OTP is invalid, please check your email.');

    
    }
}
