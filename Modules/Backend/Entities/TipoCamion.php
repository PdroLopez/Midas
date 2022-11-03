<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoCamion extends Model
{
    protected $table = "tipo_camion";
    protected $fillable = ['nombre'];

    public function camiones()
    {
    	return $this->HasMany('Modules\Backend\Entities\Camion');
    }
}
