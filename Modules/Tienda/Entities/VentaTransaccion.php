<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class VentaTransaccion extends Model
{
    protected $table = "ventas_transaccion";
    protected $fillable = ["ventas_id","transacciones_id"];

    public function transaccion(){
        return $this->belongsTo('Modules\Tienda\Entities\Transaccion','transacciones_id');
    }
    public function venta(){
        return $this->belongsTo('Modules\Tienda\Entities\Ventas','ventas_id');
    }
}
