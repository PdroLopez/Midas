<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarConfirmacion extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Confirmación de compra de producto';
    public $producto;
    public $msj;
    public $direccion;
    public $region;
    public $comuna;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($producto,$msj,$direccion,$region,$comuna)
    {
        $this->producto = $producto;
        $this->msj = $msj;
        $this->direccion = $direccion;
        $this->region = $region;
        $this->comuna = $comuna;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.enviar-mensaje');
    }
}
