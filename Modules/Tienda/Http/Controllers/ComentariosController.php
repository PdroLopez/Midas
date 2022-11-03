<?php

namespace Modules\Tienda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\Redirect;
use Modules\Tienda\Entities\Comentarios as comentario;
use Modules\Tienda\Entities\Producto as producto;


class ComentariosController extends Controller
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

        $comentario = new comentario($request->all());
        $comentario->users_id = Auth::user()->id;
        $comentario->save();

        return redirect('tienda/producto/'.$comentario->td_productos_id.'/valoracion');


       // return view('tienda::public.valoracion-producto',compact('productos','producto'));
    }
    public function si_util(Request $request, $id)
    {
        $comentario = comentario::findOrFail($id);


        $comentario->si_util  = $comentario->si_util +1;
        $comentario->save();

        Session::flash('mensaje',['content'=>'Funcion realizada  con exito','type'=>'primary']);
        return redirect::back();

    }

    public function no_util(Request $request, $id)
    {
        $comentario = comentario::findOrFail($id);


        $comentario->no_util  = $comentario->no_util +1;
        $comentario->save();

        Session::flash('mensaje',['content'=>'Funcion realizada  con exito','type'=>'primary']);
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
        try {
            $comentario = comentario::findOrFail($id);

            $comentario->denuncia = 1;//1=Denunciado
            $comentario->cantidad_denuncias = $comentario->cantidad_denuncias+1;
            $comentario->save();

            Session::flash('mensaje',['content'=>'Denuncia realizada  con exito','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }

    }

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
