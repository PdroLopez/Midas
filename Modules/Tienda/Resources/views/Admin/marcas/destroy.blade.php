{!! Form::open(['route'=>['mantenedor-marca.delete',$marca->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar la marca ?')">Eliminar</button>
{!! Form::close() !!}