<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class CheckLogin
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
       if(Auth::check() && isset(Auth::user()->user_id) && Auth::user()->user_id != ""){
            return $next($request);
       }       
       else{
            return redirect()->route('login');
       }       
    }
}
