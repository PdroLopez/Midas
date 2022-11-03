<?php

namespace Modules\Agendamiento\Entities;

use Illuminate\Database\Eloquent\Model;

class HorasDisponibles extends Model
{
    protected $table = "ag_horasdisponibles";
    protected $fillable = ['id','dia','tipohora','hora_in','hora_out','valor'];

}
