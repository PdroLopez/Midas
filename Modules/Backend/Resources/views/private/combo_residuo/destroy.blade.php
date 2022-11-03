{!! Form::open(['route'=>['mantenedor-combo-residuos.delete',$combo_residuo->id],'method'=>'delete']) !!}
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el Registro ?')">Eliminar</button>
{!! Form::close() !!}
