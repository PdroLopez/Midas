<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\DireccionUsuario;
use Modules\Login\Entities\Region;
use Modules\Login\Entities\Comuna;
use Illuminate\Support\Facades\Redirect;
use Session;


class DireccionUserController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        return view('create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('show');
    }

    public function edit($id)
    {
        return view('edit');
    }

    public function quitar($id)
    {

      $direccion = DireccionUsuario::find($id);
      $direccion->activo = 0;
      $direccion->save();
      return redirect::back();
    }

    public function direccionEdit($id)
    {
        $direcciones = DireccionUsuario::find($id);
        $region = Region::pluck('nombre','id');
        $comuna = Comuna::where('bk_regiones_id',$direcciones->bk_regiones_id)->pluck('nombre','id');
        return view('tienda::Public.direccion.edit',compact('direcciones','region','comuna'));


    }



    public function update(Request $request, $id)
    {
        $DireccionUsuario = DireccionUsuario::find($id);
        // dd($request);
        $DireccionUsuario->fill($request->all());
        $DireccionUsuario->save();
        Session::flash('mensaje',['content'=>'actualización exitosa','type'=>'primary']);

        return redirect::back();
    }


    public function destroy($id)
    {
        //
    }
}
