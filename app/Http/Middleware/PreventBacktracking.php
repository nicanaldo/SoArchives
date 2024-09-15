<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PreventBacktracking
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Regardless of the authentication state, add the no-cache headers
        return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
                        ->header('Pragma', 'no-cache');
    }
}
