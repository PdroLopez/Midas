<?php

namespace Modules\Dgr\Entities;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table="configuracion";
    protected $fillable = ['prefix','variable','valor'];
}
