<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use App\Petugas;
use Carbon\Carbon;
use Auth;

class LastSeenUserActivity
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
        if (Auth::guard('petugas')->check()) {
            $expireTime = Carbon::now()->addMinute(1); // keep online for 1 min
            Cache::put('is_online'.Auth::guard('petugas')->user()->id, true, $expireTime);

            //Last Seen
            Petugas::where('id', Auth::guard('petugas')->user()->id)->update(['last_seen' => Carbon::now()]);
        }
        return $next($request);
    }
}
