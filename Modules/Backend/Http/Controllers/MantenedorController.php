<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\Certificados as certificados;
use Modules\Backend\Entities\Comunas as comunas;
use Modules\Backend\Entities\Regiones as regiones;
use Modules\Backend\Entities\Comunidad as comunidad;
use Modules\Backend\Entities\TipoComunidad as tipo_comunidad;
use Modules\Backend\Entities\DireccionEmpresa as direccion_empresa;
use Modules\Backend\Entities\DireccionUser as direccion_user;
use Modules\Backend\Entities\Estados as estados;
use App\User as users;
use App\Camiones as camiones;
use Modules\Workflow\Entities\Boleta;
use Modules\Tienda\Entities\Transaccion;
use Modules\Backend\Entities\Pais as pais;
use Modules\Backend\Entities\ServiciosHome as servicio;
use Modules\Backend\Entities\TipoCamion;
use Modules\Backend\Entities\Recurso as recursos;
use Modules\Backend\Entities\TipoComunidad as tipo_comunidades;
use Modules\Backend\Entities\Programacion as programacion;
use Modules\Workflow\Entities\Marcas as marcas;
use App\Empresa as empresa;
use Modules\Backend\Entities\Cobertura as cobertura;
use Modules\Backend\Entities\Despacho as despacho;
use Modules\Backend\Entities\Combo as combo;
use Modules\Backend\Entities\ComboResiduo as combos_residuos;
use Modules\Backend\Entities\TipoProducto as tipo_producto;
use Modules\Backend\Entities\TipoServicio as tipo_servicio;
use Modules\Backend\Entities\Destino as destino;
use Modules\Backend\Entities\SubCategoria as subcategoria;
use Modules\Workflow\Entities\Clasificacion as clasificacion;
use App\Residuo as residuos;


class MantenedorController extends Controller
{
    public function certificaciones()
    {
        $certificado = certificados::all();
        return view('backend::private.certificaciones.index',compact('certificado'));
    }

    public function servicioshome()
    {
        $servicio = servicio::all();
        return view('backend::private.servicios_home.index',compact('servicio'));
    }
    public function comunas()
    {

        $comuna = comunas::all();
        $region = regiones::pluck('nombre','id');
        $regiones = regiones::pluck('nombre','id');
        return view('backend::private.comunas.index',compact('comuna','region','regiones'));

    }

    public function comunidades()
    {


        $comunidad = comunidad::all();
        $tipo_comunidad = tipo_comunidad::pluck('nombre','id');
        return view('backend::private.comunidades.index',compact('comunidad','tipo_comunidad'));

    }

    public function direccion_empresas()
    {
        $empresa = empresa::pluck('nombre','id');
        $direccion_empresa = direccion_empresa::all();
        return view('backend::private.direccion_empresas.index',compact('direccion_empresa','empresa'));
    }

    public function direccion_users()
    {
        $region = regiones::all();
        $direccion_user = direccion_user::all();
        return view('backend::private.direccion_users.index',compact('direccion_user','region'));
    }
    public function estados()
    {
        $estado = estados::all();
        return view('backend::private.estados.index',compact('estado'));
    }

    public function pais()
    {
        $pais = pais::all();
        $region = regiones::pluck('nombre','id');
        return view('backend::private.pais.index',compact('pais','region'));
    }
    public function SelectComunas($id)
    {
        return Comunas::where('bk_regiones_id',$id)->get();
    }
    public function marcas()
    {

        $marcas = marcas::all();
        $estado = estados::wherein('id',[22,23])->pluck('nombre','id');
        $prueba = estados::wherein('id',[22,23])->get();
        return view('backend::private.marcas.index',compact('marcas','estado','prueba'));
    }

    public function programacion()
    {
        $chofer = users::where('roles_id',12)->pluck('id');
        $choferes = users::where('roles_id',12)->pluck('name', 'id');
        $vehiculo = camiones::pluck('patente','id');
        $tipo_camiones = TipoCamion::all();

        $boleta = boleta::where('bk_estados_id',19)->where('camionero_id',$chofer)->get();

       $programacion = programacion::all();
       $total = Boleta::where('bk_estados_id',1)->get();
       $boletas = Boleta::wherein('bk_estados_id',[26,27,21,9])->orderBy('id','DESC')->paginate(5);
       $enproceso = Boleta::where('bk_estados_id',[9,26])->get();
       $aceptado = Boleta::where('bk_estados_id',8)->get();
       $cancelado = Boleta::where('bk_estados_id',17)->get();
       $terminado = Boleta::where('bk_estados_id',2)->get();
       $transaccion = Transaccion::orderBy('id','DESC')->get();

       return view('backend::private.programacion.index',compact('transaccion','choferes','vehiculo','boletas','total','enproceso','aceptado','cancelado','terminado','tipo_camiones'));
    }
    public function chofer()
    {
        $chofer = users::where('roles_id',12)->pluck('id');
        $boleta = boleta::where('camionero_id',$chofer)->get();


        return view('backend::private.carga',compact('boleta'));
    }
    public function recursos()
    {
        $recurso = recursos::all();
        return view('backend::private.recursos.index',compact('recurso'));
    }
    public function regiones()
    {
        $region = regiones::all();
        return view('backend::private.regiones.index',compact('region'));
    }
    public function tipo_comunidades()
    {
        $tipo_comunidad = tipo_comunidades::all();
        return view('backend::private.tipo_comunidades.index',compact('tipo_comunidad'));
    }

    public function despacho()
    {
        $despachos = despacho::all();
        $regiones = regiones::pluck('nombre','id');
        $coberturas = cobertura::pluck('nombre','id');
        return view('backend::private.despacho.index',compact('despachos','regiones','coberturas'));
    }

    public function cobertura()
    {
        $coberturas = cobertura::all();
        return view('backend::private.cobertura.index',compact('coberturas'));
    }

    public function residuos()
    {
        $residuos = residuos::all();
        return view('backend::private.residuos.index',compact('residuos'));
    }

    public function combo()
    {
        $combos = combo::all();
        return view('backend::private.combo.index',compact('combos'));
    }

    public function comboresiduos($id)
    {
        $combo = combo::find($id);
        $combos_residuos = combos_residuos::where('combos_id',$combo->id)->get();
        $residuos = residuos::pluck('nombre','id');
        return view('backend::private.combo_residuo.index',compact('combos_residuos','combo','residuos'));
    }

    public function tipo_producto()
    {
        $tipo_productos = tipo_producto::all();
        return view('backend::private.tipo_producto.index',compact('tipo_productos'));
    }

    public function tipo_servicio()
    {
        $tipo_servicios = tipo_servicio::all();
        return view('backend::private.tipo_servicio.index',compact('tipo_servicios'));
    }

    public function destino()
    {
        $destinos = destino::all();
        return view('backend::private.destino.index',compact('destinos'));
    }

    public function subcategoria()
    {
        $subcategorias = subcategoria::all();
        $clasificacion = clasificacion::pluck('nombre','id');
        return view('backend::private.subcategoria.index',compact('subcategorias','clasificacion'));
    }
    

}
