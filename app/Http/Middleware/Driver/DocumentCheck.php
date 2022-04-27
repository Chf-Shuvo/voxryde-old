<?php

namespace App\Http\Middleware\Driver;

use Closure;
use Illuminate\Http\Request;

class DocumentCheck
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
        if (gettype(auth()->user()->document_status) != "object") {
            return redirect()->route('driver.document.provide.index');
        }
        return $next($request);
    }
}
