<?php

namespace App\Services;

use App\Exceptions\Handler;
use Modules\Tienda\Entities\Transaccion;
use Modules\Tienda\Entities\Ventas as venta;
use Modules\Backend\Entities\ResumenSms;
use URL;
use AWS;
use Log;


class ServiceSendSMSsinPago
{

    // protected $url;
    // protected $mensage;
    // protected $phone;

    public function __construct()
    {
        
    }

    public function getResponsePago($ventaId)
    {
       try {
          $sms = AWS::createClient('sns');
          $venta = venta::find($ventaId);
          $url_usar = url('sp/'.$venta->codigo);
            
            if($venta->sms != 1){
                $sms->publish([
                    'Message' => 'MidasChile te informa que tu reserva fue exitosa, puedes ver y descargar el comprobante en :'.$url_usar.'. Recuerda realizar el pago al momento de recibir el kit de reciclaje.',
                        'PhoneNumber' => '569'.$venta->ventas_fuera->telefono,	
                        'MessageAttributes' => [
                            'AWS.SNS.SMS.SMSType'  => [
                                'DataType'    => 'String',
                                'StringValue' => 'Transactional',
                             ]
                         ],
                      ]);

                $venta->pdf = 0;
                $venta->sms = 1;
                $venta->save();   

                $resumen_sms = new ResumenSms();
                $resumen_sms->telefono = '+569'.$venta->ventas_fuera->telefono;
                $resumen_sms->estado = 'Enviado';
                $resumen_sms->mensaje = 'MidasChile te informa que tu reserva fue exitosa, puedes ver y descargar el comprobante en :'.$url_usar.'. Recuerda realizar el pago al momento de recibir el kit de reciclaje.';
                $resumen_sms->save();
            }
  
          return true;
  
                  
      } catch (\Throwable $th) {
            $resumen_sms = new ResumenSms();
            $resumen_sms->telefono = '+569'.$venta->ventas_fuera->telefono;
            $resumen_sms->estado = 'Error';
            $resumen_sms->mensaje = 'MidasChile te informa que tu reserva fue exitosa, puedes ver y descargar el comprobante en :'.$url_usar.'. Recuerda realizar el pago al momento de recibir el kit de reciclaje.';
            $resumen_sms->save();
            Log::info('Fallo SMS de Compra sin pago');
            return false;

      }   
    }
        
}