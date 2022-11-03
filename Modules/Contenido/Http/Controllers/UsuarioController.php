<?php

namespace Modules\Contenido\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use App\User as User;
use App\DireccionUsuario as direccion;
use Log;
use Storage;
use Session;


class UsuarioController extends Controller
{

    public function store(Request $request)
    {
       $foto = $request->file('foto')->store('public/foto');
        $url = Storage::url($foto);

        $user = User::create([
            'name'=> $request->name,
            'apellido'=> $request->apellido,
            'email'=> $request->email,
            'fecha_nacimiento'=> $request->fecha_nacimiento,
            'password'=> bcrypt($request->password),
            'roles_id'=> $request->roles_id,
            'rut'=> $request->rut,
            'dv'=> $request->dv,
            'telefono'=> $request->telefono,
            'foto'=> $url,
        ]);
        direccion::create([
            'nombre'=> $request->direccion,
            'users_id'=> $user->id,
            'bk_comunas_id'=> $request->bk_comunas_id,
            'bk_regiones_id'=> $request->bk_regiones_id
        ]);




        return redirect::back();
    }


    public function update(Request $request, $id)
    {
        if($request->password != null){
            User::find($id)->update([
                'name'=> $request->name,
                'apellido'=> $request->apellido,
                'email'=> $request->email,
                'fecha_nacimiento'=> $request->fecha_nacimiento,
                'password'=> bcrypt($request->password),
                'roles_id'=> $request->roles_id,
                'rut'=> $request->rut,
                'dv'=> $request->dv,
                'telefono'=> $request->telefono
            ]);
        }else{
            User::find($id)->update([
                'name'=> $request->name,
                'apellido'=> $request->apellido,
                'email'=> $request->email,
                'fecha_nacimiento'=> $request->fecha_nacimiento,
                'roles_id'=> $request->roles_id,
                'rut'=> $request->rut,
                'dv'=> $request->dv,
                'telefono'=> $request->telefono
            ]);
        }

        return back();

    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect::back();
    }
}
