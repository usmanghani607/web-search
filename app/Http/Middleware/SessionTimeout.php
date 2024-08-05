<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity');
            $currentTime = Carbon::now()->timestamp;

            // Invalidate the session if it has been inactive for more than 10 seconds
            if ($lastActivity && ($currentTime - $lastActivity > 10)) {
                Auth::logout();
                $request->session()->invalidate();
                return redirect('/login')->with('message', 'Your session has expired due to inactivity.');
            }

            // Update last activity time
            session(['last_activity' => $currentTime]);
        }

        return $next($request);
    }
}
