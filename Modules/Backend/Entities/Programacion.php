<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    protected $table = "bk_programaciones";
    protected $fillable = ["id","nombre"];
}
