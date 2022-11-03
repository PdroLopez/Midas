<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "ct_review";
    protected $fillable = ["id","titulo","subtitulo","msj_final","slug"];
}
