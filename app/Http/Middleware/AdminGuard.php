<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminGuard
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

//        echo 'reached here';

        if (Auth::user()->role == 2)
        {
//            echo 'go ahead';
        }

//        echo "here: ".Auth::user()->role;

        else
        {
            return redirect('/');
        }

        return $next($request);

    }
}
