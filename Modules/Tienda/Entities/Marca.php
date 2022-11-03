<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = "td_marcas";
    protected $fillable = ['id','nombre','archivo','observaciones'];
}
