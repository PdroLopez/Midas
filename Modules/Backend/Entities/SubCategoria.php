<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    protected $table = "subcategoria";
    protected $fillable = ['nombre','clasificaciones_id'];

    public function clasificaciones()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Clasificacion', 'clasificaciones_id');
    }
}
