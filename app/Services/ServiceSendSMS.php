<?php

namespace App\Services;

use App\Exceptions\Handler;
use Modules\Tienda\Entities\Transaccion;
use Modules\Backend\Entities\ResumenSms;
use Log;
use URL;
use AWS;


class ServiceSendSMS
{

    // protected $url;
    // protected $mensage;
    // protected $phone;

    public function __construct()
    {
        
    }

    public function getResponsePago($transaccionId)
    {


             try {
                // dd($transaccionId);
                $sms = AWS::createClient('sns');
                $transaccion = Transaccion::where('codigo', $transaccionId)->where('estado','pagado')->first();
                $url_usar = url('p/'.$transaccionId);

                if($transaccion->sms != 1){
                  $sms->publish([
                      'Message' => 'MidasChile te informa que tu pago fue exitoso, puedes ver y descargar tu comprobante en '.$url_usar,
                          'PhoneNumber' => '569'.$transaccion->ventas_fuera->telefono,	
                          'MessageAttributes' => [
                              'AWS.SNS.SMS.SMSType'  => [
                                  'DataType'    => 'String',
                                  'StringValue' => 'Transactional',
                               ]
                           ],
                        ]);

                  $transaccion->pdf = 0;
                  $transaccion->sms = 1;
                  $transaccion->save();

                  $resumen_sms = new ResumenSms();
                  $resumen_sms->telefono = '+569'.$transaccion->ventas_fuera->telefono;
                  $resumen_sms->estado = 'Enviado';
                  $resumen_sms->mensaje = 'MidasChile te informa que tu pago fue exitoso, puedes ver y descargar tu comprobante en '.$url_usar;
                  $resumen_sms->save();    
                }
        
                return true;
        
                        
            } catch (\Throwable $th) {
              $resumen_sms = new ResumenSms();
              $resumen_sms->telefono = '+569'.$transaccion->ventas_fuera->telefono;
              $resumen_sms->mensaje = 'MidasChile te informa que tu pago fue exitoso, puedes ver y descargar tu comprobante en '.$url_usar;
              $resumen_sms->estado = 'Error';
              $resumen_sms->save();
              Log::info('Fallo SMS de Compra webpay');
                return false;

            }
 
    }
        
}