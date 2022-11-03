<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Nodo extends Model
{
    protected $table = "ct_nodo";
    protected $fillable = ["id","peso","visible","titulo","subtitulo","resumen","body","url","ct_estado_id"];
}
