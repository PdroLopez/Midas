<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\Destino as destino;
use Storage;

class DestinoController extends Controller
{
    public function store(Request $request)
    {
        $destino = new destino($request->all());
        $destino->save();
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $destino = destino::find($id);
        $destino->fill($request->all());
        $destino->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $destino = destino::find($id);
        $destino->delete();
        return redirect::back();
    }

    public function estado($id)
    {
        $destino = destino::find($id);
        if($destino->activo == 0){
            $destino->activo = 1;
        }else{
            $destino->activo = 0;
        }
        $destino->save();
        return redirect::back();
    }
}
