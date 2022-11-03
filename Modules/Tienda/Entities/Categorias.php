<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = "td_categorias";
    protected $fillable = ['id','nombre'];
}
