<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;


use Illuminate\Routing\Controller;
use Session;


use Modules\Tienda\Entities\Transaccion;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus;
use Log;

class WebpayPlusController extends Controller
{
    public function __construct(){
        if (ENV('APP_ENV') === 'production') {
            WebpayPlus::configureForProduction('597037515272', 'f739fe11b39cfc61e1a3ecdd63eafbef');
            
            
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function createdTransaction($codigo)
    {
        
        //$req = $request->except('_token');

        $transaccion = Transaccion::where('codigo', $codigo)->first();
        $seesionId = Session::getId();

        $response = WebpayPlus\Transaction::create($transaccion->codigo, $seesionId, $transaccion->total, route('gateway.webpay.finish.tienda', $transaccion->codigo));

        
        return $response;
    }

    public function commitTransaction($token)
    {
        // try {
            // Log::info('entra al commitTransaction');

            $resp = WebpayPlus\Transaction::commit($token);

            return $resp;
            
        // } catch (\Exception $e) {
        //     return view('tienda::Public.error');
        // }
    }


    public function showRefund()
    {
        return view('webpayplus/refund');
    }

    public function refundTransaction(Request $request)
    {
        $req = $request->except('_token');
        
        $resp = WebpayPlus\Transaction::refund($req["token"], $req["amount"]);

        return view('webpayplus/refund_success', ["resp" => $resp]);
    }

    public function getTransactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];

        $resp = WebpayPlus\Transaction::status($token);

        return view('webpayplus/transaction_status', ["resp" => $resp, "req" => $req]);
    }
}