<?php

namespace App\Http\Middleware;

use Closure;

class Petugas
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
        if (!auth::guard('petugas')->check()) {

            return redirect('/auth/login');
        }
        return $next($request);
    }
}
