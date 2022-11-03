<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarConfirmacionUser extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Confirmación de registro';
    public $nombre;
    public $apellido;
    public $msj;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msj,$nombre,$apellido)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->msj = $msj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.enviar-mensaje-user');
    }
}
