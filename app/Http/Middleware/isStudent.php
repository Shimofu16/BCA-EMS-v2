<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isStudent
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
        // check if the user is a student
        if (!Auth::user()->hasRole('Student')) {
            return back()->with('errorAlert', 'You are not authorized to access this page');
        }
        // check if the user is authenticated
        if (Auth::check() && Auth::user()->isActive()) {
            // check if the user's active session is over 30 minutes
            $lastActivity = session(Auth::id() . '_active_session');

            if ($lastActivity && time() - $lastActivity->timestamp > 1800) {
                Auth::user()->update(['status' => 'offline']);
                // logout the user
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('portals.show',['role' => 'Student'])->with('errorAlert', 'Your session has expired. Please login again');
            }

            // Update last activity to the current time
            session([Auth::id() . "_active_session" => now()]);
            return $next($request);
        }

        return redirect()->route('portals.show',['role' => 'Student'])->with('errorAlert', 'You need to login to access this page');
    }
}
