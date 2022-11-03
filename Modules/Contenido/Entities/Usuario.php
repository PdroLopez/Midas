<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "users";
    protected $fillable = ["id","name","roles_id","email","password"];

    public function rol()
    {
        return $this->belongsTo('Modules\Contenido\Entities\Rol','roles_id');
    }
}
