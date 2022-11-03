<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class BoletaSolicitud extends Model
{
    protected $table = "boleta_solicitud";
    protected $fillable = ['sl_solicitudes_id','boletas_id'];

    public function solicitud()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Solicitud','sl_solicitudes_id');
    }
    public function boleta()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Boleta','boletas_id');
    }
}