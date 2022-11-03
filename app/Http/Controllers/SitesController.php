<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Modules\Tienda\Entities\Transaccion;
use Carbon\Carbon;
use Modules\Workflow\Entities\Solicitud as solicitud;
use App\ImagenSolicitud as imagen;
use Modules\Contenido\Entities\Noticia as noticia;
use Modules\Contenido\Entities\Imagen as imagenNoticia;
use App\Residuo as residuo;
use App\Acceso as acceso;
use App\EmpresaUsuario as empresa_usuario;
use App\ImagenAcceso as img_acceso;
use App\Horario as horario;
use App\HorarioDia as hr_dia;
use Modules\Workflow\Entities\BoletaSolicitud;
use Modules\Workflow\Entities\Boleta;
use Modules\Login\Entities\Region;
use Modules\Login\Entities\Comuna;
use Modules\Backend\Entities\DireccionEmpresa;
use App\DireccionUsuario;
use Modules\Workflow\Entities\Grupo;
use Modules\Contenido\Entities\ImagenSlider;
use Modules\Tienda\Entities\Banner as banner;
use Modules\Backend\Entities\Camion;
use Modules\Workflow\Entities\GrupoClasificacion;
use Modules\Workflow\Entities\Clasificacion;
use App\Empresa;
use App\EmpresaUsuario;
use Modules\Backend\Entities\Comunidad as comunidades;
use Modules\Backend\Entities\TipoComunidad as tipo;
use Storage;
use App\ImagenAcceso;
use Modules\Workflow\Entities\Marcas;
use App\Retiro;
use Barryvdh\DomPDF\Facade as PDF;
use Log;
use Modules\Backend\Entities\ServiciosHome;
use Modules\Tienda\Entities\Producto as producto;
use Modules\Tienda\Entities\Ventas as venta;
use Modules\Tienda\Entities\VentaTransaccion as ventaTransaccion;


class SitesController extends Controller
{
    public function index(){

        $img = ImagenSlider::where('ct_categoria_slider_id',3)->get();
        $servicios_home = ServiciosHome::orderBy('peso','asc')->get();
        return view('welcome',compact('img','servicios_home'));
    }

    public function faq()
    {
        return view('faq');
    }
    public function certificados_empresa()
    {
        $boleta = Boleta::where('bk_estados_id',2)->get();
        return view('certificados',compact('boleta'));

    }
    public function descargar_pdf($id)
    {
        $boleta = Boleta::where('id',$id)->get();
        $pdf = PDF::loadview('pdf',compact('boleta'));

        $documento = Boleta::find($id);

        return $pdf->download($documento->empresas->nombre.'.pdf');
    }

    public function comunidades(){
       $comunidades = comunidades::all();
        $img = ImagenSlider::where('ct_categoria_slider_id',5)->OrderBy('id','DESC')->get();
        $banner =banner::find(12);
        return view('comunidades',compact('comunidades','img','banner'));
    }
    public function reporteria_empresa()
    {
        return view('reporteria_empresa');
    }

    public function editar_ob($id)
    {
        return "a";
    }

    public function mis_direcciones($id)
    {
        $region = Region::pluck('nombre','id');
        $comuna = Comuna::pluck('nombre','id');
        $direccion = DireccionUsuario::where('users_id',$id)->where('activo',1)->get();

        return view('direccion.index', compact('direccion','region','comuna'));

    }

    public function quitar($id)
    {
        $direccion = DireccionUsuario::find($id);
        $direccion->activo = 0;
        $direccion->save();
        return redirect::back();
    }
    public function direccionEdit($id)
    {
        $direcciones = DireccionUsuario::find($id);
        $region = Region::pluck('nombre','id');
        $comuna = Comuna::where('bk_regiones_id',$direcciones->bk_regiones_id)->pluck('nombre','id');
        return view('direccion.edit',compact('direcciones','region','comuna'));


    }
    public function mis_comunidades($id)
    {
        $comunidad = comunidades::where('users_id',$id)->get();
        return view('mis_comunidades.index',compact('comunidad'));
    }

    public function educacion(){
        $banner =banner::find(8);
        return view('educacion',compact('banner'));
    }

    public function noticias(){
        $banner =banner::find(12);
        return view('noticias',compact('banner'));
    }

    public function noticia_single($slug){
        $noticia = noticia::where('slug',$slug)->first();
        $imagen = imagenNoticia::where('ct_noticias_id',$noticia->id)->first();
        return view('single-noticias',compact('noticia','imagen'));
    }

    public function empresa(){
        return view('midas');
    }

    public function paso_1(){
        $tipo = tipo::all();
        return view('comunidades.paso-1',compact('tipo'));
    }

    public function paso_2(){
        return view('comunidades.paso-2');
    }

    public function paso_3(){
        return view('comunidades.paso-3');
    }

    public function paso_4($nombre){
       $tipo = $nombre;
       $t_comunidad = tipo::pluck('nombre','id');

       return view('comunidades.paso-4',compact('tipo','t_comunidad'));
    }

    public function agregar(Request $request)
    {
        try {
            $comunidad = new comunidades($request->all());
            if ($request->hasfile('foto')) {
                $file= $request->file('foto');
                $extension = $file->getClientOriginalExtension();
                $filename= time() . '.' .$extension;
                $file->move('public/comunidades/',$filename);
                $comunidad->foto = $filename;
            }
            else
            {
                return $request;
                $comunidad->foto = '';
            }
            $comunidad->save();

            Session::flash('mensaje',['content'=>'Comunidad  realizada  correctamente','type'=>'primary']);
            return redirect('comunidades');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }

    }
    ////////////////////////////////////////////////
    //SOLICITUD DE RETIRO

