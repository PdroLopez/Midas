<?php

namespace Modules\Tienda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;
use Modules\Tienda\Entities\VentaFuera;
use Modules\Tienda\Entities\Producto;
use Modules\Backend\Entities\Despacho;

class VentaFueraController extends Controller
{
    public function store(Request $request)
    {
        if(Session::has('sesion_comprador_externo_new')){
            $venta_fuera = VentaFuera::find(Session::get('sesion_comprador_externo_new')->id);
            $venta_fuera->fill($request->all());
            if ($request->direccion_detalle != null) {
                $venta_fuera->direccion = $request->direccion;
                $venta_fuera->detalle = $request->detalle;
            }
            $venta_fuera->save();
            Session::put('sesion_comprador_externo_new',$venta_fuera);

        }else{
            Session::put('sesion_comprador_externo',$request->all());
        }
        return redirect::to('tienda/venta-corta/producto/'.$request->producto_id.'/paso-3');
    }

    public function formaPagoCant(Request $request){
        $array = array($request->all());
        Session::put('sesion_pago_externo',$array);
        return redirect::to('tienda/venta-corta/producto/'.$request->producto_id.'/paso-4');
    }

    public function cancelar(){   
        if(Session::has('sesion_comprador_externo_new')){
            $sesion = Session::get('sesion_comprador_externo_new');
            $venta_fuera = VentaFuera::find($sesion->id);
            $venta_fuera->delete();
        }
        Session::forget('sesion_pago_externo');
        Session::forget('sesion_comprador_externo');
        Session::forget('sesion_comprador_externo_new');
        return redirect::to('https://www.instagram.com/midaschile/');
    }
}
