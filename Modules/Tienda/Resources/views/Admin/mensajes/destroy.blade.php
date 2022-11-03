{!! Form::open(['route'=>['mantenedor-mensajes.delete',$mensajes->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el mensaje ?')">Eliminar</button>
{!! Form::close() !!}
