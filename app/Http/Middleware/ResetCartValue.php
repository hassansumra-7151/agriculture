<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResetCartValue
{
    public function handle(Request $request, Closure $next)
    {
        // If the current route is the cart page, set the cart value to zero
        if ($request->route()->getName() === 'product.cart') {
            session(['cart_value' => 0]);
        }

        return $next($request);
    }
}



