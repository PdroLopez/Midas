<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = "transacciones";
    protected $fillable = ["total","codigo","users_id",'bk_direcciones_user_id','bk_estatus_id','estado','ventas_fuera_id','pdf','typecode','tipo_tarjeta','n_tarjeta','cuotas','boletas_id'];

    public function user(){
        return $this->belongsTo('App\User','users_id');
    }
    public function tran_venta(){
        return $this->hasMany('Modules\Tienda\Entities\VentaTransaccion','transacciones_id');
    }
    public function estatus(){
        return $this->belongsTo('Modules\Backend\Entities\Estatus','bk_estatus_id');
    }
    public function ventas_fuera(){
        return $this->belongsTo('Modules\Tienda\Entities\VentaFuera','ventas_fuera_id');
    }
    public function direccion()
    {
        return $this->belongsTo('App\DireccionUsuario','bk_direcciones_user_id');
    }
    public function boleta()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Boleta','boletas_id');
    }
}
