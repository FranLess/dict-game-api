<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenAndAddToHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $all = $request->all();
        if (isset($all['_token'])) {
            Log::debug('token from http param', [$all['_token']]);
            $request->headers->set('Authorization', sprintf('%s %s', 'Bearer', $all['_token']));
        }
        return $next($request);
    }
}
