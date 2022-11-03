<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

use Freshwork\Transbank\RedirectorHelper;
use Freshwork\Transbank\WebpayNormal;
use Freshwork\Transbank\WebpayOneClick;
use Freshwork\Transbank\CertificationBagFactory;  
use Freshwork\Transbank\TransbankServiceFactory;
use Modules\Tienda\Entities\Transaccion;
use Modules\Payments\Http\Controllers\WebpayPlusController as CommitWebpay;


use Log;
use Sessions;

class WebpayController extends Controller
{
    
    /**
     * Inicia una transacción
     * @param $transactionCodigo
     * @param WebpayNormal $webpayNormal
     * @return string
     * @throws \Freshwork\Transbank\Exceptions\EmptyTransactionException
     * @throws \Freshwork\Transbank\Exceptions\InvalidCertificateException
     * @throws \SoapFault
     */
    public function transaction($transactionCodigo, WebpayNormal $webpayNormal){
        Log::info('Proceso de paso');

        //TODO se debe sacar el codigo es solo para una muestra
       // $transactionCodigo = "t_G32934";
        $transaccion = Transaccion::where('codigo', $transactionCodigo)->first();

        Log::info('1');

        $data = [
            'price' => $transaccion->total,
            'id' => $transaccion->codigo,
        ];
        Log::info('2');

 
         if (ENV('APP_ENV')==='production') {
        Log::info('produccion');
        Log::info(storage_path().'/app/certs/normal/client.key');
        

            $bag =  CertificationBagFactory::production(storage_path().'/app/certs/normal/client.key', storage_path().'/app/certs/normal/client.crt'); 
         }else {
        Log::info('no produccion');

            $bag = CertificationBagFactory::integrationWebpayNormal();  
         }
        $webpayNormal = TransbankServiceFactory::normal($bag);
        $webpayNormal->addTransactionDetail($data['price'], $data['id']);
        $response = $webpayNormal->initTransaction(
            route('gateway.webpay.response', $transaccion->codigo),
            route('gateway.webpay.finish', $transaccion->codigo)
        );

        
        return RedirectorHelper::redirectHTML($response->url, $response->token);
    }

