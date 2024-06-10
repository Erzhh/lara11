<?php

namespace App\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class MainAuthenticate
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if( Auth::guard('main')->user() ) {

            Config::set('auth.defaults.guard','main');

            return $next($request);
        }

        return redirect()->route('main_login');
    }
}
