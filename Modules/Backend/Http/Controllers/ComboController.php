<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\Combo as combo;
use Storage;

class ComboController extends Controller
{
    public function store(Request $request)
    {
        $combo = new combo($request->all());
        $combo->save();

        $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ran_sol = substr(str_shuffle($permit),0,6);
        if ($request->hasFile('imagen')) {
            foreach ($request->imagen as $key => $value) {
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($value->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $url = 'combos/'.$combo->id;

                $combo_file = combo::find($combo->id);
                $combo_file->img = $url.'/'.$nombre;
                $combo_file->save();
                $ruta= Storage::putFileAs($url,$value,$nombre);
            }
        }
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $combo = combo::find($id);
        $combo->fill($request->all());
        $combo->save();

        $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ran_sol = substr(str_shuffle($permit),0,6);
        if ($request->hasFile('imagen')) {
            foreach ($request->imagen as $key => $value) {
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($value->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $url = 'combos/'.$combo->id;

                $combo_file = combo::find($combo->id);
                $combo_file->img = $url.'/'.$nombre;
                $combo_file->save();
                $ruta= Storage::putFileAs($url,$value,$nombre);
            }
        }
        return redirect::back();
    }

    public function destroy($id)
    {
        $combo = combo::find($id);
        $combo->delete();
        return redirect::back();
    }

    public function activarcombo($id)
    {
        $combo = combo::find($id);
        if ($combo->activo == 0) {
            $combo->activo = 1;
        }else{
            $combo->activo = 0;
        }
        $combo->save();
        return redirect::back();
    }
}
