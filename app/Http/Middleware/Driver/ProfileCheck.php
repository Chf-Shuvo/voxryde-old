<?php

namespace App\Http\Middleware\Driver;

use Closure;
use App\Enums\Boolean;
use Illuminate\Http\Request;

class ProfileCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->image == null) {
            return redirect()->route('driver.profile.edit', auth()->user()->id);
        }
        return $next($request);
    }
}
