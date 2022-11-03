<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\Comunas as comunas;
use Modules\Backend\Entities\Despacho as despacho;
use Modules\Backend\Entities\Cobertura as cobertura;

class DespachoController extends Controller
{

    public function store(Request $request)
    {
        $despacho = new despacho($request->all());
        $despacho->save();
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $despacho = despacho::find($id);
        $despacho->fill($request->all());
        $despacho->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $despacho = despacho::find($id);
        $despacho->delete();
        return redirect::back();
    }
}
