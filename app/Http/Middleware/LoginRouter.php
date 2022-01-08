<?php

namespace App\Http\Middleware;

use App\Member;
use Closure;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

class LoginRouter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {

        print_r($request->all());

        $user = Member::where('id', Auth::id())->get()[0];

        if ($user['role'] == 1)
        {
            return redirect('/home_hostel');
        }
        else if ($user['role'] == 2)
        {
            return redirect('/admin_panel');
        }
        else if ($user['role'] == 3)
        {
            echo "Okay we got three";

            return redirect('/mess_secretary');
        }


    }
}
