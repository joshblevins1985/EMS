<?php

namespace Vanguard\Http\Middleware;

use Closure;

class StationMiddleware
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
        if($request->user && $request->user()->primary_station != 21){
            abort(403, "Forbidden.");
        }
        
        return $next($request);
    }
}
