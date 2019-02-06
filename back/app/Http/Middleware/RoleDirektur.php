<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleDirektur
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
        if(Auth::user()->role == 'direktur'){
            return $next($request);
        }

        return redirect('/home');
    }
}
