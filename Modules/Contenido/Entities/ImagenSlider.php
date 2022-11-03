<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class ImagenSlider extends Model
{
    protected $table = "imagenes_sliders";
    protected $fillable = ['nombre','atributos','active','bk_estados_id','ruta','ct_categoria_slider_id','texto_principal','texto_secundario','btn_texto','btn_url'];

    public function estado()
    {
    	return $this->belongsTo('Modules\Backend\Entities\Estados','bk_estados_id');
    }
    public function categoria_slider()
    {
    	return $this->belongsTo('Modules\Contenido\Entities\Categoria','ct_categoria_slider_id');
    }
}
