<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenSolicitud extends Model
{
    protected $table = "sl_imagenes";
    protected $fillable = ["archivo","url","sl_solicitudes_id"];

    public function solicitudes()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Solicitud','sl_solicitudes_id');
    }
}
