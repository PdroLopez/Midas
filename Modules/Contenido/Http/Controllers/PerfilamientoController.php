<?php

namespace Modules\Contenido\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Contenido\Entities\Rol as rol;
use App\User as usuario;
use Modules\Login\Entities\Region;
use Modules\Login\Entities\Comuna;

class PerfilamientoController extends Controller
{
    public function index()
    {
        $rol = rol::all();
        return view('contenido::private.perfilamiento.roles',compact('rol'));
    }
    public function users(){
        $usuario = usuario::orderBy('id','desc')->paginate(10);
        $rol = rol::pluck('name','id');
        $region = Region::all();
        return view('contenido::private.perfilamiento.usuarios',compact('rol','usuario','region'));
    }
    public function SelectComunas($id)
    {
        $comuna = Comuna::where('bk_regiones_id',$id)->get();
        return response()->json($comuna);
    }
    public function ver($id)
    {
        $usuario = usuario::where('id',$id)->get();
        $rol = rol::pluck('name','id');
        $region = Region::all();
        return view('contenido::private.perfilamiento.modal.usuarios.ver',compact('usuario','rol','region'));
    }
   
   

}
