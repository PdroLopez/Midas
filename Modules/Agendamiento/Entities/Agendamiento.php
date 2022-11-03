<?php

namespace Modules\Agendamiento\Entities;

use Illuminate\Database\Eloquent\Model;

class Agendamiento extends Model
{
    protected $table = "ag_agendamiento";
    protected $fillable = ['id','hora_in','hora_out','ag_recursos_id','bk_estados_id','ag_horasdisponibles_id','valor'];

}
