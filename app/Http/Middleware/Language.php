<?php

namespace App\Http\Middleware;

use Closure;

class Language
{
    /**
     * Handle language 
     * Lam pham
     */
    public function handle($request, Closure $next)
    {
        $language = \Session::get('website_language', config('app.locale'));
        \App::setLocale($language);

        return $next($request);
    }
}
