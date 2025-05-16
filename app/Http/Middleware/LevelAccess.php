<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class LevelAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard): Response
    {
        if (!empty($guard) && Auth::guard($guard)->check() && in_array(Auth::guard($guard)->user()->level, ['admin', 'superadmin'])) {
            return $next($request);
        }

        return redirect()->back();
    }
}
