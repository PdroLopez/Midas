<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table="roles";
    protected $fillable=['name'];

    public function usuario()
    {
        return $this->hasMany('App\User');
    }
    public function nav_role()
    {
        return $this->hasMany('Modules\Dgr\Entities\RoleNav','roles_id');
    }
	
}
