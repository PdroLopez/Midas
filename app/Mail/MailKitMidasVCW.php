<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Tienda\Entities\Transaccion;
use Modules\Tienda\Entities\Ventas as venta;
use Modules\Tienda\Entities\VentaTransaccion as ventaTransaccion;
use PDF;

class MailKitMidasVCW extends Mailable
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
        // $region = Region::find(1);
        // $comuna = Comuna::find(1);
        $codigo = $transaccion->codigo;

        // $excel = Excel::download(new VentaCortaWExport, 'ventacortakit.xlsx');
        // dd($excel);

        return $this->subject("Venta Corta de Kit de Reciclaje")
        ->view('mail.mail_venta_cortawp',compact('transaccion','ventas'));
    }
}
