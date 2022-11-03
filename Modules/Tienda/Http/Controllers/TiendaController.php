<?php

namespace Modules\Tienda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

use Modules\Tienda\Entities\Descuentos as descuentos;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Tienda\Entities\Producto as producto;
use Modules\Tienda\Entities\Transaccion as transaccion;
use Modules\Tienda\Entities\Ventas as venta;
use Modules\Tienda\Entities\Categorias as categorias;
use Modules\Tienda\Entities\Banner as banner;
use Modules\Tienda\Entities\Comentarios as comentarios;
use Storage;
use Modules\Tienda\Entities\VentaTransaccion as ventaTransaccion;
use Modules\Tienda\Entities\Regalo as regalo;
use Session;
use Auth;
use DB;
use App\Mail\EnviarConfirmacion;
use App\Mail\EnviarConfirmacionUser;
use App\User;
use App\DireccionUsuario;
use Modules\Login\Entities\Region;
use Modules\Login\Entities\Comuna;
use Modules\Workflow\Entities\Boleta as boleta;
use App\Actions\VerificarRutAction;
use Modules\Contenido\Entities\ImagenSlider;
use Modules\Tienda\Entities\VentaFuera;
use Modules\Payments\Http\Controllers\WebpayPlusController as WebpayPlus;
use App\Mail\MailConfirmarVentaCortaWebpay;
use App\Mail\MailConfirmarVentaCorta;
use App\Mail\MailKitMidasVC;
use PDF;
use Log;
use Modules\Backend\Entities\Despacho;
use App\Services\ServiceSendSMSsinPago;

class TiendaController extends Controller{

    public function index(){
        $productos = producto::where('bk_estados_id',12)->get();
        $categorias =categorias::all();
        //home
        $banner =banner::find(6);
        $img = ImagenSlider::where('ct_categoria_slider_id',4)->get();
        // $banner = banner::find(12)->get();
        return view('tienda::Public.index',compact('productos','banner','categorias','img'));
    }

    public function contacto()
    {
        return view('tienda::Public.contacto');
    }

    public function buscador(Request $request){
        if ($request->texto) {
            $productos = producto::where('nombre','like',$request->texto.'%')->get();
        }
        return view('tienda::layouts.public.search', compact('productos'));
    }

    public function admin(){
        return view('tienda::Admin.index');
    }
    public function ver_direcciones($id)
    {
       $region = Region::pluck('nombre','id');
       $comuna = Comuna::pluck('nombre','id');
       $direccion = DireccionUsuario::where('users_id',$id)->where('activo',1)->get();
       return view('tienda::Public.direccion.index', compact('direccion','region','comuna'));
    }

    public function carro(){
        return view('tienda::Public.carro');
    }

    public function post_carro(Request $request){


        try {
            if (Session::has('carro')) {
                $session = Session::get('carro');
                $array = array(
                    'id'=>$request->id,
                    'nombre'=> $request->nombre,
                    'imagen'=> $request->imagen,
                    'descripcion'=> $request->descripcion,
                    'categoria'=> $request->categoria,
                    'marca'=> $request->marca,
                    'precio'=> $request->precio,
                    'cantidad'=> 1
                );
                array_push($session, $array);
                Session::put('carro',$session);
            }else{
                $prueba = array(0=>[
                    'id'=>$request->id,
                    'nombre'=> $request->nombre,
                    'imagen'=> $request->imagen,
                    'descripcion'=> $request->descripcion,
                    'categoria'=> $request->categoria,
                    'marca'=> $request->marca,
                    'precio'=> $request->precio,
                    'cantidad'=> 1
                    ]
                );
                Session::put('carro',$prueba);
            }

            //return view('tienda::Public.carro');
            Session::flash('mensaje',['content'=>'Producto Agregado','type'=>'primary']);
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect()->back();
        }
    }

