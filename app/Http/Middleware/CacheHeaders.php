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

        // Add cache headers
        return $response->header('Cache-Control', 'public, max-age=3600')
                       ->header('Expires', gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
    }
}
