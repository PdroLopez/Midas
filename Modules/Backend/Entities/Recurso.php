<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = "bk_recursos";
    protected $fillable = ["id","nombre"];
}
