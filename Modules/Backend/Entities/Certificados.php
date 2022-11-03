<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Certificados extends Model
{
    protected $table = "bk_certificados";
    protected $fillable = ['id','nombre','empresa','rut','direccion','fecha_retiro','cantidad'];
}