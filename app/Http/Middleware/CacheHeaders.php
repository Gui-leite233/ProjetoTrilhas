<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!$request->isMethod('GET')) {
            return $response;
        }

        return $response->header('Cache-Control', 'public, max-age=3600')
                       ->header('Vary', 'Accept-Encoding');
    }
}
