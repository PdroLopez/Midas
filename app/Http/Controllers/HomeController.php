<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Dgr\Entities\Modulos as modulos;
use Modules\Workflow\Entities\Boleta;
// use Modules\Dgr\Entities\role_nav as role_nav;

use Auth;
use Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {


        if (Session::has('sesion_datos_retiro')) {//Session retiro
            return redirect::to('/retiro-corto/paso-2');
        }
        if(Auth::user()->rol->name == 'DGR'){
            return redirect::to('dgr');
        }elseif (Auth::user()->roles_id == 17) {//Rol usuario
            return redirect::to('/');
        }elseif(Auth::user()->roles_id == 19){//Rol Particular
            $url = substr(request()->headers->get('referer'), -6);
            if ($url == "tienda"){
                return redirect::to('/tienda');
            }else{
                return redirect::to('/');
            }
        }elseif (Auth::user()->roles_id == 12) {//Rol Chofer
            $retiros = Boleta::where('camionero_id', Auth::user()->id)->wherein('bk_estados_id',[21,27,9])->orderBy('fecha_hora', 'asc')->get();
            $plantas = Boleta::where('bk_estados_id',28)->where('camionero_id', Auth::user()->id)->OrderBy('fecha_hora','DESC')->get();
            // dd($plantas);
            return view('private.chofer.home',compact('retiros','plantas'));
        }else{//Los demas roles
            if (!Session::has('modulo')) { 
                if (Auth::user()->rol->nav_role->unique('modulos_id')->first() != null) {
                    $modulos = Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id;
                    if (Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id) {
                        Session::put('modulo',$modulos);
                    }
                    //obtengo los modulos que tengo asociado.
                    Session::put('collection',Auth::user()->rol->nav_role->unique('modulos_id'));
                    return redirect::to('workflow/me');
                }else{
                    return view('private.me.me');
                }
            }
        }
        //Rol Pesador
        // if(Auth::user()->roles_id == 14){
        //     if (!Session::has('modulo')) {
        //         $modulos = modulos::all();
        //         if ($modulos->count() != 0) {
        //             Session::put('modulo',$modulos->first());
        //         }
        //     }
        // }
        // si es gestor 18


        // //Administrador de empresa rol 15
        // if(Auth::user()->roles_id == 15){
        //     if (!Session::has('modulo')) {
        //         $modulos = Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id;
        //         if (Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id) {
        //             Session::put('modulo',$modulos);
        //         }

        //     }
        //     //obtengo los modulos que tengo asociado.
        //     Session::put('collection',Auth::user()->rol->nav_role->unique('modulos_id'));
        //     return redirect::to('workflow/me');

        // }
        // //Rol Logistica
        // if(Auth::user()->roles_id == 20){
        //     if (!Session::has('modulo')) {
        //         $modulos = Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id;
        //         if (Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id) {
        //             Session::put('modulo',$modulos);
        //         }

        //     }
        //     //obtengo los modulos que tengo asociado.
        //     Session::put('collection',Auth::user()->rol->nav_role->unique('modulos_id'));
        //     return redirect::to('workflow/me');

        // }
        // //Proveedor empresa Rol 16
        // if(Auth::user()->roles_id == 16){
        //     if (!Session::has('modulo')) {
        //         $modulos = Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id;
        //         if (Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id) {
        //             Session::put('modulo',$modulos);
        //         }

        //     }
        //     //obtengo los modulos que tengo asociado.
        //     Session::put('collection',Auth::user()->rol->nav_role->unique('modulos_id'));
        //     return redirect::to('workflow/me');

        // }


        // //ROl Gestor
        // if(Auth::user()->roles_id == 18){
        //     if (!Session::has('modulo')) {
        //         $modulos = Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id;
        //         if (Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id) {
        //             Session::put('modulo',$modulos);
        //         }

        //     }
        //     //obtengo los modulos que tengo asociado.
        //     Session::put('collection',Auth::user()->rol->nav_role->unique('modulos_id'));
        //     return redirect::to('workflow/me');

        // }
        // //Rol Pesador
        // if(Auth::user()->roles_id ==14 ){
        //     if (!Session::has('modulo')) {
        //         $modulos = Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id;
        //         if (Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id) {
        //             Session::put('modulo',$modulos);
        //         }
        //     }
        //     //obtengo los modulos que tengo asociado.
        //     Session::put('collection',Auth::user()->rol->nav_role->unique('modulos_id'));

        //     return redirect::to('workflow/me');

        // }

        // //Administrador
        // if(Auth::user()->roles_id == 21){
        //     if (!Session::has('modulo')) {
        //         $modulos = Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id;
        //         if (Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id) {
        //             Session::put('modulo',$modulos);
        //         }
        //     }
        //     //obtengo los modulos que tengo asociado.
        //     Session::put('collection',Auth::user()->rol->nav_role->unique('modulos_id'));

        //     return redirect::to('workflow/me');

        // }


        // //Rol Tecnico Empresa
        // if(Auth::user()->roles_id == 24){
        //     if (!Session::has('modulo')) {
        //         $modulos = Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id;
        //         if (Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id) {
        //             Session::put('modulo',$modulos);
        //         }
        //     }
        //     //obtengo los modulos que tengo asociado.
        //     Session::put('collection',Auth::user()->rol->nav_role->unique('modulos_id'));

        //     return redirect::to('workflow/me');

        // }

        // //Gerente de operaciones
        // if(Auth::user()->roles_id == 25){
        //     if (!Session::has('modulo')) {
        //         $modulos = Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id;
        //         if (Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id) {
        //             Session::put('modulo',$modulos);
        //         }
        //     }


        //     //obtengo los modulos que tengo asociado.
        //     Session::put('collection',Auth::user()->rol->nav_role->unique('modulos_id'));

        //     return redirect::to('workflow/me');

        // }

        // if(Auth::user()->roles_id == 26){
        //     if (!Session::has('modulo')) {
        //         $modulos = Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id;
        //         if (Auth::user()->rol->nav_role->unique('modulos_id')->first()->modulos_id) {
        //             Session::put('modulo',$modulos);
        //         }
        //     }


        //     //obtengo los modulos que tengo asociado.
        //     Session::put('collection',Auth::user()->rol->nav_role->unique('modulos_id'));

        //     return redirect::to('workflow/me');

        // }
        return view('private.me.me');
    }

    public function usar_modulo($id)
    {
        $modulos = modulos::find($id);
        $modulos = $modulos->id;
        Session::put('modulo',$modulos);
    // Orden de servicio


        if ($modulos == '8') {
            return redirect::to('workflow');
        //sistema
        }elseif($modulos == '9'){
            return redirect::to('tienda/admin/ventas');
        //tienda
        }elseif($modulos == '13'){
            return redirect::to('backend/');
        //backend
        }elseif ($modulos == '10'){
            return redirect::to('contenido/editor/noticias');
        //Contenido
        }
        // elseif ($modulos == '10'){
        //     return redirect::to('tienda/admin/ventas');
        // //Contenido
        // }
        // return redirect::to('private')

    }

}













