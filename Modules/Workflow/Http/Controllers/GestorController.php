<?php

namespace Modules\Workflow\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\User;
use App\Residuo;
use App\Horario;
use App\HorarioDia;
use Modules\Tienda\Entities\Transaccion;
use Modules\Workflow\Entities\Solicitud;
use Modules\Workflow\Entities\Ticket;
use App\ImagenSolicitud;
use App\Seguimiento;
use App\Empresa;
use Carbon\Carbon;
use Modules\Workflow\Entities\Boleta;
use Modules\Workflow\Entities\Calidad;
use Modules\Dgr\Entities\Configuracion;
use Modules\Backend\Entities\Camion;
use Modules\Backend\Entities\TipoCamion;
use Modules\Workflow\Entities\EmpresasMarcas as em;
use App\Camiones as camiones;
use Modules\Workflow\Entities\BoletaSolicitud;
use Modules\Workflow\Entities\Bitacora as bit;
use Illuminate\Support\Facades\Redirect;
use App\Acceso;
use App\ImagenAcceso;
use Modules\Workflow\Entities\Clasificacion;
use Modules\Workflow\Entities\Grupo;
use Modules\Workflow\Entities\GrupoClasificacion;
use Modules\Workflow\Entities\Marcas;
use Modules\Workflow\Entities\EmpresasMarcas;
use Modules\Workflow\Entities\TicketTipoProducto;
use Session;
use App\DireccionUsuario;
use App\EmpresaUsuario;
use Modules\Login\Entities\Region;
use Modules\Login\Entities\Comuna;
use Modules\Backend\Entities\DireccionEmpresa;
use Modules\Backend\Entities\Estados;
use Modules\Backend\Entities\TipoProducto;
use Modules\Backend\Entities\TipoServicio;
use Modules\Backend\Entities\SubCategoria;
use Modules\Backend\Entities\Destino;
use App\Retiro;
use Auth;
use Log;
use File;
use Storage;

class GestorController extends Controller
{
	//wizard particular
    public function index()
    {
    	$user = User::whereIn('roles_id',[17,19])->get();
    	$residuo = Residuo::all();
    	$horario = Horario::all();
    	$hr_dia = HorarioDia::all();
        return view('workflow::private.solicitud.create_particular',compact('user','residuo','horario','hr_dia'));
    }

    public function historial()
    {
        $chofer = User::where('roles_id',12)->pluck('id');
        $choferes = User::where('roles_id',12)->pluck('name', 'id');
        $vehiculo = camiones::pluck('patente','id');
        $boleta = boleta::where('bk_estados_id',19)->where('camionero_id',$chofer)->get();
       //$programacion = programacion::all();
       $total = Boleta::where('bk_estados_id',1)->get();
       $boletas = Boleta::whereIn('bk_estados_id',[29,30,2])->orderBy('updated_at','desc')->paginate(10);
       $enproceso = Boleta::where('bk_estados_id',[9,26])->get();
       $aceptado = Boleta::where('bk_estados_id',8)->get();
       $cancelado = Boleta::where('bk_estados_id',17)->get();
       $terminado = Boleta::where('bk_estados_id',2)->get();
       $transaccion = Transaccion::orderBy('id','DESC')->get();

        return view('workflow::private.historial',compact('transaccion','choferes','vehiculo','boletas','total','enproceso','aceptado','cancelado','terminado'));
    }
    public function obtener_user($id)
	{
		$user = User::find($id);
        $direccion = DireccionUsuario::where('users_id',$id)->get();
        $region = Region::all();
		return response()->json(['user'=>$user, 'direccion'=>$direccion, 'region'=>$region]);
	}
    public function obtener_user_empresa($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function sendAprobacion($id){
        // la solicitud de creada pasa a estar en aprobación
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>25
            ]);

