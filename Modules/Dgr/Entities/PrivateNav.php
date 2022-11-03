<?php

namespace Modules\Dgr\Entities;

use Illuminate\Database\Eloquent\Model;

class PrivateNav extends Model
{
    protected $table="private_nav";
    protected $fillable = ['nombre','peso','url','sub_nav','estado','private_nav_id','icono'];

    public function padre()
    {
    	return $this->belongsTo('Modules\Dgr\Entities\PrivateNav','private_nav_id');
    }

    public function hijos()
    {
    	return $this->hasMany('Modules\Dgr\Entities\PrivateNav','private_nav_id');
    }

    public function role_nav()
    {
    	return $this->hasMany('Modules\Dgr\Entities\RoleNav');
    }

    public function hijos_array()
    {
        $array = array();
        foreach ($this->hijos as $value) {
            array_push($array, asset($this->url.'/'.$value->url));
        }
        return $array;
    }
}
