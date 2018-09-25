<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;


class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('is_admin')) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->isAdmin()) {
            $request->session()->put('is_admin', 1);
            return $next($request);
        }
        return redirect(route('system.login'));
    }
}
