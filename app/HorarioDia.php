<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioDia extends Model
{
    protected $table = "horarios_dias";
    protected $fillable = ["nombre"];
}
