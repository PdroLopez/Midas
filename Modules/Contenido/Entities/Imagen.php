<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = "ct_img_portal";
    protected $fillable = ["id","archivo","nombre","slider","url","red_social","portada","img_descripcion","miniatura","detalle","peso","users_id","ct_noticias_id","ct_categoria_slider_id","ct_mes_id","ct_review_id","ct_estrenos_id"];

    public function noticia()
    {
    	return $this->belongsTo('Modules\Contenido\Entities\Noticia','ct_noticias_id');
    }
}
