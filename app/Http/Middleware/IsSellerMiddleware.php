<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class IsSellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //if user isn't seller then abort with code 401
        if (auth()->user()->role_id === Role::IS_SELLER) {
            return $next($request);
        }
        abort(code: 401);
    }
}