    public function eliminar_producto($arrayKey){
        if (Session::has('carro')) {
            if (count(Session::get('carro'))>1) {
                $array = Session::get('carro');
                foreach ($array as $key => $value) {
                    if ($key == $arrayKey) {
                        unset($array[$arrayKey]);
                        Session::put('carro', $array);
                    }
                }
            }else if(count(Session::get('carro'))==1){

                $array = Session::get('carro');
                foreach ($array as $key => $value) {
                    if ($key == $arrayKey) {
                        unset($array[$arrayKey]);
                        Session::put('carro', $array);
                    }
                }
                Session::forget('carro');
            }
        }
        return back();
    }

    public function sumar_producto($arrayKey){
        if (Session::has('carro')) {
            if (count(Session::get('carro'))>=1) {
                $array = Session::get('carro');
                foreach ($array as $key => $value) {
                    if ($key == $arrayKey) {
                        $arrayAux = array($arrayKey=>[
                            'id'=>$value['id'],
                            'nombre'=> $value['nombre'],
                            'imagen'=> $value['imagen'],
                            'descripcion'=> $value['descripcion'],
                            'categoria'=> $value['categoria'],
                            'marca'=> $value['marca'],
                            'precio'=> $value['precio'],
                            'cantidad'=> $value['cantidad']+1
                            ]
                        );
                        Session::put('carro', array_replace($array,$arrayAux));
                    }
                }
            }
        }
        return back();
    }

    public function restar_producto($arrayKey){
        if (Session::has('carro')) {
            if (count(Session::get('carro'))>=1) {
                $array = Session::get('carro');
                foreach ($array as $key => $value) {
                    if ($key == $arrayKey) {
                        if ($value['cantidad']>1) {
                            $arrayAux = array($arrayKey=>[
                                'id'=>$value['id'],
                                'nombre'=> $value['nombre'],
                                'imagen'=> $value['imagen'],
                                'descripcion'=> $value['descripcion'],
                                'categoria'=> $value['categoria'],
                                'marca'=> $value['marca'],
                                'precio'=> $value['precio'],
                                'cantidad'=> $value['cantidad']-1
                                ]
                            );
                            Session::put('carro', array_replace($array,$arrayAux));
                        }else if($value['cantidad']==1) {
                            unset($array[$arrayKey]);
                            Session::put('carro', $array);
                        }
                    }
                }
            }
        }
        return back();
    }

    public function compra(){
        $region = Region::all();
        $direcciones = DireccionUsuario::where('users_id',Auth::user()->id)->pluck('nombre','id');
        return view('tienda::Public.compra',compact('region','direcciones'));
    }

    public function buscar_comuna($id)
    {
        $comuna = Comuna::where('bk_regiones_id',$id)->get();
        return response()->json($comuna);
    }

