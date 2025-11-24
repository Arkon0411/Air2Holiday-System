<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || ($user->role ?? '') !== 'admin') {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
