<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkAdminLogin
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
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == config('const.role.root') || $user->role == config('const.role.admin')) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect('/admin/logout');
            }
        } else {
            return redirect('/admin/login')->with('status', 'Please login to admin');
        }
    }
}