    public function final_compra(Request $request){

        $codigo = 'TPN'.rand(1111111111, 9999999999);
        $total = 0;
        $usuario = null;
        $region = null;
        $comuna = null;
        $imagen = null;
        $contador = 0;
        $contador = count(User::where('email',$request->correo)->get());
        //$usu = User::where('email',$request->correo)->get();
        //dd($request->correo,$contador,$usu);
        //logica de direccion y otros valores
        if(Session::has('carro')){
            if(Auth::check()){
                if($request->direccion != null){
                    $dir = DireccionUsuario::create([
                        'nombre'=> $request->direccion,
                        'users_id'=> Auth::user()->id,
                        'bk_comunas_id'=>$request->comunas,
                        'bk_regiones_id'=> $request->regiones
                    ]);
                    $region = Region::find($request->regiones);
                    $comuna = Comuna::find($request->comunas);
                }else{
                    //todo cambiar por la que biene desde el request
                    $dir = DireccionUsuario::where('id',$request->mydireccion)->first();
                }
                foreach(Session::get('carro') as $key => $producto){
                    $total = $total +($producto['precio']*$producto['cantidad']);
                }
                $usuario = Auth::user()->id;
            }else{
                if ($contador > 0) {
                    $usu = User::where('email',$request->correo)->first();
                    $usuario = $usu->id;
                    if($request->direccion != null){
                        $dir = DireccionUsuario::create([
                            'nombre'=> $request->direccion,
                            'users_id'=> $usuario,
                            'bk_comunas_id'=>$request->comunas,
                            'bk_regiones_id'=> $request->regiones
                        ]);
                        $region = Region::find($request->regiones);
                        $comuna = Comuna::find($request->comunas);
                    }else{
                        $dir = DireccionUsuario::where('users_id',$usuario)->first();
                    }
                }else{
                    $user = User::create([
                        'name'=> $request->nombre,
                        'apellido'=> $request->apellido,
                        'rut'=> $request->rut,
                        'dv'=> $request->dv,
                        'telefono'=> $request->telefono,
                        'email'=> $request->correo
                    ]);
                    $usuario = $user->id;

                    $dir = DireccionUsuario::create([
                        'nombre'=> $request->direccion,
                        'users_id'=> $usuario,
                        'bk_comunas_id'=>$request->comunas,
                        'bk_regiones_id'=> $request->regiones
                    ]);

                    $region = Region::find($request->regiones);
                    $comuna = Comuna::find($request->comunas);
                    //$msj = "ahora eres parte de la gran comunidad Midas, Reciclemos futuro juntos";
                    //Mail::to($request->correo)->send(new EnviarConfirmacionUser($msj,$nombre,$apellido));
                }

                foreach(Session::get('carro') as $key => $producto){
                    $total = $total +($producto['precio']*$producto['cantidad']);
                }
            }
        }



        //transaccion
        $transaccion =  transaccion::create([
            'codigo'=> $codigo,
            'total'=>$total,
            'users_id'=>$usuario,
            'bk_direcciones_user_id' => $dir->id,
            'bk_estatus_id'=> 4,
            'estado'=> 'por pagar'

        ]);

        // dd($transaccion);
        //Venta

        if(Session::has('carro')){
            foreach(Session::get('carro') as $key => $producto){
                $venta = venta::create([
                    'td_productos_id'=> $producto['id'],
                    'cantidad' => $producto['cantidad'],
                    'venta_fuera_id' => 2
                ]);
                if ($request->file('regaloimagen')) {
                    $imagen =  $request->file('regaloimagen')->store('public/img/regalos');
                    $url = Storage::url($imagen);


                }else{
                   $imagenNombre = NULL;
                }
                $regalo = regalo::create([
                    'nota'=> $request->nota,
                    'imagen' => $imagen,
                    'ventas_id' => $venta->id
                ]);
                ventaTransaccion::create([
                    'ventas_id'=> $venta->id,
                    'transacciones_id'=> $transaccion->id
                ]);
            }
        }

        //$producto = Session::get('carro');
        //$msj = "Nuestro equipo de MidasChile se pondra en contacto contigo a la brevedad";
        //Mail::to('ivansaez_31@hotmail.com')->send(new EnviarConfirmacion($producto,$msj,$direccion,$comuna,$region));

        //WIP se debe reemplazar con el valor del codigo de la transacciÃƒÂ³n
        return redirect('payments/gateway/webpay/transaction/'.$codigo);
        //return view('tienda::Public.exito',compact('request','transaccion','region','comuna'));
    }
    public function region_comuna($region, $comuna)
    {
        $region = Region::find($region);
        $comuna = Comuna::find($comuna);
        return response()->json(['region'=>$region,'comuna'=>$comuna]);

    }

    public function finalizar(){
        Session::forget('carro');
        $productos = producto::where('bk_estados_id',12)->get();
        $categorias =categorias::all();
        $img = ImagenSlider::where('ct_categoria_slider_id',4)->get();

        //home
        $banner =banner::find(6);
        return view('tienda::Public.index',compact('productos','banner','categorias','img'));
    }

    public function seguimiento($id){

        $boleta = boleta::find($id);
        return view('tienda::Public.seguimiento_retiro',compact('boleta'));
    }

    public function ordenes(){
        setlocale(LC_ALL, 'es_ES');
        $transacciones = Transaccion::where('users_id',Auth::id())->get();
        $ventaTransaccion = ventaTransaccion::all();
        //$ventas = Venta::all();

        $usuario_logueado = Transaccion::where('users_id',Auth::user()->id)->pluck('id');

        // dd($usuario_logueado);
        $venta_tr = ventaTransaccion::wherein('transacciones_id',$usuario_logueado)->get();
        ;

        $boletas = boleta::where('users_id',Auth::user()->id)->orderby('updated_at','desc')->get();

        return view('tienda::Public.ordenes_de_compra',compact('transacciones','ventaTransaccion','boletas','venta_tr'));
    }

