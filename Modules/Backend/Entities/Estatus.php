<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    protected $table = "bk_estatus";
    protected $fillable = ['id','nombre'];
}
