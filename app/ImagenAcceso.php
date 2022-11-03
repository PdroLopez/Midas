<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenAcceso extends Model
{
   	protected $table = "imagenes_accesos";
    protected $fillable = ["archivo","url","accesos_id"];

    public function accesos()
    {
        return $this->belongsTo('App\Acceso','accesos_id');
    }
}