    public function certificados(){
        $boletas = boleta::where('users_id',Auth::user()->id)->orderby('updated_at','desc')->where('bk_estados_id',2)->get();

        return view('tienda::Public.certificados',compact('boletas'));
    }

    public function mi_cuenta(){

        $region = Region::all();
        $foto = User::where('id', Auth::user()->id)->get();
        return view('tienda::Public.mi-cuenta',compact('foto','region'));
    }
    public function servicios(){
        return view('tienda::Public.servicios');
    }
    public function productos(){
        $productos = producto::where('bk_estados_id',12)->get();
        return view('tienda::Public.productos',compact('productos'));
    }
    public function single_producto($id){
        $comentario = comentarios::where('td_productos_id',$id)->get();
        $producto = producto::find($id);
        $des = descuentos::where('td_productos_id',$id)->pluck('id');


        $count_1estrella=  comentarios::where('td_productos_id',$id)->where('voto',1)->get();
        $contador_1estrella = count($count_1estrella);

        $count_2estrella=  comentarios::where('td_productos_id',$id)->where('voto',2)->get();
        $contador_2estrella = count($count_2estrella);

        $count_3estrella=  comentarios::where('td_productos_id',$id)->where('voto',3)->get();
        $contador_3estrella = count($count_3estrella);

        $count_4estrella=  comentarios::where('td_productos_id',$id)->where('voto',4)->get();
        $contador_4estrella = count($count_4estrella);

        $count_5estrella=  comentarios::where('td_productos_id',$id)->where('voto',5)->get();
        $contador_5estrella = count($count_5estrella);

        $total_estrella = $contador_1estrella+$contador_2estrella+$contador_3estrella+$contador_4estrella+$contador_5estrella;


        $sumatoria = DB::table("reviews")->sum('voto');


        if ($total_estrella == 0) {
          $prom_final=0;
        } else {
            $prom = $sumatoria/$total_estrella;
            $prom_final = number_format($prom);
        }

        if ($total_estrella != 0)
        {

            $numero5 = ($contador_5estrella/$total_estrella)*10;
            $numero_cinco= ($numero5/2);
            $numero_5= intval($numero_cinco);

             // 4 Estrella
            $numero4 = ($contador_4estrella/$total_estrella)*10;
            $numero_cuatro= ($numero4/2);
            $numero_4= intval($numero_cuatro);
            //3 Estrella
            $numero3 = ($contador_3estrella/$total_estrella)*10;
            $numero_tres= ($numero3/2);
            $numero_3= intval($numero_tres);
            //2 Estrella
            $numero2 = ($contador_2estrella/$total_estrella)*10;
            $numero_dos= ($numero2/2);
            $numero_2= intval($numero_dos);
            //1 Estrella
            $numero1 = ($contador_1estrella/$total_estrella)*10;
            $numero_uno= ($numero1/2);
            $numero_1= intval($numero_uno);
        }
        else
        {
            $numero_1=0;
            $numero_2=0;
            $numero_3=0;
            $numero_4=0;
            $numero_5=0;
        }
        $producto = producto::find($id);
        $pro = producto::where('id',$id)->first();
        $comentarios = count(comentarios::where('td_productos_id',$id)->get());
        $productos = producto::where('bk_estados_id',12)->get();
        return view('tienda::Public.single-producto',compact('pro','producto','productos','comentarios','prom_final'));
    }
    public function rut_verificar($rut)
    {
        $verificar = new VerificarRutAction();
        $a = $verificar->execute($rut);
        return response()->json($a);
    }
    public function productos_categorias($id)
    {
        $producto = producto::where('td_categorias_id',$id)->get();
        $nombre_categoria = producto::find($id);
        return view('tienda::Public.productos_categorias',compact('producto','nombre_categoria'));
    }
    public function actualizar(Request $request)
    {
        try{

            $users = User::find(Auth::user()->id);
            $users->fill($request->all());
            $users->save();

            $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $ran_sol = substr(str_shuffle($permit),0,6);
            if ($request->hasFile('foto')) {
                foreach ($request->foto as $key => $value) {
                    $random_nombre = substr(str_shuffle($permit),0,12);
                    $extension = pathinfo($value->getClientOriginalName(),PATHINFO_EXTENSION );
                    $nombre = $random_nombre.'.'.$extension;
                    $url = 'perfil/'.$users->id;

                    $users_file = User::find($users->id);
                    $users_file->foto = $url.'/'.$nombre;
                    $users_file->save();
                    $ruta= Storage::putFileAs($url,$value,$nombre);
                }
            }

           Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
           return redirect::back();
        }catch(\Throwable $th){
            Session::flash('mensaje',['content'=>'Datos no pudieron ser actualizados','type'=>'danger']);
           return redirect::back();
        }
        // else
        // {
        //     $users = User::find(Auth::user()->id);
        //     $users->fill($request->all());
        //    // $foto =  $request->file('foto')->store('public/perfil');
        //     //$url = Storage::url($foto);
        //    // $users->foto = $url;
        //     $users->save();
        //     $dir = DireccionUsuario::create([
        //         'nombre'=> $request->direccion,
        //         'users_id'=> Auth::user()->id,
        //         'bk_comunas_id'=>$request->bk_comunas_id,
        //         'bk_regiones_id'=> $request->bk_regiones_id
        //         ]);
        //     Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
        //     return redirect::back();
        // }
    }
    public function actualizar_contraseña(Request $request)
    {
        $users = User::find(Auth::user()->id);
        if (password_verify($request->old_ps, $users->password)) {
            if ($request->password1 == $request->password2) {
                $users->password = bcrypt($request->password1);
                $users->save();
                Session::flash('mensaje',['content'=>'Contraseña Actualizada','type'=>'primary']);
            }
            else{
                Session::flash('mensaje',['content'=>'Las contraseñas no coinciden','type'=>'danger']);
            }
        }
        else{
            Session::flash('mensaje',['content'=>'Contraseña incorrecta','type'=>'danger']);
        }
        return redirect::back();
    }

