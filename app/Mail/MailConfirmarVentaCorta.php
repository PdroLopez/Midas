<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Tienda\Entities\Ventas as venta;
use PDF;

class MailConfirmarVentaCorta extends Mailable
{
    use Queueable, SerializesModels;
    public $venta;

    public function __construct($venta)
    {
        $this->venta = $venta;
    }

    public function build()
    {
        // $this->withSwiftMessage(function ($message) use ($correo, $fecha, $eventName) {

        //     $headers = $message->getHeaders();
        //     $headers->addTextHeader('X-SES-CONFIGURATION-SET', 'mailing');
        //     $headers->addTextHeader('Email',$correo);
        //     $headers->addTextHeader('Events', 'midaschile');
        //     $headers->addTextHeader('Fecha', $fecha);
            
        // });

        $ventas = $this->venta;  
        $venta =  venta::find($ventas->id);
        $codigo = $venta->codigo;

        $pdf = PDF::loadview('tienda::Public.venta.exito_pdf_sp',compact('venta','codigo'));
        $pdf->setPaper(array(0, 0, 283.465, 850.394), 'portrait');

        return $this->subject("Reserva de Kit de Reciclaje")
        ->attachData($pdf->output(), $codigo.".pdf")
        ->cc('kit@midaschile.cl')
        ->view('mail.mailconfirmar_venta_corta',compact('venta'));
    }
}
