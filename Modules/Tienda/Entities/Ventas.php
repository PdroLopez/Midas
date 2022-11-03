<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = "ventas";
    protected $fillable = ["td_productos_id","cantidad",'rrss','tipo_venta_id','ventas_fuera_id','tipo_pago','total','estado','codigo','users_id','bk_direcciones_user_id','bk_despacho_id','despacho_valor','bk_estatus_id','boletas_id','sms','mail'];

    public function producto(){
        return $this->belongsTo('Modules\Tienda\Entities\Producto','td_productos_id');
    }

    public function tipo_venta(){
        return $this->belongsTo('Modules\Tienda\Entities\TipoVenta','tipo_venta_id');
    }

    public function ventas_fuera(){
        return $this->belongsTo('Modules\Tienda\Entities\VentaFuera','ventas_fuera_id');
    }

    public function tran_venta(){
        return $this->hasMany('Modules\Tienda\Entities\VentaTransaccion','ventas_id');
    }

    public function user(){
        return $this->belongsTo('App\User','users_id');
    }
    
    public function direccion()
    {
        return $this->belongsTo('App\DireccionUsuario','bk_direcciones_user_id');
    }

    public function despacho()
    {
        return $this->belongsTo('Modules\Backend\Entities\Despacho','bk_despacho_id');
    }
    public function estatus(){
        return $this->belongsTo('Modules\Backend\Entities\Estatus','bk_estatus_id');
    }
    public function boleta()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Boleta','boletas_id');
    }
}
