<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (session()->has('applocale') AND array_key_exists(session()->get('applocale'), config('languages')) ) {
            App::setLocale(session()->get('applocale'));
        }
        else {
            App::setLocale(config('app.fallback_locale'));
        }

        return $next($request);
    }
}
