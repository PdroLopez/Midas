<?php

namespace Modules\Login\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;

class ComunaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('login::index');
    }
    public function buscarRegion($id)
    {
        return Comuna::where('bk_regiones_id',$id)->get();
    }
    public function buscarComuna()
    {
        Log::info("dentro del funciona XXX");
        return response()->json("llego al metodo");
    }

}
