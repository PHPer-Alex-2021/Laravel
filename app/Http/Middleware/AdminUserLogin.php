<?php

namespace App\Http\Middleware;

use Closure;

class AdminUserLogin
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
        // session()->put('user',$user);
        if(!session()->has('user')){
            return redirect()->route('superLogin');
        }
        return $next($request);
    }
}
