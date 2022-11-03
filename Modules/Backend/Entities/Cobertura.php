<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Cobertura extends Model
{
    protected $table = "bk_cobertura";
    protected $fillable = ['nombre'];

    public function despacho()
    {
    	return $this->HasMany('App\User');
    }
}
