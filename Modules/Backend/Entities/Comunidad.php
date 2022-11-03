<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    protected $table = "bk_comunidades";
    protected $fillable = ['id','nombre','descripcion','foto','tipo_comunidades_id'];

    public function tipo_comunidades()
    {
        return $this->belongsTo('Modules\Backend\Entities\TipoComunidad', 'tipo_comunidades_id');
    }
}
