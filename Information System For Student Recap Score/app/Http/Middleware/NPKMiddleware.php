<?php

namespace App\Http\Middleware;

use Closure;

class NPKMiddleware
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
        if ($request->session()->has('NPK')) {
            return $next($request);
        } else {
            return view('HalamanError');
        }
    }
}
