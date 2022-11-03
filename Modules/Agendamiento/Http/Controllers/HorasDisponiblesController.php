<?php

namespace Modules\Agendamiento\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Agendamiento\Entities\HorasDisponibles as horas;

class HorasDisponiblesController extends Controller
{
 
    public function agregar(Request $request){
        $horas = new horas($request->all());
        $horas->save();
        return redirect::back(); 
    }

    public function editar(Request $request, $id){
        $horas = horas::find($id);
        $horas->fill($request->all());
        $horas->save();
        return redirect::back();
    }

    public function eliminar($id){
        $horas = horas::find($id);
        $horas->delete();
        return redirect::back();
    }

}
