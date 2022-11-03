<?php

namespace Modules\Tienda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Tienda\Entities\Categorias as categorias;

class CategoriasController extends Controller
{
    public function index()
    {
        return view('tienda::index');
    }

    public function store(Request $request)
    {
        $categorias = new categorias($request->all());
        $categorias->save();
        return redirect::back(); 
    }

    public function update(Request $request, $id)
    {
        $categorias = categorias::find($id);
        $categorias->fill($request->all());
        $categorias->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $categorias = categorias::find($id);
        $categorias->delete();
        return redirect::back();
    }
}
