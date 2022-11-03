<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table ="ct_mensajes";
    protected $fillable = ["id","nombre","correo","asunto","mensaje","visto","contestado","bk_estados_id"];

    public function estado()
    {
    	return $this->belongsTo('Modules\Backend\Entities\Estados','bk_estados_id');
    }
}
