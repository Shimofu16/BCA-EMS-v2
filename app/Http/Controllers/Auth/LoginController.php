<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\SchoolYear;
use App\Models\ActivityLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers, ThrottlesLogins;
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 3; // Default is 1

    private function validateData($request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        return $credentials;
    }

    private function createLog($id,$activity,$description)
    {
        ActivityLog::create([
            'user_id' => $id,
            'activity' => $activity,
            'description' => $description,
        ]);
    }
    private function updateStatusTo($id, $status)
    {
        User::where('id', '=', $id)->update(['status' => $status]);
    }

    private function createUserSession($id)
    {
        session([$id . '_active_session' => now()]);
        session([$id . '_current_sy' => SchoolYear::where('is_active', '=', 1)->first()->id]);
    }
    private function forgetUserSession($id)
    {
        session()->forget($id . '_active_session');
        session()->forget($id . '_current_sy');
    }

    public function login(Request $request, $role)
    {
        $role = Str::lower($role);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $credentials =  $this->validateData($request);
        if (Auth::attempt($credentials)) {
            if (Auth::user()->student && Auth::user()->student->status === 'dropped') {
                return back()->withErrors([
                    'email' => 'Login Failed. This account is blocked.',
                ]);
            }
            if (Auth::user()->hasRole($role)) {
                $this->updateStatusTo(Auth::id(), 'online');
                $this->createLog(Auth::id(),'Login','User logged in.');
                $this->createUserSession(Auth::id());
                $request->session()->regenerate();
                $this->clearLoginAttempts($request);
                $role = ($role === "administrator") ? "admin" : $role;
                return redirect()->intended(route($role . '.dashboard.index'))->with('successToast', 'Welcome back, ' . Auth::user()->getFullName() . '!');
            }
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $this->clearLoginAttempts($request);

        }
        $this->incrementLoginAttempts($request);
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout(Request $request)
    {
        try {
            // Create a log
            $this->createLog(Auth::id(),'Logout','User logged out.');

            // Forget the admin's session
            $this->forgetUserSession(Auth::id());

            // Update the admin's account to set the "active" status to "offline"
            $this->updateStatusTo(Auth::id(), 'offline');


            // Invalidate the session and log out the admin
            Auth::logout();

            // Redirect to the home page
            return redirect()->route('home.index');
        } catch (\Throwable $th) {
            alert()->info('SYSTEM MESSAGE', $th->getMessage())->autoClose(5000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
            return redirect()->back();
        }
    }
}
