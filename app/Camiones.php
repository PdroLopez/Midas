<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camiones extends Model
{
    protected $table = "camiones";
    protected $fillable = ['patente','users_id'];

}
