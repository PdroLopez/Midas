<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    protected $table = "tipo_producto";
    protected $fillable = ['nombre','activo'];

    public function solicitud()
    {
        return $this->HasMany('Modules\Workflow\Entities\Solicitud');
    }
}
