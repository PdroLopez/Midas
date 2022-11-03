<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $table = "combos";
    protected $fillable = ["nombre",'valor','activo','img'];

    public function combo_residuo()
    {
        return $this->HasMany('Modules\Backend\Entities\ComboResiduo','combos_id');
    }
}
