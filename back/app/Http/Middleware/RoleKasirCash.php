<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleKasirCash
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
        if(Auth::user()->role == 'kasircash'){
            return $next($request);
        }

        return redirect('/home');
    }
}
