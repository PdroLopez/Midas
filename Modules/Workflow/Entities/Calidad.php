<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class Calidad extends Model
{
    protected $table = "calidad";
    protected $fillable = ['archivo','observacion','sl_solicitudes_id','users_id','boletas_id','sl_tipo_imagen_id'];

    public function solicitud()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Solicitud','sl_solicitudes_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','users_id');
    }

    public function tipo_imagen()
    {
        return $this->belongsTo('Modules\Workflow\Entities\TipoImagen','sl_tipo_imagen_id');
    }
}
