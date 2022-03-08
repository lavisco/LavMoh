<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class IsBuyerMiddleware
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
        //if user isn't buyer then abort with code 403
        if (auth()->user()->role_id === Role::IS_BUYER) {
            return $next($request);
        }
        abort(code: 401);
    }
}
