<?php

namespace Modules\Tienda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Tienda\Entities\Descuentos as descuentos;
use Session;

class DescuentosController extends Controller
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
        $descuentos = new descuentos($request->all());
        $descuentos->descuento_final = ($request->cantidad*$request->descuento_final)/100;
        $descuentos->save();
        return redirect::back();
    }
    public function ActivarDescuento($id)
    {
        $descuentos = descuentos::find($id);
        $descuentos->bk_estados_id = 22;
        $descuentos->save();
        Session::flash('success','El registro se ha activado con exito');
        return redirect::back();

    }

    public function DesactivarDescuento($id)
    {
        $descuentos = descuentos::find($id);
        $descuentos->bk_estados_id = 23;
        $descuentos->save();
        Session::flash('success','El registro ha sido desactivado con exito');
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

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $descuentos = descuentos::find($id);
        $descuentos->fill($request->all());
        $descuentos->save();
        return redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $descuentos = descuentos::find($id);
        $descuentos->delete();
        return redirect::back();
    }
}
