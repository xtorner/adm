<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        $roles = is_array($role) ? $role : explode('|', $role);

        if (!Auth::user()->hasRole($roles)) {
           return redirect()->route('unauthorized');
        }

        return $next($request);
    }
}
