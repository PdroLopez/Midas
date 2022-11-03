<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    protected $table = "clasificaciones";
    protected $fillable = ['nombre'];

    public function subcategoria()
    {
        return $this->HasMany('Modules\Backend\Entities\SubCategoria', 'clasificaciones_id');
    }
}
