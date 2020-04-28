<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Posko
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
        if (Auth::check() && Auth::user()->role == 'POSKO') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'LOGISTIK') {
            return redirect('/logistik');
        }
        elseif (Auth::check() && Auth::user()->role == 'ADMIN') {
            return redirect('/admin');
        }
        elseif (Auth::check() && Auth::user()->role == 'DONATUR') {
            return redirect('/');
        }
        else {
            return redirect('/');
        }
    }
}
