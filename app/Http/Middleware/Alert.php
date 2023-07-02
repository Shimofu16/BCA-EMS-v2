<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Alert
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
        if ($request->session()->has('successToast')) {
            toast()->success('SYSTEM MESSAGE', $request->session()->get('successToast'))->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
        }
        if ($request->session()->has('errorToast')) {
            toast()->error('SYSTEM MESSAGE', $request->session()->get('errorToast'))->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
        }
        if ($request->session()->has('infoToast')) {
            toast()->info('SYSTEM MESSAGE',  $request->session()->get('infoToast'))->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
        }
        if ($request->session()->has('warningToast')) {
            toast()->warning('SYSTEM MESSAGE', $request->session()->get('warningToast'))->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
        }
        /* alert */
        if ($request->session()->has('successAlert')) {
            alert()->success('SYSTEM MESSAGE', $request->session()->get('successAlert'))->autoClose(9000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
        }
        if ($request->session()->has('errorAlert')) {
            alert()->error('SYSTEM MESSAGE',$request->session()->get('errorAlert'))->autoClose(9000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
        }
        if ($request->session()->has('infoAlert')) {
            alert()->info('SYSTEM MESSAGE', $request->session()->get('infoAlert'))->autoClose(9000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
        }
        if ($request->session()->has('warningAlert')) {
            alert()->warning('SYSTEM MESSAGE', $request->session()->get('warningAlert'))->autoClose(9000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
        }
        
        return $next($request);
    }
}
