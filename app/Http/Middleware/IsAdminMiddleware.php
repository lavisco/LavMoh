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
        //if user isn't admin or manager then abort with code 401
        
        if (in_array(auth()->user()->role_id, [Role::IS_ADMIN, Role::IS_MANAGER])) {
            return $next($request); 
        }
        abort(code: 401);
    }
}
