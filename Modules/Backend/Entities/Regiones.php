<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Regiones extends Model
{
    protected $table = "bk_regiones";
    protected $fillable = ['id','nombre'];

    public function comunas()
    {
    	return $this->HasMany(Comunas::class,'bk_regiones_id');
    }
    public function direccion_user()
    {
    	return $this->HasMany(DireccionUser::class,'bk_regiones_id');
    }

    public function venta_fuera(){
        return $this->HasMany('Modules\Tienda\Entities\VentaFuera');
    }
}
