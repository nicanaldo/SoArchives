<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the session has expired
            if (session()->has('session_expired') && session('session_expired') === true) {
                session()->forget('session_expired'); // Clear session expired flag
                return redirect()->route('login')->with('sessionExpired', 'Your session has expired. Please log in again.');
            }
        }

        return $next($request);
    }
}
