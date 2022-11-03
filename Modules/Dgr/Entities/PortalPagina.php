<?php

namespace Modules\Dgr\Entities;

use Illuminate\Database\Eloquent\Model;

class PortalPagina extends Model
{
    protected $table="portal_pagina";
    protected $fillable = ['titulo','sub_titulo','body','js','css','titulos','menu','footer'];


    public function portalmenu()
    {
    	return $this->hasMany('Modules\Dgr\Entities\PortalMenu');
    }
}