    public function getVentaCortaPaso1($id){
        // paso 1 mostras bienvenida y el producto
        // $transaccion = transaccion::find(214);
        // Mail::to($transaccion->ventas_fuera->correo)->send(new MailConfirmarVentaCortaWebpay($transaccion));

        $producto = producto::find($id);
        return view('tienda::Public.venta.ventaCortaP1',compact('producto'));

    }
    public function VentaCortaPaso1(){
        $producto = producto::find(19);
        return view('tienda::Public.venta.ventaCortaP1',compact('producto'));

    }


    public function getVentaCortaPaso2($id){
        // paso 2 ingresar, telefono,Direccion
        $producto = producto::find($id);
        $region = Region::all();
        return view('tienda::Public.venta.ventaCortaP2',compact('producto','region'));
    }

    public function getVentaCortaPaso3($id){
        // paso 3 metodos de pago
        $producto = producto::find($id);
        if(Session::has('sesion_comprador_externo')){
            $despacho = Despacho::where('bk_comunas_id',Session::get('sesion_comprador_externo')['bk_comunas_id'])->first();
        }elseif(Session::has('sesion_comprador_externo_new')){
            $despacho = Despacho::where('bk_comunas_id',Session::get('sesion_comprador_externo_new')->bk_comunas_id)->first();
        }else{
            return redirect::to('tienda/venta-corta/producto/'.$id.'/paso-2');
        }
        return view('tienda::Public.venta.ventaCortaP3',compact('producto','despacho'));
    }

