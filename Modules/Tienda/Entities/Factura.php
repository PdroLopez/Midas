<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = "td_factura";
    protected $fillable = ['id','nombre'];
}
