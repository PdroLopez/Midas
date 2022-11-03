<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = "ct_page";
    protected $fillable = ["id","alias","titulo","subtitulo","peso","body","li_anidado","activa",'ct_page_id'];
}
