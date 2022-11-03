<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Carbon\Carbon;
use Modules\Workflow\Entities\Solicitud;
use App\ImagenSolicitud;
use Modules\Contenido\Entities\Noticia;
use Modules\Contenido\Entities\Imagen;
use Modules\Tienda\Entities\Producto;
use App\Residuo;
use App\Acceso;
use App\EmpresaUsuario;
use App\ImagenAcceso;
use App\Horario;
use App\HorarioDia;
use Modules\Workflow\Entities\BoletaSolicitud;
use Modules\Workflow\Entities\Boleta;
use Modules\Login\Entities\Region;
use Modules\Login\Entities\Comuna;
use Modules\Backend\Entities\DireccionEmpresa;
use App\DireccionUsuario;
use Modules\Workflow\Entities\Grupo;
use Modules\Contenido\Entities\ImagenSlider;
use Modules\Tienda\Entities\Banner;
use Modules\Workflow\Entities\GrupoClasificacion;
use Modules\Workflow\Entities\Clasificacion;
use App\Empresa;
use Storage;
use Modules\Workflow\Entities\Marcas;
use App\Retiro;
use Barryvdh\DomPDF\Facade as PDF;
use Log;
use Modules\Backend\Entities\ServiciosHome;
use Modules\Backend\Entities\Combo;
use Modules\Backend\Entities\ComboResiduo;
use Modules\Tienda\Entities\Transaccion as transaccion;
use Modules\Tienda\Entities\Ventas as venta;
use Modules\Tienda\Entities\VentaTransaccion as ventaTransaccion;
use Modules\Payments\Http\Controllers\WebpayPlusController as WebpayPlus;
use App\Mail\MailConfirmarRetiroCorto;
use App\Mail\MailDeCreacionUsuario;
use Mail;
use App\User;


