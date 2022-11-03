<?php

namespace Modules\Payments\Entities;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = "py_transaccion";

    protected $fillable = ['codigo', 'nombre', 'descripcion', 'estado','total',
    'cliente_id', 'return_url','estado'];

    public function cliente()
    {
        return $this->belongsTo('App\User','cliente_id');
    }


    public function venta()
    {
        return $this->belongsTo('Modules\Tienda\Entities','ventas_id');
    }

    public function planes()
    {
        return $this->belongsTo('App\Servicios','planes_id');
    }
}
