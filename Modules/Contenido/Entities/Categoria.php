<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "ct_categoria_slider";
    protected $fillable = ["id","nombre"];
}
