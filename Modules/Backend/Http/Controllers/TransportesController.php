<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Modules\Backend\Entities\Camion;
use Modules\Backend\Entities\TipoCamion as tipo_camion;
use Session;

class TransportesController extends Controller
{
    public function conductores()
    {
    	$user = User::where('roles_id',12)->get();
        return view('backend::private.conductores.index',compact('user'));
    }

    public function camiones()
    {
    	$camiones = Camion::all();
        $user = User::where('roles_id',12)->pluck('name','id');
    	$tipo_camion = tipo_camion::pluck('nombre','id');
        return view('backend::private.camiones.index',compact('camiones','user','tipo_camion'));
    }

    public function store(Request $request)
    {
    	try {
    		Camion::create([
    			'patente' => $request->patente,
				'users_id' => $request->users_id,
                'tipo_camion_id' => $request->tipo_camion_id,
                'nombre' => $request->nombre
    		]);
            Session::flash('mensaje',['content'=>'Camion agregado','type'=>'primary']);
            return redirect::back();

    	} catch (Exception $e) {
			Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();			    		
    	}
    }

    public function update(Request $request,$id)
    {
        try {
            $camiones = Camion::find($id);
            $camiones->fill($request->all());
            $camiones->save();
            Session::flash('mensaje',['content'=>'Camion actualizado','type'=>'primary']);
            return redirect::back();

        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();                        
        }
    }
}
