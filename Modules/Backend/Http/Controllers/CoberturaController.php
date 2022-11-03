<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\Cobertura as cobertura;

class CoberturaController extends Controller
{

    public function store(Request $request)
    {
        $cobertura = new cobertura($request->all());
        $cobertura->save();
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $cobertura = cobertura::find($id);
        $cobertura->fill($request->all());
        $cobertura->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $cobertura = cobertura::find($id);
        $cobertura->delete();
        return redirect::back();
    }
}
