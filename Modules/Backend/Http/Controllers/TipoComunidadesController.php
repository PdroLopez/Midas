<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\TipoComunidad as tipo_comunidad;

class TipoComunidadesController extends Controller
{

    public function store(Request $request)
    {
        $tipo_comunidad = new tipo_comunidad($request->all());
        $tipo_comunidad->save();
        return redirect::back(); 
    }

    public function update(Request $request, $id)
    {
        $tipo_comunidad = tipo_comunidad::find($id);
        $tipo_comunidad->fill($request->all());
        $tipo_comunidad->save();
        return redirect::back(); 
    }

    public function destroy($id)
    {
        $tipo_comunidad = tipo_comunidad::find($id);
        $tipo_comunidad->delete();
        return redirect::back();
    }
}
