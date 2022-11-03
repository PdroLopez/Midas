<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "td_banner";
    protected $fillable = ["id","nombre","peso","estado","tipo_archivo","archivo","texto1","texto2","parrafo","boton","url"];
}
