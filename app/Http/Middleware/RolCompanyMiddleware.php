<?php

namespace App\Http\Middleware;

use Closure;

class RolCompanyMiddleware
{

    public function handle($request, Closure $next)
    {
      if ( \Auth::user()->isCompany() == false )
      {
        return back();
      }
        return $next($request);
    }
}
