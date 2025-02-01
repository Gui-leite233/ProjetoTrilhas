<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user() || $request->user()->role_id != $role) {
            return redirect()->route('unauthorized');
        }
        return $next($request);
    }
}
