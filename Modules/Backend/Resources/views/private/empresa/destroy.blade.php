<form method="post" action="{{ asset('backend/eliminar-empresa') }}/{{ $emp->id }}">
    @csrf	
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el Registro ?')">Eliminar</button>
</form>
