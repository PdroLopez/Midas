<?php

namespace Modules\Contenido\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "ct_menu";
    protected $fillable = ["id","nombre","url","pagina","elemento","visible","ct_menu_id","ct_nodo_id","ct_estado_id"];
}
