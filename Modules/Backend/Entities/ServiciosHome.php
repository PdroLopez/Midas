<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class ServiciosHome extends Model
{
    protected $table = "bk_servicios_home";
    protected $fillable = ['nombre','icono','texto','peso'];


}
