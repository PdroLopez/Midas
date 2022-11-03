{!! Form::open(['route'=>['mantenedor-categoria.delete',$categoria->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar la categoria ?')">Eliminar</button>
{!! Form::close() !!}