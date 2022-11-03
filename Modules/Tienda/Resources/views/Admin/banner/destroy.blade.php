{!! Form::open(['route'=>['mantenedor-banner.delete',$banners->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el Banner ?')">Eliminar</button>
{!! Form::close() !!}
