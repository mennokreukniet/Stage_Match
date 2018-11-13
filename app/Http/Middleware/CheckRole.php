<?php

namespace App\Http\Middleware;

use Closure;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (auth()->check() && $request->user()->role == USER_ROLES[$role]) {
            return $next($request);
        };
        return response([
            'message' => 'auth check or role check failed'
        ], 400);
    }
}
