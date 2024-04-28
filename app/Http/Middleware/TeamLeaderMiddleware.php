<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamLeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user() || !auth()->user()->hasRole('HR')) {
            return redirect()->back()->with('warning', "Unauthorized Access!"); // You can redirect to a login page instead
        }

        return $next($request);
    }
}
