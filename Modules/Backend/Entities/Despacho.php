<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Despacho extends Model
{
    protected $table = "bk_despacho";
    protected $fillable = ['costo','bk_cobertura_id','bk_comunas_id'];

    public function comuna()
    {
    	return $this->belongsTo('Modules\Backend\Entities\Comunas','bk_comunas_id');
    }

    public function cobertura()
    {
    	return $this->belongsTo('Modules\Backend\Entities\Cobertura','bk_cobertura_id');
    }
}