    public function getVentaCortaPaso4($id){
        // paso 4 resumen y pagar
        $producto = producto::find($id);
        if(Session::has('sesion_pago_externo')){
            if(Session::has('sesion_comprador_externo')){
                $venta_fuera = new VentaFuera();
                $venta_fuera->nombre = Session::get('sesion_comprador_externo')['nombre'];
                $venta_fuera->telefono = Session::get('sesion_comprador_externo')['telefono'];
                $venta_fuera->correo = Session::get('sesion_comprador_externo')['correo'];
                $venta_fuera->bk_regiones_id = Session::get('sesion_comprador_externo')['bk_regiones_id'];
                $venta_fuera->bk_comunas_id = Session::get('sesion_comprador_externo')['bk_comunas_id'];
                $venta_fuera->direccion = Session::get('sesion_comprador_externo')['direccion'];;
                $venta_fuera->detalle = Session::get('sesion_comprador_externo')['detalle'];;
                $venta_fuera->save();
                Session::put('sesion_comprador_externo_new',$venta_fuera);
                Session::forget('sesion_comprador_externo');
            }elseif(Session::has('sesion_comprador_externo_new')){
                $venta_fuera = VentaFuera::find(Session::get('sesion_comprador_externo_new')->id);  
            }else{
                return redirect::to('tienda/venta-corta/producto/'.$id.'/paso-2');
            }

            if (Session::get('sesion_pago_externo')[0]['creditcard'] == 'webpay') {
                $trans =  transaccion::where('ventas_fuera_id',$venta_fuera->id)->get();
                if($trans->count() == 0){
                    $codigo = 'TPC'.rand(1111111111, 9999999999);
                    do {
                        $codigo_random = 'VSP'.rand(100000, 999999);
                        $venta_count = venta::where('codigo',$codigo_random)->count();
                    }while ($venta_count != 0);

                    //transaccion
                    $transaccion =  transaccion::create([
                        'codigo'=> $codigo,
                        'total'=>Session::get('sesion_pago_externo')[0]['valor_total'],
                        'bk_estatus_id'=> 4,
                        'estado'=> 'incompleta',
                        'ventas_fuera_id'=>Session::get('sesion_comprador_externo_new')->id
                    ]);

                    //Venta
                    $venta = venta::create([
                        'td_productos_id'=> Session::get('sesion_pago_externo')[0]['producto_id'],
                        'cantidad' => Session::get('sesion_pago_externo')[0]['cantidad'],
                        'tipo_venta_id' => 1,
                        'ventas_fuera_id'=>Session::get('sesion_comprador_externo_new')->id,
                        'total'=>Session::get('sesion_pago_externo')[0]['valor_total'],
                        'tipo_pago'=>Session::get('sesion_pago_externo')[0]['creditcard'],
                        'bk_despacho_id'=>Session::get('sesion_pago_externo')[0]['despacho_id'],
                        'despacho_valor'=>Session::get('sesion_pago_externo')[0]['despacho_valor'],
                        'bk_estatus_id'=>4,
                        'estado'=> 'incompleta',
                        'codigo'=>$codigo_random
                    ]);

                    ventaTransaccion::create([
                        'ventas_id'=> $venta->id,
                        'transacciones_id'=> $transaccion->id
                    ]);
                }else{
                    $codigo = $trans->first()->codigo;
                    $transaccion = transaccion::find($trans->first()->id);
                    $transaccion->total = Session::get('sesion_pago_externo')[0]['valor_total'];
                    $transaccion->save();

                    $ven =  venta::where('ventas_fuera_id',$venta_fuera->id)->get();
                    if($ven->count() == 0){
                        $venta = venta::create([
                            'td_productos_id'=> Session::get('sesion_pago_externo')[0]['producto_id'],
                            'cantidad' => Session::get('sesion_pago_externo')[0]['cantidad'],
                            'tipo_venta_id' => 1,
                            'ventas_fuera_id'=>Session::get('sesion_comprador_externo_new')->id,
                            'total'=>Session::get('sesion_pago_externo')[0]['valor_total'],
                            'tipo_pago'=>Session::get('sesion_pago_externo')[0]['creditcard'],
                            'bk_despacho_id'=>Session::get('sesion_pago_externo')[0]['despacho_id'],
                            'despacho_valor'=>Session::get('sesion_pago_externo')[0]['despacho_valor'],
                            'bk_estatus_id'=>4,
                            'estado'=> 'incompleta',
                            'codigo'=>$codigo_random
                        ]);
                    }else{
                        $venta = venta::find($ven->first()->id);
                        $venta->cantidad = Session::get('sesion_pago_externo')[0]['cantidad'];
                        $venta->total = Session::get('sesion_pago_externo')[0]['valor_total'];
                        $venta->tipo_pago = Session::get('sesion_pago_externo')[0]['creditcard'];
                        $venta->bk_despacho_id = Session::get('sesion_pago_externo')[0]['despacho_id'];
                        $venta->despacho_valor = Session::get('sesion_pago_externo')[0]['despacho_valor'];
                        $venta->save();
                    }
                }
                    $created_transaction = new WebpayPlus();
                    $response = $created_transaction->createdTransaction($codigo);
            }else{
                $ven =  venta::where('ventas_fuera_id',$venta_fuera->id)->get();
                if($ven->count() == 0){
                    do {
                        $codigo_random = 'VSP'.rand(100000, 999999);
                        $venta_count = venta::where('codigo',$codigo_random)->count();
                    }while ($venta_count != 0);
                    
                    //Venta 
                    $venta = venta::create([
                        'td_productos_id'=> Session::get('sesion_pago_externo')[0]['producto_id'],
                        'cantidad' => Session::get('sesion_pago_externo')[0]['cantidad'],
                        'tipo_venta_id' => 1,
                        'ventas_fuera_id'=>Session::get('sesion_comprador_externo_new')->id,
                        'total'=>Session::get('sesion_pago_externo')[0]['valor_total'],
                        'tipo_pago'=>Session::get('sesion_pago_externo')[0]['creditcard'],
                        'bk_despacho_id'=>Session::get('sesion_pago_externo')[0]['despacho_id'],
                        'despacho_valor'=>Session::get('sesion_pago_externo')[0]['despacho_valor'],
                        'bk_estatus_id'=>4,
                        'estado'=>'por pagar',
                        'mail'=>0,
                        'codigo'=>$codigo_random
                    ]);
                }else{
                    $venta = venta::find($ven->first()->id);
                    $venta->cantidad = Session::get('sesion_pago_externo')[0]['cantidad'];
                    $venta->total = Session::get('sesion_pago_externo')[0]['valor_total'];
                    $venta->tipo_pago = Session::get('sesion_pago_externo')[0]['creditcard'];
                    $venta->bk_despacho_id = Session::get('sesion_pago_externo')[0]['despacho_id'];
                    $venta->despacho_valor = Session::get('sesion_pago_externo')[0]['despacho_valor'];
                    $venta->save();
                }
                $response = $venta->id;
            }
        }else{
            return redirect::to('tienda/venta-corta/producto/'.$id.'/paso-3');  
        }
        

        return view('tienda::Public.venta.ventaCortaP4',compact('producto','venta_fuera','response'));
    }

