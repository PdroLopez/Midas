<?php
namespace Modules\Workflow\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Workflow\Entities\Solicitud as soli;
use Modules\Workflow\Entities\BoletaSolicitud;
use Modules\Workflow\Entities\Boleta;
use App\ImagenSolicitud;
use App\Empresa;
use App\User;
use Modules\Backend\Entities\Estados;
use Session;
use Modules\Tienda\Entities\Transaccion;
use Modules\Backend\Entities\Camion as camion;
use App\Residuo;
use App\Acceso;
use App\ImagenAcceso;
use Modules\Workflow\Entities\Grupo;
use Modules\Backend\Entities\TipoProducto;
use Modules\Workflow\Entities\Clasificacion;
use Modules\Backend\Entities\SubCategoria;
use Modules\Workflow\Entities\GrupoClasificacion;
use Modules\Backend\Entities\DireccionEmpresa;
use Modules\Workflow\Entities\EmpresasMarcas;
use App\EmpresaUsuario;
use App\DireccionUsuario;
use App\Horario;
use App\HorarioDia;
use Modules\Login\Entities\Region;
use Modules\Login\Entities\Comuna;
use Modules\Backend\Entities\TipoServicio;
use Modules\Backend\Entities\TipoCamion;
use Modules\Backend\Entities\Destino;
use Modules\Workflow\Entities\Marcas;
use Modules\Workflow\Entities\Ticket;
use Auth;
use Storage;
use Log;

