<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class GrupoClasificacion extends Model
{
    protected $table = "grupo_clasificacion";
    protected $fillable = ['grupos_id','clasificaciones_id'];

    public function grupo()
    {
        return $this->hasMany('Modules\Workflow\Entities\Grupo','grupos_id');
    }
    public function clasificacion()
    {
        return $this->hasMany('Modules\Workflow\Entities\Clasificacion','clasificaciones_id');
    }
}
