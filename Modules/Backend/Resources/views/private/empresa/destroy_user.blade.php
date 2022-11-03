{!! Form::open(['route'=>['mantenedor-empresas_user.delete',$usuario->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el Registro ?')">Eliminar</button>
{!! Form::close() !!}
