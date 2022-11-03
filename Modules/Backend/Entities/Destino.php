<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    protected $table = "destino";
    protected $fillable = ['nombre','activo'];

    public function boleta()
    {
        return $this->HasMany('Modules\Workflow\Entities\Boleta', 'destino_id');
    }
}
