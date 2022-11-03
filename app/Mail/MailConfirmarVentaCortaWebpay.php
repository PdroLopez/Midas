<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Tienda\Entities\Transaccion;
use Modules\Tienda\Entities\Ventas as venta;
use Modules\Tienda\Entities\VentaTransaccion as ventaTransaccion;
use Modules\Login\Entities\Region;
use Modules\Login\Entities\Comuna;
use PDF;

class MailConfirmarVentaCortaWebpay extends Mailable
{
    use Queueable, SerializesModels;
    public $transaccion;

    public function __construct($transaccion)
    {
        $this->transaccion = $transaccion;
    }

    public function build()
    {
            $transaccion = $this->transaccion;
            $ventas = ventaTransaccion::where('transacciones_id',$transaccion->id)->get();    
            $venta =  venta::find($ventas[0]->ventas_id);
            $region = Region::find(1);
            $comuna = Comuna::find(1);
            $codigo = $transaccion->codigo;

            $pdf = PDF::loadview('tienda::Public.venta.exito_pdf_nuevo',compact('transaccion','region','comuna','ventas','codigo'));
            $pdf->setPaper(array(0, 0, 283.465, 850.394), 'portrait');

        return $this->subject("Transacción Compra Kit de Reciclaje")
        ->cc('kit@midaschile.cl')
        ->attachData($pdf->output(), $codigo.".pdf")
        ->view('mail.mailconfirmar_venta_cortawebpay',compact('transaccion'));
    }
}
