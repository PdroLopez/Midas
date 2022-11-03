<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\TipoServicio as tipo_servicio;

class TipoServicioController extends Controller
{
    public function store(Request $request)
    {
        $tipo_servicio = new tipo_servicio($request->all());
        $tipo_servicio->save();
        return redirect::back(); 
    }

    public function update(Request $request, $id)
    {
        $tipo_servicio = tipo_servicio::find($id);
        $tipo_servicio->fill($request->all());
        $tipo_servicio->save();
        return redirect::back(); 
    }

    public function destroy($id)
    {
        $tipo_servicio = tipo_servicio::find($id);
        $tipo_servicio->delete();
        return redirect::back();
    }

    public function estado($id)
    {
        $tipo_servicio = tipo_servicio::find($id);
        if($tipo_servicio->activo == 0){
            $tipo_servicio->activo = 1;
        }else{
            $tipo_servicio->activo = 0;
        }
        $tipo_servicio->save();
        return redirect::back();
    }
   
}
