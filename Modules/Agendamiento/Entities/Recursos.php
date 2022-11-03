<?php

namespace Modules\Agendamiento\Entities;

use Illuminate\Database\Eloquent\Model;

class Recursos extends Model
{
    protected $table = "ag_recursos";
    protected $fillable = ['id','nombre','descripcion','valor'];

}
