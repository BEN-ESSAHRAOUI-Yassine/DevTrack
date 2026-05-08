<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrustProxies
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    protected $proxies = '*';

    protected $headers =
    \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
    \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
    \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO |
    \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT;
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
