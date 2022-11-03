<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\ComboResiduo as combo_residuo;

class ComboResiduoController extends Controller
{
    public function store(Request $request)
    {
        $combo_residuo = new combo_residuo($request->all());
        $combo_residuo->save();
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $combo_residuo = combo_residuo::find($id);
        $combo_residuo->fill($request->all());
        $combo_residuo->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $combo_residuo = combo_residuo::find($id);
        $combo_residuo->delete();
        return redirect::back();
    }
}
