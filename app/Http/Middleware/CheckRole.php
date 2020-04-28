<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    private $auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       // Not Logged
       if (!Auth::check()) {
        return redirect('/login');
    }

    if (Auth::user()->role == 'ADMIN') {
        return redirect('/admin');
    }
    return redirect('/');


        // if(Auth::user()->role == 'ADMIN'){
        // return $next($request);

     
        // }
        // return redirect('/');    
    }
}
