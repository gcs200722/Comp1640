<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class businessCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->faculty === 'Business Administration') {
            return $next($request);
        }

        return redirect()->route('logout')->with('error', 'You do not have access..');
    }
}
