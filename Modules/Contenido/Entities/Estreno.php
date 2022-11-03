<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Estreno extends Model
{
    protected $table = "ct_estrenos";
    protected $fillable = ["id","titulo","sinopsis","director","reparto","url","estreno","slug","peso"];
}
