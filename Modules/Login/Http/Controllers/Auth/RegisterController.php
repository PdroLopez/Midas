<?php

namespace Modules\Login\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\DireccionUsuario;
use App\Empresa;
use Modules\Backend\Entities\DireccionEmpresa;
use Modules\Backend\Entities\Comunidad;
use Modules\Login\Entities\Region as region;
use App\EmpresaUsuario;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        $comunidades = Comunidad::all();
        $region = region::all();
        return view('login::auth.register',compact('comunidades','region'));
    }
    public function register(Request $request)
    {
        try {
            // if($request->tipo == 1){
                $user = User::create([
                    'name'=> $request->name,
                    'apellido'=> $request->apellido,
                    'email'=> $request->email,
                    'password'=> bcrypt($request->password),
                    'roles_id'=> 19,
                    'telefono'=> '+56'.$request->telefono,
                    'bk_comunidades_id'=>$request->comunidades
                ]);
                DireccionUsuario::create([
                    'nombre'=> $request->direccion,
                    'users_id'=> $user->id,
                    'bk_comunas_id'=> $request->bk_comunas_id,
                    'bk_regiones_id'=> $request->bk_regiones_id
                ]);
            // }
            // else if($request->tipo == 2){
            //     $user = User::create([
            //         'name'=> $request->name,
            //         'email'=> $request->email,
            //         'password'=> bcrypt($request->password),
            //         'roles_id'=> 17,
            //         'telefono'=> '+56'.$request->telefono
            //     ]);
            //     $empresa = Empresa::create([
            //         'razon_social' => $request->razon_social,
            //         'nombre' => $request->nombre_empresa,
            //         'rut'=> $request->rut,
            //         'bk_estados_id' => 18
            //     ]);
            //     EmpresaUsuario::create([
            //         'cargo'=>$request->cargo,
            //         'users_id'=>$user->id,
            //         'empresas_id'=>$empresa->id
            //     ]);
            //     DireccionEmpresa::create([
            //         'nombre' => $request->direccion,
            //         'empresas_id' => $empresa->id,
            //         'bk_comunas_id' => $request->bk_comunas_id,
            //         'bk_regiones_id' => $request->bk_regiones_id
            //     ]);
            // }
            Session::flash('mensaje',['content'=>'Registro realizado con exito','type'=>'primary']);
            Auth::login($user, true);
            return Redirect::action('HomeController@index');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect('login'); 
        } 
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roles_id'=>17
        ]);
    }
    public function paso_2(Request $request)
    {
        $tipo = $request->tipo;
        if($request->tipo == 1){
            return view('login::auth.usuario.paso2',compact('tipo'));
        }else if($request->tipo == 2){
            $region = region::all();
            return view('login::auth.empresa.paso2',compact('tipo','region'));
        }
    }
    public function userPaso_3(Request $request)
    {
        $name = $request->name;
        $apellido = $request->apellido;
        $email = $request->email;
        $tipo = $request->tipo;
        return view('login::auth.usuario.paso3',compact('name','apellido','email','tipo'));
    }
    public function userPaso_4(Request $request)
    {
        $name = $request->name;
        $apellido = $request->apellido;
        $email = $request->email;
        $tipo = $request->tipo;
        $telefono = $request->telefono;
        $password = $request->password;
        $comunidades = Comunidad::all();
        return view('login::auth.usuario.paso4',compact('name','apellido','email','tipo','telefono','password','comunidades'));
    }
    public function userPaso_5(Request $request)
    {
        $region = region::all();
        $name = $request->name;
        $apellido = $request->apellido;
        $email = $request->email;
        $tipo = $request->tipo;
        $telefono = $request->telefono;
        $password = $request->password;
        $comunidades = $request->comunidades;
        return view('login::auth.usuario.paso5',compact('name','apellido','email','tipo','telefono','password','comunidades','region'));
    }
    public function empresaPaso_3(Request $request)
    {
        $tipo = $request->tipo;
        $nombre_empresa=$request->nombre_empresa;
        $rut=$request->rut;
        $razon_social=$request->razon_social;
        $bk_regiones_id=$request->bk_regiones_id;
        $bk_comunas_id=$request->bk_comunas_id;
        $direccion=$request->direccion;
        return view('login::auth.empresa.paso3',compact('tipo','nombre_empresa','rut','razon_social','bk_regiones_id','bk_comunas_id','direccion'));
    }
}
