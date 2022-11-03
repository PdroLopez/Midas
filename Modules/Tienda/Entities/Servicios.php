<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    protected $table = "td_servicios";
    protected $fillable = ['id','nombre','descripcion','precio','stock','td_categorias_id','td_cupones_id','bk_pais_id'];
}
