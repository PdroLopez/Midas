<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = "td_detalle";
    protected $fillable = ['id','cantidad','precio','td_productos_id','td_servicios_id','td_factura_id'];
}
