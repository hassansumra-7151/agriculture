<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class AdminMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole(['super-admin', 'admin'])) {
                return $next($request);
            }
            abort(403, 'User does not have the correct role');
        }
        abort(401, 'Authentication required');
    }
}