    public function final_compra_webpay(){

        // XXXXX migradon al paso 4

        $send = Http::post($response->url, [
            'token_ws' => $response->token,
            
        ]);

        return $send;
        
        //$return = Redirect::to($response->url)->with(['token' => $response->token]);

        
        

        //return redirect($response->url, ['token'=>$response->token]);
        //return redirect($response->url.'/?token='.$response->token);

         //      dd($response->token);
        //return redirect('payments/gateway/webpay/transaction/'.$codigo);
    }

    public function final_compra_rapida($id){
        $venta = venta::find($id);
        if($venta->ventas_fuera->correo != null){
            try{
                if($venta->mail == 0){
                    Mail::to($venta->ventas_fuera->correo)->send(new MailConfirmarVentaCorta($venta));
                    $venta->mail = 1;
                    $venta->save();
                }
            }catch(\Throwable $th){
                Log::info('Fallo Mail de Compra');
            }
            
        }

        $SMS = new ServiceSendSMSsinPago();
        $response = $SMS->getResponsePago($venta->id);
        Session::forget('sesion_pago_externo');
        Session::forget('sesion_comprador_externo');
        Session::forget('sesion_comprador_externo_new');
        return view('tienda::Public.venta.exito_sinpago', compact('venta'));
    }
    
}
