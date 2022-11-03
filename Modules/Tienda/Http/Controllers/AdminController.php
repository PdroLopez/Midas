<?php

namespace Modules\Tienda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Tienda\Entities\Producto as producto;
use Modules\Tienda\Entities\Comentarios as comentario;
use Modules\Tienda\Entities\Banner as banner;
use Modules\Tienda\Entities\Intro as intro;
use Modules\Tienda\Entities\Categorias as categorias;
use Modules\Tienda\Entities\Marca as marca;
use Modules\Tienda\Entities\Transaccion;
use Modules\Tienda\Entities\Ventas as ventas;
use Modules\Tienda\Entities\Descuentos as descuentos;
use Modules\Backend\Entities\Estatus as estatus;
use Modules\Tienda\Entities\Mensaje as msj;
use Barryvdh\DomPDF\Facade as PDF;
use Modules\Tienda\Entities\VentaTransaccion as ventaTransaccion;
use Modules\Login\Entities\Region;
use Modules\Tienda\Entities\TipoVenta;
use Auth;
use Session;
use URL;

class AdminController extends Controller
{
    public function index()
    {
        $ventas = ventas::where('historial',0)->orderBy('id','DESC')->get();
        $estatus = estatus::pluck('nombre','id');
        $producto = producto::find(19);
        $region = Region::all();
        $tipo_venta = TipoVenta::all();
        return view('tienda::Admin.index',compact('ventas','estatus','producto','region','tipo_venta'));
    }
    public function producto()
    {
        $url_usar = url('/');
        $descuentos = descuentos::all();
        $marcas = marca::all();
        $categorias = categorias::all();
        $productos = producto::orderBy('id','asc')->get();
        return view('tienda::Admin.productos',compact('productos','marcas','categorias','descuentos','url_usar'));
    }
    public function productoDescuentos($id)
    {
        $ax = producto::find($id);
        $producto_valor = $ax->precio;
        // dd($producto_valor);
        $descuentos = descuentos::where('td_productos_id',$id)->get();
        $producto = producto::where('id',$id)->first();
        $productos = producto::pluck('nombre','id');
        return view('tienda::Admin.descuentos.index',compact('producto','descuentos','productos','producto_valor'));
    }


    public function categoria()
    {
        $categorias = Categorias::all();
        return view('tienda::Admin.categorias',compact('categorias'));
    }

    public function descuentos()
    {
        $descuentos = descuentos::all();
        return view('tienda::Admin.descuentos',compact('descuentos'));
    }
    public function marcas()
    {
        $marcas = marca::all();
        return view('tienda::Admin.marcas',compact('marcas'));
    }
    public function marcas_tienda()
    {
        $marcas = marca::all();
        return view('tienda::Admin.marcas',compact('marcas'));
    }
    public function portal()
    {
        return view('tienda::Admin.portal');
    }
    public function pagos()
    {
        return view('tienda::Admin.pagos');
    }
    public function banner()
    {
        $banner = banner::all();
        return view('tienda::Admin.banners',compact('banner'));
    }
    public function intro()
    {
        $intro = intro::all();
        return view('tienda::Admin.intro',compact('intro'));
    }
    public function ver_mas($id)
    {
        $comentario = comentario::findOrFail($id);


        $comentario->baja  = 1;
        $comentario->save();

        Session::flash('mensaje',['content'=>'Funcion realizada  con exito','type'=>'primary']);
        return redirect::back();

    }
    public function mensaje()
    {
        $mensaje = msj::all();
        return view('tienda::Admin.mensaje',compact('mensaje'));
    }
    public function review()
    {
        $producto = comentario::where('users_id',Auth::user()->id)->get();
        return view('tienda::Admin.reviews',compact('producto'));
    }
    public function publicar($id)
    {
        producto::find($id)->update([
            'bk_estados_id' => 12
        ]);
        return back();
    }
    public function desactivar($id)
    {
        producto::find($id)->update([
            'bk_estados_id' => 13
        ]);
        return back();
    }

    public function transpdf($id)
    {
        $transaccion = Transaccion::find($id);
        $ventas = ventaTransaccion::where('transacciones_id',$transaccion->id)->get();    
        $codigo = $transaccion->codigo;
            
        $pdf = PDF::loadview('tienda::Public.venta.exito_pdf_nuevo',compact('transaccion','ventas','codigo'));
        $pdf->setPaper(array(0, 0, 283.465, 850.394), 'portrait');
        return $pdf->download($codigo.'.pdf');
    }

    public function ventapdf($id)
    {
        $venta =  ventas::find($id);
        $codigo = $venta->codigo;
            
        $pdf = PDF::loadview('tienda::Public.venta.exito_pdf_sp',compact('venta','codigo'));
        $pdf->setPaper(array(0, 0, 283.465, 850.394), 'portrait');
        return $pdf->download($codigo.'.pdf');
    } 

}
