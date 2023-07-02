<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserLogs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActiveSession
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
        if (Auth::check() && Auth::user()->status === "online") {
            //ccheck if the user`s active session is over 30 minutes
            $lastActivity = session(Auth::id() . '_active_session');
            // Convert the Carbon object to a timestamp
            $last_activity_timestamp = $lastActivity->timestamp;
            //check if the user`s last activity is over 30 minutes
            if (time() - $last_activity_timestamp > 1800) {
                //logout the user
                // remove last_activity from session
                $request->session()->forget(Auth::id() . "_active_session");
                // set the user's status to offline
                Auth::user()->update(['status' => 'offline']);
                //update user log
                $log = UserLogs::where('user_id', Auth::id())->latest()->first();
                $log->update(['time_out' => now()]);
                //regenerate   session
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                // get role
                $role = Str::lower(Auth::user()->first->name);
                // logout the user
                Auth::logout();
                // Redirect to the login page
                return redirect()->route($role . '.portal')->with('errorAlert', 'Your session has expired. Please login again');
            }
            // The user's last activity was less than 10 minutes ago
            // Update last activity to the current time
            session([Auth::id() . "_active_session" => now()]);
            return $next($request);
        }
        return redirect()->back()->with('errorAlert', '');
    }
}
