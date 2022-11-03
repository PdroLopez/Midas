<?php

namespace Modules\Contenido\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Contenido\Entities\Categoria as categoria;
use Modules\Contenido\Entities\Page as page;

class MantenedoresController extends Controller
{
    public function page()
    {
        $page = page::all();
        return view('contenido::private.mantenedores.page',compact('page'));
    }

    public function imagenes(){
        return view('contenido::private.mantenedores.imagenes');
    }

    public function categoria()
    {
        $categoria = categoria::all();
        return view('contenido::private.mantenedores.categoria',compact('categoria'));
    }

}
