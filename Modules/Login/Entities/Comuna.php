<?php

namespace Modules\Login\Entities;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $table = "bk_comunas";
    protected $fillable = ["id","nombre","bk_regiones_id"];
}
