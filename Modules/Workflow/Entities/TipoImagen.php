<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoImagen extends Model
{
    protected $table = "sl_tipo_imagen";
    protected $fillable = ['nombre'];
}
