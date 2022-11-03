<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\Estados as estados;

class EstadosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('backend::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('backend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        /*
        Estados que habian:
        Solicitado
        Finalizado
        Aceptado
        En Camino
        Publicado
        Sin Publicar
        En Stock
        Sin Stock
        Ultimas Unidades
        Cancelado
        Pendiente
        PorDespachar
        Recibido
        Retirado


        */
        $estados = new estados($request->all());
        $estados->save();
        return redirect::back(); 
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('backend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $estados = estados::find($id);
        $estados->fill($request->all());
        $estados->save();
        return redirect::back(); 
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $estados = estados::find($id);
        $estados->delete();
        return redirect::back();
    }
}
