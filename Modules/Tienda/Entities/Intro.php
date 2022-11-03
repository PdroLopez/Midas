<?php

namespace Modules\Tienda\Entities;

use Illuminate\Database\Eloquent\Model;

class Intro extends Model
{
    protected $table = "td_intro";
    protected $fillable = ["id","nombre","peso","estado","tipo_archivo","archivo","texto1","texto2","parrafo","boton","url"];
}
