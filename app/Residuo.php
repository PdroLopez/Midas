<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residuo extends Model
{
    protected $table = "Residuos";
    protected $fillable = ["nombre","precio","detalle","largo","ancho","altura","imagen"];

    public function combo_residuo()
    {
        return $this->HasMany('Modules\Backend\Entities\ComboResiduo');
    }
}
