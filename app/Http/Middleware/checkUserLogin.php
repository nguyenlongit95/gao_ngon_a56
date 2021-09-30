<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkUserLogin
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
            if ($user->role == config('const.role.user')) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect('/logout');
            }
        } else {
            return redirect('/login')->with('status', 'Please login again!');
        }
    }
}
