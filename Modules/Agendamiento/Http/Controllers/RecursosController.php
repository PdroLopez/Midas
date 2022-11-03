<?php

namespace Modules\Agendamiento\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Agendamiento\Entities\Recursos as recursos;

class RecursosController extends Controller
{
 
    public function agregar(Request $request){
        $recursos = new recursos($request->all());
        $recursos->save();
        return Redirect::back(); 
    }

    public function editar(Request $request, $id){
        $recursos = recursos::find($id);
        $recursos->fill($request->all());
        $recursos->save();
        return Redirect::back();
    }

    public function eliminar($id){
        $recursos = recursos::find($id);
        $recursos->delete();
        return Redirect::back();
    }

}
