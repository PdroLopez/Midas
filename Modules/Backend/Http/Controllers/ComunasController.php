<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\Comunas as comunas;

class ComunasController extends Controller
{

    public function index()
    {
        return view('backend::index');
    }

    public function store(Request $request)
    {
        $comunas = new comunas($request->all());
        $comunas->save();
        return redirect::back(); 
    }

    public function update(Request $request, $id)
    {
        $comunas = comunas::find($id);
        $comunas->fill($request->all());
        $comunas->save();
        return redirect::back(); 
    }


    public function destroy($id)
    {
        $comunas = comunas::find($id);
        $comunas->delete();
        return redirect::back();
    }

    public function BuscarComunas($id){
        $comuna = Comuna::where('bk_regiones_id',$id)->get();
        return response()->json($comuna);
    }
}
