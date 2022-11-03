<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoVenta extends Model
{
    protected $table = "tipo_venta";
    protected $fillable = ["nombre"];

    public function venta(){
        return $this->HasMany('Modules\Tienda\Entities\Ventas');
    }
}
