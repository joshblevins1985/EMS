<?php

namespace Vanguard\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class AuthLock
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
        if ($request->session()->has('locked')) {

            return redirect('/lockscreen');

        }


        return $next($request);
        if(!$request->user()){
            return $next($request);
        }

    }
}
