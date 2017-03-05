<?php

namespace App\Http\Middleware;

use Closure;

class CustomAuth
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
    session_start();

    if(isset($_SESSION['user-id'])){
      if(in_array($request->path(), ['auth', 'auth/login'])){ // logged in and trying to log in again ... not cool ...
        return redirect('start');
      } else { // logged in and going anywhere else - cool
        return $next($request);
      }
    } else {
      if (!in_array($request->path(), ['auth', 'auth/login'])){ // not logged in and trying to go anywhere else ... not cool ...
        return redirect('auth/login');
      } else { // not logged in and trying to log in - cool
        return $next($request);
      }
    }
  }
}
