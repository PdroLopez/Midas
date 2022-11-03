{!! Form::open(['route'=>['mantenedor-intro.delete',$intros->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el intro ?')">Eliminar</button>
{!! Form::close() !!}