    public function solicitud_paso_1(){
        $imagen = imagen::all();
        $img_acceso = img_acceso::all();
        return view('solicitudes.paso-1',compact('imagen','img_acceso'));
    }

    public function agregar_producto(){
        $residuo = residuo::all();
        return view('solicitudes.agregar-producto',compact('residuo'));
    }

    public function post_agregar_producto(Request $request)
    {
        try {
            $residuo = residuo::find($request->producto);
            if (Session::has('cod')) {

            }else{
                $codigo = time();
                Session::put('cod',$codigo);
            }
            $soli = solicitud::create([
                'Residuos_id'=> $request->producto,
                'peso' => $request->peso,
                'cantidad' => 1,
                'altura'=> $request->altura,
                'largo'=> $request->largo,
                'profundidad' => $request->profundo,
                'motivo'=> $request->motivo,
                'precio'=>$residuo->precio
            ]);
            $total = $residuo->precio;
            if (Session::has('intento_carro')) {
                $session = Session::get('intento_carro');
                $array = array(
                    'id'=>$soli->id,
                    'producto'=> $residuo->nombre,
                    'peso'=> $request->peso,
                    'altura'=> $request->altura,
                    'largo'=> $request->largo,
                    'profundo'=> $request->profundo,
                    'motivo'=> $request->motivo,
                    'cantidad'=> 1,
                    'precio'=>$residuo->precio,
                    'codigo'=>Session::get('cod'),
                    'users_id'=>Auth::user()->id
                );
                array_push($session, $array);
                Session::put('intento_carro',$session);
            }else{
                $prueba = array(0=>[
                    'id'=>$soli->id,
                    'producto'=> $residuo->nombre,
                    'peso'=> $request->peso,
                    'altura'=> $request->altura,
                    'largo'=> $request->largo,
                    'profundo'=> $request->profundo,
                    'motivo'=> $request->motivo,
                    'cantidad'=> 1,
                    'precio'=>$residuo->precio,
                    'codigo'=>Session::get('cod'),
                    'users_id'=>Auth::user()->id
                    ]
                );
                Session::put('intento_carro',$prueba);
            }

            if(Session::has('id_img')){
                $img = imagen::whereIn('id',Session::get('id_img'))->get();
                foreach ($img as $value) {
                    imagen::find($value->id)->update([
                        'sl_solicitudes_id'=>$soli->id
                    ]);
                }
                Session::forget('id_img');
            }

            if (Session::has('total')) {
                $array_total = Session::get('total');
                $total = $array_total + $total;
                Session::put('total',$total);
            }else{
                $total += 20000;
                Session::put('total',$total);
            }
            Session::flash('mensaje',['content'=>'Producto Agregado','type'=>'primary']);
            return Redirect::action('SitesController@solicitud_paso_1');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return Redirect::action('SitesController@solicitud_paso_1');
        }
    }

    public function solicitud_paso_2(){
        if (Session::has('acceso_carro')) {
            $imagen = imagen::all();
            return view('solicitudes.paso-2',compact('imagen'));
        }else{
            Session::flash('mensaje',['content'=>'Recuerde agregar los accesos, estan a un lado de producto','type'=>'danger']);
            return Redirect::action('SitesController@solicitud_paso_1');
        }
    }

    public function solicitud_paso_3(){
        $horario = horario::all();
        $hr_dia = hr_dia::all();
        $region = Region::all();
        return view('solicitudes.paso-3',compact('hr_dia','horario','region'));
    }

    public function solicitud_paso_4(Request $request){

        if ($request->direccionUser == null) {
            $direccion = $request->direccion;
            $region = Region::find($request->regiones);
            $comuna = Comuna::find($request->comunas);
            Session::put('direccion',$direccion);
            Session::put('region',$region->nombre);
            Session::put('comuna',$comuna->nombre);
            Session::put('region_id',$region->id);
            Session::put('comuna_id',$comuna->id);
        }else{
            $direccionUsuario = DireccionUsuario::find($request->direccionUser);
            $direccion = $direccionUsuario->nombre;
            $region = Region::find($direccionUsuario->bk_regiones_id);
            $comuna = Comuna::find($direccionUsuario->bk_comunas_id);
            Session::put('direccion_id',$direccionUsuario->id);
            Session::put('direccion',$direccion);
            Session::put('region',$region->nombre);
            Session::put('comuna',$comuna->nombre);
            Session::put('region_id',$region->id);
            Session::put('comuna_id',$comuna->id);
        }

        $horario = horario::find($request->tiporetiro);
        $hr_dia = hr_dia::find($request->horario);
        $total = $horario->precio;
        if (Session::has('total')) {
            $array_total = Session::get('total');
            $total = $array_total + $total;
            Session::put('total',$total);
        }
        if (Session::has('intento_carro')) {
            foreach (Session::get('intento_carro') as $value) {
                solicitud::find($value['id'])->update([
                    'precio' => Session::get('total')
                ]);
            }
        }
        if (Session::has('hor') && Session::has('dia')) {

        }else{
            Session::put('hor',$horario);
            Session::put('dia',$hr_dia);
        }
        return view('solicitudes.paso-4',compact('horario','hr_dia','direccion','region','comuna'));
    }

    public function solicitud_exitosa(){

        return view('solicitudes.exito');
    }

