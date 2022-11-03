<?php

namespace Modules\Dgr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Modules\Dgr\Entities\Modulos as modulos;
use Session;

class ModulosController extends Controller
{
    public function index()
    {
        $modulos = modulos::all();
        return view('dgr::private.modulos.index',compact('modulos'));
    }

    public function store(Request $request)
    {
        $modulos = new modulos($request->all());
        $modulos->save();
        return redirect::back(); 
    }

    public function update(Request $request, $id)
    {
        $modulos = modulos::find($id);
        $modulos->fill($request->all());
        $modulos->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $modulos = modulos::find($id);
        $modulos->delete();
        return redirect::back();
    }
}