class RetiroCortoController extends Controller
{
    public function RetiroCortoPaso1(){
        if (Auth::check()) {
            return Redirect::to('retiro-corto/paso-2');
        }else{  
            $comunas = Comuna::where('bk_regiones_id',7)->get(); //solo region metropolitana
            $region = Region::where('id',7)->get(); //cuando digan que usaran regiones
            return view('retirocorto.paso-1', compact('comunas','region'));
        }
    }
    public function RecopilarDatos(Request $request){
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            Session::put('sesion_datos_retiro',$user);
        }else{
            $array = array($request->all());
            Session::put('sesion_datos_retiro',$array);
            $user = User::where('email',$request->correo)->get();
            if($user->count() != 0){
                Session::flash('usuarioyaexisteingrese','hola');
                return Redirect::to('/login');
            }
        }
        return Redirect::to('retiro-corto/paso-2');
    }

    public function RetiroCortoPaso2(){
        if(Session::has('sesion_datos_retiro')){
            $residuo = Residuo::all();
            $combos = Combo::where('activo',1)->get();
            return view('retirocorto.paso-2',compact('residuo','combos'));
        }else{
            if (Auth::check()) {
                $user = User::find(Auth::user()->id);
                Session::put('sesion_datos_retiro',$user);
                $residuo = Residuo::all();
                $combos = Combo::where('activo',1)->get();
                return view('retirocorto.paso-2',compact('residuo','combos'));
            }else{
                return Redirect::to('/retiro');
            }
        }
    }
    public function AgregarProductoRC(Request $request){
        
        $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ran_sol = substr(str_shuffle($permit),0,6);
        if ($request->hasFile('imagen')) {
            foreach ($request->imagen as $key => $value) {
                $random = substr(str_shuffle($permit),0,25);
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($value->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $ruta= Storage::putFileAs('temporal/'.$random,$value,$nombre);

                if (Session::has('foto_retiro_corto')) {
                   $session_foto = Session::get('foto_retiro_corto');
                   $array_foto = array(
                        'imagen'=>$ruta,
                        'id_sol'=> $ran_sol
                   );
                   array_push($session_foto, $array_foto);
                   Session::put('foto_retiro_corto',$session_foto);
                }else{
                    $session_foto_first = array(0=>[
                        'imagen'=> $ruta,
                        'id_sol'=> $ran_sol
                    ]);
                    Session::put('foto_retiro_corto',$session_foto_first);
                }
            }
        }
        if ($request->producto == 0) {
            $precio = 0;
            $altura = $request->altura;
            $largo = $request->largo;
            $ancho = $request->profundo;
            $nombre_residuo = $request->nombre;
            $mt3 = ($request->altura/100)*($request->largo/100)*($request->profundo/100);
            $mt3 = $mt3*$request->cantidad;
        }else{
            $residuo = Residuo::find($request->producto);
            $precio = $residuo->precio;
            $altura = $residuo->altura;
            $largo = $residuo->largo;
            $ancho = $residuo->ancho;
            $nombre_residuo = $residuo->nombre;
            $mt3 = ($residuo->altura/100)*($residuo->largo/100)*($residuo->ancho/100);
            $mt3 = $mt3*$request->cantidad;
        }

        if (Session::has('prod_retiro_corto')) {
           $session = Session::get('prod_retiro_corto');
           $array = array(
            'producto'=>$request->producto,
            'residuo'=>$nombre_residuo,
            'peso'=>$request->peso,
            'precio'=>$precio,
            'altura'=>$altura,
            'largo'=>$largo,
            'profundidad'=> $ancho,
            'cantidad'=> $request->cantidad,
            'motivo'=> $request->motivo,
            'id_sol'=> $ran_sol,
            'mt3'=> $mt3,
            'imagen'=> $ruta
           );
           array_push($session, $array);
           Session::put('prod_retiro_corto',$session);
        }else{
            $prueba = array(0=>[
                'producto'=>$request->producto,
                'residuo'=>$nombre_residuo,
                'peso'=>$request->peso,
                'precio'=>$precio,
                'altura'=>$altura,
                'largo'=>$largo,
                'profundidad'=> $ancho,
                'cantidad'=> $request->cantidad,
                'motivo'=> $request->motivo,
                'id_sol'=> $ran_sol,
                'mt3'=> $mt3,
                'imagen'=> $ruta
            ]);
            Session::put('prod_retiro_corto',$prueba);
        }
        return Redirect::back();
    }

    public function ElegirComboRC(Request $request){
        $combos = Combo::find($request->combos);
        $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ran_sol = substr(str_shuffle($permit),0,6);
        if (Session::has('combo_retiro_elegidos')){
           $session = Session::get('combo_retiro_elegidos');
           $array = array(
                'nombre'=>$combos->nombre,
                'id_combo'=>$ran_sol,
                'valor'=>$combos->valor,
                'img'=>$combos->img,
                'n_combo'=>$combos->id
           );
           array_push($session, $array);
           Session::put('combo_retiro_elegidos',$session);
        }else{
            $prueba = array(0=>[
                'nombre'=>$combos->nombre,
                'id_combo'=>$ran_sol,
                'valor'=>$combos->valor,
                'img'=>$combos->img,
                'n_combo'=>$combos->id
            ]);
            Session::put('combo_retiro_elegidos',$prueba);
        }

        $combo_array = array(
            'id_combo'=>$ran_sol,
            'n_combo'=>$combos->id
        );
        Session::put('combo_elegido',$combo_array);
        //TODO Ahora el paso 3 sera para completar el elegir el combo y las solicitudes
        return Redirect::to('retiro-corto/paso-3');
    }

    public function RetiroCortoPaso3(){
        if(Session::has('combo_elegido')){
            $combo = Combo::find(Session::get('combo_elegido')['n_combo']);
            return view('retirocorto.paso-3',compact('combo'));
        }else{
            return Redirect::to('retiro-corto/paso-2');
        }
    }
    public function AgregarAccesoRC(Request $request){
        $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ran_sol = substr(str_shuffle($permit),0,6);
        if ($request->hasFile('imagen')) {
            foreach ($request->imagen as $key => $value) {
                $random = substr(str_shuffle($permit),0,25);
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($value->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $ruta= Storage::putFileAs('temporal/'.$random,$value,$nombre);

                if (Session::has('foto_combo_retiro_corto')) {
                   $session_foto = Session::get('foto_combo_retiro_corto');
                   $array_foto = array(
                        'imagen'=>$ruta,
                        'id_sol'=> $ran_sol
                   );
                   array_push($session_foto, $array_foto);
                   Session::put('foto_combo_retiro_corto',$session_foto);
                }else{
                    $session_foto_first = array(0=>[
                        'imagen'=> $ruta,
                        'id_sol'=> $ran_sol
                    ]);
                    Session::put('foto_combo_retiro_corto',$session_foto_first);
                }
            }
        }
        $combo_residuo = ComboResiduo::find($request->combo_residuo);
        $residuo = Residuo::find($combo_residuo->Residuos_id);
        $precio = $residuo->precio;
        $altura = $residuo->altura;
        $largo = $residuo->largo;
        $ancho = $residuo->ancho;
        $nombre_residuo = $residuo->nombre;
        $mt3 = ($residuo->altura/100)*($residuo->largo/100)*($residuo->ancho/100);
        $mt3 = $mt3*$request->cantidad;

        if (Session::has('combo_retiro_corto')) {
           $session = Session::get('combo_retiro_corto');
           $array = array(
            'producto'=>$residuo->id,
            'residuo'=>$nombre_residuo,
            'peso'=>$request->peso,
            'precio'=>$precio,
            'altura'=>$altura,
            'largo'=>$largo,
            'profundidad'=> $ancho,
            'cantidad'=> $request->cantidad,
            'motivo'=> $request->motivo,
            'id_sol'=> $ran_sol,
            'id_combo'=> Session::get('combo_elegido')['id_combo'],
            'mt3'=> $mt3,
            'imagen'=> $ruta,
            'combo_residuo'=> $combo_residuo->id
           );
           array_push($session, $array);
           Session::put('combo_retiro_corto',$session);
        }else{
            $prueba = array(0=>[
                'producto'=>$residuo->id,
                'residuo'=>$nombre_residuo,
                'peso'=>$request->peso,
                'precio'=>$precio,
                'altura'=>$altura,
                'largo'=>$largo,
                'profundidad'=> $ancho,
                'cantidad'=> $request->cantidad,
                'motivo'=> $request->motivo,
                'id_sol'=> $ran_sol,
                'id_combo'=> Session::get('combo_elegido')['id_combo'],
                'mt3'=> $mt3,
                'imagen'=> $ruta,
                'combo_residuo'=> $combo_residuo->id
            ]);
            Session::put('combo_retiro_corto',$prueba);
        }
        return Redirect::back();
    }
    public function RetiroCortoPaso4(){
        if(Session::has('prod_retiro_corto')){
            $horario = Horario::all();
            $hr_dia = HorarioDia::all();
            $comunas = Comuna::where('bk_regiones_id',7)->get();
            $region = Region::where('id',7)->get(); //cuando digan que usaran regiones

            if (Auth::check()) {
                $direccion = DireccionUsuario::where('users_id',Auth::user()->id)->get();
            }else{
                $direccion = null;
            }
            return view('retirocorto.paso-4', compact('horario','hr_dia','comunas','direccion','region'));
        }else{
            if(Session::has('combo_retiro_corto')){
                $horario = Horario::all();
                $hr_dia = HorarioDia::all();
                $comunas = Comuna::where('bk_regiones_id',7)->get();
                $region = Region::where('id',7)->get();
                if (Auth::check()) {
                    $direccion = DireccionUsuario::where('users_id',Auth::user()->id)->get();
                }else{
                    $direccion = null;
                }
                return view('retirocorto.paso-4', compact('horario','hr_dia','comunas','direccion','region'));
            }else{
                return Redirect::to('retiro-corto/paso-2');
            }
        }
    }
    public function AgregarTipoRetiroRC(Request $request){
        if ($request->hasFile('imagen')) {
            foreach ($request->imagen as $key => $value) {
                $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $random = substr(str_shuffle($permit),0,25);
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($value->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $ruta_archivo = 'accesos/'.$random.'/';
                $ruta= Storage::putFileAs($ruta_archivo,$value,$nombre);

                if (Session::has('foto_acceso_corto')) {
                   $session_foto = Session::get('foto_acceso_corto');
                   $array_foto = array(
                        'url'=>$ruta_archivo,
                        'archivo'=>$nombre
                   );
                   array_push($session_foto, $array_foto);
                   Session::put('foto_acceso_corto',$session_foto);
                }else{
                    $session_foto_first = array(0=>[
                        'url'=>$ruta_archivo,
                        'archivo'=>$nombre
                    ]);
                    Session::put('foto_acceso_corto',$session_foto_first);
                }
            }
        }

       $array = array(
            'comentario'=>$request->comentario,
            'url'=>$ruta_archivo,
            'archivo'=>$nombre
       );
       Session::put('acceso_retiro_corto',$array);

        $sesion = array();
        if ($request->confirmar_direccion == 2) {
           $array_dir = array(
                'bk_comunas_id'=>$request->bk_comunas_id,
                'bk_regiones_id'=>$request->bk_regiones_id,
                'direccion'=>$request->direccion,
                'detalle'=>$request->detalle
           );
           array_push($sesion, $array_dir);
           Session::put('nueva_direccion',$sesion);
        }else{  
            if($request->bk_direccionuser_id) {
                Session::put('id_direccion_user',$request->bk_direccionuser_id);
            }
        }

        $horario = Horario::find($request->tiporetiro);
        $hr_dia = HorarioDia::find($request->horario);

       $array = array(
            'tiporetiro_id'=>$request->tiporetiro,
            'tiporetiro'=>$horario->nombre,
            'horario_id'=>$request->horario,
            'horario'=>$hr_dia->nombre,
            'precio'=>$horario->precio
       );
       Session::put('tipo_retiro_horario',$array);
        
        return Redirect::to('retiro-corto/paso-5');
    }
    public function RetiroCortoPaso5(){
        if(Session::has('tipo_retiro_horario')){
            $producto = Producto::find(19);
            return view('retirocorto.paso-5', compact('producto'));
        }else{
            return Redirect::to('retiro-corto/paso-4');
        }
    }

    public function AgregarSolicitudRC(Request $request){
        // dd($request);
        $creditcard = $request->creditcard;
        $confirmar_kit =$request->confirmar_kit;
        if(Session::has('acceso_retiro_corto')){
            //Agregar Acceso
            if (Session::get('acceso_retiro_corto')['comentario'] != null){
                $acceso = Acceso::create([
                    'comentario'=> Session::get('acceso_retiro_corto')['comentario']
                ]);
            }else{
                $acceso = Acceso::create([
                    'comentario'=> "Sin cometario"
                ]);
            }
        }
        // $acceso = Acceso::find(218);

        if(Session::has('foto_acceso_corto')){
        //Agregar las imagenes de los Accesos
            foreach (Session::get('foto_acceso_corto') as $key => $foto_acceso) {
                $acc = ImagenAcceso::create([
                    'archivo'=>$foto_acceso['archivo'],
                    'url'=>$foto_acceso['url'].''.$foto_acceso['archivo'],
                    'accesos_id'=>$acceso->id
                ]);
            }
        }
        // dd($acc);

        $total_producto = 0;
        $mt3 = 0;
        $mt3_total = 0;
        $array_sol = array();
        $array_combo = array();
        if(Session::has('prod_retiro_corto')){
            //Agregar Solicitud

            foreach (Session::get('prod_retiro_corto') as $key => $solicitudRC) {
                $nombre_residuo = $solicitudRC['residuo'];
                if ($solicitudRC['producto'] == 0) {
                    $residuo_id = null;
                }else{
                    $residuo_id = $solicitudRC['producto'];
                }
                $solicitud = Solicitud::create([
                    'Residuos_id'=> $residuo_id,
                    'nombre'=> $nombre_residuo,
                    'peso' => $solicitudRC['peso'],
                    'cantidad' => $solicitudRC['cantidad'],
                    'altura'=> $solicitudRC['altura'],
                    'largo'=> $solicitudRC['largo'],
                    'profundidad' => $solicitudRC['profundidad'],
                    'motivo'=> $solicitudRC['motivo'],
                    'precio'=> $solicitudRC['precio'],
                    'mt3'=> $solicitudRC['mt3'],
                    'accesos_id'=>$acceso->id
                ]);
                // $solicitud = Solicitud::find(258);
                array_push($array_sol,$solicitud->id);
                $total_producto = 29990;
                $mt3 = $solicitudRC['mt3'];
                $mt3_total = $mt3_total+$mt3;

                if($mt3_total > 2){
                    $mt3_restante = $mt3_total-2;
                    $valor_mt3 = ($mt3_restante*29990)/2;
                    $total_producto  = $total_producto+$valor_mt3;
                }
                // dd($solicitud);

                if(Session::has('foto_retiro_corto')){
                    //Agregar Imagenes de Solicitud
                    foreach(Session::get('foto_retiro_corto') as $key => $img_sol){
                        if($solicitudRC['id_sol']== $img_sol['id_sol']){
                            $img_solicitud = ImagenSolicitud::create([
                                'archivo'=> $img_sol['imagen'],
                                'url' => 'storage',
                                'sl_solicitudes_id' => $solicitud->id
                            ]); 
                        }  
                    }
                }
            }
            // array_push($array_sol,$solicitud->id);
            // $total_producto =$total_producto+$solicitud->precio;
            // dd($array_sol,$total_producto);

        }

        if (Session::has('combo_retiro_elegidos')){
            foreach (Session::get('combo_retiro_elegidos') as $key => $comboeleRC) {
                $total_producto = $total_producto+$comboeleRC['valor'];  
                if (Session::has('combo_retiro_corto')) {
                    foreach (Session::get('combo_retiro_corto') as $key => $combosRC) {
                        $sol_combo = Solicitud::create([
                            'Residuos_id'=> $combosRC['producto'],
                            'nombre'=> $combosRC['residuo'],
                            'peso' => $combosRC['peso'],
                            'cantidad' => $combosRC['cantidad'],
                            'altura'=> $combosRC['altura'],
                            'largo'=> $combosRC['largo'],
                            'profundidad' => $combosRC['profundidad'],
                            'motivo'=> $combosRC['motivo'],
                            'precio'=> $combosRC['precio'],
                            'mt3'=> $combosRC['mt3'],
                            'accesos_id'=>$acceso->id
                        ]);
                        // $solicitud = Solicitud::find(258);
                        array_push($array_combo,$sol_combo->id);

                        if(Session::has('foto_combo_retiro_corto')){
                            //Agregar Imagenes de Solicitud
                            foreach(Session::get('foto_combo_retiro_corto') as $key => $imgcom_sol){
                                if($combosRC['id_sol']== $imgcom_sol['id_sol']){
                                    $img_solicitud = ImagenSolicitud::create([
                                        'archivo'=> $imgcom_sol['imagen'],
                                        'url' => 'storage',
                                        'sl_solicitudes_id' => $sol_combo->id
                                    ]); 
                                }  
                            }
                        }
                    }
                }
            }
        }



        if(Session::has('tipo_retiro_horario')){
        //Actualizar los datos de la solicitud
            $horario = Horario::find(Session::get('tipo_retiro_horario')['tiporetiro_id']);
            $hr_dia = HorarioDia::find(Session::get('tipo_retiro_horario')['horario_id']);

        }

        if(Session::has('sesion_datos_retiro')){

        //Crear Boleta con las solicitudes
            $codigo = time();
            $total = $total_producto+intval($horario->precio);

            if (Auth::check()) {
                $user = User::find(Auth::user()->id);
                $nombre_user = $user->name.' '.$user->apellido;
                $telefono = $user->telefono;
                $correo = $user->email;
                $user_id = $user->id;

                if (Session::has('nueva_direccion')) {
                    $comuna_id = Session::get('nueva_direccion')[0]['bk_comunas_id'];
                    $region_id = Session::get('nueva_direccion')[0]['bk_regiones_id'];
                    $direccion = Session::get('nueva_direccion')[0]['direccion'];
                    $detalle = Session::get('nueva_direccion')[0]['detalle'];

                    $direccion_user = new DireccionUsuario();
                    $direccion_user->nombre = $direccion.' '.$detalle;
                    $direccion_user->bk_comunas_id = $comuna_id;
                    $direccion_user->bk_regiones_id = $region_id;
                    $direccion_user->activo = 1;
                    $direccion_user->users_id = $user_id;
                    $direccion_user->save();

                    $direccion_user_id = $direccion_user->id;
                }else{
                    if (Session::has('id_direccion_user')){
                        $direccion_user = DireccionUsuario::find(Session::get('id_direccion_user'));
                        $comuna_id = $direccion_user->bk_comunas_id;
                        $direccion = $direccion_user->nombre;
                        $detalle = null;
                        $direccion_user_id = $direccion_user->id;
                    }else{
                        $comuna_id = null;
                        $direccion = null;
                        $detalle = null;
                        $direccion_user_id = null;

                    }
                }
            }else{
                $correo = Session::get('sesion_datos_retiro')[0]['correo'];
                $telefono = Session::get('sesion_datos_retiro')[0]['telefono'];
                $nombre_user = Session::get('sesion_datos_retiro')[0]['nombre'];
                $user_id = null;
                $direccion_user_id = null;

                if (Session::has('nueva_direccion')) {
                //Si esta session existe actualizar los datos de la boleta
                    $comuna_id = Session::get('nueva_direccion')[0]['bk_comunas_id'];
                    $direccion = Session::get('nueva_direccion')[0]['direccion'];
                    $detalle = Session::get('nueva_direccion')[0]['detalle'];
                }else{
                    // dd(Session::get('sesion_datos_retiro'));
                    $comuna_id = Session::get('sesion_datos_retiro')[0]['bk_comunas_id'];
                    $direccion = Session::get('sesion_datos_retiro')[0]['direccion'];
                    $detalle = Session::get('sesion_datos_retiro')[0]['detalle'];
                }

            }



            $boleta = Boleta::create([
                'total'=>$total,
                'codigo'=>$codigo,
                'bk_estados_id'=>1,
                'horarios_id'=>$horario->id,
                'horarios_dias_id'=>$hr_dia->id,
                'nombre'=>$nombre_user,
                'telefono'=>$telefono,
                'correo'=>$correo,
                "comuna_id" => $comuna_id,
                "bk_direcciones_user_id" => $direccion_user_id,
                "users_id" => $user_id,
                "creador_id" => $user_id,
                "direccion_rc" => $direccion,
                "detalle" => $detalle,
                "tipo_pago" => $creditcard
            ]);

            if(count($array_sol)!=0){
                foreach($array_sol as $dato){
                    $bol_sol = BoletaSolicitud::create([
                        'sl_solicitudes_id'=>$dato,
                        'boletas_id'=>$boleta->id
                    ]);
                } 
            }
            if(count($array_combo)!=0){
                foreach($array_combo as $datocom){
                    $bol_sol = BoletaSolicitud::create([
                        'sl_solicitudes_id'=>$datocom,
                        'boletas_id'=>$boleta->id
                    ]);
                }
            }
            // $boleta = Boleta::find(165);
        }


        if ($creditcard == 'webpay') {
        //SI la forma de pago es webpay crear una transaccion con id de la boleta.
            $codigo = 'TPC'.rand(1111111111, 9999999999);
            do {
                $codigo_random = 'VSP'.rand(100000, 999999);
                $venta_count = venta::where('codigo',$codigo_random)->count();
            }while ($venta_count != 0);

            //transaccion
            $transaccion =  transaccion::create([
                'codigo'=> $codigo,
                'total'=>$boleta->total,
                'bk_estatus_id'=> 4,
                'estado'=> 'por pagar',
                'boletas_id'=>$boleta->id
            ]);
            
        }

        // $transaccion =  transaccion::find(14);


        $producto = Producto::find(19);
        if ($confirmar_kit == 1) {
        //Si el confirmar_kit viene en 1 es porque le agrego al total un kit se debe guardar en tabla venta. Y modificar el valor que va a enviar al webpay.
            do{
                $codigo_random = 'VSP'.rand(100000, 999999);
                $venta_count = venta::where('codigo',$codigo_random)->count();
            }while ($venta_count != 0);
            $kit_cant = $producto->precio*$request->cantidad;
            $total_kit = $boleta->total+$kit_cant;
            //Venta
            $venta = venta::create([
                'td_productos_id'=> $producto->id,
                'cantidad' => $request->cantidad,
                'tipo_venta_id' => 3,
                'total'=>$producto->precio,
                'tipo_pago'=>$boleta->tipo_pago,
                'bk_estatus_id'=>4,
                'estado'=> 'por pagar',
                'boletas_id'=>$boleta->id,
                'codigo'=>$codigo_random
            ]);

            if ($creditcard == 'webpay') {
                $transaccion->total = $total_kit;
                $transaccion->save();

                ventaTransaccion::create([
                    'ventas_id'=> $venta->id,
                    'transacciones_id'=> $transaccion->id
                ]);

                
            }
        }
        if ($creditcard == 'webpay') {
            if ($confirmar_kit == 1) {
                $array_ids = array(
                    'id_boleta'=>$boleta->id,
                    'id_acceso'=>$acceso->id,
                    'id_acc'=>$acc->id,
                    'id_transaccion'=>$transaccion->id,
                    'confirmar'=>$confirmar_kit,
                    'id_venta'=>$venta->id
                ); 
            }else{
                $array_ids = array(
                    'id_boleta'=>$boleta->id,
                    'id_acceso'=>$acceso->id,
                    'id_acc'=>$acc->id,
                    'id_transaccion'=>$transaccion->id,
                    'confirmar'=>$confirmar_kit
                ); 
            }
        }else{ 
            if ($confirmar_kit == 1) {
                $array_ids = array(
                    'id_boleta'=>$boleta->id,
                    'id_acceso'=>$acceso->id,
                    'id_acc'=>$acc->id,
                    'confirmar'=>$confirmar_kit,
                    'id_venta'=>$venta->id
                ); 
            }else{
                $array_ids = array(
                    'id_boleta'=>$boleta->id,
                    'id_acceso'=>$acceso->id,
                    'id_acc'=>$acc->id,
                    'confirmar'=>$confirmar_kit
                );
            }   
        }
        Session::put('todos_id_guardados',$array_ids);

        return Redirect::to('retiro-corto/paso-6');
    }

    public function RetiroCortoPaso6(){
        if(Session::has('todos_id_guardados')){
            $boleta = Boleta::find(Session::get('todos_id_guardados')['id_boleta']);
            $acceso = Acceso::find(Session::get('todos_id_guardados')['id_acceso']);
            $acc = ImagenAcceso::find(Session::get('todos_id_guardados')['id_acc']);
            if ($boleta->tipo_pago == 'webpay') {
                $transaccion =  transaccion::find(Session::get('todos_id_guardados')['id_transaccion']);
                $created_transaction = new WebpayPlus();
                $response = $created_transaction->createdTransaction($transaccion->codigo);
            }else{
                $response = $boleta->id;
            }
            $confirmar_kit = Session::get('todos_id_guardados')['confirmar'];
            if ($confirmar_kit == 1) {
               $venta = venta::find(Session::get('todos_id_guardados')['id_venta']);
            }else{
               $venta = 0; 
            }
            $producto = Producto::find(19);
            return view('retirocorto.paso-6',compact('acceso','boleta','confirmar_kit','producto','response','acc','venta'));
        }else{
            return Redirect::to('retiro-corto/paso-5');
        }

    }
    public function CancelarRC(){
        Session::forget('foto_acceso_corto');
        Session::forget('acceso_retiro_corto');
        Session::forget('foto_retiro_corto');
        Session::forget('prod_retiro_corto');
        Session::forget('sesion_datos_retiro');
        Session::forget('tipo_retiro_horario');
        Session::forget('nueva_direccion');
        Session::forget('datos_pago_retiro');
        Session::forget('todos_id_guardados');
        Session::forget('id_direccion_user');
        Session::forget('combo_elegido');
        Session::forget('combo_retiro_corto');
        Session::forget('combo_retiro_elegidos');
        Session::forget('foto_combo_retiro_corto');
        return Redirect::to('/');
    }

    public function CancelarRCPaso6($id){
        $boleta = Boleta::find($id);
        $boleta_solicitud = BoletaSolicitud::where('boletas_id',$boleta->id)->first();
        $solicitud = Solicitud::find($boleta_solicitud->sl_solicitudes_id);
        $acceso = Acceso::find($solicitud->accesos_id);
        $acceso->delete();
        $boleta->delete();

        if (Session::get('todos_id_guardados')['id_venta']) {
            $venta = venta::find(Session::get('todos_id_guardados')['id_venta']);
            $venta->delete();
        }

        Session::forget('foto_acceso_corto');
        Session::forget('acceso_retiro_corto');
        Session::forget('foto_retiro_corto');
        Session::forget('prod_retiro_corto');
        Session::forget('sesion_datos_retiro');
        Session::forget('tipo_retiro_horario');
        Session::forget('nueva_direccion');
        Session::forget('datos_pago_retiro');
        Session::forget('todos_id_guardados');
        Session::forget('id_direccion_user');
        Session::forget('combo_elegido');
        Session::forget('combo_retiro_corto');
        Session::forget('combo_retiro_elegidos');
        Session::forget('foto_combo_retiro_corto');

        return Redirect::to('/');
    }

    public function RetiroCortoPagoSP($id){
        $boleta = Boleta::find($id);
        $confirmar_kit = Session::get('todos_id_guardados')['confirmar'];
        // $confirmar_kit = 1;
        $producto = Producto::find(19);


        if ($boleta->users_id != null) {
            $user = User::find($boleta->users_id);
            try{
                Mail::to($user->email)->send(new MailConfirmarRetiroCorto($boleta));
            }catch(\Throwable $th){
                Log::info('Fallo Mail de Compra');
            }
        }else{
            $password_random = rand(111111, 999999);
            $user = new User();
            $user->roles_id = 19;
            $user->password = bcrypt($password_random);
            $user->email = Session::get('sesion_datos_retiro')[0]['correo'];
            $user->telefono = Session::get('sesion_datos_retiro')[0]['telefono'];
            $user->name = Session::get('sesion_datos_retiro')[0]['nombre'];
            $user->save();

            $comuna = Comuna::find($boleta->comuna_id);

            $direccion = new DireccionUsuario();
            $direccion->nombre = $boleta->direccion_rc;
            $direccion->bk_comunas_id = $boleta->comuna_id;
            $direccion->bk_regiones_id = $comuna->bk_regiones_id;
            $direccion->activo = 1;
            $direccion->users_id = $user->id;
            $direccion->save();

            $boleta->users_id = $user->id;
            $boleta->creador_id = $user->id;
            $boleta->save();

            try{
                Mail::to($boleta->correo)->send(new MailConfirmarRetiroCorto($boleta));
            }catch(\Throwable $th){
                Log::info('Fallo Mail de Compra');
            }

            try{
                Mail::to($user->email)->send(new MailDeCreacionUsuario($user,$password_random));
            }catch(\Throwable $th){
                Log::info('Fallo Mail de Compra');
            }
        }

        Session::forget('foto_acceso_corto');
        Session::forget('acceso_retiro_corto');
        Session::forget('foto_retiro_corto');
        Session::forget('prod_retiro_corto');
        Session::forget('sesion_datos_retiro');
        Session::forget('tipo_retiro_horario');
        Session::forget('nueva_direccion');
        Session::forget('datos_pago_retiro');
        Session::forget('todos_id_guardados');
        Session::forget('id_direccion_user');
        Session::forget('combo_elegido');
        Session::forget('combo_retiro_corto');
        Session::forget('combo_retiro_elegidos');
        Session::forget('foto_combo_retiro_corto');

        return view('retirocorto.exito_sinpago',compact('boleta','confirmar_kit','producto'));
    }

    public function BorrarSolRC($id){
        if(Session::has('prod_retiro_corto')){
            $array = array();
            $session = Session::get('prod_retiro_corto');
            foreach ($session as $key => $value) {
                if($value['id_sol'] != $id){
                    array_push($array, $value);
                }
            }
            if(count($array) != 0){
                Session::put('prod_retiro_corto',$array);
            }else{
                Session::forget('prod_retiro_corto');
            }
            return Redirect::back();
        }   
    }
    
    public function BorrarComboRC($id){
        if(Session::has('combo_retiro_corto')){
            $array = array();
            $session = Session::get('combo_retiro_corto');
            foreach ($session as $key => $value) {
                if($value['id_sol'] != $id){
                    array_push($array, $value);
                }
            }
            if(count($array) != 0){
                Session::put('combo_retiro_corto',$array);
            }else{
                Session::forget('combo_retiro_corto');
            }
            return Redirect::back();
        }   
    }

    public function BuscarComuna($id)
    {
        $comuna = Comuna::where('bk_regiones_id',$id)->get();
        return response()->json($comuna);
    }
    

}
