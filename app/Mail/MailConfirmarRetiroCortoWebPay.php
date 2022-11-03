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

class MailConfirmarRetiroCortoWebPay extends Mailable
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
        $codigo = $transaccion->codigo;

        $pdf = PDF::loadview('retirocorto.exito_pdf',compact('transaccion','codigo'));
        $pdf->setPaper(array(0, 0, 283.465, 850.394), 'portrait');

        return $this->subject("Transacción Solicitud Retiro")
        // ->cc('kit@midaschile.cl')
        ->attachData($pdf->output(), $codigo.".pdf")
        ->view('mail.mailconfirmar_retiro_cortowebpay',compact('transaccion'));
    }
}
