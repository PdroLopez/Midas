<?php

namespace Modules\Login\Entities;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = "bk_regiones";
    protected $fillable = ["id","nombre","bk_comunas_id"];




}
