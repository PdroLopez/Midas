<?php

namespace Modules\Dgr\Entities;

use Illuminate\Database\Eloquent\Model;

class RoleNav extends Model
{
    protected $table="role_nav";
    protected $fillable = ['private_nav_id','roles_id','modulos_id'];

    public function nav()
    {
    	return $this->belongsTo('Modules\Dgr\Entities\PrivateNav','private_nav_id');
    }

    public function rol()
    {
    	return $this->belongsTo('App\Role');
    }

    public function modulos()
    {
        return $this->belongsTo('Modules\Dgr\Entities\Modulos');
    }
}
