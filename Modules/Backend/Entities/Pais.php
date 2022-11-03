<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = "bk_pais";
    protected $fillable = ['id','nombre','bk_regiones_id'];
}
