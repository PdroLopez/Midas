<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Residuo as residuos;
use Storage;

class ResiduosController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $residuos = new residuos();
        $residuos->largo = $request->largo;
        $residuos->ancho = $request->ancho;
        $residuos->altura = $request->altura;
        $residuos->nombre = $request->nombre;
        $residuos->save();

        $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ran_sol = substr(str_shuffle($permit),0,6);
        if ($request->hasFile('imagen')) {
            foreach ($request->imagen as $key => $value) {
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($value->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $url = 'residuos/'.$residuos->id;

                $residuos_file = residuos::find($residuos->id);
                $residuos_file->imagen = $url.'/'.$nombre;
                $residuos_file->save();
                $ruta= Storage::putFileAs($url,$value,$nombre);
            }
        }
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $residuos = residuos::find($id);
        $residuos->fill($request->all());
        $residuos->save();

        $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ran_sol = substr(str_shuffle($permit),0,6);
        if ($request->hasFile('imagen')) {
            foreach ($request->imagen as $key => $value) {
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($value->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $url = 'residuos/'.$residuos->id;

                $residuos_file = residuos::find($residuos->id);
                $residuos_file->imagen = $url.'/'.$nombre;
                $residuos_file->save();
                $ruta= Storage::putFileAs($url,$value,$nombre);
            }
        }

        return redirect::back();
    }

    public function destroy($id)
    {
        $residuos = residuos::find($id);
        $residuos->delete();
        return redirect::back();
    }
}
