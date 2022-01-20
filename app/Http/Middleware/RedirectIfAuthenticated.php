<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //return redirect(RouteServiceProvider::HOME);
                $role = Auth::user()->role_id; 
                switch ($role) {
                    case Role::IS_ADMIN:
                        return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
                        break;
                    case Role::IS_SELLER:
                        return redirect(RouteServiceProvider::SELLER_DASHBOARD);
                        break; 
                    case Role::IS_BUYER:
                        return redirect(RouteServiceProvider::BUYER_DASHBOARD);
                        break; 
                
                    default:
                        return redirect('/login'); 
                    break;
                }
            }
        }

        return $next($request);
    }
}