            Session::flash('success', "Solicitud en proceso.");
            //Session::flash('mensaje',['content'=>'Solicitud en proceso','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            //Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            Session::flash('error', "Surgio un problema inseperado.");
            return redirect::back();
        }

    }
    public function sendProgramacion($id){
        // la solicitud en aprobación se envía aprobada a programación
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>26
            ]);

            Session::flash('success', "Solicitud en proceso.");
            //Session::flash('mensaje',['content'=>'Solicitud en proceso','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            //Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            Session::flash('error', "Surgio un problema inesperado.");
            return redirect::back();
        }

    }
    public function sendProcesar($id){
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>30
            ]);
            Session::flash('success', "Solicitud en proceso.");
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('error', "Surgio un problema inesperado.");
            return redirect::back();
        }

    }
    
    public function pesa()
    {
        $chofer = User::where('roles_id',12)->pluck('id');
        $choferes = User::where('roles_id',12)->pluck('name', 'id');
        $vehiculo = camiones::pluck('patente','id');
        $boleta = boleta::where('bk_estados_id',19)->where('camionero_id',$chofer)->get();
       //$programacion = programacion::all();
       $valor = Configuracion::find(32);//Dias de horizonte para ver las solicitudes para el pesador
       $total = Boleta::where('bk_estados_id',1)->get();
       $date = Carbon::now();
       $addDate = $date->subDay($valor->variable);
        $grupo = Grupo::all();
        $tipo_producto = TipoProducto::where('activo',0)->get();
       $addDate =  $addDate->format('Y-m-d');

        // $a= date("d-m-Y", strtotime("now"));

       $boletas = Boleta::wherein('bk_estados_id',[27,28])->Where('fecha_hora','>=' , $addDate)->orderBy('updated_at','DESC')->paginate(10);
    //    $boletas = Boleta::wherein('bk_estados_id',[9,21,28,27,29])->OrWhere('created_at','>=' , $addDate)->orderBy('id','DESC')->paginate(5);
       $enproceso = Boleta::where('bk_estados_id',[9,26])->get();
       $aceptado = Boleta::where('bk_estados_id',8)->get();
       $cancelado = Boleta::where('bk_estados_id',17)->get();
       $terminado = Boleta::where('bk_estados_id',2)->get();
       $transaccion = Transaccion::orderBy('id','DESC')->get();
        return view('workflow::private.pesajes.index',compact('transaccion','choferes','vehiculo','boletas','total','enproceso','aceptado','cancelado','terminado','grupo','tipo_producto'));

    }
	public function obtener_prod($id)
	{
    	$residuo = Residuo::find($id);
		return response()->json($residuo);
	}
	public function obtener_hor($id,$hor)
	{
    	$horario = Horario::find($id);
    	$hr_dia = HorarioDia::find($hor);
        $residuo = Session::get('prod_particular');

		return response()->json(['horario'=>$horario, 'hr_dia'=>$hr_dia, 'residuo'=>$residuo]);
	}
	//solicitud wizard para persona natural
	public function add_sol(Request $request)
	{
        try {
            $codigo = time();
            $horario = Horario::find($request->tiporetiro);
            $total = intval($horario->precio) + intval($horario->totalproducto);

            if ($request->comentario){
                $acceso = Acceso::create([
                    'comentario'=> $request->comentario
                ]);
            }else{
                $acceso = Acceso::create([
                    'comentario'=> "Sin cometario"
                ]);
            }

         //archivo de acceso

            // if ($request->file('accesos')) {
            //     $imgAcc = $request->file('accesos');
            //     $imgAccName = time().'.'.$imgAcc->getClientOriginalExtension();
            //     $imgAcc->move('public/img/accesos/',$imgAccName);

            // }

            if ($request->hasFile('accesos')) {
                $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $random = substr(str_shuffle($permit),0,25);
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($request->accesos->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $ruta_archivo = 'accesos/'.$random.'/';
                $ruta = Storage::putFileAs($ruta_archivo,$request->file('accesos'),$nombre);
                $imgAcc = $request->file('accesos');
                $acc = ImagenAcceso::create([
                    'archivo'=>$nombre,
                    'url'=>$ruta_archivo.''.$nombre,
                    'accesos_id'=>$acceso->id
                ]);
            }



            //productos desde la sesion

            $array = array();
            if (Session::has('prod_particular')) {
                foreach (Session::get('prod_particular') as $value) {
        	        $residuo2 = Residuo::find($value['producto']);
                    $nombre_residuo = $value['residuo'];
                    if ($value['producto'] == 0) {
                        $residuo_id = null;
                    }else{
                        $residuo_id = $value['producto'];
                    }
                    $soli = Solicitud::create([
                        'Residuos_id'=> $residuo_id,
                        'nombre'=> $nombre_residuo,
                        'peso' => $value['peso'],
                        'cantidad' => $value['cantidad'],
                        'altura'=> $value['altura'],
                        'largo'=> $value['largo'],
                        'profundidad' => $value['profundidad'],
                        'motivo'=> $value['motivo'],
                        'precio'=> $value['precio'],
                        'mt3'=> $value['mt3'],
                        'accesos_id'=>$acceso->id
                    ]);
                    $dato_id = array(
                        'id'=>$soli->id
                    );

                    array_push($array, $dato_id);

                    $id = ImagenSolicitud::create([
                        'archivo'=> $value['imagen'],
                        'url' => 'storage',
                        'sl_solicitudes_id' => $soli->id
                    ]);

                }
                Session::forget('prod_particular');

            }

            // if($request->file('file')){
            //     $imagen = $request->file('file');

            //     $imgName = time().'.'.$imagen->getClientOriginalExtension();
            //     $imagen->move('public/img/solicitudes/',$imgName);
            //     $id = ImagenSolicitud::create([
            //         'archivo'=> $imgName,
            //         'url' => 'public/img/solicitudes/',
            //         'sl_solicitudes_id' => $soli->id
            //     ]);
            // }
            $user = User::find($request->usuario);
            $nombre_user = $user->name.' '.$user->apellido;
            $telefono = $user->telefono;
            $correo = $user->email;

            if ($request->direccion_usuario != 'otra') {
                $boleta = Boleta::create([
                    'total'=>$total,
                    'codigo'=>$codigo,
                    'bk_estados_id'=>1,
                    'users_id'=>$request->usuario,
                    'horarios_id'=>$request->tiporetiro,
                    'horarios_dias_id'=>$request->horario,
                    'bk_direcciones_user_id'=>$request->direccion_usuario,
                    'creador_id'=>Auth::user()->id,
                    'nombre'=>$nombre_user,
                    'telefono'=>$telefono,
                    'correo'=>$correo,
                    "tipo_pago" => $request->pago
                ]);

            }else{
                $direccion_usuario = DireccionUsuario::create([
                    'nombre'=> $request->direccion,
                    'users_id' => $request->usuario,
                    'bk_comunas_id'=> $request->comunas,
                    'bk_regiones_id'=> $request->regiones
                ]);
                $boleta = Boleta::create([
                    'total'=>$total,
                    'codigo'=>$codigo,
                    'bk_estados_id'=>1,
                    'users_id'=>$request->usuario,
                    'horarios_id'=>$request->tiporetiro,
                    'horarios_dias_id'=>$request->horario,
                    'bk_direcciones_user_id'=>$direccion_usuario->id,
                    'creador_id'=>Auth::user()->id

                ]);
            }

            foreach($array as $dato){
                $bol_sol = BoletaSolicitud::create([
                    'sl_solicitudes_id'=>$dato['id'],
                    'boletas_id'=>$boleta->id
                ]);
            }
            Session::flash('mensaje',['content'=>'Solicitud exitosa','type'=>'primary']);
            return redirect('workflow');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect('workflow');
        }
	}
	//vista seguimiento
	public function seguimiento($id)
	{
        $id_empresas = Boleta::where('id',$id)->pluck('empresas_id');
        $marcas= em::where('empresas_id',$id_empresas)->get();
        $comentarios = BoletaSolicitud::where('boletas_id',$id)->get();
        $soli = Boleta::find($id);
        $bol = $id;
        $bitacora = bit::where('boletas_id',$id)->get();
        $id_boleta_soli = BoletaSolicitud::where('boletas_id',$id)->pluck('sl_solicitudes_id');
        $accesos_id= Solicitud::where('id',$id_boleta_soli)->pluck('accesos_id');
        $imagen = ImagenAcceso::where('accesos_id',$accesos_id)->get();
        // dd($imagen);
       // $segui = Seguimiento::where('sl_solicitudes_id',$soli->solicitudes->first()->sl_solicitudes_id)->get();
	   return view('workflow::private.solicitud.view_industrial',compact('soli','bol','bitacora','marcas','comentarios','imagen'));

    }
	//wizard empresa
	public function wizard()
	{
        $empresaUsuario = EmpresaUsuario::where('users_id',Auth::user()->id)->get();
        $empresaMarca = EmpresasMarcas::all();
        $empresas = Empresa::all();
        $horario = Horario::all();
        $hr_dia = HorarioDia::all();
        $grupo = Grupo::all();
        $marcas = Marcas::all();
        $region = Region::all();
        $tipo_producto = TipoProducto::where('activo',0)->get();
        $tipo_servicio = TipoServicio::all();
        $estado = Estados::where('id',22)->Orwhere('id',23)->pluck('nombre','id');
        $marca = Marcas::pluck('nombre','id');
        $direcciones_emp = DireccionEmpresa::all();
        $destinos = Destino::all();
        $hr_dia = HorarioDia::all();

		return view('workflow::private.solicitud.create_industrial_new',compact('empresas','horario','grupo','hr_dia','marcas','region','empresaUsuario','empresaMarca','tipo_producto','tipo_servicio','estado','marca','direcciones_emp','destinos','hr_dia'));
	}
    //datos para resument
    public function obtenerDatos($id, $empresa, $hora)
    {
        $empresas = Empresa::find($empresa);
        $horario = Horario::find($hora);
        $hr_dia = HorarioDia::find($id);
        $productos = null;
        if (Session::has('prod_industrial')) {
            $productos = Session::get('prod_industrial');
        }
        return response()->json(['empresas'=>$empresas, 'horario'=>$horario, 'hr_dia'=>$hr_dia, 'productos'=>$productos]);
    }
    //buscar direccion de empresa
    public function buscar_direccion($id)
    {
        $empresa = Empresa::find($id);
        Session::forget('empresa_retiro_industrial');
        Session::put('empresa_retiro_industrial',$empresa);
        $direccion = DireccionEmpresa::
        leftjoin('bk_regiones', 'bk_direcciones_empresas.bk_regiones_id', '=', 'bk_regiones.id')
        ->leftjoin('bk_comunas', 'bk_direcciones_empresas.bk_comunas_id', '=', 'bk_comunas.id')
        ->where('empresas_id',$id)
        ->select('bk_direcciones_empresas.*',
            'bk_comunas.nombre as comunas',
            'bk_regiones.nombre as regiones')
        ->get();
        $region = Region::all();
        return response()->json(['direccion'=>$direccion, 'region'=> $region]);
    }

    public function edit_buscar_direccion($id)
    {
        $empresa = Empresa::find($id);
        Session::forget('edit_empresa_retiro_industrial');
        Session::put('edit_empresa_retiro_industrial',$empresa);
        $direccion = DireccionEmpresa::
        leftjoin('bk_regiones', 'bk_direcciones_empresas.bk_regiones_id', '=', 'bk_regiones.id')
        ->leftjoin('bk_comunas', 'bk_direcciones_empresas.bk_comunas_id', '=', 'bk_comunas.id')
        ->where('empresas_id',$id)
        ->select('bk_direcciones_empresas.*',
            'bk_comunas.nombre as comunas',
            'bk_regiones.nombre as regiones')
        ->get();
        $region = Region::all();
        return response()->json(['direccion'=>$direccion, 'region'=> $region]);
    }

    public function buscar_marca($id){
        $marcas = EmpresasMarcas::where('marcas_id',$id)->get();
        $marca = Marcas::all();
        return response()->json(['marcas'=>$marcas , 'marca'=>$marca]);
    }

    public function buscar_residuo($id){
        $residuo = Solicitud::find($id);
        return response()->json($residuo);
    }

    public function buscar_empresa($id){
        // Log::info($id);

        $empresas = EmpresasMarcas::where('marcas_id',$id)->pluck('empresas_id');
        $empresas2 = Empresa::wherein('id',$empresas)->where('bk_estados_id',22)->get();

        // Log::info('empresas busqueda');
        // Log::info($empresas2);
        $empresa = Empresa::all();
        return response()->json(['empresas'=>$empresas , 'empresa'=>$empresa, 'empresas2'=>$empresas2]);
    }

    public function nueva_direccion(Request $request){
        $direccion = DireccionEmpresa::create([
            'empresas_id'=>$request->empresa_id,
            'bk_regiones_id'=>$request->bk_regiones_id,
            'bk_comunas_id'=>$request->bk_comunas_id,
            'bk_estados_id'=>$request->bk_estados_id,
            'nombre'=>$request->direccion
        ]);
        $empresa = Empresa::find($request->empresa_id);
        Session::forget('empresa_retiro_industrial');
        Session::put('empresa_retiro_industrial',$empresa);
        Session::forget('direccion_retiro_industrial');
        Session::put('direccion_retiro_industrial',$direccion);
        return redirect::back();
    }

    public function addSoliEmpresa(Request $request)
    {
        try {

            if (Session::has('prod_industrial')) {
            }else{
                return redirect::back();
            }
            //crea el mensaje del comentario si este aplica siempre va a ocurrir
            $codigo = time();
            if ($request->comentario){
                $acceso = Acceso::create([
                    'comentario'=> $request->comentario
                ]);
            }else{
                $acceso = Acceso::create([
                    'comentario'=> "Sin cometario"
                ]);
            }

            if ($request->hasFile('accesos')) {
                foreach ($request->accesos as $key => $value) {
                    $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $random = substr(str_shuffle($permit),0,25);
                    $random_nombre = substr(str_shuffle($permit),0,12);
                    $extension = pathinfo($value->getClientOriginalName(),PATHINFO_EXTENSION );
                    $nombre = $random_nombre.'.'.$extension;
                    $ruta_archivo = 'accesos/'.$random.'/';
                    $ruta= Storage::putFileAs($ruta_archivo,$value,$nombre);
                    $acc = ImagenAcceso::create([
                        'archivo'=>$nombre,
                        'url'=>$ruta_archivo.''.$nombre,
                        'accesos_id'=>$acceso->id
                    ]);
                }
            }

            $array = array();
            if (Session::has('prod_industrial')) {
                foreach (Session::get('prod_industrial') as $value) {
                    if($value['id_tipo_producto'] == 'otro'){
                        $tipo_producto_id = null;
                        $otro_estado = $value['nom_tipo_producto'];
                    }else{
                        $tipo_producto_id = $value['id_tipo_producto'];
                        $otro_estado = null;
                    }
                    $soli = Solicitud::create([
                        'accesos_id' =>$acceso->id,
                        'clasificaciones_id' =>$value['id_clasi'],
                        'grupos_id' =>$value['id_grupo'],
                        'subcategoria_id' =>$value['id_subcate'],
                        'tipo_producto_id' =>$tipo_producto_id,
                        'otro_estado' =>$otro_estado,
                        // 'destruccion_certificada' =>$value['des_certificada'],
                        'peso'=> $value['peso'],
                        // 'cantidad'=> $value['cantidad'],
                        'detalle_retiro'=>$value['detalle_retiro']
                    ]);
                    $dato_id = array(
                        'id'=>$soli->id
                    );
                    array_push($array, $dato_id);
                }
                Session::forget('prod_industrial');
            }

            // $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            // $ran_sol = substr(str_shuffle($permit),0,6);
            // if ($request->hasFile('imagen')) {
            //     foreach ($request->imagen as $key => $value) {
            //         $random = substr(str_shuffle($permit),0,25);
            //         $random_nombre = substr(str_shuffle($permit),0,12);
            //         $extension = pathinfo($value->getClientOriginalName(),PATHINFO_EXTENSION );
            //         $nombre = $random_nombre.'.'.$extension;
            //         $ruta= Storage::putFileAs('temporal/'.$random,$value,$nombre);

            //         if (Session::has('foto_retiro_corto')) {
            //            $session_foto = Session::get('foto_retiro_corto');
            //            $array_foto = array(
            //                 'imagen'=>$ruta,
            //                 'id_sol'=> $ran_sol
            //            );
            //            array_push($session_foto, $array_foto);
            //            Session::put('foto_retiro_corto',$session_foto);
            //         }else{
            //             $session_foto_first = array(0=>[
            //                 'imagen'=> $ruta,
            //                 'id_sol'=> $ran_sol
            //             ]);
            //             Session::put('foto_retiro_corto',$session_foto_first);
            //         }
            //     }
            // }
            
            if($request->destino == 0){
                $destino_midas = $request->destino_midas;
            }else{
                $destino_midas = null;
            }

            // creo la instancia asociada a la solicitud si la direccion es nueva debo crear la dirección tambien de lo contrario solo la boleta

            if($request->direccion_usuario){
                $direccion_usuario = $request->direccion_usuario;
            }else{
                $dire_empresa = DireccionEmpresa::create([
                    'nombre'=> $request->direccion,
                    'empresas_id'=> $request->empresa,
                    'bk_comunas_id'=> $request->comunas,
                    'bk_regiones_id'=> $request->regiones
                ]);
                $direccion_usuario = $dire_empresa->id;
            }

            $boleta = new Boleta();
            $boleta->codigo = $codigo;
            if (Auth::user()->roles_id == 24 ) { //rol Técnico empresa
                $boleta->bk_estados_id = 31; //31  estado Aprobar del Administrador
            }else{
                 $boleta->bk_estados_id = 24; //24  estado Creado
            }
            $boleta->empresas_id =  $request->empresa;
            $boleta->bk_direcciones_empresas_id = $direccion_usuario;
            $boleta->creador_id = Auth::user()->id;
            $boleta->grua = $request->grua;
            if ($request->operario_carga == 1) {
                $boleta->encargado_grua = $request->encargado_grua;
            }
            $boleta->tipo_servicio_id = $request->tipo_servicio;
            $boleta->destino = $request->destino;
            $boleta->destino_id = $destino_midas;
            $boleta->estacion_camion = $request->esta_camion;
            $boleta->desde = $request->desde_retiro;
            $boleta->hasta = $request->hasta_retiro;
            $boleta->nombre = $request->nombre_contacto;
            $boleta->telefono = $request->telefono_contacto;
            $boleta->correo = $request->email_contacto;
            if($request->jornada != 0){
                $boleta->horarios_dias_id = $request->jornada;
            }
            $boleta->observaciones = $request->observaciones;
            $boleta->destruccion_certificada = $request->des_certificada;
            $boleta->save();

            foreach($array as $dato){
                $bol_sol = BoletaSolicitud::create([
                    'sl_solicitudes_id'=>$dato['id'],
                    'boletas_id'=>$boleta->id
                ]);
            }
            Session::forget('empresa_retiro_industrial');
            Session::forget('direccion_retiro_industrial');
            Session::forget('empresa_retiro_industrial');
            Session::forget('direccion_retiro_industrial');
            Session::flash('mensaje',['content'=>'Solicitud exitosa','type'=>'primary']);
            return redirect('workflow');
        }catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect('workflow');

        }

    }

    public function editar_obs(Request $request)
    {
        $boleta = Boleta::find($request->id);
        $boleta->observaciones = $request->observaciones;
        $boleta->save();
        return redirect::back();
    }

    public function Pesado(Request $request)
    {
        try {
            $ticket = Ticket::create([
                'diferencia_peso_kg'=>$request->diferencia_peso_kg,
                'diferencia_peso'=>$request->diferencia_peso,
                'observaciones'=>$request->observaciones_ticket,
                'descargado_por'=>$request->descargado_por,
                'preparado_por'=>$request->preparado_por,
                'fecha_entrega'=>$request->fecha_entrega,
                'boletas_id'=>$request->id_bol,
            ]);


            foreach ($request->tipo_producto as $key => $value) {
                if($value != '' || $value != 0){
                    if ($key == 0) {
                        $key = null;
                        $otro_estado = $request->otro_estado_ticket;
                    }else{
                        $otro_estado = null;
                    } 
                    TicketTipoProducto::create([
                        'ticket_id'=>$ticket->id,
                        'tipo_producto_id'=>$key,
                        'cantidad'=>$value,
                        'otro_estado'=>$otro_estado,
                    ]);
                }
            }

            if ($request->hasFile('foto')) {
                $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $random = substr(str_shuffle($permit),0,25);
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($request->foto->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $ruta_archivo = 'calidad/'.$random.'/';
                $ruta = Storage::putFileAs($ruta_archivo,$request->file('foto'),$nombre);

                $calidad = Calidad::create([
                    'boletas_id'=>$request->id_bol,
                    'archivo'=>$ruta_archivo.''.$nombre,
                    'observacion'=>$request->observaciones,
                    'sl_tipo_imagen_id'=>2,
                    'users_id'=>Auth::user()->id
                ]);
            }


            Boleta::find($request->id_bol)->update([
                'bk_estados_id'=>29
            ]);
            Session::flash('mensaje',['content'=>'Retiro pesado con exito','type'=>'primary']);
            if(Auth::user()->roles_id == 14){
                return redirect::to('workflow/pesajes');
            }else{
                return redirect('workflow/me');
            }
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            if(Auth::user()->roles_id == 14){
                return redirect::to('workflow/pesajes');
            }else{
                return redirect('workflow/me');
            }
        }
    }
    //estados de solicitudes
    public function en_proceso($id)
    {
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>9
            ]);
            Session::flash('mensaje',['content'=>'Solicitud en proceso','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }
    public function cancelar($id){
        $boleta = Boleta::find($id);
        return view('workflow::private.modal.gestor.cancelar', compact('boleta'));
    }

    public function comentario_cancelar(Request $request)
    {
        try {
            Boleta::find($request->id)->update([
                'bk_estados_id'=>17,
                'comentario_cancelar'=>$request->asunto_cancelar.'-'.$request->comentario_cancelar
            ]);
            Session::flash('mensaje',['content'=>'Solicitud cancelada','type'=>'warning']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }
    public function finalizar($id)
    {
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>2
            ]);
            Session::flash('mensaje',['content'=>'Solicitud finalizada','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }
    public function aceptado($id)
    {
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>8
            ]);
            Session::flash('mensaje',['content'=>'Solicitud aceptada','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }
    public function sendEnCamino($id)
    {
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>9
            ]);
            Session::flash('success', "Solicitud actualizada con éxito");
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('error', "Surgio un problema inesperado, intente mas tarde");

            return redirect::back();
        }
    }
    public function sendEnAprobacionAdministrador($id)
    {
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>1
            ]);
            Session::flash('success', "Solicitud actualizada con éxito");
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('error', "Surgio un problema inesperado, intente mas tarde");

            return redirect::back();
        }
    }
    public function sendRetirado($id)
    {
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>21
            ]);
            Session::flash('success', "Solicitud actualizada con éxito");
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('error', "Surgio un problema inesperado, intente mas tarde");

            return redirect::back();
        }
    }

    public function sendEnPlanta($id)
    {
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>28
            ]);
            Session::flash('success', "Solicitud actualizada con éxito");
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('error', "Surgio un problema inesperado, intente mas tarde");

            return redirect::back();
        }
    }
    public function viewPesaje($id)
    {
        // dd($id);
        // $boleta_a = boleta::where('bk_estados_id',28)->pluck('id');//busco el id,Obtengo los id de las boletas, donde el estado sea igual "en retiro"
        // $productos_retirado =  BoletaSolicitud::wherein('boletas_id', $boleta_a)->get();

        //Se buscan las boletas con el id ingresado
        $solicitudes =  BoletaSolicitud::where('boletas_id' , $id)->pluck('sl_solicitudes_id');
        //Se hace un where in para el select, los que aun no son pesados
        $producto_select = Solicitud::wherein('id',$solicitudes)->where('peso_interno' , NULL)->get();
        //Se busca el de los que si han sido pesados
        $productos = Solicitud::wherein('id',$solicitudes)->where('peso_interno' ,'!=', NULL)->get();
        $boleta = boleta::find($id);
        $grupo = Grupo::all();
        $tipo_producto = TipoProducto::where('activo',0)->get();
        $residuo = Residuo::all();

        // $soli =  BoletaSolicitud::wherein('boletas_id',$boleta_a)->pluck('sl_solicitudes_id');
        // // dd($soli);
        // $produc = Solicitud::wherein('id',$soli)->get();
        // $pro = Solicitud::wherein('id',$solicitudes)->where('peso_interno' ,'!=', NULL)->get();


        // $pesados = Solicitud::wherein('id',$solicitudes)->where('peso_interno' , NULL)->pluck('nombre','id');
        return view('workflow::private.peso',compact('productos','boleta','producto_select','grupo','tipo_producto','residuo'));

    }
    public function edit_peaje(Request $request, $id )
    {
        return "y";
    }

    public function postPesaje(Request $request)
    {
        try {
            Solicitud::find($request->solicitud)->update([
                'peso_interno'=>$request->peso_interno,
                'peso_neto'=>$request->peso_neto,
                'peso_bruto'=>$request->peso_bruto
            ]);
            if ($request->hasFile('foto')) {
                $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $random = substr(str_shuffle($permit),0,25);
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($request->foto->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $ruta_archivo = 'calidad/'.$random.'/';
                $ruta = Storage::putFileAs($ruta_archivo,$request->file('foto'),$nombre);

                $calidad = Calidad::create([
                    'sl_solicitudes_id'=>$request->solicitud,
                    'archivo'=>$ruta_archivo.''.$nombre,
                    'observacion'=>$request->observaciones,
                    'users_id'=>Auth::user()->id
                ]);
            }
            Session::flash('success', "Solicitud actualizada con éxito");
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('error', "Surgio un problema inesperado, intente mas tarde");

            return redirect::to('pesaje/'.$request->id);
        }
    }

    public function canceladoRetirado($id)
    {
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>21
            ]);
            Session::flash('success', "Solicitud actualizada con éxito");
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('error', "Surgio un problema inesperado, intente mas tarde");

            return redirect::back();
        }
    }


    public function por_despacho($id)
    {
        try {
            Boleta::find($id)->update([
                'bk_estados_id'=>19
            ]);
            Session::flash('mensaje',['content'=>'Solicitud aceptada','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }

    //session de productos
    public function Session_Producto(Request $request)
    {
        $clasi = Clasificacion::find($request->clasi);
        $grupo = Grupo::find($request->grupo);
        if($request->subcate != null){
            $subcategoria = SubCategoria::find($request->subcate);
            $subcategoria_id = $subcategoria->id;
            $subcategoria_nombre = $subcategoria->nombre;
        }else{
            $subcategoria_id = null;
            $subcategoria_nombre = null;
        }
        if ($request->tipo_pro == 'otro') {
            $nom_tipo_producto = $request->otro_estado;
        }else{
            $tipo_producto = TipoProducto::find($request->tipo_pro);
            $nom_tipo_producto = $tipo_producto->nombre;
        }
        // des_certificada
        // subcategoria
        if (Session::has('prod_industrial')) {
            $session = Session::get('prod_industrial');
            $array = array(
                'id_clasi'=>$clasi->id,
                'nombre_clasi'=>$clasi->nombre,
                'id_grupo'=>$grupo->id,
                'nombre_grupo'=>$grupo->nombre,
                'id_tipo_producto'=>$request->tipo_pro,
                'nom_tipo_producto'=>$nom_tipo_producto,
                'peso'=> $request->peso,
                'id_subcate'=>$subcategoria_id,
                'nom_subcate'=>$subcategoria_nombre,
                // 'des_certificada'=>$request->des_certificada,
                // 'cantidad'=> $request->cantidad,
                'detalle_retiro'=> $request->detalle_retiro
            );
            array_push($session, $array);
            Session::put('prod_industrial',$session);
        }else{
            $prueba = array(0=>[
                'id_clasi'=>$clasi->id,
                'nombre_clasi'=>$clasi->nombre,
                'id_grupo'=>$grupo->id,
                'nombre_grupo'=>$grupo->nombre,
                'id_tipo_producto'=>$request->tipo_pro,
                'nom_tipo_producto'=>$nom_tipo_producto,
                'peso'=> $request->peso,
                'id_subcate'=>$subcategoria_id,
                'nom_subcate'=>$subcategoria_nombre,
                'des_certificada'=>$request->des_certificada,
                // 'cantidad'=> $request->cantidad,
                'detalle_retiro'=> $request->detalle_retiro,
            ]);
            Session::put('prod_industrial',$prueba);
        }
        return response()->json(Session::get('prod_industrial'));
    }
    public function Session_Producto_particular(Request $request){
        // dd($request);
        $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ran_sol = substr(str_shuffle($permit),0,6);
        // if ($request->hasFile('imagen')) {
        //     foreach ($request->imagen as $key => $value) {
        //         $random = substr(str_shuffle($permit),0,25);
        //         $random_nombre = substr(str_shuffle($permit),0,12);
        //         $extension = pathinfo($value->getClientOriginalName(),PATHINFO_EXTENSION );
        //         $nombre = $random_nombre.'.'.$extension;
        //         $ruta= Storage::putFileAs('temporal/'.$random,$value,$nombre);

        //         if (Session::has('foto_retiro_part')) {
        //            $session_foto = Session::get('foto_retiro_part');
        //            $array_foto = array(
        //                 'imagen'=>$ruta,
        //                 'id_sol'=> $ran_sol
        //            );
        //            array_push($session_foto, $array_foto);
        //            Session::put('foto_retiro_part',$session_foto);
        //         }else{
        //             $session_foto_first = array(0=>[
        //                 'imagen'=> $ruta,
        //                 'id_sol'=> $ran_sol
        //             ]);
        //             Session::put('foto_retiro_part',$session_foto_first);
        //         }
        //     }
        // }
        if ($request->hasFile('imagen')) {
             Log::info('imagen');

             $ruta= Storage::putFile('temporal/'.Session::getId(), $request->file('imagen'));
        }

        if ($request->producto == 0) {
            $precio = 0;
            $altura = $request->altura;
            $largo = $request->largo;
            $ancho = $request->profundidad;
            $nombre_residuo = $request->nombre;
            $mt3 = ($request->altura/100)*($request->largo/100)*($request->profundidad/100);
            $mt3 = $mt3*$request->cantidad;
        }else{
            $residuo = Residuo::find($request->producto);
            $precio = $residuo->precio;
            $altura = $residuo->altura;
            $largo = $residuo->largo;
            $ancho = $residuo->ancho;
            $nombre_residuo = $residuo->nombre;
            $mt3 = ($residuo->altura/100)*($residuo->largo/100)*($residuo->ancho/100);
            $mt3 = $mt3*$request->cantidad;
        }

        if (Session::has('prod_particular')) {
           $session = Session::get('prod_particular');
           $array = array(
            'producto'=>$request->producto,
            'residuo'=>$nombre_residuo,
            'peso'=>$request->peso,
            'precio'=>$precio,
            'altura'=>$altura,
            'largo'=>$largo,
            'profundidad'=> $ancho,
            'cantidad'=> $request->cantidad,
            'motivo'=> $request->motivo,
            'id_sol'=> $ran_sol,
            'mt3'=> $mt3,
            'imagen'=> $ruta
           );
           array_push($session, $array);
           Session::put('prod_particular',$session);
        }else{
            $prueba = array(0=>[
                'producto'=>$request->producto,
                'residuo'=>$nombre_residuo,
                'peso'=>$request->peso,
                'precio'=>$precio,
                'altura'=>$altura,
                'largo'=>$largo,
                'profundidad'=> $ancho,
                'cantidad'=> $request->cantidad,
                'motivo'=> $request->motivo,
                'id_sol'=> $ran_sol,
                'mt3'=> $mt3,
                'imagen'=> $ruta
            ]);
            Session::put('prod_particular',$prueba);
        }
        return response()->json(Session::get('prod_particular'));
    }

    public function borrarproducto($id_sol){
        if (Session::has('prod_particular')) {
            $session = Session::get('prod_particular');
            $array = array();
            foreach ($session as $key => $value) {
                if($value['id_sol'] != $id_sol){
                    array_push($array,$value);
                }
            }
            Session::put('prod_particular',$array);
        }
        return response()->json(Session::get('prod_particular'));
    }

    public function buscar_comuna($id)
    {
        $comuna = Comuna::where('bk_regiones_id',$id)->get();
        return response()->json($comuna);
    }


    //vista de estados de las solicitudes
    public function datos_aceptados()
    {
        $total = Boleta::whereIn('bk_estados_id',[8,25])->get();
        $solicitudes = Boleta::where('bk_estados_id',1)->get();
        $boletas = Boleta::whereIn('bk_estados_id',[8,25])->orderBy('id','DESC')->paginate(5);
        $enproceso = Boleta::wherein('bk_estados_id',[9,26,27,21,28,29,30])->get();
        $cancelado = Boleta::where('bk_estados_id',17)->get();
        $terminado = Boleta::where('bk_estados_id',2)->get();

        return view('workflow::private.estados.aceptado',compact('total','boletas','enproceso','solicitudes','cancelado','terminado'));
    }
    public function datos_cancelados()
    {
        $total = Boleta::where('bk_estados_id',17)->get();
        $boletas = Boleta::where('bk_estados_id',17)->orderBy('id','DESC')->paginate(5);
        $enproceso = Boleta::wherein('bk_estados_id',[9,26,27,21,28,29,30])->get();
        $aceptado = Boleta::whereIn('bk_estados_id',[8,25])->get();
        $solicitudes = Boleta::where('bk_estados_id',1)->get();
        $terminado = Boleta::where('bk_estados_id',2)->get();
        $choferes = User::where('roles_id',12)->pluck('name','id');
        $vehiculo = Camion::pluck('patente','id');
        $tipo_camiones = TipoCamion::all();
        return view('workflow::private.estados.cancelados',compact('total','boletas','enproceso','solicitudes','aceptado','terminado','choferes','tipo_camiones','vehiculo'));
    }
    public function datos_terminados()
    {
        $total = Boleta::where('bk_estados_id',2)->get();
        $boletas = Boleta::where('bk_estados_id',2)->orderBy('updated_at','DESC')->paginate(5);
        $enproceso = Boleta::wherein('bk_estados_id',[9,26,27,21,28,29,30])->get();
        $aceptado = Boleta::whereIn('bk_estados_id',[8,25])->get();
        $cancelado = Boleta::where('bk_estados_id',17)->get();
        $solicitudes = Boleta::where('bk_estados_id',1)->get();
        return view('workflow::private.estados.terminados',compact('total','boletas','enproceso','solicitudes','aceptado','cancelado'));
    }
    public function datos_proceso()
    {
        //WIP En proceso
        $total = Boleta::wherein('bk_estados_id',[9,26,27,21,28,29])->get();
        $boletas = Boleta::wherein('bk_estados_id',[9,26,27,21,28,29,30])->orderBy('updated_at','DESC')->paginate(5);
        $solicitudes = Boleta::where('bk_estados_id',[1,24,25])->get();
        $aceptado = Boleta::whereIn('bk_estados_id',[8,25])->get();
        $cancelado = Boleta::where('bk_estados_id',17)->get();
        $terminado = Boleta::where('bk_estados_id',2)->get();

        $choferes = User::where('roles_id',12)->pluck('name','id');
        $vehiculo = Camion::pluck('patente','id');
        $tipo_camiones = TipoCamion::all();


        return view('workflow::private.estados.enproceso',compact('total','vehiculo','boletas','terminado','choferes','solicitudes','aceptado','cancelado','tipo_camiones'));
    }

    //api consumible
    public function GrupoClasificacion($id)
    {
        $grupo_clasificacion = GrupoClasificacion::where('grupos_id',$id)->pluck('clasificaciones_id');
        $clasi = Clasificacion::whereIn('id',$grupo_clasificacion)->get();
        return response()->json($clasi);
    }

    //api consumible
    public function clasificacionsubcategoria($id)
    {
        $subcategoria = SubCategoria::where('clasificaciones_id',$id)->get();
        return response()->json($subcategoria);
    }

    //Boletas
    public function calendario(){
        return view('workflow::private.calendario');
    }

    public function get_events(){
        //$events = Boleta::select('id','codigo as title','fecha_hora as start','fecha_hora as end')->get()->toArray();
        $events = [];
        $boletas = Boleta::all();
        $solicitudes = Solicitud::all();
        $boletaSolicitud = BoletaSolicitud::all();
        $user = User::all();
        foreach ($boletaSolicitud as $bs) {
            foreach ($boletas as $bo) {
                foreach ($solicitudes as $so) {
                    if ($bs->sl_solicitudes_id == $so->id && $bs->boletas_id == $bo->id) {
                        $array = array(
                            'id'=>$bo->id,
                            'title'=> 'Cliente: '.$bo->user['name'].' '.$bo->user['apelido'].' | Empresa: '.$bo->empresas['nombre'],
                            'start'=> $bo->fecha_hora,
                            'end'=> $bo->fecha_hora
                        );
                        array_push($events, $array);
                    }
                }
            }
        }
        return response()->json($events);
    }

    public function solicitar_boletas($id)
    {
        $estados = Estados::all();
        $boleta = Boleta::find($id);
        $boletaSolicitud = BoletaSolicitud::where('boletas_id',$boleta->id)->first();
        $solicitud = Solicitud::where('id',$boletaSolicitud->sl_solicitudes_id)->first();
        return response()->json(['boleta'=>$boleta, 'estados'=>$estados, 'solicitud'=>$solicitud]);
    }

    public function filtrar_solicitudes(Request $request){
        $contratista = $request->get('contratista');
        $estados = $request->get('estados');
        $boleta_filtrado = Boleta::where('empresas_id','like','%'.$contratista.'%')->Where('bk_estados_id','like','%'.$estados.'%')->get();
        $bandera = 2;
        return view('workflow::private.gestor_filtro',compact('boleta_filtrado'));


        // $propiedad = propiedad::where('tipo_propiedad_id','like','%' .$tipo_propiedad . '%')->
        // orWhere('valor','like','%' .$precio . '%')->
        // orWhere('n_dormitorios','like','%' .$n_dormitorios . '%')->
        // get();

        // if($propiedad->count() > 0)
        // {

        //     $propiedad_find = propiedad::find($propiedad[0]->id);
        //     $propiedad_encontrada = propiedad::find($propiedad)->pluck('id');

        //     // $id = propiedad::where('direccion','like','%' .$direccion . '%')->pluck('id');
        //     $propiedad_img =ImagenesPropiedad::wherein('propiedad_id',$propiedad_encontrada)->get();
        //     $bandera=1;
        //     return view('propiedad.detalle-propiedad',compact('bandera','propiedad_find','propiedad','propiedad_img','propiedad_encontrada'));
        // }
        // else{
        //   return redirect('/');
        // }
    }

    public function tecnico_empresa(){
       return view('workflow::private.tecnico_empresa');
    }

    public function gerente_operaciones(){
        return view('workflow::private.gerente_operacion');
    }

    public function cambiardirecion($id){
        $direccion = DireccionEmpresa::find($id);
        Session::forget('direccion_retiro_industrial');
        Session::put('direccion_retiro_industrial',$direccion);
        return response()->json(Session::get('direccion_retiro_industrial'));
    }

    public function postEmpresaModal(Request $request){
        try {

            $empresa = new empresa($request->all());
            $empresa->save();

            $empresa_marca = EmpresasMarcas::create([
                'marcas_id'=> $request->marcas_id,
                'empresas_id'=> $empresa->id,
            ]);

            $dire_empresa = DireccionEmpresa::create([
                'nombre'=> $request->direccion_nombre,
                'empresas_id'=> $empresa->id,
                'bk_comunas_id'=> $request->bk_comunas_id,        
                'bk_regiones_id'=> $request->bk_regiones_id
            ]);
            Session::forget('empresa_retiro_industrial');
            Session::forget('direccion_retiro_industrial');
            Session::put('empresa_retiro_industrial',$empresa);
            Session::put('direccion_retiro_industrial',$dire_empresa);
            Session::flash('mensaje',['content'=>'Empresa agregada con exito','type'=>'primary']);
            return redirect::back();

        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
  
            return redirect::back();
        }
    }

    public function retirado(Request $request, $id)
    {
        try {
            if ($request->hasFile('foto')) {
                $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $random = substr(str_shuffle($permit),0,25);
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($request->foto->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $ruta_archivo = 'retirado/'.$random.'/';
                $ruta = Storage::putFileAs($ruta_archivo,$request->file('foto'),$nombre);

                $ret = Retiro::create([
                    'archivo'=>$ruta_archivo.''.$nombre,
                    'boletas_id'=>$id,
                    'camionero_id'=>Auth::user()->id
                ]);
            }else{
                $ret = Retiro::create([
                    'boletas_id'=>$id,
                    'camionero_id'=>Auth::user()->id
                ]);
            }
            $boleta = Boleta::find($id)->update([
                'bk_estados_id'=>21,
                'observacion_retirado'=>$request->observacion_retirado
            ]);
            Session::flash('mensaje',['content'=>'Productos Retirados','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();

        }
    }

    public function session_tipocarga(Request $request){

        //si existe la session
        if (Session::has('session_tipocarga')) {
            Log::info('entro al session');
            //entrega lo que ya esta en la session
            $session = Session::get('session_tipocarga');
            $new_tc = array();
            $count_tc = 0;
            //la recorre
            foreach($session as $key => $value){
                //busca el id tc
                if($value['id_tc'] == $request->id){
                    $count_tc = $count_tc+1;
                    //si lo encuentra,corrobora que el valor no sea 0.
                    if($val != 0){
                        //Si el valor es diferente a 0 se agrega o se actualiza el valor.
                        $array = array(
                            'id_tc'=>$request->id,
                            'cantidad'=>$request->val
                        );
                        array_push($new_tc, $array);
                    }
                }
                if($count_tc == 0){
                    //si el count 0 es porque no lo encuentro el id,
                    //por lo que se debe agregar uno nuevo
                    if($request->val != 0){
                        array_push($new_tc,$value);
                    }
                }
            }
            Session::put('session_tipocarga',$session);
        }else{
            Log::info('NO entro al session');

            //si la session no existe
            if($request->val != 0){
                //verifica que sea diferente a 0
                //y se agrega una nueva.
                $prueba = array(0=>[
                    'id_tc'=>$request->id,
                    'cantidad'=>$request->val
                ]);
                Session::put('session_tipocarga',$prueba);
            }
        }

        return response()->json(Session::get('session_tipocarga'));
    }

    public function sendControlCalidad($id){
        $boleta = Boleta::find($id);
        $solicitudes =  BoletaSolicitud::where('boletas_id' , $id)->pluck('sl_solicitudes_id');
        $productos = Solicitud::wherein('id',$solicitudes)->where('peso_interno' ,'!=', NULL)->get();
        $tipo_producto = TipoProducto::where('activo',0)->get();
        return view('workflow::private.calidad.index',compact('boleta','productos','tipo_producto'));
    }
    
    public function postControlCalidad(Request $request){
        try{
            if ($request->hasFile('foto')) {
                $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $random = substr(str_shuffle($permit),0,25);
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($request->foto->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $ruta_archivo = 'calidad/'.$random.'/';
                $ruta = Storage::putFileAs($ruta_archivo,$request->file('foto'),$nombre);

                $calidad = Calidad::create([
                    'boletas_id'=>$request->id_bol,
                    'archivo'=>$ruta_archivo.''.$nombre,
                    'observacion'=>$request->observaciones,
                    'sl_tipo_imagen_id'=>4,
                    'users_id'=>Auth::user()->id
                ]);
            }
            Session::flash('mensaje',['content'=>'Control de Calidad completado','type'=>'success']);
            return redirect::to('workflow');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::to('workflow');

        }
    }

}
