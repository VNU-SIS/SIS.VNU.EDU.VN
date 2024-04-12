<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Locale
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
        $language = \Session::get('website_language', config('app.locale'));
        if (!\Session::has('website_language')) {
            \Session::put('website_language', $language);
        }

        config(['app.locale' => $language]);

        return $next($request);
    }
}
