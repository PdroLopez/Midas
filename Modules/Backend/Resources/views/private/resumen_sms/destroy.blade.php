{!! Form::open(['route'=>['mantenedor-resumen-sms.delete',$sms->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el Registro ?')">Eliminar</button>
{!! Form::close() !!}
