<?php

namespace Modules\Dgr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Modules\Dgr\Entities\Configuracion as configuracion;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuracion = configuracion::all();
        return view('dgr::configuracion.index',compact('configuracion'));
    }

    public function store(Request $request)
    {
        $configuracion = new configuracion($request->all());
        $configuracion->save();
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $configuracion = configuracion::find($id);
        $configuracion->fill($request->all());
        $configuracion->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $configuracion = configuracion::find($id);
        $configuracion->delete();
        return redirect::back();
    }
}
