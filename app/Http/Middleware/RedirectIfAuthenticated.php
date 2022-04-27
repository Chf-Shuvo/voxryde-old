<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // dd($request);
        if ($guard == "customer" && Auth::guard($guard)->check()) {
            return redirect()->route("customer.home");
        }
        if ($guard == "driver" && Auth::guard($guard)->check()) {
            return "driver logged in";
        }
        if (Auth::guard($guard)->check()) {
            return redirect()->route("home");
        }
        // dd("nothing matched");
        return $next($request);
    }
}
