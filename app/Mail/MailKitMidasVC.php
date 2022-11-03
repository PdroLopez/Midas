<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Tienda\Entities\Ventas as venta;
use App\Exports\VentaCortaExport;
use Excel;

class MailKitMidasVC extends Mailable
{
    use Queueable, SerializesModels;
    public $venta;

    public function __construct($venta)
    {
        $this->venta = $venta;
    }

    public function build()
    {
            $ventas = $this->venta;  
            $venta =  venta::find($ventas->id);
            $codigo = $venta->codigo;

        // $excel = Excel::download(new VentaCortaExport($venta), 'ventacortakit.xlsx');
        // dd($excel->file);

        return $this->subject("Reserva de Kit de Reciclaje")
        // ->attach(public_path('Manual de Uso Kit de Reciclaje.pdf'))
        // ->attach($excel)
        ->view('mail.mail_venta_corta',compact('venta'));
    }
}
