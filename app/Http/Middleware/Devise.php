<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Devise
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
        if (session()->has('appdevise') AND in_array(session()->get('appdevise'), config('devises')) ) {
            config(['app.devise' => session()->get('appdevise')]);
        }
        else {
            config(['app.devise' => config('app.fallback_devise')]);
        }

        return $next($request);
    }
}
