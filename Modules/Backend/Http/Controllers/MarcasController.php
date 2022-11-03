<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Workflow\Entities\Marcas as marca;
use Log;
use Storage;
use Session;


class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('Backend::index');
    }

    public function ActivarMarca($id)
    {
        $marca = marca::find($id);
        $marca->bk_estados_id = 22;
        $marca->save();
        Session::flash('success','El registro ha sido activado con exito');

        return redirect::back();

    }

    public function DesactivarMarca($id)
    {
        $marca = marca::find($id);
        $marca->bk_estados_id = 23;
        $marca->save();
        Session::flash('success','El registro ha sido desactivado con exito');

        return redirect::back();

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('Backend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $imagen =  $request->file('archivo')->store('public/archivo');
        $url = Storage::url($imagen);

        $marcas = new marca($request->all());
        $marcas->archivo = $imagen;
        $marcas->save();
        return redirect::back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('Backend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('Backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $marca = marca::find($id);
        $marca->fill($request->all());
        $marca->save();
        return redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $marca = marca::find($id);
        $marca->delete();
        return redirect::back();
    }
}

