<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\SubCategoria as subcategoria;
use Storage;

class SubCategoriaController extends Controller
{
    public function store(Request $request)
    {
        $subcategoria = new subcategoria($request->all());
        $subcategoria->save();
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $subcategoria = subcategoria::find($id);
        $subcategoria->fill($request->all());
        $subcategoria->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $subcategoria = subcategoria::find($id);
        $subcategoria->delete();
        return redirect::back();
    }
}
