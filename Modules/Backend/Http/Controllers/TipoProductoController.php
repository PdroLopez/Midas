<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\TipoProducto as tipo_producto;


class TipoProductoController extends Controller
{
    public function store(Request $request)
    {
        $tipo_producto = new tipo_producto($request->all());
        $tipo_producto->save();
        return redirect::back(); 
    }

    public function update(Request $request, $id)
    {
        $tipo_producto = tipo_producto::find($id);
        $tipo_producto->fill($request->all());
        $tipo_producto->save();
        return redirect::back(); 
    }

    public function destroy($id)
    {
        $tipo_producto = tipo_producto::find($id);
        $tipo_producto->delete();
        return redirect::back();
    }

    public function estado($id)
    {
        $tipo_producto = tipo_producto::find($id);
        if($tipo_producto->activo == 0){
            $tipo_producto->activo = 1;
        }else{
            $tipo_producto->activo = 0;
        }
        $tipo_producto->save();
        return redirect::back();
    }
}
