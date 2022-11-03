<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Empresa as empresa;
use Illuminate\Support\Facades\Redirect;
use Modules\Login\Entities\Region;
use Modules\Login\Entities\Comuna;
use App\User;
use Modules\Backend\Entities\DireccionUser;

use Modules\Backend\Entities\DireccionEmpresa;
use Modules\Backend\Http\Requests\EmpresaRequest;
use App\EmpresaUsuario as EmpresaUsuario;
use Modules\Backend\Entities\Estados as estado;
use Modules\Workflow\Entities\Marcas as marca;
use Modules\Workflow\Entities\EmpresasMarcas as empresa_marca;

use Session;


class EmpresaController extends Controller
{
    public function index()
    {
    	$empresa = Empresa::all();
        $region = Region::all();
        $estado = estado::where('id',22)->Orwhere('id',23)->pluck('nombre','id');
        $marca = marca::pluck('nombre','id');
    	return view('backend::private.empresa.index',compact('marca','estado','empresa','region'));
    }

    public function index_direcciones($id)
    {
        //TODO falta colocar el contexto de la empresa es decir si estoy en la empresa 1 debe salir dlos datos de la empresa uno

        $direcciones = DireccionEmpresa::where('empresas_id',$id)->OrWhere('bk_estados_id','!=',23)->get();
        $empresa = empresa::where('id',$id)->first();

        $empresa_id=$id;

        $region = Region::pluck('nombre','id');

    	return view('backend::private.empresa.index_direcciones',compact('empresa','direcciones','empresa_id','region'));
    }

    public function index_users($id)
    {
        //TODO falta colocar el contexto de la empresa es decir si estoy en la empresa 1 debe salir dlos datos de la empresa uno
        $empresa_id=$id;
        $empresa = empresa::where('id',$id)->first();

        $users= User::pluck('name','id');
    	$usuarios = EmpresaUsuario::where('empresas_id',$id)->get();
    	return view('backend::private.empresa.index_users',compact('empresa','usuarios','empresa_id','users'));
    }
    public function store(EmpresaRequest $request)
    {

        try {

            $validatedData = $request->validated();

            $empresa = new empresa($request->all());
            $empresa->save();

            $empresa_marca = empresa_marca::create([
                'marcas_id'=> $request->marcas_id,
                'empresas_id'=> $empresa->id,
            ]);
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);

            return redirect::back();

        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Empresa agregada con exito','type'=>'primary']);

            return redirect::back();
        }

        /*

        try {
        	$user = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> bcrypt($request->password),
                'roles_id'=> 15,
                'telefono'=> $request->telefono
            ]);
            $empresa = Empresa::create([
                'razon_social' => $request->razon_social,
                'nombre' => $request->nombre_empresa,
                'users_id' => $user->id,
                'bk_estados_id' => 18,
                'cargo'=> $request->cargo
            ]);
            DireccionEmpresa::create([
                'nombre' => $request->direccion,
                'empresas_id' => $empresa->id,
                'bk_comunas_id' => $request->bk_comunas_id,
                'bk_regiones_id' => $request->bk_regiones_id
            ]);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }*/
    }
    public function update(Request $request, $id)
    {
        try {
            $emp = Empresa::find($id);
        	Empresa::find($id)->update([
        		'razon_social'=> $request->razon_social,
                'nombre'=> $request->nombre,
                'rut'=> $request->rut,
    			'retc'=> $request->retc,
                'observaciones'=>$request->observaciones
        	]);
            // User::find($emp->usuario->id)->update([
            //     'name'=> $request->name,
            //     'email'=> $request->email,
            //     'telefono'=> $request->telefono
            // ]);
            Session::flash('mensaje',['content'=>'Empresa actualizada con exito','type'=>'primary']);
        	return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }
    public function destroy($id)
    {
        try {
        	Empresa::find($id)->delete();
            Session::flash('mensaje',['content'=>'Empresa eliminada con exito','type'=>'primary']);
        	return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }

    public function editUserEmpresa(Request $request )
    {
        dd("llegue");

    }
    public function postUserEmpresa(Request $request ){

        $empresa = new EmpresaUsuario($request->all());
        $empresa->save();
        //TODO falta validar que el usuario seleccionado ya existe asociado a esa empresa si es asi debe haber un mensaje de danger
        Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'success']);
        return redirect::back();

    }
    public function estado($id)
    {
        try {
        	Empresa::find($id)->update([
        		'bk_estados_id'=>22
        	]);
            Session::flash('mensaje',['content'=>'Empresa aceptada con exito','type'=>'primary']);
        	return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }
    public function estadodesactivar($id)
    {
        try {
        	Empresa::find($id)->update([
        		'bk_estados_id'=>23
        	]);
            Session::flash('mensaje',['content'=>'Empresa aceptada con exito','type'=>'primary']);
        	return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }
    public function Desactivar_Direccion($id)
    {

        $direccion = DireccionEmpresa::find($id);
        $direccion->bk_estados_id = 23;
        $direccion->save();
            // $direcciones = DireccionEmpresa::where('empresas_id',$id)->pluck('id');
        // $a = DireccionEmpresa::find($direcciones)->update([
        //     'bk_estados_id'=>23
        // ]);
        // // dd($direcciones);
        Session::flash('mensaje',['content'=>'Direccion desactivada con exito','type'=>'primary']);
        return redirect::back();

    }

    public function Desactivar_User($id)
    {
        $direccion = EmpresaUsuario::find($id);
        $direccion->bk_estados_id = 23;
        $direccion->save();
        Session::flash('mensaje',['content'=>'Direccion desactivada con exito','type'=>'primary']);
        return redirect::back();

    }

    public function agregar_direccion(Request $request){
        try {
            $direccion = DireccionEmpresa::create([
                'nombre'=> $request->nombre,
                'empresas_id'=> $request->empresas_id,
                'bk_regiones_id'=> $request->bk_regiones_id,
                'bk_comunas_id'=> $request->bk_comunas_id
            ]);
            Session::flash('mensaje',['content'=>'Dirección agregada con exito','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }
}
