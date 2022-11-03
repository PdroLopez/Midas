<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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

      if(Auth::user()->rol->nombre == 'Superadmin' || Auth::user()->rol->nombre == 'Administrador'){
        return $next($request);
      }else{
        abort(404);
      }
    }
}
