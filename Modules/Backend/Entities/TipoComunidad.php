<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoComunidad extends Model
{
    protected $table = "bk_tipo_comunidades";
    protected $fillable = ['id','nombre'];

    public function comunidad()
    {
    	return $this->belongsTo(Comunidad::class,'bk_tipo_comunidades_id');
    }
}
