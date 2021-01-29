<?php

namespace Vanguard\Http\Middleware;

use Closure;
use Auth;

class DebugBarMiddleware
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
        
        $user = Auth::user()->id;
        
        if ($user == 450) {
            \Debugbar::enable();
        }
        else {
            \Debugbar::enable();
        }
        return $next($request);
    }
}
