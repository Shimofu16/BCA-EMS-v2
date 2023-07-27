<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->is('admin') || $request->is('admin/*')) {
            if (Auth::check() && Auth::user()->status == 'online') {
                if (Auth::user()->hasRole('administrator')) {
                    return route('admin.dashboard.index');
                }
                return back()->with('errorAlert', 'You are not authorized to access this page');
            } else {
                return route('portals.show',['role' => 'administrator']);
            }
        } elseif ($request->is('registrar') || $request->is('registrar/*')) {
            if (Auth::check() && Auth::user()->status == 'online') {
                if (Auth::user()->hasRole('registrar')) {
                    return route('registrar.dashboard.index');
                }
                return back()->with('errorAlert', 'You are not authorized to access this page');
            } else {
                return route('portals.show',['role' => 'Registrar']);
            }
        } elseif ($request->is('cashier') || $request->is('cashier/*')) {
            if (Auth::check() && Auth::user()->status == 'online') {
                if (Auth::user()->hasRole('cashier')) {
                    return route('cashier.dashboard.index');
                }
                return back()->with('errorAlert', 'You are not authorized to access this page');
            } else {
                return route('portals.show',['role' => 'Cashier']);
            }
        } elseif ($request->is('teacher') || $request->is('teacher/*')) {
            if (Auth::check() && Auth::user()->status == 'online') {
                if (Auth::user()->hasRole('teacher')) {
                    return route('teacher.dashboard.index');
                }
                return back()->with('errorAlert', 'You are not authorized to access this page');
            } else {
                return route('portals.show',['role' => 'Teacher']);
            }
        } elseif ($request->is('student') || $request->is('student/*')) {
            if (Auth::check() && Auth::user()->status == 'online') {
                return route('student.dashboard.index');
            } else {
                return route('portals.show',['role' => 'Student']);
            }
        } else {
            return route('portals.index');
        }
    }
}
