<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table="seguimientos";
    protected $fillable=['users_id','sl_solicitudes_id'];
}
