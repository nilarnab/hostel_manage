<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MessGuard
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

//        echo "Went rhgough this middleware";
        if (Auth::user()->role == 3)
        {
            return $next($request);
        }
        else
        {
            return redirect('./home');
        }
    }
}
