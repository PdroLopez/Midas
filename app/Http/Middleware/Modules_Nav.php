<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use App\Sucursales as sucursales;
use App\Taller as taller;
use App\Modulos as modulos;

class Modules_Nav
{
    public function handle($request, Closure $next)
    {
    	if (Auth::user()->roles_id == 11) {
            if (Auth::user()->administrador_taller->count() != 0) {
                if (!Session::has('taller_usado')) {
                    Session::put('taller_usado',Auth::user()->administrador_taller->first()->taller);
                }
                else{
                	Session::put('taller_usado',taller::find(Session::get('taller_usado')->id));
                }
            }
        }

        /*if (Auth::user()->roles_id == 12) {
            if (Auth::user()->usuario_sucursal->count() != 0) {
                if (!Session::has('sucursal_usado')) {
                    Session::put('sucursal_usado',Auth::user()->usuario_sucursal->first()->sucursales);
                }
                else{
                    Session::put('sucursal_usado',sucursales::find(Session::get('sucursal_usado')->id));
                }
            }
        }*/


        if (Session::has('modulo_usado')) {
            $modulos = modulos::find(Session::get('modulo_usado')->id);
            Session::put('modulo_usado',$modulos);
        }

    	return $next($request);
    }
}