class SolicitudController extends Controller
{
	public function index()
	{
        // se consulta si la session tiene un modulo asignado de lo contrario debe redirigir a un logout
        if(Session::get('modulo') > 0){

            $user = User::where('roles_id',24)->pluck('id');
            $total = Boleta::wherein('bk_estados_id',[1,24])->get();
            $boletas = Boleta::wherein('bk_estados_id',[1,24])->orderBy('id','DESC')->paginate(5);
            $enproceso = Boleta::wherein('bk_estados_id',[9,26,27,21,28,29,30])->get();
            $aceptado = Boleta::whereIn('bk_estados_id',[8,25])->get();
            $cancelado = Boleta::where('bk_estados_id',17)->get();
            $terminado = Boleta::where('bk_estados_id',2)->get();
            $transaccion = Transaccion::orderBy('id','DESC')->get();
            $bandera = 1;
            //filtros
            $contratista = Empresa::all();
            $estados = Estados::wherein('id',[25,26,17,28,2,9,21,29,30])->get();
            return view('workflow::private.gestor',compact('bandera','transaccion','boletas','total','enproceso','aceptado','cancelado','terminado','contratista','estados'));

        }else{
            Auth::logout();
            Session::flush();
            return Redirect::to('/');
        }
	}
    public function me()
    {
        if (Auth::user()->roles_id == 12) {
            $retiros = Boleta::where('camionero_id', Auth::user()->id)->wherein('bk_estados_id',[21,27,9])->orderBy('fecha_hora', 'asc')->get();
            $plantas = Boleta::whereIn('bk_estados_id',[28,29,30,2])->where('camionero_id', Auth::user()->id)->OrderBy('fecha_hora','DESC')->get();

            return view('private.chofer.home',compact('retiros','plantas'));
        }
        if(Session::get('modulo') > 0){
            return view('workflow::private.tecnico_empresa');
        }else{
            Auth::logout();
            Session::flush();
            return Redirect::to('/');
        }
    }
    public function solicitudes()
    {
        $boletas = Boleta::whereIn('bk_estados_id',[19,8])->get();
        $choferes = User::where('roles_id',12)->pluck('name','id');
        $vehiculo = camion::pluck('patente','id');
        $tipo_camiones = TipoCamion::all();

        return view('workflow::private.logistica',compact('vehiculo','boletas','choferes','tipo_camiones'));
    }
    public function store(Request $request)
    {
    	soli::create([
            'nombre'=> $request->producto,
            'peso' => $request->peso,
            'cantidad' => $request->cantidad,
            'altura' => $request->altura,
            'largo' => $request->largo,
            'profundidad' => $request->profundo,
            'motivo'=> $request->motivo,
        ]);
        return back();
    }
    public function update(Request $request, $id)
    {
    	soli::find($id)->update([
    		'nombre'=> $request->producto,
            'peso' => $request->peso,
            'altura' => $request->altura,
            'largo' => $request->largo,
            'profundidad' => $request->profundo,
            'motivo'=> $request->motivo,
    	]);
    	return back();
    }
    public function actualizar_boleta(Request $request, $id)
    {
        try {
            Boleta::find($id)->update([
                'fecha_hora' => $request->fecha_hora,
                'camionero_id' => $request->user_id,
                'camiones_id' => $request->camiones_id,
                'bk_estados_id' => 27
            ]);
            Session::flash('mensaje',['content'=>'Actualización exitosa','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }

    public function ViewModificarPesado($id){
        $solicitud = soli::find($id);
        $boleta = Boleta::find($solicitud->boleta_solicitud->first()->boletas_id);
        $grupo = Grupo::all();
        $tipo_producto = TipoProducto::where('activo',0)->get();
        $residuo = Residuo::all();
        $categorias_pluck = GrupoClasificacion::where('grupos_id',$solicitud->grupos_id)->pluck('id');
        $categorias = Clasificacion::whereIn('id',$categorias_pluck)->get();
        $subcategorias = SubCategoria::where('clasificaciones_id',$solicitud->clasificaciones_id)->get();
        if ($boleta->empresas_id == null){
            return view('workflow::private.pesajes.edit',compact('solicitud','boleta','residuo'));
        }else{
            return view('workflow::private.pesajes.edit_indus',compact('solicitud','boleta','residuo','grupo','tipo_producto','categorias','subcategorias'));
        }

    }

    public function PartModificarPesado(Request $request)
    {
        try {
            
            $boletas = Boleta::find($request->boletas_id);

            if ($request->residuo == 0) {
                $precio = 0;
                $altura = $request->altura;
                $largo = $request->largo;
                $ancho = $request->profundidad;
                $nombre_residuo = $request->nombre;
                $mt3 = ($request->altura/100)*($request->largo/100)*($request->profundidad/100);
                $mt3 = $mt3*$request->cantidad;
            }else{
                $residuo = Residuo::find($request->residuo);
                $precio = $residuo->precio;
                $altura = $residuo->altura;
                $largo = $residuo->largo;
                $ancho = $residuo->ancho;
                $nombre_residuo = $residuo->nombre;
                $mt3 = ($residuo->altura/100)*($residuo->largo/100)*($residuo->ancho/100);
                $mt3 = $mt3*$request->cantidad;
            }

            $soli = soli::find($request->sol_id)->update([
                'Residuos_id'=> $request->residuo,
                'nombre'=> $nombre_residuo,
                'peso' => $request->peso,
                'cantidad' => $request->cantidad,
                'altura'=> $altura,
                'largo'=> $largo,
                'profundidad' => $ancho,
                'motivo'=> $request->motivo,
                'precio'=> $precio,
                'mt3'=> $mt3
            ]);

            $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            if ($request->hasFile('foto')) {
                $random = substr(str_shuffle($permit),0,25);
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($request->file('foto')->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $ruta= Storage::putFileAs('temporal/'.$random,$request->file('foto'),$nombre);

                $img = ImagenSolicitud::create([
                    'archivo'=> $ruta,
                    'url' => 'storage',
                    'sl_solicitudes_id' => $request->sol_id
                ]);
            }
            Session::flash('mensaje',['content'=>'Actualización exitosa','type'=>'primary']);
            return redirect::to('workflow/pesaje/'.$boletas->id);
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }


    public function InduModificarPesado(Request $request)
    {
        try {
            if($request->subcategoria != null){
                $subcategoria = SubCategoria::find($request->subcategoria);
                $subcategoria_id = $subcategoria->id;
                $subcategoria_nombre = $subcategoria->nombre;
            }else{
                $subcategoria_id = null;
                $subcategoria_nombre = null;
            }
            if ($request->tipo_producto == 'otro') {
                $nom_tipo_producto = $request->otro_estado;
            }else{
                $tipo_producto = TipoProducto::find($request->tipo_producto);
                $nom_tipo_producto = null;
            }

            $boletas = Boleta::find($request->boletas_id);

            $soli = soli::find($request->sol_id)->update([
                'clasificaciones_id' =>$request->clasificacion,
                'grupos_id' =>$request->grupo,
                'subcategoria_id' =>$subcategoria_id,
                'tipo_producto_id' =>$request->tipo_producto,
                'otro_estado' =>$nom_tipo_producto,
                'destruccion_certificada' =>$request->des_certificada,
                'peso'=> $request->peso,
                'detalle_retiro'=>$request->detalle_retiro
            ]);
            Session::flash('mensaje',['content'=>'Actualización exitosa','type'=>'primary']);
            return redirect::to('workflow/pesaje/'.$boletas->id);
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }

    public function AddPartAgregarPesado(Request $request)
    {
        try {
            
            $boletas = Boleta::find($request->boletas_id);

            if ($request->residuo == 0) {
                $precio = 0;
                $altura = $request->altura;
                $largo = $request->largo;
                $ancho = $request->profundidad;
                $nombre_residuo = $request->nombre;
                $mt3 = ($request->altura/100)*($request->largo/100)*($request->profundidad/100);
                $mt3 = $mt3*$request->cantidad;
            }else{
                $residuo = Residuo::find($request->residuo);
                $precio = $residuo->precio;
                $altura = $residuo->altura;
                $largo = $residuo->largo;
                $ancho = $residuo->ancho;
                $nombre_residuo = $residuo->nombre;
                $mt3 = ($residuo->altura/100)*($residuo->largo/100)*($residuo->ancho/100);
                $mt3 = $mt3*$request->cantidad;
            }

            $soli = soli::create([
                'Residuos_id'=> $request->residuo,
                'nombre'=> $nombre_residuo,
                'peso' => $request->peso,
                'cantidad' => $request->cantidad,
                'altura'=> $altura,
                'largo'=> $largo,
                'profundidad' => $ancho,
                'motivo'=> $request->motivo,
                'precio'=> $precio,
                'mt3'=> $mt3,
                'accesos_id'=>$boletas->solicitudes->first()->solicitud->accesos_id
            ]);

            $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            if ($request->hasFile('foto')) {
                $random = substr(str_shuffle($permit),0,25);
                $random_nombre = substr(str_shuffle($permit),0,12);
                $extension = pathinfo($request->file('foto')->getClientOriginalName(),PATHINFO_EXTENSION );
                $nombre = $random_nombre.'.'.$extension;
                $ruta= Storage::putFileAs('temporal/'.$random,$request->file('foto'),$nombre);

                $img = ImagenSolicitud::create([
                    'archivo'=> $ruta,
                    'url' => 'storage',
                    'sl_solicitudes_id' => $soli->id
                ]);
            }


            $bol_sol = BoletaSolicitud::create([
                'sl_solicitudes_id'=>$soli->id,
                'boletas_id'=>$request->boletas_id
            ]);
            Session::flash('mensaje',['content'=>'Se agrego exitosamente el residuo','type'=>'success']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }

    public function AddInduAgregarPesado(Request $request)
    {
        try {
            if($request->subcategoria != null){
                $subcategoria = SubCategoria::find($request->subcategoria);
                $subcategoria_id = $subcategoria->id;
                $subcategoria_nombre = $subcategoria->nombre;
            }else{
                $subcategoria_id = null;
                $subcategoria_nombre = null;
            }
            if ($request->tipo_producto == 'otro') {
                $nom_tipo_producto = $request->otro_estado;
            }else{
                $tipo_producto = TipoProducto::find($request->tipo_producto);
                $nom_tipo_producto = null;
            }

            $boletas = Boleta::find($request->boletas_id);

            $soli = soli::create([
                'accesos_id' =>$boletas->solicitudes->first()->solicitud->accesos_id,
                'clasificaciones_id' =>$request->clasificacion,
                'grupos_id' =>$request->grupo,
                'subcategoria_id' =>$subcategoria_id,
                'tipo_producto_id' =>$request->tipo_producto,
                'otro_estado' =>$nom_tipo_producto,
                // 'destruccion_certificada' =>$request->des_certificada,
                'peso'=> $request->peso,
                // 'cantidad'=> $value['cantidad'],
                'detalle_retiro'=>$request->detalle_retiro
            ]);

            $bol_sol = BoletaSolicitud::create([
                'sl_solicitudes_id'=>$soli->id,
                'boletas_id'=>$request->boletas_id
            ]);
            Session::flash('mensaje',['content'=>'Se agrego exitosamente el residuo','type'=>'success']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }

    public function EditTicketDatos(Request $request){
        $boleta = Boleta::find($request->boletas_id)->update([
            'n_guia_despacho' => $request->despacho,
            'n_contenedor' => $request->contenedor
        ]);
        return response()->json(['boleta'=>$boleta]);
    }

    public function editIndustrial($id){
        $empresaUsuario = EmpresaUsuario::where('users_id',Auth::user()->id)->get();
        $empresas = Empresa::all();
        $horario = Horario::all();
        $hr_dia = HorarioDia::all();
        $grupo = Grupo::all();
        $region = Region::all();
        $tipo_producto = TipoProducto::where('activo',0)->get();
        $tipo_servicio = TipoServicio::all();
        $estado = Estados::where('id',22)->Orwhere('id',23)->pluck('nombre','id');
        $direcciones_emp = DireccionEmpresa::all();
        $destinos = Destino::all();
        $boleta = Boleta::find($id);
        $marca = Marcas::pluck('nombre','id');
        return view('workflow::private.solicitud.edit.edit_industrial',compact('boleta','empresas','horario','grupo','hr_dia','region','empresaUsuario','tipo_producto','tipo_servicio','estado','direcciones_emp','destinos','marca'));

    }

    public function PostEditIndustrial(Request $request){
        try {
            $boleta = Boleta::find($request->boleta_id);
            $acceso = Acceso::find($boleta->solicitudes->first()->solicitud->accesos_id);

            if($request->adjunto_imagen == 0){
                foreach ($acceso->imagen as $key => $ac_im) {
                    $delete_ac_img = ImagenAcceso::find($ac_im->id);
                    $delete_ac_img->delete();
                }
            }else{
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
            }

            $array = array();
            if (Session::has('edit_prod_industrial')) {
                foreach (Session::get('edit_prod_industrial') as $value) {
                    if($boleta->solicitudes->where('sl_solicitudes_id',$value['id_sol'])->count() == 0){
                        if($value['id_tipo_producto'] == 'otro'){
                            $tipo_producto_id = null;
                            $otro_estado = $value['nom_tipo_producto'];
                        }else{
                            $tipo_producto_id = $value['id_tipo_producto'];
                            $otro_estado = null;
                        }
                        $soli = soli::create([
                            'accesos_id' =>$acceso->id,
                            'clasificaciones_id' =>$value['id_clasi'],
                            'grupos_id' =>$value['id_grupo'],
                            'subcategoria_id' =>$value['id_subcate'],
                            'tipo_producto_id' =>$tipo_producto_id,
                            'otro_estado' =>$otro_estado,
                            'destruccion_certificada' =>$value['des_certificada'],
                            'peso'=> $value['peso'],
                            'detalle_retiro'=>$value['detalle_retiro']
                        ]);
                        $dato_id = array(
                            'id'=>$soli->id
                        );
                        array_push($array, $dato_id);
                    }
                }
                Session::forget('edit_prod_industrial');
            }
            
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
            $boleta->empresas_id =  $request->empresa;
            $boleta->bk_direcciones_empresas_id = $direccion_usuario;
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
            $boleta->horarios_dias_id = $request->jornada;
            $boleta->observaciones = $request->observaciones;
            $boleta->save();

            foreach($array as $dato){
                $bol_sol = BoletaSolicitud::create([
                    'sl_solicitudes_id'=>$dato['id'],
                    'boletas_id'=>$boleta->id
                ]);
            }
            Session::forget('edit_empresa_retiro_industrial');
            Session::forget('edit_direccion_retiro_industrial');
            Session::forget('edit_empresa_retiro_industrial');
            Session::forget('edit_direccion_retiro_industrial');
            Session::flash('mensaje',['content'=>'Solicitud Editada con exito','type'=>'success']);
            return redirect('workflow');
        }catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect('workflow');
        }
    }

    public function editParticular($id){
        $boleta = Boleta::find($id);
        $user = User::whereIn('roles_id',[17,19])->get();
        $residuo = Residuo::all();
        $horario = Horario::all();
        $hr_dia = HorarioDia::all();
        return view('workflow::private.solicitud.edit.edit_particular',compact('boleta','user','residuo','horario','hr_dia'));
    }

    public function PostEditParticular(Request $request){
        try {
            $boleta = Boleta::find($request->boleta_id);
            $acceso = Acceso::find($boleta->solicitudes->first()->solicitud->accesos_id);
            // $totalproducto = $boleta->total-$boleta->horario->
            $horario = Horario::find($request->tiporetiro);
            // $total = intval($horario->precio) + intval($totalproducto);

            if ($request->comentario){
                $acceso->comentario = $request->comentario;
                $acceso->save();
            }

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
            if (Session::has('edit_prod_particular')) {
                foreach (Session::get('edit_prod_particular') as $value) {
                    if($boleta->solicitudes->where('sl_solicitudes_id',$value['id_sol'])->count() == 0){
                        $residuo2 = Residuo::find($value['producto']);
                        $nombre_residuo = $value['residuo'];
                        if ($value['producto'] == 0) {
                            $residuo_id = null;
                        }else{
                            $residuo_id = $value['producto'];
                        }
                        $soli = soli::create([
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
                }
                Session::forget('edit_prod_particular');
            }

            if ($request->direccion_usuario != 'otra') {
                Boleta::find($boleta->id)->update([
                    // 'total'=>$total,
                    'bk_estados_id'=>1,
                    'users_id'=>$request->usuario,
                    'horarios_id'=>$request->tiporetiro,
                    'horarios_dias_id'=>$request->horario,
                    'bk_direcciones_user_id'=>$request->direccion_usuario,
                    "tipo_pago" => $request->pago
                ]);

            }else{
                $direccion_usuario = DireccionUsuario::create([
                    'nombre'=> $request->direccion,
                    'users_id' => $request->usuario,
                    'bk_comunas_id'=> $request->comunas,
                    'bk_regiones_id'=> $request->regiones
                ]);
                Boleta::find($boleta->id)->update([
                    // 'total'=>$total,
                    'bk_estados_id'=>1,
                    'users_id'=>$request->usuario,
                    'horarios_id'=>$request->tiporetiro,
                    'horarios_dias_id'=>$request->horario,
                    'bk_direcciones_user_id'=>$direccion_usuario->id,
                ]);
            }

            foreach($array as $dato){
                $bol_sol = BoletaSolicitud::create([
                    'sl_solicitudes_id'=>$dato['id'],
                    'boletas_id'=>$boleta->id
                ]);
            }
            Session::flash('mensaje',['content'=>'Solicitud editada con exito','type'=>'success']);
            return redirect('workflow');
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect('workflow');
        }
    }

    public function postEmpresaModalEdit(Request $request){
        try {

            $empresa = new Empresa($request->all());
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
            Session::forget('edit_empresa_retiro_industrial');
            Session::forget('edit_direccion_retiro_industrial');
            Session::put('edit_empresa_retiro_industrial',$empresa);
            Session::put('edit_direccion_retiro_industrial',$dire_empresa);
            Session::flash('mensaje',['content'=>'Empresa agregada con exito','type'=>'primary']);
            return redirect::back();

        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
  
            return redirect::back();
        }
    }

    public function edit_nueva_direccion(Request $request){
        $direccion = DireccionEmpresa::create([
            'empresas_id'=>$request->empresa_id,
            'bk_regiones_id'=>$request->bk_regiones_id,
            'bk_estados_id'=>$request->bk_estados_id,
            'nombre'=>$request->direccion
        ]);
        $empresa = Empresa::find($request->empresa_id);
        Session::forget('edit_empresa_retiro_industrial');
        Session::put('edit_empresa_retiro_industrial',$empresa);
        Session::forget('edit_direccion_retiro_industrial');
        Session::put('edit_direccion_retiro_industrial',$direccion);
        return redirect::back();
    }

    //session de productos
    public function edit_Session_Producto(Request $request)
    {
        $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ran_sol = substr(str_shuffle($permit),0,6);
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

        $boleta = Boleta::find($request->boleta_id);

        if (Session::has('edit_prod_industrial')) {
            $session = Session::get('edit_prod_industrial');
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
                'id_sol'=> $ran_sol,
                'des_certificada'=>$request->des_certificada,
                'detalle_retiro'=> $request->detalle_retiro
            );
            array_push($session, $array);
            Session::put('edit_prod_industrial',$session);
        }else{
            if ($boleta->solicitudes->count() != 0) {
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
                    'id_sol'=> $ran_sol,
                    'des_certificada'=>$request->des_certificada,
                    'detalle_retiro'=> $request->detalle_retiro
                ]);
                Session::put('edit_prod_industrial',$prueba);

                foreach ($boleta->solicitudes as $key => $value) {
                    if($value->solicitud->subcategoria_id != null){
                        $subcat = SubCategoria::find($value->solicitud->subcategoria_id);
                        $subcat_id = $subcat->id;
                        $subcat_nombre = $subcat->nombre;
                    }else{
                        $subcat_id = null;
                        $subcat_nombre = null;
                    }
                    if ($value->solicitud->tipo_producto_id == null) {
                        $tipo_pro = 'otro';
                        $nom_tipo_prod = $value->solicitud->otro_estado;
                    }else{
                        $tipo_pro = $value->solicitud->tipo_producto_id;
                        $nom_tipo_pro = $value->solicitud->tipo_producto->nombre;
                    }  
                    if (Session::has('edit_prod_industrial')) {
                        $session = Session::get('edit_prod_industrial');
                        $array = array(
                            'id_clasi'=>$value->solicitud->clasificaciones_id,
                            'nombre_clasi'=>$value->solicitud->clasificacion->nombre,
                            'id_grupo'=>$value->solicitud->grupos_id,
                            'nombre_grupo'=>$value->solicitud->grupo->nombre,
                            'id_tipo_producto'=>$tipo_pro,
                            'nom_tipo_producto'=>$nom_tipo_pro,
                            'peso'=> $value->solicitud->peso,
                            'id_subcate'=>$subcat_id,
                            'nom_subcate'=>$subcat_nombre,
                            'id_sol'=> $value->sl_solicitudes_id,
                            'des_certificada'=>$value->solicitud->destruccion_certificada,
                            'detalle_retiro'=> $value->solicitud->detalle_retiro
                        );
                        array_push($session, $array);
                        Session::put('edit_prod_industrial',$session);
                    }else{
                        $prueba = array(0=>[
                            'id_clasi'=>$value->solicitud->clasificaciones_id,
                            'nombre_clasi'=>$value->solicitud->clasificacion->nombre,
                            'id_grupo'=>$value->solicitud->grupos_id,
                            'nombre_grupo'=>$value->solicitud->grupo->nombre,
                            'id_tipo_producto'=>$tipo_pro,
                            'nom_tipo_producto'=>$nom_tipo_producto,
                            'peso'=> $value->solicitud->peso,
                            'id_subcate'=>$subcategoria_id,
                            'nom_subcate'=>$subcategoria_nombre,
                            'id_sol'=> $value->sl_solicitudes_id,
                            'des_certificada'=>$value->solicitud->destruccion_certificada,
                            'detalle_retiro'=> $value->solicitud->detalle_retiro
                        ]);
                        Session::put('edit_prod_industrial',$prueba);
                    }
                }
                
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
                    'id_sol'=> $ran_sol,
                    'detalle_retiro'=> $request->detalle_retiro
                ]);
                Session::put('edit_prod_industrial',$prueba);
            }
        }
        return response()->json(Session::get('edit_prod_industrial'));
    }
    public function edit_Session_Producto_particular(Request $request){
        // dd($request);
        $permit='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ran_sol = substr(str_shuffle($permit),0,6);
        $boleta = Boleta::find($request->boleta_id);


        if ($request->hasFile('imagen')) {
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

        if (Session::has('edit_prod_particular')) {
           $session = Session::get('edit_prod_particular');
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
           Session::put('edit_prod_particular',$session);
        }else{
            if ($boleta->solicitudes->count() != 0) {
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
                Session::put('edit_prod_particular',$prueba);

                foreach ($boleta->solicitudes as $key => $value) {

                    if ($value->solicitud->residuos == null) {
                        $residuo = 0;
                        $nombre_residuo = $value->solicitud->nombre;
                    }else{
                        $residuo = $value->solicitud->Residuos_id;
                        $nombre_residuo = $value->solicitud->residuos->nombre;
                    } 
                    if (Session::has('edit_prod_particular')) {
                        $session = Session::get('edit_prod_particular');
                        $array = array(
                            'producto'=>$residuo,
                            'residuo'=>$nombre_residuo,
                            'peso'=>$value->solicitud->peso,
                            'precio'=>$value->solicitud->precio,
                            'altura'=>$value->solicitud->altura,
                            'largo'=>$value->solicitud->largo,
                            'profundidad'=> $value->solicitud->profundidad,
                            'cantidad'=> $value->solicitud->cantidad,
                            'motivo'=> $value->solicitud->motivo,
                            'id_sol'=> $value->sl_solicitudes_id,
                            'mt3'=> $value->solicitud->mt3,
                            'imagen'=> $value->solicitud->imagen->first()->archivo
                        );
                        array_push($session, $array);
                        Session::put('edit_prod_particular',$session);
                    }else{

                        $prueba = array(0=>[
                            'producto'=>$residuo,
                            'residuo'=>$nombre_residuo,
                            'peso'=>$value->solicitud->peso,
                            'precio'=>$value->solicitud->precio,
                            'altura'=>$value->solicitud->altura,
                            'largo'=>$value->solicitud->largo,
                            'profundidad'=> $value->solicitud->profundidad,
                            'cantidad'=> $value->solicitud->cantidad,
                            'motivo'=> $value->solicitud->motivo,
                            'id_sol'=> $value->sl_solicitudes_id,
                            'mt3'=> $value->solicitud->mt3,
                            'imagen'=> $value->solicitud->imagen->first()->archivo
                        ]);
                        Session::put('edit_prod_particular',$prueba);
                    }
                }
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
                Session::put('edit_prod_particular',$prueba);
            }

        }
        return response()->json(Session::get('edit_prod_particular'));
    }

    public function borrarproductoedit($id_sol){
        if (Session::has('edit_prod_particular')) {
            $session = Session::get('edit_prod_particular');
            $array = array();
            $solicitud = soli::find($id_sol);
            if ($solicitud != null) {
                $solicitud->delete();
            }
            foreach ($session as $key => $value) {
                if($value['id_sol'] != $id_sol){
                    array_push($array,$value);
                }
            }
            Session::put('edit_prod_particular',$array);
        }else{
            $sol = soli::find($id_sol);
            $boleta = $sol->solicitudes->first()->boletas_id;
            if ($sol != null) {
                $sol->delete();
            }
            $bolesoli = BoletaSolicitud::where('boletas_id',$boleta)->get();
            if ($bolesoli->count() != 0) {
                foreach ($bolesoli as $key => $value) {

                    if ($value->solicitud->residuos == null) {
                        $residuo = null;
                        $nombre_residuo = $value->solicitud->nombre;
                    }else{
                        $residuo = $value->solicitud->Residuos_id;
                        $nombre_residuo = $value->solicitud->residuos->nombre;
                    } 
                    if (Session::has('edit_prod_particular')) {
                        $session = Session::get('edit_prod_particular');
                        $array = array(
                            'producto'=>$residuo,
                            'residuo'=>$nombre_residuo,
                            'peso'=>$value->solicitud->peso,
                            'precio'=>$value->solicitud->precio,
                            'altura'=>$value->solicitud->altura,
                            'largo'=>$value->solicitud->largo,
                            'profundidad'=> $value->solicitud->profundidad,
                            'cantidad'=> $value->solicitud->cantidad,
                            'motivo'=> $value->solicitud->motivo,
                            'id_sol'=> $value->sl_solicitudes_id,
                            'mt3'=> $value->solicitud->mt3,
                            'imagen'=> $value->solicitud->imagen->first()->archivo
                        );
                        array_push($session, $array);
                        Session::put('edit_prod_particular',$session);
                    }else{
                        $prueba = array(0=>[
                            'producto'=>$residuo,
                            'residuo'=>$nombre_residuo,
                            'peso'=>$value->solicitud->peso,
                            'precio'=>$value->solicitud->precio,
                            'altura'=>$value->solicitud->altura,
                            'largo'=>$value->solicitud->largo,
                            'profundidad'=> $value->solicitud->profundidad,
                            'cantidad'=> $value->solicitud->cantidad,
                            'motivo'=> $value->solicitud->motivo,
                            'id_sol'=> $value->sl_solicitudes_id,
                            'mt3'=> $value->solicitud->mt3,
                            'imagen'=> $value->solicitud->imagen->first()->archivo
                        ]);
                        Session::put('edit_prod_particular',$prueba);
                    }
                }
            }
        }
        return response()->json(Session::get('edit_prod_particular'));
    }


    public function EditTicketHistorial(Request $request){
        dd();
    }

    public function ViewEditTicketHistorial($id){
        $boleta = Boleta::find($id);
        $ticket = Ticket::where('boletas_id',$id)->first();
        $tipo_producto = TipoProducto::where('activo',0)->get();

        return view('workflow::private.pesajes.edit_ticket', compact('boleta','ticket','tipo_producto'));
    }

    public function EditPesajeProducto(Request $request,$id){
        dd($request,$id);

        if (Session::has('edit_solicitudes_pesaje')) {
            //Si existe la sesion se pasa a una variable que recorre
            $session = Session::get('edit_solicitudes_pesaje');
            $array = array();
            foreach ($session as $key => $value) {
                if($value['id_sol'] != $id){
                    //si el id no es el mismo no se hace nada
                    array_push($array,$value);
                }else{
                    //si es el mismo se debe actualizar el registro de la session 
                    //y agregar al array actualizado
                    $prueba = array(
                        'id_sol'=>$residuo,
                        'nombre'=>$nombre_residuo,
                        'peso_bruto'=>$value->solicitud->peso,
                        'peso_envase'=>$value->solicitud->precio,
                        'peso_neto'=>$value->solicitud->altura,
                        'peso_cliente'=>$value->solicitud->largo,
                        'id_bol'=> $value->solicitud->profundidad
                    );
                    array_push($array,$prueba);
                }
            }
            Session::put('edit_solicitudes_pesaje',$array);
        }else{
            $sol = soli::find($id);
            $boleta = $sol->solicitudes->first()->boletas_id;
            $bolesoli = BoletaSolicitud::where('boletas_id',$boleta)->get();
            if ($bolesoli->count() != 0) {
                //si hay solicitudes se deben recorrer.
                foreach ($bolesoli as $key => $value) {
                    //si el id es el mismo
                    if($value->sl_solicitudes_id == $id){
                        //comprueba si existe la sesion ya que es un foreach, 
                        //asi que pasara las veces necesarias
                        if (Session::has('edit_solicitudes_pesaje')) {
                            //si existe se debe agregar los datos actualizados
                            $session = Session::get('edit_solicitudes_pesaje');
                            $array = array(
                                'id_sol'=>$residuo,
                                'nombre'=>$nombre_residuo,
                                'peso_bruto'=>$value->solicitud->peso,
                                'peso_envase'=>$value->solicitud->precio,
                                'peso_neto'=>$value->solicitud->altura,
                                'peso_cliente'=>$value->solicitud->largo,
                                'id_bol'=> $value->solicitud->profundidad
                            );
                            array_push($session, $array);
                            Session::put('edit_solicitudes_pesaje',$session);
                        }else{
                            //porque si no existe lo crea desde 0 y con los datos actualizados
                            $prueba = array(0=>[
                                'id_sol'=>$residuo,
                                'nombre'=>$nombre_residuo,
                                'peso_bruto'=>$value->solicitud->peso,
                                'peso_envase'=>$value->solicitud->precio,
                                'peso_neto'=>$value->solicitud->altura,
                                'peso_cliente'=>$value->solicitud->largo,
                                'id_bol'=> $value->solicitud->profundidad
                            ]);
                            Session::put('edit_solicitudes_pesaje',$prueba);
                        }
                    }else{
                        //Si no es el mismo id pasa por aqui que es solo para que se agrege
                        if (Session::has('edit_solicitudes_pesaje')) {
                            //si existe la session pues se agrega con los datos.
                            $session = Session::get('edit_solicitudes_pesaje');
                            $array = array(
                                'id_sol'=>$residuo,
                                'nombre'=>$nombre_residuo,
                                'peso_bruto'=>$value->solicitud->peso,
                                'peso_envase'=>$value->solicitud->precio,
                                'peso_neto'=>$value->solicitud->altura,
                                'peso_cliente'=>$value->solicitud->largo,
                                'id_bol'=> $value->solicitud->profundidad
                            );
                            array_push($session, $array);
                            Session::put('edit_solicitudes_pesaje',$session);
                        }else{
                            //sino se agrega con los datos de 0
                            $prueba = array(0=>[
                                'id_sol'=>$residuo,
                                'nombre'=>$nombre_residuo,
                                'peso_bruto'=>$value->solicitud->peso,
                                'peso_envase'=>$value->solicitud->precio,
                                'peso_neto'=>$value->solicitud->altura,
                                'peso_cliente'=>$value->solicitud->largo,
                                'id_bol'=> $value->solicitud->profundidad
                            ]);
                            Session::put('edit_solicitudes_pesaje',$prueba);
                        }
                    }
                }
            }
        }
    }


}
