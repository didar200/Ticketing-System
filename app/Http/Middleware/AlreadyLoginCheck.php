<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlreadyLoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && ($request->url('/') || $request->url('/forgotPassword') || $request->url('/resetPassword/{token}') || $request->url('/resetPassword') ))
        {
            return back();
        }

        return $next($request);
    }
}
