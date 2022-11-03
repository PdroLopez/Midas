<?php


namespace Modules\Dgr\Entities;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    protected $connection = 'mysql';
    protected $table = "modulos";
    protected $fillable = ['nombre','estado','descripcion'];

	public function nav_role()
    {
        return $this->hasMany('Modules\Dgr\Entities\RoleNav','modulos_id');
    }

}
