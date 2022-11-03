<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class DireccionEmpresa extends Model
{
    protected $table = "bk_direcciones_empresas";
    protected $fillable = ['id',"nombre","empresas_id","bk_comunas_id","bk_regiones_id"];

    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'empresas_id');
    }
    public function comuna()
    {
        return $this->belongsTo('Modules\Backend\Entities\Comunas','bk_comunas_id');
    }
    public function region()
    {
        return $this->belongsTo('Modules\Backend\Entities\Regiones','bk_regiones_id');
    }
}
