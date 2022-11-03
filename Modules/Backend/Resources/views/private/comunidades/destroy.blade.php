{!! Form::open(['route'=>['mantenedor-comunidades.delete',$comunidades->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el Registro ?')">Eliminar</button>
{!! Form::close() !!}
