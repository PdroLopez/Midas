<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = "sl_imagenes";
    protected $fillable = ['archivo','url','sl_solicitudes_id'];

    public function solicitud()
    {
        return $this->hasMany('Modules\Workflow\Entities\Solicitud','sl_solicitudes_id');
    }
}
