{!! Form::open(['route'=>['mantenedor-descuento.delete',$desc->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Desea Borrar el registro ?')">Eliminar</button>
{!! Form::close() !!}
