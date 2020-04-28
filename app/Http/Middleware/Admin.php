<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin
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



        if (Auth::check() && Auth::user()->role == 'ADMIN') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'LOGISTIK') {
            return redirect('/logistik');
        }
        elseif (Auth::check() && Auth::user()->role == 'DONATUR') {
            return redirect('/');
        }
        elseif (Auth::check() && Auth::user()->role == 'POSKO') {
            return redirect('/posko');
        }
        else {
            return redirect('/');
        }
    }
}
