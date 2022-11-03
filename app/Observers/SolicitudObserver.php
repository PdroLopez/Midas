<?php

namespace App\Observers;

use Modules\Workflow\Entities\Solicitud;
use Auth;
use App\Seguimiento;

class SolicitudObserver
{
    /**
     * Handle the solicitud "created" event.
     *
     * @param  \App\Solicitud  $solicitud
     * @return void
     */
    public function created(Solicitud $solicitud)
    {
        if (Auth::check()) {
            Seguimiento::create([
                'users_id' => Auth::user()->id,
                'sl_solicitudes_id' => $solicitud->id
            ]);
        }else{  
            Seguimiento::create([
                'sl_solicitudes_id' => $solicitud->id
            ]);
        }
    }

    /**
     * Handle the solicitud "updated" event.
     *
     * @param  \App\Solicitud  $solicitud
     * @return void
     */
    public function updated(Solicitud $solicitud)
    {
        //
    }

    /**
     * Handle the solicitud "deleted" event.
     *
     * @param  \App\Solicitud  $solicitud
     * @return void
     */
    public function deleted(Solicitud $solicitud)
    {
        //
    }

    /**
     * Handle the solicitud "restored" event.
     *
     * @param  \App\Solicitud  $solicitud
     * @return void
     */
    public function restored(Solicitud $solicitud)
    {
        //
    }

    /**
     * Handle the solicitud "force deleted" event.
     *
     * @param  \App\Solicitud  $solicitud
     * @return void
     */
    public function forceDeleted(Solicitud $solicitud)
    {
        //
    }
}
