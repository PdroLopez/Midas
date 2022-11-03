{!! Form::open(['route'=>['mantenedor-ventas.delete',$venta->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar la venta?')">Eliminar</button>
{!! Form::close() !!}