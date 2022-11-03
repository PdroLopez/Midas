<?php

namespace Modules\Dgr\Entities;

use Illuminate\Database\Eloquent\Model;

class Errors extends Model
{
    protected $table="errors";
    protected $fillable = ['auth','error','route'];
}
