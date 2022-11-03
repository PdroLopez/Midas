<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "roles";
    protected $fillable = ["id","name"];

    public function usuario()
    {
        return $this->hasMany('Modules\Contenido\Entities\Usuario');
    }
}
