<?php

namespace Modules\Dgr\Entities;

use Illuminate\Database\Eloquent\Model;

class PortalMenu extends Model

{
	protected $table="portal_menu";
    protected $fillable = ['nombre','url','peso','sub_menu','portal_pagina_id','estado','portal_menu_id'];

    public function portal_pagina()
    {
    	return $this->belongsTo('Modules\Dgr\Entities\PortalPagina');
    }

    public function portal_menu_hijos()
    {
    	return $this->hasMany('Modules\Dgr\Entities\PortalMenu');
    }

    public function portal_menu_padre()
    {
    	return $this->belongsTo('Modules\Dgr\Entities\PortalMenu');
    }
}
