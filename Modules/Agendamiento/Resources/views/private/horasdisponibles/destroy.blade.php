<form method="post" action="{{ asset('agendamiento/eliminar-hora') }}/{{ $h->id }}">
	@csrf
	<button class="btn btn-danger" onclick="return confirm('¿Quiere borrar el Registro ?')">Eliminar</button>
</form>
