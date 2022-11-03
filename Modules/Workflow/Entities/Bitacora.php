<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = "bk_bitacora_solicitud";
    protected $fillable = ['comentarios','users_id','boletas_id'];

    public function user()
    {
        return $this->belongsTo('App\User','users_id');
    }
    public function boleta()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Boleta','boletas_id');
    }
}
