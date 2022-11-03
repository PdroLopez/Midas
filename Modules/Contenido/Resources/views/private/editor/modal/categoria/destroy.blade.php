{!! Form::open(['route'=>['mantenedor-categorias.delete',$item->id],'method'=>'delete']) !!}
	<button class="dropdown-item" onclick="return confirm('¿Quiere borrar el registro?')">Eliminar</button>
{!! Form::close() !!}
