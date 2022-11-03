@if(count($productos))
	<h3>Productos</h3>
	@foreach($productos as $producto)
		<a href="{{ asset('tienda/producto/'.$producto->id) }}">
			<div class="row">
				<div class="col-6">
					<div class="symbol symbol-60 flex-shrink-0 mr-4 bg-light">
						<div class="symbol-label" style="background-image: url('{{ asset('storage/'.$producto['imagen']) }}')"></div>
					</div>
				</div>
				<div class="col-6 p-0">
					<span>{{ $producto->nombre }}</span>
				</div>
			</div>
		</a>
	@endforeach
@endif
