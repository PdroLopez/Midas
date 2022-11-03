<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = "ct_estado";
    protected $fillable = ["id","nombre"];
}
