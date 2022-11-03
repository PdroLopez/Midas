<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use Log;
use App\Mail\FacturaCorreo;

class ProcessMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user, $asunto, $mensaje;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $asunto, $mensaje)
    {
        $this->user = $user;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new FacturaCorreo($this->user, $this->asunto, $this->mensaje));
    }
}
