<?php

namespace App\Http\Middleware;

use Closure;

class RolAdminMiddleware
{

    public function handle($request, Closure $next)
    {
      if ( \Auth::user()->isAdmin() == false )
      {
        return back();
      }
        return $next($request);
    }
}
