<?php

namespace Modules\Contenido\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ConfiguracionController extends Controller
{
    public function page()
    {
        return view('contenido::private.configuracion.page');
    }

    public function css(){
        return view('contenido::private.configuracion.css');
    }

    public function informacion()
    {
        return view('contenido::private.configuracion.info');
    }

    public function mantenimiento()
    {
        return view('contenido::private.configuracion.mantenimiento');
    }
}
