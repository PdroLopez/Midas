<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Session;
use Auth;
use App\Mail\VerificarCuenta;
use Illuminate\Support\Facades\Mail;
use App\User as users;
use App\AlergiasPaciente as alergiasP; 
use App\Http\Controllers\PruebaApiController as api;
use Log;

class UsuariosController extends Controller
{
   
    public function store(Request $request)
    {
        $users = new users($request->all());
        $users->password = bcrypt($request->password);
        $users->save();
        Session::put('mensaje',['content'=>'Registro creado exitosamente','type'=>'success']);
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $users = users::find($id);
        $users->fill($request->all());
        $users->save();
        Session::put('mensaje',['content'=>'Registro actualizado exitosamente','type'=>'success']);
        return redirect::back();
    }

    public function destroy($id)
    {
        $users = users::find($id);
        $users->delete();
        Session::put('mensaje',['content'=>'Registro eliminado exitosamente','type'=>'success']);
        return redirect::back();
    }

    public function mi_perfil()
    {
        if (Auth::user()->roles_id == 15) {
            return view('private.new_mi_perfil');
        }
        if (Auth::user()->roles_id == 14) {
            return view('private.medico_mi_perfil');
        }

        return view('private.mi_perfil');
    }

    public function cambiar_foto(Request $request)
    {
        if ($request->HasFile('archivo')) 
        {
            $nombre = Auth::user()->id.'.'.$request->archivo->getClientOriginalExtension();
            Storage::putFileAs('public/fotos-perfil/', $request->file('archivo'), $nombre);  
            $users = users::find(Auth::user()->id);
            $users->foto = $nombre;
            $users->save();
            Session::put('mensaje',['content'=>'Foto actualizada','type'=>'success']);
        }
        else{
            Session::put('mensaje',['content'=>'No se encontro archivo','type'=>'danger']);
        }
        return redirect::back();
    }

    public function quitar_foto(Request $request)
    {
        $users = users::find(Auth::user()->id);
        $users->foto = null;
        $users->save();
        Session::put('mensaje',['content'=>'Foto quitada','type'=>'success']);
        return redirect::back();
    }
    

    public function actualizar(Request $request)
    {
        $users = users::find(Auth::user()->id);
        $users->fill($request->all());
        $users->save();
        Session::put('mensaje',['content'=>'Registro actualizado exitosamente','type'=>'success']);
        return redirect::back();
    }

    public function restablecer_contraseña(Request $request)
    {
        $users = users::find(Auth::user()->id);
        if (password_verify($request->old_ps, $users->password)) {
            if ($request->password1 == $request->password2) {
                $users->password = bcrypt($request->password1);
                $users->save();
                Session::put('mensaje',['content'=>'Contraseña actualizada','type'=>'success']);
            }
            else{
                Session::put('mensaje',['content'=>'Contraseñas no coinciden','type'=>'danger']);
            }
        } 
        else{
            Session::put('mensaje',['content'=>'La contraseña es incorrecta','type'=>'danger']);
        }
        return redirect::back();
    }


    public function crear_medico(Request $request)
    {
        $users = new users($request->all());
        $users->roles_id = 14;
        $users->password = bcrypt($request->password);
        $users->save();
        $array = $request->all();
        $api = new api();
        $prueba = $api->crearUsuario($array);
        $codigo_array = json_decode($prueba,true);
        Log::info($codigo_array);
        $us = users::find($users->id);
        $us->id_syswooy = $codigo_array['codigo'];
        $us->save();
        Session::put('mensaje',['content'=>'Registro creado exitosamente','type'=>'success']);
        return redirect::back();

    }
    public function crear_paciente(Request $request)
    {
     
        $users = new users($request->all());
        $users->roles_id = 15;
        $users->password = bcrypt($request->password);
        $users->save();

        foreach ($request->alergia_id as $value) {
            $alergias = new alergiasP();
            $alergias->users_id=$users->id;
            $alergias->alergia_id=$value;
            $alergias->save();
        }

        Session::put('mensaje',['content'=>'Registro creado exitosamente','type'=>'success']);
        return redirect::back();
    }

    public function registro_portal(Request $request){
        $users = new users($request->all());
        $users->roles_id = $request->rol;
        $users->password = bcrypt($request->password);
        $users->estado = 0; //Pendiente
        $users->validado = 0;
        $users->validar_mail = str_random(4);
        $users->validar_telefono = str_random(4);

        //confirmation code
        Mail::to($users->email)->send(new VerificarCuenta($users));

        $users->save();
        
        if($request->rol == 14){
            return redirect('/doctor/inscripcion/paso-1');
        }

        if($request->rol == 15){
            return redirect('/paciente/inscripcion/paso-1');
        }
    }

     public function verificar_cuenta(Request $request){
        $user = users::where('validar_mail', $request->pin)->first();

        if(!$user){

            $user = users::where('validar_telefono', $request->pin)->first();

            if (!$user) {
                return redirect::back();
            }else{
                $user->estado = 1;
                $user->validado = 1;
                $user->validar_mail = null;
                $user->validar_telefono = null;
                $user->save();
                
                if($user->roles_id == 14){
                    return redirect('/doctor/inscripcion/paso-2')->with('notification', 'Has confirmado correctamente la creación de tu cuenta');
                }

                if($user->roles_id == 15){
                    return redirect('/paciente/inscripcion/paso-2')->with('notification', 'Has confirmado correctamente la creación de tu cuenta');
                }
            }

        }else{
            $user->estado = 1;
            $user->validado = 1;
            $user->validar_mail = null;
            $user->validar_telefono = null;
            $user->save();
            if($user->roles_id == 14){
                return redirect('/doctor/inscripcion/paso-2')->with('notification', 'Has confirmado correctamente la creación de tu cuenta');
            }

            if($user->roles_id == 15){
                return redirect('/paciente/inscripcion/paso-2')->with('notification', 'Has confirmado correctamente la creación de tu cuenta');
            }
        }

    }
}