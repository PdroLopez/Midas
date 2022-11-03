<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Descuentos extends Model
{
    protected $table = "td_descuentos";
    protected $fillable = ['id','nombre','vencimiento', 'td_productos_id','inicio', 'cantidad','bk_estados_id'];

    public function producto(){
        return $this->belongsTo('Modules\Tienda\Entities\Producto','td_productos_id');
    }

    public function estado()
    {
        return $this->belongsTo('Modules\Backend\Entities\Estados','bk_estados_id');
    }


}
