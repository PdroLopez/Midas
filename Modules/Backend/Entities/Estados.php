<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $table = "bk_estados";
    protected $fillable = ['id','nombre'];
}