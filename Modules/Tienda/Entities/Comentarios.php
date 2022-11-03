<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    protected $table = "reviews";
    protected $fillable = ['id','voto','comentario', 'users_id','td_productos_id'];

    public function producto(){
        return $this->belongsTo('Modules\Tienda\Entities\Producto','td_productos_id');
    }
    public function user(){
        return $this->belongsTo('App\User','users_id');
    }

}
