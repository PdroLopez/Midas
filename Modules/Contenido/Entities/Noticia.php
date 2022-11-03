<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Taggable;

class Noticia extends Model
{
    protected $table = "ct_noticias";
    protected $fillable = ["id","titulo","subtitulo","descripcion","url","tags","mayuscula","slug","peso","ct_estado_id"];

}
