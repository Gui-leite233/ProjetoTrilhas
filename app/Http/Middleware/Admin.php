<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Check if user is admin using a more descriptive variable
            $isAdmin = Auth::user()->role_id === 1;
            
            if ($isAdmin) {
                return $next($request);
            }
        }
        
        // If not authorized, redirect with a message
        return redirect()->route('unauthorized')->with('error', 'Acesso permitido apenas para administradores.');
    }
}
