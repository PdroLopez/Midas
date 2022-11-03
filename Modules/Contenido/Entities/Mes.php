<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    protected $table = "ct_mes";
    protected $fillable = ["id","mes","descripcion","url","ct_review_id"];
}
