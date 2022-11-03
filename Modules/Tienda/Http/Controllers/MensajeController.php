<?php

namespace Modules\Tienda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Tienda\Entities\Mensaje as msj;
use Session;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('tienda::index');
    }
    public function Leido($id)
    {
        $mensaje = msj::find($id);
        $mensaje->bk_estados_id = 33;
        $mensaje->save();
        return redirect::back();


    }
    public function No_Leido($id)
    {
        $mensaje = msj::find($id);
        $mensaje->bk_estados_id = 32;
        $mensaje->save();
        return redirect::back();
    }

    public function Respondido($id)
    {
        $mensaje = msj::find($id);
        $mensaje->bk_estados_id = 34;
        $mensaje->save();
        return redirect::back();

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
        $mensaje = new msj($request->all());
        $mensaje->save();
        Session::flash('mensaje',['content'=>'Mensaje agregada con exito','type'=>'primary']);
        return back();

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
        $mensaje = msj::find($id);
        $mensaje->fill($request->all());
        $mensaje->save();
        return redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $mensaje = msj::find($id);
        $mensaje->delete();
        return redirect::back();
    }
}
