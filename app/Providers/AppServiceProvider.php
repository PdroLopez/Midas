<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Modules\Contenido\Entities\Review as review;
use Modules\Contenido\Entities\Imagen as imagen;
use Modules\Contenido\Entities\Noticia as noticia;
use Modules\Dgr\Entities\Configuracion as configuracion;
use Modules\Dgr\Entities\Modulos as modulos;
use Modules\Workflow\Entities\Solicitud;
use App\Observers\SolicitudObserver;
use View;
use Modules\Contenido\Entities\ImagenSlider;


class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {

        Schema::defaultStringLength(191);
        $login = array();
        $private = array();
        $portal = array();
        $dgr = array();
        $configuracion = configuracion::all();
        $modulos = modulos::where('estado',1)->get();
        foreach ($configuracion->where("prefix","Login") as $lg) {
            $login[$lg->variable] = $lg->valor;
        }
        foreach ($configuracion->where("prefix","Private") as $pr) {
            $private[$pr->variable] = $pr->valor;
        }
        foreach ($configuracion->where("prefix","Portal") as $po) {
            $portal[$po->variable] = $po->valor;
        }
        foreach ($configuracion->where("prefix","Dgr") as $dg) {
            $dgr[$dg->variable] = $dg->valor;
        }
        $noticia = noticia::orderBy('id', 'DESC')->paginate(9);
        $imagen = imagen::orderBy('id', 'DESC')->paginate(9);


        $review = review::all();
        $imagen_portal = ImagenSlider::where('bk_estados_id',12)->where('ct_categoria_slider_id',3)->get();
        $imagen_tienda = ImagenSlider::where('bk_estados_id',12)->where('ct_categoria_slider_id',4)->get();

        Solicitud::observe(SolicitudObserver::class);

        View::share('noticia',$noticia);
        View::share('imagen',$imagen);
        View::share('review',$review);
        View::share('imagen_portal',$imagen_portal);
        View::share('imagen_tienda',$imagen_tienda);

        View::share('dgr',$dgr);
        View::share('login',$login);
        View::share('private',$private);
        View::share('portal',$portal);
        View::share('modulos',$modulos);


    }
}
