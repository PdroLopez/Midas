<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class EmpresasMarcas extends Model
{
    protected $table = "empresas_marcas";
    protected $fillable = ['id','marcas_id','empresas_id'];

    public function marcas(){
        return $this->belongsTo('Modules\Workflow\Entities\Marcas','marcas_id');
    }

	public function empresa()
    {
        return $this->belongsTo('App\Empresa','empresas_id');
    }
}