<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Regalo extends Model
{
    protected $table = "regalo";
    protected $fillable = ['id','nota','imagen','ventas_id'];
}
