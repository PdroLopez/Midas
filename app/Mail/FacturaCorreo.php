<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class FacturaCorreo extends Mailable
{
    use Queueable, SerializesModels;
    protected $asunto;
    protected $mensaje;


    public function __construct($user,$asunto,$mensaje)
    {
        $this->user = $user;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
    }

    public function build()
    {
        $mensajes = $this->mensaje;
        $usuario = $this->user;
        return $this->subject($this->asunto)->view('mail.VerificarCorreo', compact('mensajes','usuario'));
    }
}