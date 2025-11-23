<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanelAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Admins have full access
        if ($user->usertype === 'admin') {
            return $next($request);
        }

        // Airlines can access admin panel but their controllers should scope data
        if ($user->usertype === 'airline') {
            return $next($request);
        }

        abort(403, 'Forbidden');
    }
}
