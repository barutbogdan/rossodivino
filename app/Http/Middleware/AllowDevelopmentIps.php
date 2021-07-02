<?php

namespace App\Http\Middleware;

use Closure;

class AllowDevelopmentIps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ips = (array) explode(',', env('ALLOWED_DEVELOPMENT_IPS'));
        
        if (false === in_array($request->ip(), $ips)) {
            header('HTTP/1.0 403 Forbidden');
            exit();
        }
        
        return $next($request);
    }
}
