<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
       
        // if logged in and is admin → allow
        if (auth('admin')->check()) {
            return $next($request);
        }

        // if not logged in or not admin → send to login
        return redirect()->route('admin.login');
    }
}
