<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CheckBlocked
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    if (Auth::guard()->check() && (auth()->guard('branch')->status != 1)) {

      Auth::guard('branch')->logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect()->route('branch.auth.login')->with('error', 'Your Account is suspended, please contact Admin.');
    }

    return $next($request);
  }
}
