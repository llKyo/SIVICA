<?php

namespace App\Http\Middleware;

use Closure;

class RolObserverMiddleware
{

    public function handle($request, Closure $next)
    {
        if ( \Auth::user()->isObserver() == false )
        {
          return back();
        }
          return $next($request);
    }
}
