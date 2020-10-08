<?php

namespace App\Http\Middleware;

use Closure;

class PembeliUser
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
        if(!$request->session()->has('Email') || ($request->session()->get('Role') == 1 || $request->session()->get('Role') == 2)) {
            return redirect('Logouts');
        }
        return $next($request);
    }
}
