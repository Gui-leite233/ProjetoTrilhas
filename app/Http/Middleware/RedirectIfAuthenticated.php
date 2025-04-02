<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Add debug logging
            \Log::debug('Auth check for guard: ' . $guard . ', Result: ' . (Auth::guard($guard)->check() ? 'true' : 'false'));
            
            if (Auth::guard($guard)->check()) {
                \Log::debug('Redirecting authenticated user to: ' . RouteServiceProvider::HOME);
                return redirect(RouteServiceProvider::HOME);
            }
        }

        \Log::debug('Allowing unauthenticated access to: ' . $request->path());
        return $next($request);
    }
}
