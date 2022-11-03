<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Comunas extends Model
{
    protected $table = "bk_comunas";
    protected $fillable = ['id','nombre','bk_regiones_id'];

    public function regiones()
    {
        return $this->belongsTo('Modules\Backend\Entities\Regiones', 'bk_regiones_id');
    }
    public function direccion_user()
    {
    	return $this->belongsTo(DireccionUser::class,'bk_comunas_id');
    }

    public function venta_fuera(){
        return $this->HasMany('Modules\Tienda\Entities\VentaFuera');
    }

    public function despacho(){
        return $this->HasMany('Modules\Tienda\Entities\Despacho');
    }
}
