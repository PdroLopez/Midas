<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    protected $table = "camiones";
    protected $fillable = ['id','patente','users_id','nombre','descripcion','tipo_camion_id'];

    public function user()
    {
    	return $this->belongsTo('App\User','users_id');
    }

    public function tipo_camion()
    {
    	return $this->belongsTo('Modules\Backend\Entities\TipoCamion','tipo_camion_id');
    }
}