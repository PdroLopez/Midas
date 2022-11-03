{!! Form::open(['route'=>['mantenedor-tipo_comunidades.delete',$tipo_comunidades->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el Registro ?')">Eliminar</button>
{!! Form::close() !!}
