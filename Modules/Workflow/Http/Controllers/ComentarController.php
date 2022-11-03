<?php

namespace Modules\Workflow\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Workflow\Entities\Bitacora as bit;
use Modules\Workflow\Entities\Solicitud;

use Auth;
use Modules\Workflow\Entities\Boleta;

use Session;


class ComentarController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('workflow::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('workflow::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        try {
            $bit = new bit($request->all());
            $bit->users_id = Auth::user()->id;
            $bit->save();


            Session::flash('mensaje',['content'=>'Registro realizada  con exito','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('workflow::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('workflow::edit');
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
            Solicitud::find($id)->update([
                'peso_interno'=>$request->peso_interno,
                'peso_bruto'=>$request->peso_bruto,
                'peso_neto'=>$request->peso_neto
            ]);
            Session::flash('success', "Solicitud actualizada con éxito");
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('error', "Surgio un problema inesperado, intente mas tarde");

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
