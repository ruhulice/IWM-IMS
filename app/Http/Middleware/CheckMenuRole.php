<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckMenuRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(isset(Auth::user()->role)) {
            foreach(Auth::user()->role as $role) {
                if(isset($role->role->menuRole)) {
                    foreach($role->role->menuRole as $menu_role) {
                        if (Route::current()->uri() == $menu_role->menu->menu_url) {
                            return $next($request);
                        }
                    }
                }
                if(isset($role->role->rolePermission)) {
                    foreach($role->role->rolePermission as $role_permission) {
                        if (Route::current()->uri() == $role_permission->permission->url) {
                            return $next($request);
                        }
                    }
                }
            }
        }

        return redirect('/dashboard')->with(['message' => 'You do not have the permission to access !!!', 'alert-type' => 'error']);
    }

}
