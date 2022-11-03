<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class ComboResiduo extends Model
{
    protected $table = "combos_residuos";
    protected $fillable = ['combos_id','Residuos_id'];

    public function combos()
    {
        return $this->belongsTo('Modules\Backend\Entities\Combo', 'combos_id');
    }
    public function residuos()
    {
        return $this->belongsTo('App\Residuo', 'Residuos_id');
    }
}
