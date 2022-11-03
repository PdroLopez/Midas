<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaUsuario extends Model
{
    protected $table = "empresa_usuario";
    protected $fillable = ["cargo","users_id","empresas_id"];
    
    public function user()
    {
        return $this->belongsTo('App\User','users_id');
    }
    public function empresa()
    {
        return $this->belongsTo('App\Empresa','empresas_id');
    }
}
