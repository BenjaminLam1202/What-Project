<?php

namespace App\Http\Middleware;
use Session;
use Closure;
use App;

class LanguageChange
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
        $language = Session::get('website_language');
        // config(['app.locale' => $language]);
        App::setLocale($language);
        return $next($request);
    }
}
