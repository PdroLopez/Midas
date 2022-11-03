<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class VentaFuera extends Model
{
   	protected $table = "ventas_fuera";
    protected $fillable = ["nombre","telefono","direccion","detalle","correo","bk_regiones_id",
"bk_comunas_id"];

    public function transaccion(){
        return $this->HasMany('Modules\Tienda\Entities\Transaccion','ventas_fuera_id');
    }

    public function ventas(){
        return $this->HasMany('Modules\Tienda\Entities\Ventas','ventas_fuera_id');
    }

    public function comuna(){
        return $this->belongsTo('Modules\Backend\Entities\Comunas','bk_comunas_id');
    }

    public function region(){
        return $this->belongsTo('Modules\Backend\Entities\Regiones','bk_regiones_id');
    }
}
