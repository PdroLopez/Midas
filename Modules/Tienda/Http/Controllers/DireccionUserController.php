<?php

namespace Modules\Tienda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\DireccionUsuario;
use Modules\Login\Entities\Region;
use Modules\Login\Entities\Comuna;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;

class DireccionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('tienda::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('tienda::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $DireccionUsuario = new DireccionUsuario($request->all());
        $DireccionUsuario->users_id = Auth::user()->id;
        $DireccionUsuario->save();
        Session::flash('mensaje',['content'=>'actualización exitosa','type'=>'primary']);
        return redirect::back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('tienda::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('tienda::edit');
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


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $DireccionUsuario = DireccionUsuario::find($id);
        // dd($request);
        $DireccionUsuario->fill($request->all());
        $DireccionUsuario->save();
        Session::flash('mensaje',['content'=>'actualización exitosa','type'=>'primary']);

        return redirect::back();
    }

    // bk_comunas_id','bk_regiones_id

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
