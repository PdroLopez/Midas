<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    protected $table = "tipo_servicio";
    protected $fillable = ['nombre','activo'];

    public function boleta()
    {
        return $this->HasMany('Modules\Workflow\Entities\Boleta');
    }
}
