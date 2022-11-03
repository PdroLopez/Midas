<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoriasNoticias extends Model
{
    protected $table = "ct_categoria";
    protected $fillable = ["nombre"];
}