    /**
     * Se llama cuando ocurre un error, se rechaza o termina con exito
     * @param Request $request
     * @param $transactionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(Request $request, $transaccionId){
        //WIP le saque el request puede se r que esta ruta sea doble finish t
        $response = session('response');

        session()->forget('response');
        session()->save();
        $transaccion = Transaccion::where('codigo', $transaccionId)->first();
        //comision
        //$transbank = Configuracion::where('variable','comision_transbank')->first();
        //$wooy = Configuracion::where('variable','comision_wooy')->first();
        //$transaccion->costo_tercero = $transaccion->total * ($transbank->valor/100);
        //$transaccion->costo_wooy = $transaccion->total * ($wooy->valor/100);
        //$transaccion->costo_total = $transaccion->costo_tercero + $transaccion->costo_wooy;
        //$transaccion->total_cliente = $transaccion->total - $transaccion->costo_total;

        if(!$response){
            $transaccion->estado = 'cancelado';
        }else{
            if($response->detailOutput->responseCode == 0){
                //pagado
                Log::info('pagado');
    //            Mail::to($transaccion->cliente->correo)->send(new PorPago($transaccion));
   //             Mail::to($transaccion->cliente->empresa->responsable->email)->send(new PorPago($transaccion));
                //Log::info($response->detailOutput);

                


            }else{
                //no pagado
                Log::info('no pagado');
//                Mail::to($transaccion->cliente->correo)->send(new PorNoPago($transaccion));
//                Mail::to($transaccion->cliente->empresa->responsable->email)->send(new PorNoPago($transaccion));
                //Log::info($response->detailOutput);
            }
        }

        $transaccion->save();
        Log::info('termino del pago');
        Log::info($transaccion->return_url."".$transaccion->codigo);
        $url = 'tienda/compra/return/';
        return Redirect::away($url. "".$transaccion->codigo);

        if ($transaccion->return_url == NULL) {
             return view('empresa.finish')->with([
             'transaccion' => $transaccion,
                ]);
        }else{

            //WIP parametrizar este valor
            
        
            return Redirect::away($transaccion->return_url. "".$transaccion->codigo);
               
        }

      //RETURN ANTIGUO
        //return Redirect::away($transaccion->return_url. "?transaction_id=".$transaccion->codigo);

        //RETURN NUEVO
    //     return view('empresa.finish')->with([
    //         'transaccion' => $transaccion,
    //     ]);
    // }
        

        }

  

    /**
     * @param Request $request
     * @param $transaccionCodigo
     * @param WebpayNormal $webpayNormal
     * @return string
     * @throws \Freshwork\Transbank\Exceptions\InvalidCertificateException
     * @throws \SoapFault
     */
    public function response(Request $request, $transaccionCodigo){

//         Falta velidar con mayor seguridad el config_path()

//   +vci: "TSY"
//   +amount: 20990
//   +status: "AUTHORIZED"
//   +buyOrder: "t_8648042078"
//   +sessionId: "S9hxoBVyA0YTpsyEUT0TjYm43E0M5nVadwyFDECe"
//   +cardDetail: array:1 [▶]
//   +accountingDate: "0403"
//   +transactionDate: "2021-04-03T04:14:21.820Z"
//   +authorizationCode: "1213"
//   +paymentTypeCode: "VN"
//   +responseCode: 0
//   +installmentsAmount: null
//   +installmentsNumber: 0
//   +balance: null



        // $commit = new CommitWebpay();
        // $req = $request->except('_token');
        // $response = $commit->commitTransaction($req["token_ws"]);
        // $transaccion = Transaccion::where('codigo', $transaccionCodigo)->first();

        // //TODO: FALTA VERIFICAR SI LA TRANSACCION YA SE PAGO
        // if ( $response->responseCode == 0 && $transaccion->estado != "pagado") {
        //     $transaccion->estado = 'pagado';
        //     $transaccion->save();

        // }else if($transaccion->estado != "pagado"){

        //      switch ($response->responseCode) {
        //          case -1:
        //              $transaccion->estado = 'rechazado';
        //              break;
        //          case -2:
        //              $transaccion->estado = 'Transacción debe reintentarse';
        //              break;
        //          case -3:
        //              $transaccion->estado = 'Error en transacción';
        //              break;
        //          case -4:
        //              $transaccion->estado = 'Rechazo de transacción';
        //              break;
        //          case -5:
        //              $transaccion->estado = 'Rechazo por error de tasa';
        //              break;
        //          case -6:
        //              $transaccion->estado = 'Excede cupo máximo mensual';
        //              break;
        //          case -7:
        //              $transaccion->estado = 'Excede límite diario por transacción';
        //              break;
        //          case -8:
        //              $transaccion->estado = 'Rubro no autorizado';
        //              break;
        //      }
        //     //$transaccion->estado = 'rechazado';
        //     $transaccion->save();
        // }        
         return Redirect::action('UserController@profile', array(1));
    }

    public function addCard($tarjetaCodigo, WebpayOneClick $webpayOneClick){
        $tarjeta = Tarjetas::where('codigo', $tarjetaCodigo)->first();

        $response = $webpayOneClick->initInscription($tarjeta->cliente->correo, $tarjeta->cliente->correo, route('gateway.webpay.responseCard', $tarjetaCodigo));

        return RedirectorHelper::redirectHTML($response->urlWebpay, $response->token);
    }

    public function responseCard($tarjetaCodigo, WebpayOneClick $webpayOneClick){
        $tarjeta = Tarjetas::where('codigo', $tarjetaCodigo)->first();

        $response = $webpayOneClick->finishInscription();

        if($response->responseCode == 0){
            $tarjeta->estado = CreateTarjetaClienteAction::ACEPTADA;
            $tarjeta->ultimos_digitos = $response->last4CardDigits;
            $tarjeta->token = $response->tbkUser;

            $cardType = $this->getCardType($response->creditCardType);
            if($cardType){
                $tarjeta->tipo_tarjeta_id = $cardType;
            }

        }else{
            $tarjeta->estado = CreateTarjetaClienteAction::RECHAZADA;
        }

        $tarjeta->save();

        return Redirect::away($tarjeta->return_url. "?tarjeta_id=".$tarjeta->codigo);
    }

    private function getCardType($cardType){
        switch($cardType){
            case 'Visa':
                return TipoTarjeta::TIPOS['Visa'];

            case 'Mastercard':
                return TipoTarjeta::TIPOS['Mastercard'];

            case 'AmericanExpress':
                return TipoTarjeta::TIPOS['AmericanExpress'];

            case 'Diners':
                return TipoTarjeta::TIPOS['Diners'];

            case 'Magna':
                return TipoTarjeta::TIPOS['Magna'];

            default:
                null;
        }
    }
}