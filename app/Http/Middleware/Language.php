<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Language
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
        if (Session::has('locale')) {
            // Set the local value in Config in local
            $locale = Session::get('locale', Config::get('app.locale'));
        } else {
            $locale = 'en';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
