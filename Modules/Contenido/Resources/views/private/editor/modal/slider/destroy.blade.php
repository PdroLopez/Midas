<form method="post" action="{{ asset('contenido/editor/eliminar') }}/{{ $imagen->id }}">
	@csrf
	<button class="btn btn-danger dropdown-item" onclick="return confirm('¿Quiere borrar el producto ?')">Eliminar</button>
</form>