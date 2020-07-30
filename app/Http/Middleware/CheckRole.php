<?php

namespace App\Http\Middleware;

use Closure;
use auth;

class CheckRole
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
       // $data=$request->route()->parameters();
        if (auth::user()->name == "Lâm Thái Gia Huy" && auth::user()->email == "benjaminlam1202@gmail.com") {
            return $next($request);
        }
        abort(403, 'Unauthorized action.');
        return redirect('/')->with('status', 'Not Authorized!');
    }
}
