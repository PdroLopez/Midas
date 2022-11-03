<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class DireccionUser extends Model
{
    protected $table = "bk_direcciones_user";
    protected $fillable = ["id","nombre",'bk_comunas_id','bk_regiones_id'];

    public function comunas()
    {
        return $this->belongsTo('Modules\Backend\Entities\Comunas', 'bk_comunas_id');
    }
    public function regiones()
    {
        return $this->belongsTo('Modules\Backend\Entities\Regiones', 'bk_regiones_id');
    }
}
