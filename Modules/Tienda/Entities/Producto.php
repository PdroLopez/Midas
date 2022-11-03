<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "td_productos";
    protected $fillable = ['id','nombre','descripcion','caracteristicas','precio','stock','td_marcas_id','td_categorias_id','td_descuentos_id','imagen','imagen2','imagen3','imagen4','bk_estados_id'];

    public function marca(){
        return $this->belongsTo('Modules\Tienda\Entities\Marca','td_marcas_id');
    }

    public function categoria(){
        return $this->belongsTo('Modules\Tienda\Entities\Categorias','td_categorias_id');
    }

    public function descuentos(){
        return $this->belongsTo('Modules\Tienda\Entities\Descuentos','td_descuentos_id');
    }
    public function estado()
    {
        return $this->belongsTo('Modules\Backend\Entities\Estados','bk_estados_id');
    }
    
}
