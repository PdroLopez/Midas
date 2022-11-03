<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "empresas";
    protected $fillable = ["razon_social","nombre","bk_estados_id","rut","observaciones","retc"];

    public function direccion_empresas()
    {
        return $this->hasMany('Modules\Backend\Entities\DireccionEmpresa', 'empresas_id');
    }
    public function estado()
    {
        return $this->belongsTo('Modules\Backend\Entities\Estados','bk_estados_id');
    }

    public function emp_usuario()
    {
        return $this->hasMany('App\EmpresaUsuario', 'empresas_id');
    }
    public function empresa_marca()
    {
        return $this->hasMany('Modules\Workflow\Entities\EmpresasMarcas', 'empresas_id');
    }


}
