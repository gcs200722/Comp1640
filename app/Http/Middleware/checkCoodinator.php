<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkCoodinator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role, $faculty)
    {
        if (Auth::check() && Auth::user()->role === 'Marketing Coordinator' && Auth::user()->faculty === $faculty) {
            return $next($request);
        }

        return redirect()->route('logout')->with('error', 'Bạn không có quyền truy cập.');
    }
}