<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    protected $table = "accesos";
    protected $fillable = ["comentario"];

    public function imagen()
    {
    	return $this->hasMany('App\ImagenAcceso','accesos_id');
    }
}
