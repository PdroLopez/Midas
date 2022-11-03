<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Tienda\Entities\Ventas as venta;
use Modules\Workflow\Entities\Boleta;
use PDF;
use App\User;

class MailDeCreacionUsuario extends Mailable
{
    use Queueable, SerializesModels;
    public $user;

    public function __construct($user,$pass)
    {
        $this->user = $user;
        $this->pass = $pass;
    }

    public function build()
    {
        $user = $this->user;  
        $pass = $this->pass;  
        $user =  User::find($user->id);
        return $this->subject("Creación de Usuario")->view('mail.mail_nuevousuario',compact('user','pass'));
    }
}
