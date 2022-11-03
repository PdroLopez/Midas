<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Login\Entities\Region;
use Modules\Login\Entities\Comuna;
use Modules\Tienda\Entities\Transaccion;
use Modules\Tienda\Entities\Producto as producto;
use Modules\Tienda\Entities\Ventas as venta;
use Modules\Tienda\Entities\VentaTransaccion as ventaTransaccion;
use Modules\Payments\Http\Controllers\WebpayPlusController as CommitWebpay;
use App\Services\ServiceSendSMS;
use App\Mail\MailConfirmarVentaCortaWebpay;
use App\Mail\MailConfirmarRetiroCortoWebPay;
use App\Mail\MailKitMidasVCW;
use Modules\Workflow\Entities\Boleta;
use Session;
use Mail;
use Log;
use App\DireccionUsuario;
use App\Mail\MailDeCreacionUsuario;
use App\User;
use Auth;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('payments::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('payments::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('payments::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('payments::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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

    public function responseTransaccion(Request $request, $transaccionCodigo){
    
        // dd($transaction_id);
        try {
            $region = Region::find(1);
            $comuna = Comuna::find(1);
            $transaction_id = $transaccionCodigo;
            $commit = new CommitWebpay();
            $req = $request->except('_token');
            $response = $commit->commitTransaction($req["token_ws"]);
            // dd($response);
            $transaccion = Transaccion::where('codigo', $transaccionCodigo)->first();
            // dd($transaccion);
            //venta corta 
            $url_usar = url('p/'.$transaccionCodigo);
            //TODO: FALTA VERIFICAR SI LA TRANSACCION YA SE PAGO

            //traer los datos de la compra y tarjeta
            switch ($response->paymentTypeCode) {
                case 'VN':
                    $tipo_tarjeta = 'Credito';
                    break;
                case 'S2':
                    $tipo_tarjeta = 'Credito Cuotas Sin Intereses';
                    break;
                case 'SI':
                    $tipo_tarjeta = 'Credito Cuotas Sin Intereses';
                    break;
                case 'NC':
                    $tipo_tarjeta = 'Credito';
                    break;
                case 'VC':
                    $tipo_tarjeta = 'Credito';
                    break;
                case 'VD':
                    $tipo_tarjeta = 'RedCompra';
                    break;
                case 'TH':
                    $tipo_tarjeta = 'Tarjeta Habiente';
                    break;
            }
            $Ntarjeta = $response->cardDetail['card_number'];
            $cuotas = $response->installmentsNumber;

            // dd($response->responseCode,$transaccion->estado);
            if ( $response->responseCode == 0 && $transaccion->estado != "pagado") {
                $transaccion->estado = 'pagado';
                $transaccion->save();

              

            }else if($transaccion->estado != "pagado"){

                 switch ($response->responseCode) {
                     case -1:
                         $transaccion->estado = 'rechazado';
                         break;
                     case -2:
                         $transaccion->estado = 'Transacción debe reintentarse';
                         break;
                     case -3:
                         $transaccion->estado = 'Error en transacción';
                         break;
                     case -4:
                         $transaccion->estado = 'Rechazo de transacción';
                         break;
                     case -5:
                         $transaccion->estado = 'Rechazo por error de tasa';
                         break;
                     case -6:
                         $transaccion->estado = 'Excede cupo máximo mensual';
                         break;
                     case -7:
                         $transaccion->estado = 'Excede límite diario por transacción';
                         break;
                     case -8:
                         $transaccion->estado = 'Rubro no autorizado';
                         break;
                 }
                $transaccion->save();
            }        

            $ventas = ventaTransaccion::where('transacciones_id',$transaccion->id)->get();
               

            if ($transaccion->estado == 'pagado') {
                $transaccion->typecode = $response->paymentTypeCode;
                $transaccion->tipo_tarjeta = $tipo_tarjeta;
                $transaccion->n_tarjeta = $Ntarjeta;
                if($cuotas != 0){
                    $transaccion->cuotas = $cuotas;
                }else{
                    $transaccion->cuotas = 1;
                }
                $transaccion->save();
                if ($ventas->count() != 0) {
                    $venta = venta::find($ventas[0]->ventas_id);
                    $venta->estado = 'pagado';
                    $venta->save();
                }else{
                    $ventas = null;
                }

                try{
                    if($transaccion->ventas_fuera_id != null){
                        if($transaccion->ventas_fuera->correo != null){
                            if($transaccion->mail == 0){
                                Mail::to($transaccion->ventas_fuera->correo)->send(new MailConfirmarVentaCortaWebpay($transaccion));
                                $transaccion->mail = 1;
                                $transaccion->save();
                            }
                        }
                    }
                }catch(\Throwable $th){
                    $transaccion->mail = 0;
                    $transaccion->save();
                    Log::info('Fallo Mail de Compra');
                }
                if($transaccion->sms != 1){
                    $SMS = new ServiceSendSMS();
                    $response = $SMS->getResponsePago($transaccionCodigo);
                }

                if ($transaccion->boletas_id != null) {
                $boleta = Boleta::find($transaccion->boletas_id);
                if ($boleta->users_id != null) {
                    $user = User::find($boleta->users_id);
                    try{
                        if($transaccion->boleta->correo != null){
                            if($transaccion->mail == 0){
                                Mail::to($transaccion->boleta->correo)->send(new MailConfirmarRetiroCortoWebPay($transaccion));
                                $transaccion->mail = 1;
                                $transaccion->save();
                            }
                            
                        }
                    }catch(\Throwable $th){
                        $transaccion->mail = 0;
                        $transaccion->save();
                        Log::info('Fallo Mail de Solicitud Webpay');
                    }
                }else{
                    $password_random = rand(111111, 999999);
                    $user = new User();
                    $user->roles_id = 19;
                    $user->password = bcrypt($password_random);
                    $user->email = $boleta->correo;
                    $user->telefono = $boleta->telefono;
                    $user->name = $boleta->nombre;
                    $user->save();

                    $comuna_result = Comuna::find($boleta->comuna_id);

                    $direccion = new DireccionUsuario();
                    $direccion->nombre = $boleta->direccion_rc;
                    $direccion->bk_comunas_id = $boleta->comuna_id;
                    $direccion->bk_regiones_id = $comuna_result->bk_regiones_id;
                    $direccion->activo = 1;
                    $direccion->users_id = $user->id;
                    $direccion->save();

                    $boleta->users_id = $user->id;
                    $boleta->creador_id = $user->id;
                    $boleta->save();

                    try{
                        if($transaccion->boleta->correo != null){
                            if($transaccion->mail == 0){
                                Mail::to($transaccion->boleta->correo)->send(new MailConfirmarRetiroCortoWebPay($transaccion));
                                $transaccion->mail = 1;
                                $transaccion->save();
                            }
                            
                        }
                    }catch(\Throwable $th){
                        $transaccion->mail = 0;
                        $transaccion->save();
                        Log::info('Fallo Mail de Solicitud Webpay');
                    }

                    try{
                        Mail::to($user->email)->send(new MailDeCreacionUsuario($user,$password_random));
                    }catch(\Throwable $th){
                        Log::info('Fallo Mail de Usuario Webpay');
                    }
                }
                
            }

                if ($transaccion->ventas_fuera_id != null) {
                    Session::forget('sesion_pago_externo');
                    Session::forget('sesion_comprador_externo');
                    Session::forget('sesion_comprador_externo_new');
                    return view('tienda::Public.venta.exito',compact('transaccion','region','comuna','ventas','tipo_tarjeta','Ntarjeta','cuotas'));
                    
                }else{
                    if ($transaccion->boletas_id != null) {
                        Session::forget('foto_acceso_corto');
                        Session::forget('acceso_retiro_corto');
                        Session::forget('foto_retiro_corto');
                        Session::forget('prod_retiro_corto');
                        Session::forget('sesion_datos_retiro');
                        Session::forget('tipo_retiro_horario');
                        Session::forget('nueva_direccion');
                        Session::forget('datos_pago_retiro');
                        Session::forget('todos_id_guardados');
                        Session::forget('combo_elegido');
                        Session::forget('combo_retiro_corto');
                        Session::forget('combo_retiro_elegidos');
                        Session::forget('foto_combo_retiro_corto');

                        return view('retirocorto.exito',compact('transaccion','boleta','tipo_tarjeta','Ntarjeta','cuotas'));
                    }else{
                        return view('tienda::Public.exito',compact('transaccion','region','comuna','ventas'));
                    }
                }
            }else{
                if ($transaccion->ventas_fuera_id != null) {
                    Session::forget('sesion_pago_externo');
                    Session::forget('sesion_comprador_externo');
                    Session::forget('sesion_comprador_externo_new');
                    return view('tienda::Public.venta.fracaso',compact('transaccion','region','comuna','ventas','tipo_tarjeta','Ntarjeta','cuotas'));
                    
                }else{
                    if ($transaccion->boletas_id != null) {
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

                        return view('retirocorto.fracaso',compact('transaccion','boleta','tipo_tarjeta','Ntarjeta','cuotas'));
                    }else{
                        return view('tienda::Public.fracaso',compact('transaccion','region','comuna','ventas'));
                    }
                }

            }
            
        } catch (\Exception $e) {
            $transaction_id = $transaccionCodigo;
            $transaccion = Transaccion::where('codigo', $transaccionCodigo)->first();
            $ventas = ventaTransaccion::where('transacciones_id',$transaccion->id)->get();
            $tipo_tarjeta = $transaccion->tipo_tarjeta;
            $Ntarjeta = $transaccion->n_tarjeta;
            $cuotas = $transaccion->cuotas;   
            if($transaccion->estado != 'pagado'){
                $transaccion->estado = 'Error en transacción';
                $transaccion->save();

                $region = Region::find(1);
                $comuna = Comuna::find(1);
                $tipo_tarjeta = 'Error en Transaccion';
                $Ntarjeta = 'Error en Transaccion';
                $cuotas = 0;
                if ($transaccion->ventas_fuera_id != null) {  
                    Session::forget('sesion_pago_externo');
                    Session::forget('sesion_comprador_externo');
                    Session::forget('sesion_comprador_externo_new');
                    return view('tienda::Public.venta.fracaso',compact('transaccion','region','comuna','ventas','tipo_tarjeta','Ntarjeta','cuotas'));
                    
                }else{
                    if ($transaccion->boletas_id != null) {
                        $boleta = Boleta::find($transaccion->boletas_id);
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
                        
                        return view('retirocorto.fracaso',compact('transaccion','boleta','tipo_tarjeta','Ntarjeta','cuotas'));
                    }else{
                        return view('tienda::Public.fracaso',compact('transaccion','region','comuna','ventas'));
                    }
                }
            }else{
                if ($transaccion->ventas_fuera_id != null) {
                    return view('tienda::Public.venta.exito',compact('transaccion','ventas','tipo_tarjeta','Ntarjeta','cuotas')); 
                }else{
                    if ($transaccion->boletas_id != null) {
                        return view('retirocorto.exito',compact('transaccion','boleta','tipo_tarjeta','Ntarjeta','cuotas'));
                    }else{
                        return view('tienda::Public.exito',compact('transaccion','region','comuna','ventas'));
                    }
                }
            }
            
        }


    }
}
