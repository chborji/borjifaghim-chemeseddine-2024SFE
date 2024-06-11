<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetLocalization
{
    /**
     * Sets the locale of the app with the session variable 'locale'.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('locale')) {
            app()->setLocale(Session::get('locale'));
        }
        return $next($request);
    }
}
