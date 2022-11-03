<?php

namespace Modules\Dgr\Entities;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $table="img";
    protected $fillable = ['nombre','src','class','style'];
}
