<?php

namespace Modules\Agendamiento\Entities;

use Illuminate\Database\Eloquent\Model;

class Seguimineto extends Model
{
    protected $table = "ag_seguimiento";
    protected $fillable = ['id','bk_estados_id','ag_agendamiento','users_id'];

}
