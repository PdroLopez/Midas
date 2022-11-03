{!! Form::open(['route'=>['mantenedor-noticias.delete',$noticias->id],'method'=>'delete']) !!}
	<button class="dropdown-item" onclick="return confirm('¿Quiere borrar el registro?')">Eliminar</button>
{!! Form::close() !!}