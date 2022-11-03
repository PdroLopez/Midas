<?php

namespace Modules\Workflow\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Workflow\Entities\Solicitud;
use App\Empresa;
use Auth;
use Datetime;
use Modules\Workflow\Entities\Boleta;
use Modules\Tienda\Entities\Ventas;
use Modules\Tienda\Entities\Transaccion;


class ReporteController extends Controller
{
    public function index()
    {
        $now_fecha = new Datetime();
        $empresas = Empresa::pluck('nombre','id');
        $boletas_em = Boleta::where('bk_estados_id',2)->get();
        $boletas_pa = Boleta::where('bk_estados_id',2)->where('empresas_id',null)->get();
        $ventas = Ventas::all();
        $transaccion = Transaccion::all();
        return view('workflow::private.reportes.index', compact('now_fecha','empresas','boletas_em','boletas_pa','ventas','transaccion'));
    }

}
