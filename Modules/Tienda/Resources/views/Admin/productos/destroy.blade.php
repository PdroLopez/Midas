{!! Form::open(['route'=>['mantenedor-producto.delete',$producto->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el producto ?')">Eliminar</button>
{!! Form::close() !!}