<?php

namespace Modules\Tienda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Tienda\Entities\VentaTransaccion;
use Modules\Tienda\Entities\Transaccion as tr;
use Modules\Tienda\Entities\Ventas as venta;
use App\Exports\VentasExport;
use App\Exports\VentasExportWebpay;
use Modules\Backend\Entities\Despacho;
use Modules\Tienda\Entities\Producto;
use Modules\Tienda\Entities\VentaFuera;
use Excel;


class VentaController extends Controller
{
    public function index()
    {
        return view('tienda::index');
    }

    public function estado(Request $request, $id)
    {
        // if ($request->op == 1) {
        $venta = venta::find($id);
        $venta->fill($request->all());
        $venta->save();
        // }else{
        //     $tr = tr::find($id);
        //     $tr->fill($request->all());
        //     $tr->save();    
        // }
        return redirect::back();   
    }

    public function estatus(Request $request, $id)
    {
        $venta = venta::find($id);
        $venta->fill($request->all());
        $venta->save();
        return redirect::back();
    }

    public function estatusTransaccion(Request $request, $id)
    {
        $tr = tr::find($id);
        $tr->fill($request->all());
        $tr->save();

        $venta = venta::find($request->venta_id);
        $venta->fill($request->all());
        $venta->save();    
        return redirect::back();   
    }

    public function ExportarVenta(){
         return Excel::download(new VentasExport, 'ventas.xlsx');
    }

    public function ExportarVentaWebPay(){
         return Excel::download(new VentasExportWebpay, 'ventas_webpay.xlsx');
    }

    public function destroy($id)
    {
        $venta = venta::find($id);
        $venta->historial = 1;
        $venta->save();
        return redirect::back();
    }

    public function despachoElegido($id)
    {
        $despacho = Despacho::where('bk_comunas_id',$id)->first();
        return response()->json($despacho);
    }

    public function createVentaCorta(Request $request){
        // dd($request);
        do {
            $codigo_random = 'VSP'.rand(100000, 999999);
            $venta_count = venta::where('codigo',$codigo_random)->count();
        }while ($venta_count != 0);

        $venta_fuera = new VentaFuera($request->all());
        if ($request->direccion_detalle != null) {
            $venta_fuera->direccion = $request->direccion;
            $venta_fuera->detalle = $request->detalle;
        }
        $venta_fuera->save();
        $producto = Producto::find(19);
        $despacho = Despacho::where('bk_comunas_id',$venta_fuera->bk_comunas_id)->first();

        $venta = new venta();
        $venta->td_productos_id = $producto->id;
        $venta->cantidad = $request->cantidad;
        $venta->tipo_venta_id = $request->tipo_venta_id;
        $venta->ventas_fuera_id = $venta_fuera->id;
        $venta->total = $producto->precio*$request->cantidad;
        $venta->tipo_pago = $request->tipo_pago;
        $venta->bk_despacho_id = $despacho->id;
        $venta->despacho_valor = $despacho->costo;
        $venta->bk_estatus_id = 4;
        $venta->estado = $request->estado;
        $venta->codigo = $codigo_random;
        $venta->save();
        return redirect::back();

    }


}
