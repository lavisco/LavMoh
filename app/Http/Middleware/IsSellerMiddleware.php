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
        //if user isn't seller then abort with code 403
        if (!auth()->check() or !auth()->user()->role_id === Role::IS_SELLER) {
            abort(code: 401);
        }
        return $next($request);
    }
}
