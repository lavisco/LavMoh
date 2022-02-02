<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware
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
        if (!auth()->check() or in_array(!auth()->user()->role_id, [Role::IS_ADMIN, Role::IS_MANAGER])) {
            abort(code: 401);
        }
        //if user isn't logged in or admin or manager then abort with code 403
        return $next($request);
    }
}
