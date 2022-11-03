{!! Form::open(['route'=>['mantenedor-tipo-servicio.delete',$tipo_servicio->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el Registro ?')">Eliminar</button>
{!! Form::close() !!}
