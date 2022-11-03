<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $table = "marcas";
    protected $fillable = ['id','nombre','archivo','observaciones','bk_estados_id'];

    public function empresa_marca()
    {
        return $this->hasMany('Modules\Workflow\Entities\EmpresasMarcas', 'bk_estados_id');
    }

    public function estado()
    {
        return $this->belongsTo('Modules\Backend\Entities\Estados', 'bk_estados_id');
    }
}
