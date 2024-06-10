<?php

namespace App\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class Translation
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if($request->hasHeader('accept-language')){

            $lang = $request->header('accept-language');

            Config::set('app.locale', $lang);

        }

        return $next($request);

    }
}