    public function solicitud_cancelado()
    {
        try {
            if (Session::has('intento_carro')) {
                foreach (Session::get('intento_carro') as $carro) {
                    $dato = imagen::where('sl_solicitudes_id',$carro['id'])->get();
                    if ($dato) {
                        foreach ($dato as $value) {
                            unlink('public/img/solicitudes/'.$value->archivo);
                            imagen::find($value->id)->delete();
                        }
                    }
                    solicitud::find($carro['id'])->delete();
                }
                Session::forget('intento_carro');
            }
            if(Session::has('acceso_carro')){
                foreach (Session::get('acceso_carro') as $acceso) {
                    $img_acceso = img_acceso::where('accesos_id',$acceso['id'])->get();
                    if($img_acceso){
                        foreach ($img_acceso as $value_carro) {
                            unlink('public/img/accesos/'.$value_carro->archivo);
                            img_acceso::find($value_carro->id)->delete();
                        }
                    }
                    acceso::find($acceso['id'])->delete();
                }
                Session::forget('acceso_carro');
            }
            if (Session::has('total')) {
                Session::forget('total');
            }
            if (Session::has('cod')) {
                Session::forget('cod');
            }
            Session::flash('mensaje',['content'=>'Solicitud cancelada','type'=>'primary']);
            return Redirect::action('SitesController@index');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return Redirect::action('SitesController@index');
        }
    }
    public function finalizar_pago()
    {
        try {
            if (Session::has('direccion_id')) {
                $boleta = Boleta::create([
                    'total'=> Session::get('total'),
                    'codigo'=>Session::get('cod'),
                    'bk_estados_id'=>1,
                    'users_id'=>Auth::user()->id,
                    'horarios_id'=>Session::get('hor')['id'],
                    'horarios_dias_id'=>Session::get('dia')['id'],
                    'bk_direcciones_user_id' => Session::get('direccion_id'),
                    'creador_id'=>Auth::user()->id
                ]);
            }else{
                $dir = DireccionUsuario::create([
                    'nombre'=> Session::get('direccion'),
                    'users_id' => Auth::user()->id,
                    'bk_comunas_id'=>Session::get('comuna_id'),
                    'bk_regiones_id'=> Session::get('region_id')
                ]);

                $boleta = Boleta::create([
                    'total'=> Session::get('total'),
                    'codigo'=>Session::get('cod'),
                    'bk_estados_id'=>1,
                    'users_id'=>Auth::user()->id,
                    'horarios_id'=>Session::get('hor')['id'],
                    'horarios_dias_id'=>Session::get('dia')['id'],
                    'bk_direcciones_user_id' => $dir->id,
                    'creador_id'=>Auth::user()->id
                ]);
            }

            if (Session::has('intento_carro')) {
                foreach (Session::get('intento_carro') as $value) {
                    BoletaSolicitud::create([
                        'sl_solicitudes_id'=> $value['id'],
                        'boletas_id'=>$boleta->id
                    ]);
                }
            }
            if (Session::has('intento_carro')) {
                Session::forget('intento_carro');
            }
            if (Session::has('total')) {
                Session::forget('total');
            }
            if (Session::has('hor')) {
                Session::forget('hor');
            }
            if (Session::has('dia')) {
                Session::forget('dia');
            }
            if (Session::has('cod')) {
                Session::forget('cod');
            }
            if (Session::has('acceso_carro')) {
                Session::forget('acceso_carro');
            }
            if (Session::has('direccion_id')) {
                Session::forget('direccion_id');
            }
            if (Session::has('direccion')) {
                Session::forget('direccion');
            }
            if (Session::has('comuna')) {
                Session::forget('comuna');
            }
            if (Session::has('comuna_id')) {
                Session::forget('comuna_id');
            }
            if (Session::has('region_id')) {
                Session::forget('region_id');
            }
            if (Session::has('region')) {
                Session::forget('region');
            }
            Session::flash('mensaje',['content'=>'Solicitud agregada con exito','type'=>'primary']);
            return redirect('/');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect('/');
        }
    }
    public function eliminar_producto($arrayKey)
    {

        try {
            if (Session::has('intento_carro')) {
                if (count(Session::get('intento_carro'))>1) {
                    $array = Session::get('intento_carro');
                    foreach ($array as $key => $value) {
                        if ($key == $arrayKey) {
                            $dato = imagen::where('sl_solicitudes_id',$value['id'])->get();
                            if ($dato) {
                                foreach ($dato as $imagen) {
                                    unlink('public/img/solicitudes/'.$imagen->archivo);
                                    imagen::find($imagen->id)->delete();
                                }
                            }
                            //quitar del total
                            $array_total = Session::get('total');
                            $total = $array_total - $value['precio'];
                            Session::put('total',$total);
                            //borrar del array
                            unset($array[$arrayKey]);
                            Session::put('intento_carro', $array);
                            solicitud::find($value['id'])->delete();
                        }
                    }
                }else if(count(Session::get('intento_carro'))==1){
                    $array = Session::get('intento_carro');
                    foreach ($array as $key => $value) {
                        if ($key == $arrayKey) {
                            $dato = imagen::where('sl_solicitudes_id',$value['id'])->get();
                            if ($dato) {
                                foreach ($dato as $imagen) {
                                    unlink('public/img/solicitudes/'.$imagen->archivo);
                                    imagen::find($imagen->id)->delete();
                                }
                            }
                            //quitar del total
                            Session::forget('total');
                            //borrar del array
                            unset($array[$arrayKey]);
                            Session::put('intento_carro', $array);
                            solicitud::find($value['id'])->delete();
                        }
                    }
                    if(Session::has('acceso_carro')){
                        foreach (Session::get('acceso_carro') as $acceso) {
                            $img_acceso = img_acceso::where('accesos_id',$acceso['id'])->get();
                            if($img_acceso){
                                foreach ($img_acceso as $value_carro) {
                                    unlink('public/img/accesos/'.$value_carro->archivo);
                                    img_acceso::find($value_carro->id)->delete();
                                }
                            }
                            acceso::find($acceso['id'])->delete();
                        }
                        Session::forget('acceso_carro');
                    }
                    Session::forget('intento_carro');
                }
            }
            Session::flash('mensaje',['content'=>'Producto eliminado','type'=>'primary']);
            return back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return back();
        }
    }
    public function eliminar_acceso($arrayKey)
    {
        try {
            if (Session::has('intento_carro')) {
                foreach (Session::get('intento_carro') as $carro) {
                    solicitud::find($carro['id'])->update([
                        'accesos_id' => null
                    ]);
                }
            }
            if(Session::has('acceso_carro')){
                if (count(Session::get('acceso_carro'))==1) {
                    $array = Session::get('acceso_carro');
                    foreach ($array as $key => $value) {
                        if ($key == $arrayKey) {
                            $dato = img_acceso::where('accesos_id',$value['id'])->get();
                            if ($dato) {
                                foreach ($dato as $imagen) {
                                    unlink('public/img/accesos/'.$imagen->archivo);
                                    img_acceso::find($imagen->id)->delete();
                                }
                            }
                            unset($array[$arrayKey]);
                            Session::put('acceso_carro', $array);
                            acceso::find($value['id'])->delete();
                        }
                    }
                    Session::forget('acceso_carro');

                }
            }
            Session::flash('mensaje',['content'=>'Acceso eliminado','type'=>'primary']);
            return back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return back();
        }
    }
    /////////////////////////////////
    //CHOFER
    public function chofer_home(){
        $retiros = Boleta::where('camionero_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);

        return view('private.chofer.home',compact('retiros','planta'));
    }

    public function detalle($id){
        $boleta = Boleta::find($id);
        $imagen = imagen::all();
        return view('private.chofer.detalle',compact('boleta','imagen'));
    }

    public function recibido($id)
    {
        try {
            $boleta = Boleta::find($id)->update([
                'bk_estados_id'=>20
            ]);
            Session::flash('mensaje',['content'=>'Solicitud recibida','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }

    public function retirado(Request $request, $id)
    {
        try {
            if ($request->hasFile('foto')) {
                $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $random = substr(str_shuffle($permit),0,25);
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($request->foto->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $ruta_archivo = 'retirado/'.$random.'/';
                $ruta = Storage::putFileAs($ruta_archivo,$request->file('foto'),$nombre);

                $ret = Retiro::create([
                    'archivo'=>$ruta_archivo.''.$nombre,
                    'boletas_id'=>$id,
                    'camionero_id'=>Auth::user()->id
                ]);
            }else{
                $ret = Retiro::create([
                    'boletas_id'=>$id,
                    'camionero_id'=>Auth::user()->id
                ]);
            }
            $boleta = Boleta::find($id)->update([
                'bk_estados_id'=>21,
                'observacion_retirado'=>$request->observacion_retirado
            ]);
            Session::flash('mensaje',['content'=>'Productos Retirados','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();

        }
    }

    public function cancelado(Request $request, $id)
    {
        try {
            $boleta = Boleta::find($id)->update([
                'comentario_cancelar'=> $request->comentario_cancelar,
                'bk_estados_id'=>17
            ]);
            Session::flash('mensaje',['content'=>'Solicitud cancelada','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }

    }

    public function detalle_producto($id){
        $solicitud = solicitud::find($id);
        return view('private.chofer.detalle-producto',compact('solicitud'));
    }

    public function dropzone(Request $request)
    {
        if($request->file('file')){

            $imagen = $request->file('file');

            $imgName = time().'.'.$imagen->getClientOriginalExtension();
            $imagen->move('public/img/solicitudes/',$imgName);
            $id = imagen::create([
                'archivo'=> $imgName,
                'url' => 'public/img/solicitudes/'
            ]);

            if (Session::has('id_img')) {
                $array = Session::get('id_img');
                array_push($array,$id->id);
                Session::put('id_img', array_unique($array));
            }
            else{
                Session::put('id_img',array($id->id));
            }
            return response()->json("Exito");

        }
            return response()->json("fallo");

    }

    /////////////////////////////////////////
    //ACCESO
    public function agregar_acceso(){
        return view('solicitudes.agregar-acceso');
    }

    public function img_acceso(Request $request)
    {
        if($request->file('file')){

            $imagen = $request->file('file');

            $imgName = time().'.'.$imagen->getClientOriginalExtension();
            $imagen->move('public/img/accesos/',$imgName);
            $id = img_acceso::create([
                'archivo'=> $imgName,
                'url' => 'public/img/accesos/'
            ]);

            if (Session::has('id_img_acc')) {
                $array = Session::get('id_img_acc');
                array_push($array,$id->id);
                Session::put('id_img_acc', array_unique($array));
            }
            else{
                Session::put('id_img_acc',array($id->id));
            }
            return response()->json("Exito");

        }
            return response()->json("fallo");
    }

    public function post_agregar_acceso(Request $request)
    {
        try {
            $acceso = acceso::create([
                'comentario'=> $request->motivo
            ]);

            if (Session::has('acceso_carro')) {
                $session = Session::get('acceso_carro');
                $array = array(
                    'id'=>$acceso->id,
                    'comentario'=> $request->motivo
                );
                array_push($session, $array);
                Session::put('acceso_carro',$session);
            }else{
                $prueba = array(0=>[
                    'id'=>$acceso->id,
                    'comentario'=> $request->motivo
                    ]
                );
                Session::put('acceso_carro',$prueba);
            }

            if(Session::has('id_img_acc')){
                $img = img_acceso::whereIn('id',Session::get('id_img_acc'))->get();
                foreach ($img as $value) {
                    img_acceso::find($value->id)->update([
                        'accesos_id'=>$acceso->id
                    ]);
                }
                Session::forget('id_img_acc');
            }

            if(Session::has('intento_carro')){
                $soli = solicitud::whereIn('id',Session::get('intento_carro'))->get();
                foreach ($soli as $value) {
                    solicitud::find($value->id)->update([
                        'accesos_id'=>$acceso->id
                    ]);
                }
            }
            Session::flash('mensaje',['content'=>'Acceso Agregado','type'=>'primary']);
            return Redirect::action('SitesController@solicitud_paso_1');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return Redirect::action('SitesController@solicitud_paso_1');
        }
    }

    ///////////////////////////////////////////////////////
    //Retiro Industrial
    public function retiro_industrial_1(){
        return view('solicitudes-industriales.paso-1');
    }

    public function retiro_industrial_2(){
        $empresas = Empresa::all();
        return view('solicitudes-industriales.paso-2',compact('empresas'));
    }

    public function retiro_industrial_3(Request $request){
        //dd($request->retiro);
        $codigo = time();
        if ($request->empresa != null) {
            $empresa = Empresa::where('id',$request->empresa)->first();
            $marca = Marcas::where('id',$request->marca)->first();
            Session::put('empresa',$empresa->nombre);
            Session::put('marca',$marca->nombre);
            $boleta = Boleta::create([
                'codigo'=>$codigo,
                'bk_estados_id'=>1,
                'retiro_propio' =>$request->retiro,
                'empresas_id'=>$empresa->id
            ]);
        }else{
            $boleta = Boleta::create([
                'codigo'=>$codigo,
                'bk_estados_id'=>1,
                'retiro_propio' =>$request->retiro,
                'empresas_id'=>Auth::user()->empresa_user->first()->empresas_id
            ]);
        }

        if (Session::has('industrial_carro')) {
            foreach (Session::get('industrial_carro') as $value) {
                BoletaSolicitud::create([
                    'sl_solicitudes_id'=> $value['id'],
                    'boletas_id'=>$boleta->id
                ]);
            }
        }
        Session::put('codigo_industrial',$codigo);
        return view('solicitudes-industriales.paso-3');
    }

    public function retiro_industrial_exito(){
        return view('solicitudes-industriales.exito');
    }
    public function finalizar_solicitud_industrial()
    {
        if (Session::has('industrial_carro')) {
            Session::forget('industrial_carro');
        }
        if (Session::has('empresa')) {
            Session::forget('empresa');
        }
        if (Session::has('marca')) {
            Session::forget('marca');
        }
        if (Session::has('codigo_industrial')) {
            Session::forget('codigo_industrial');
        }
        Session::flash('mensaje',['content'=>'Solicitud industrial exitosa','type'=>'primary']);
        return redirect::to('/');
    }

    public function retiro_industrial_error(){

        if (Session::has('industrial_carro')) {
            foreach (Session::get('industrial_carro') as $value) {
                $boleta_solicitud = BoletaSolicitud::where('sl_solicitudes_id',$value['id'])->get();
                if (count($boleta_solicitud)>0) {
                    foreach($boleta_solicitud as $boleta){
                        BoletaSolicitud::find($boleta->id)->delete();
                        Boleta::find($boleta->boletas_id)->delete();
                    }
                }
                solicitud::find($value['id'])->delete();
            }
                Session::forget('industrial_carro');
        }
        return view('solicitudes-industriales.error');
    }

    public function agregar_productos_industriales(){
        $residuo = residuo::all();
        $grupo = Grupo::all();
        return view('solicitudes-industriales.agregar-producto',compact('residuo','grupo'));
    }
    public function dropzone_industria(Request $request)
    {
        if($request->file('file')){

            $imagen = $request->file('file');

            $imgName = time().'.'.$imagen->getClientOriginalExtension();
            $imagen->move('public/img/solicitudes/',$imgName);
            $id = imagen::create([
                'archivo'=> $imgName,
                'url' => 'public/img/solicitudes/'
            ]);

            if (Session::has('id_img_industrial')) {
                $array = Session::get('id_img_industrial');
                array_push($array,$id->id);
                Session::put('id_img_industrial', array_unique($array));
            }
            else{
                Session::put('id_img_industrial',array($id->id));
            }
            return response()->json("Exito");

        }
            return response()->json("fallo");

    }
    public function eliminar_producto_industrial($arrayKey)
    {
        try {
            if (Session::has('industrial_carro')) {
                if (count(Session::get('industrial_carro'))>1) {
                    $array = Session::get('industrial_carro');
                    foreach ($array as $key => $value) {
                        if ($key == $arrayKey) {
                            $dato = imagen::where('sl_solicitudes_id',$value['id'])->get();
                            if ($dato) {
                                foreach ($dato as $imagen) {
                                    unlink('public/img/solicitudes/'.$imagen->archivo);
                                    imagen::find($imagen->id)->delete();
                                }
                            }
                            unset($array[$arrayKey]);
                            Session::put('intento_carro', $array);
                            solicitud::find($value['id'])->delete();
                        }
                    }
                }else if(count(Session::get('industrial_carro'))==1){

                    $array = Session::get('industrial_carro');
                    foreach ($array as $key => $value) {
                        if ($key == $arrayKey) {
                            $dato = imagen::where('sl_solicitudes_id',$value['id'])->get();
                            if ($dato) {
                                foreach ($dato as $imagen) {
                                    unlink('public/img/solicitudes/'.$imagen->archivo);
                                    imagen::find($imagen->id)->delete();
                                }
                            }
                            unset($array[$arrayKey]);
                            Session::put('industrial_carro', $array);
                            solicitud::find($value['id'])->delete();
                        }
                    }
                    Session::forget('industrial_carro');
                }
            }
            Session::flash('mensaje',['content'=>'Producto eliminado','type'=>'primary']);
            return back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return back();
        }
    }
    public function post_agregar_productos_industriales(Request $request)
    {
        try {
            $clasi = Clasificacion::find($request->clasificacion);
            $grup = Grupo::find($request->grupo);

            $soli = solicitud::create([
                'clasificaciones_id' => $request->clasificacion,
                'grupos_id' => $request->grupo,
                'comentario' => $request->comentario,
                'peso' => $request->peso
            ]);

            if (Session::has('industrial_carro')) {
                $session = Session::get('industrial_carro');
                $array = array(
                    'id'=>$soli->id,
                    'id_clasi'=>$request->clasificacion,
                    'nombre_clasi'=>$clasi->nombre,
                    'id_grupo'=>$request->grupo,
                    'nombre_grupo'=>$grup->nombre,
                    'comentario'=> $request->comentario
                );
                array_push($session, $array);
                Session::put('industrial_carro',$session);
            }else{
                $prueba = array(0=>[
                    'id'=>$soli->id,
                    'id_clasi'=>$request->clasificacion,
                    'nombre_clasi'=>$clasi->nombre,
                    'id_grupo'=>$request->grupo,
                    'nombre_grupo'=>$grup->nombre,
                    'comentario'=> $request->comentario
                    ]
                );
                Session::put('industrial_carro',$prueba);
            }

            if(Session::has('id_img_industrial')){
                $img = imagen::whereIn('id',Session::get('id_img_industrial'))->get();
                foreach ($img as $value) {
                    imagen::find($value->id)->update([
                        'sl_solicitudes_id'=>$soli->id
                    ]);
                }
                Session::forget('id_img_industrial');
            }
            Session::flash('mensaje',['content'=>'Producto Agregado','type'=>'primary']);
            return Redirect::action('SitesController@retiro_industrial_1');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return Redirect::action('SitesController@retiro_industrial_1');
        }
    }
    //api consumible
    public function GrupoClasificacion($id)
    {
        $grupo_clasificacion = GrupoClasificacion::where('grupos_id',$id)->pluck('clasificaciones_id');
        $clasi = Clasificacion::whereIn('id',$grupo_clasificacion)->get();
        return response()->json($clasi);
    }
    //qr
    public function qrcode()
    {
        return view('reciclaje');
    }

    ///////////////////////////////////////////////
    //RETIRO INDUSTRIAL DE ADMINISTRADOR Y TERCERO

    public function retiro_industrial_empresa(){

        //$boletas = Boleta::where('users_id',Auth::user()->id)->get();

        if (Auth::user()->roles_id == 15) {
            $total = Boleta::wherein('bk_estados_id',[1,24,25,31])->get();
            // $boletas = Boleta::wherein('bk_estados_id',[1,24,25])->orderBy('id','DESC')->paginate(5);
             $enproceso = Boleta::wherein('bk_estados_id',[9,26,27,21,29,28,31])->get();
             $aceptado = Boleta::where('bk_estados_id',8)->get();
             $cancelado = Boleta::where('bk_estados_id',17)->get();
             $terminado = Boleta::where('bk_estados_id',2)->get();


             $transaccion = Transaccion::orderBy('id','DESC')->get();
             $empresa_user = empresa_usuario::where('users_id',Auth::user()->id)->pluck('empresas_id');//id=24 , users=13
            //  $boletas =  Boleta::whereIn('empresas_id',$empresa_user)->paginate(5);
             if ( Boleta::whereIn('empresas_id',$empresa_user)->count()>0) {
                $existeboleta = 1;
                $boletas =   Boleta::whereIn('empresas_id',$empresa_user)->paginate(5);

             } else {
                 $existeboleta = 0;
                 $boletas = null;
             }
             return view('workflow::private.administrador.retiro-industrial-empresa',compact('existeboleta','boletas','transaccion','boletas','total','enproceso','aceptado','cancelado','terminado'));
        }
        if (Auth::user()->roles_id == 24) {
            $total = Boleta::wherein('bk_estados_id',[1,24,25,31])->get();
            //$boletas = Boleta::wherein('bk_estados_id',[1,24,25])->orderBy('id','DESC')->paginate(5);
             $enproceso = Boleta::wherein('bk_estados_id',[9,26,27,21,29,28])->get();
             $aceptado = Boleta::where('bk_estados_id',8)->get();
             $cancelado = Boleta::where('bk_estados_id',17)->get();
             $terminado = Boleta::where('bk_estados_id',2)->get();
             $transaccion = Transaccion::orderBy('id','DESC')->get();
             $empresa_user = empresa_usuario::where('users_id',Auth::user()->id)->pluck('empresas_id');//id=24 , users=13
             $boletas =  Boleta::where('creador_id',Auth::user()->id)->paginate(5);
             if (Boleta::where('creador_id',Auth::user()->id)->count()>0) {
                $existeboleta = 1;
                $boletas =  Boleta::where('creador_id',Auth::user()->id)->paginate(5);

             } else {
                 $existeboleta = 0;
                 $boletas = null;
             }

             return view('workflow::private.administrador.retiro-industrial-empresa',compact('existeboleta','boletas','transaccion','boletas','total','enproceso','aceptado','cancelado','terminado'));
        }






    }

    public function agregar_retiro_industrial_empresa(){
        $grupo = Grupo::all();
        $empresasusuarios = EmpresaUsuario::where('users_id',Auth::user()->id)->get();
        return view('workflow::private.administrador.agregar-retiro-industrial-empresa',compact('grupo','empresasusuarios'));
    }

    public function add_solicitud_empresa(Request $request)
    {
        try {
            $codigo = time();
            if ($request->comentario){
                $acceso = Acceso::create([
                    'comentario'=> $request->comentario
                ]);
            }else{
                $acceso = Acceso::create([
                    'comentario'=> "Sin cometario"
                ]);
            }

         //archivo de acceso



        //    if ($request->file('acceso')) {
        //         $imgAcc = $request->file('acceso');
        //         $imgAccName = time().'.'.$imgAcc->getClientOriginalExtension();
        //         $imgAcc->move('public/img/accesos/',$imgAccName);
        //         $acc = img_acceso::create([
        //             'archivo'=>$imgAccName,
        //             'url'=>'public/img/accesos/',
        //             'accesos_id'=>$acceso->id
        //         ]);
        //     }

            if ($request->File('acceso')) {
                Log::info('accesos');
                foreach($request->file('acceso') as $file)
                {
                    // $name = time().'.'.$file->extension();
                    // $file->move(public_path().'/files/', $name);
                    // $data[] = $name;
                    // dd('gf');
                    $imgAcc = $file;
                    $imgAccName = time().'.'.$imgAcc->getClientOriginalExtension();
                    $ruta= Storage::putFile('solicitud/accesos',$imgAcc);

                    // $data[] = $name;

                    // guaarda la imagen
                    Log::info('ruta');
                    Log::info($ruta);

                    $acc = ImagenAcceso::create([
                        'archivo'=>$imgAccName,
                        'url'=>$ruta,
                        'accesos_id'=>$acceso->id
                    ]);
                }
                // $file= new File();
                // $file->filenames=json_encode($data);
                // $file->save();
         }


                // $ruta= Storage::putFile('solicitud/accesos/', $request->file('acceso'));
                // $imgAcc = $request->file('acceso');
                // $imgAccName = time().'.'.$imgAcc->getClientOriginalExtension();
            //     foreach($request->file('acceso') as $file)
            //     {
            //         $ruta= Storage::putFile('solicitud/accesos/', $request->file('acceso'));
            //         $imgAcc = $request->file('acceso');
            //         $imgAccName = time().'.'.$imgAcc->getClientOriginalExtension();
            //         $data[] = $name;
            //         $imf$file->filenames=json_encode($data);
            //     }

            //     Log::info('imagen_acceso');
            //     Log::info( $acc);

            //
            $array = array();
            if (Session::has('prod_industrial')) {
                foreach (Session::get('prod_industrial') as $value) {
                    $soli = Solicitud::create([
                        'accesos_id' =>$acceso->id,
                        'clasificaciones_id' =>$value['id_clasi'],
                        'grupos_id' =>$value['id_grupo'],
                        'comentario'=>$value['comentario'],
                        'detalle_retiro'=>$value['detalle_retiro']
                    ]);
                    $dato_id = array(
                        'id'=>$soli->id
                    );

                    array_push($array, $dato_id);
                }
                Session::forget('prod_industrial');

            }
            if (Auth::user()->roles_id == 24) {

            if($request->direccion_usuario){
                $boleta = Boleta::create([
                    'codigo'=>$codigo,
                    'bk_estados_id'=>31,
                    'retiro_propio'=>$request->retiro,
                    'empresas_id'=> $request->empresa,
                    'users_id'=> Auth::user()->id,
                    'horarios_id'=>$request->tiporetiro,
                    'horarios_dias_id'=>$request->horario,
                    'bk_direcciones_empresas_id'=>$request->direccion_usuario,
                    'creador_id'=>Auth::user()->id

                ]);
            }else{
                $dire_empresa = DireccionEmpresa::create([
                    'nombre'=> $request->direccion,
                    'empresas_id'=> $request->empresa,
                    'bk_comunas_id'=> $request->comunas,
                    'bk_regiones_id'=> $request->regiones
                ]);
                $boleta = Boleta::create([
                    'codigo'=>$codigo,
                    'bk_estados_id'=>31,
                    'empresas_id'=> $request->empresa,
                    'users_id'=> Auth::user()->id,
                    'horarios_id'=>$request->tiporetiro,
                    'horarios_dias_id'=>$request->horario,
                    'bk_direcciones_empresas_id'=>$dire_empresa->id,
                    'retiro_propio'=>$request->retiro,
                    'creador_id'=>Auth::user()->id

                ]);
            }
            } else {

            if($request->direccion_usuario){
                $boleta = Boleta::create([
                    'codigo'=>$codigo,
                    'bk_estados_id'=>1,
                    'retiro_propio'=>$request->retiro,
                    'empresas_id'=> $request->empresa,
                    'users_id'=> Auth::user()->id,
                    'horarios_id'=>$request->tiporetiro,
                    'horarios_dias_id'=>$request->horario,
                    'bk_direcciones_empresas_id'=>$request->direccion_usuario,
                    'creador_id'=>Auth::user()->id

                ]);
            }else{
                $dire_empresa = DireccionEmpresa::create([
                    'nombre'=> $request->direccion,
                    'empresas_id'=> $request->empresa,
                    'bk_comunas_id'=> $request->comunas,
                    'bk_regiones_id'=> $request->regiones
                ]);
                $boleta = Boleta::create([
                    'codigo'=>$codigo,
                    'bk_estados_id'=>1,
                    'empresas_id'=> $request->empresa,
                    'users_id'=> Auth::user()->id,
                    'horarios_id'=>$request->tiporetiro,
                    'horarios_dias_id'=>$request->horario,
                    'bk_direcciones_empresas_id'=>$dire_empresa->id,
                    'retiro_propio'=>$request->retiro,
                    'creador_id'=>Auth::user()->id

                ]);
            }
            }

            foreach($array as $dato){
                $bol_sol = BoletaSolicitud::create([
                    'sl_solicitudes_id'=>$dato['id'],
                    'boletas_id'=>$boleta->id
                ]);
            }
            $boletas = Boleta::where('users_id',Auth::user()->id)->paginate(5);

            if (Boleta::where('users_id',Auth::user()->id)->count()>0) {
                $existeboleta = 1;
                $boletas =  Boleta::where('creador_id',Auth::user()->id)->paginate(5);

            } else {
                $existeboleta = 0;
                $boletas = null;
            }




            Session::flash('mensaje',['content'=>'Solicitud exitosa','type'=>'primary']);
            return view('workflow::private.administrador.retiro-industrial-empresa',compact('boletas','existeboleta'));
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return view('workflow::private.administrador.retiro-industrial-empresa');
        }
    }

    /////////////////////////////////////////
    // AGREGAR DIRECCION
    public function agregar_direccion(){
        $region = Region::all();
        return view('solicitudes.agregar-direccion', compact('region'));
    }

    public function post_agregar_direccion(Request $request)
    {
        try {

            $direccionUsuario = new DireccionUsuario($request->all());
            $direccionUsuario->users_id = Auth::user()->id;
            $direccionUsuario->save();

            Session::flash('mensaje',['content'=>'Dirección Agregada','type'=>'primary']);
            return Redirect::action('SitesController@solicitud_paso_3');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return Redirect::action('SitesController@solicitud_paso_3');
        }
    }
 /////////////////////////77
////// FIN AGREGAR DIRECCION
    public function pdfventa($id){

        // try {
        if (Transaccion::where('codigo', $id)->where('pdf',0)->count() > 0) {

            $transaccion = Transaccion::where('codigo', $id)->first();
            $transaccion->pdf = 1;
            $transaccion->save();
            $ventas = ventaTransaccion::where('transacciones_id',$transaccion->id)->get();    
            $venta =  venta::find($ventas[0]->ventas_id);
            $region = Region::find(1);
            $comuna = Comuna::find(1);
            $codigo = Transaccion::where('codigo', $id)->pluck('codigo');

                
            $pdf = PDF::loadview('tienda::Public.venta.exito_pdf_nuevo',compact('transaccion','region','comuna','ventas','codigo'));
            $pdf->setPaper(array(0, 0, 283.465, 850.394), 'portrait');
            return $pdf->download($id.'.pdf');
            
        }else{

            $codigo = Transaccion::where('codigo', $id)->pluck('codigo');

            return view('tienda::Public.venta.nopdf', compact('codigo'));


        }  
    }   


        public function pdfventasi($id){

        try {
            if (Transaccion::where('codigo', $id)->count() > 0) {
    
                $transaccion = Transaccion::where('codigo', $id)->first();
            
                $codigo = Transaccion::where('codigo', $id)->pluck('codigo');

                $ventas = ventaTransaccion::where('transacciones_id',$transaccion->id)->get();    
                $venta =  venta::find($ventas[0]->ventas_id);
                    
                return view('tienda::Public.venta.sipdf',compact('transaccion','ventas','codigo'));
            }
              

        } catch (\Throwable $th) {
        //     dd('tu comprobante todavía no est listo pronto te lo enviaremos. ');
        }

    }

    public function pdfventasp($id){

        // try {
        if (venta::where('codigo', $id)->where('pdf',0)->count() > 0) {

            $venta =  venta::where('codigo', $id)->first();
            $venta->pdf = 1;
            $venta->save();   
            $codigo = $venta->codigo;

                
            $pdf = PDF::loadview('tienda::Public.venta.exito_pdf_sp',compact('venta','codigo'));
            $pdf->setPaper(array(0, 0, 283.465, 850.394), 'portrait');
            return $pdf->download($id.'.pdf');
            
        }else{
            $venta =  venta::where('codigo', $id)->first();
            $codigo = $venta->codigo;
            return view('tienda::Public.venta.nopdf_sinpago', compact('codigo'));
        }  
    }   


    public function pdfventasisp($id){

        try {
            if (venta::where('codigo', $id)->count() > 0) {
    
                $ventas = venta::where('codigo', $id)->first();
                $codigo = $ventas->codigo; 
                return view('tienda::Public.venta.sipdf_sinpago',compact('ventas','codigo'));
            }
              
        } catch (\Throwable $th) {

        }

    }

    public function beneficio_adidas(){
        return view('adidas.vista1');
    }

    public function beneficio_adidas_paso1(){
        return view('adidas.vista2');
    }

    public function buscarCamion($id)
    {
        $camion = Camion::where('tipo_camion_id',$id)->get();
        return response()->json($camion);
    }
}
