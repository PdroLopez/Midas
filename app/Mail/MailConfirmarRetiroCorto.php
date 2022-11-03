<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Tienda\Entities\Ventas as venta;
use Modules\Workflow\Entities\Boleta;
use PDF;

class MailConfirmarRetiroCorto extends Mailable
{
    use Queueable, SerializesModels;
    public $boleta;

    public function __construct($boleta)
    {
        $this->boleta = $boleta;
    }

    public function build()
    {
            $boleta = $this->boleta;  
            $boleta =  Boleta::find($boleta->id);
            // $codigo = $boleta->codigo;

            // $pdf = PDF::loadview('tienda::Public.venta.exito_pdf_sp',compact('venta','codigo'));
            // $pdf->setPaper(array(0, 0, 283.465, 850.394), 'portrait');

        return $this->subject("Solicitud de Retiro")
        // ->attachData($pdf->output(), $codigo.".pdf")
        // ->cc('kit@midaschile.cl')
        ->view('mail.mailconfirmar_retiro_corto',compact('boleta'));
    }
}
