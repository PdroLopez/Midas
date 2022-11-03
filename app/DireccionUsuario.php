<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DireccionUsuario extends Model
{
    protected $table = "bk_direcciones_user";
    protected $fillable = ['nombre','users_id','bk_comunas_id','bk_regiones_id'];

    public function comuna()
    {
        return $this->belongsTo('Modules\Backend\Entities\Comunas','bk_comunas_id');
    }
    public function region()
    {
        return $this->belongsTo('Modules\Backend\Entities\Regiones','bk_regiones_id');
    }

}
