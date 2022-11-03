@extends('tienda::layouts.public.master')

@section('tienda::content')
	<div class="container mb-0">
		<div class="card card-custom card-stretch gutter-b" style="height: auto;">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<div class="card card-custom gutter-b overflow-hidden">
							<div class="card-body p-0 d-flex rounded bg-light-warning">
								<div class="py-18 px-12">
									<h3 class="font-size-h1">
										<a href="#" class="text-dark font-weight-bolder">Productos</a>
									</h3>
									<div class="font-size-h4 text-success">Obtén nuestros productos</div>
								</div>
								<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover" style="background-size: auto;margin: 25px;margin-left: 250px;background-image: url('{{ asset('') }}')"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					@foreach ($productos as $producto)
					<a href="{{ asset('/tienda/producto/'.$producto->id) }}">
						<div class="col-12 col-sm-6 col-md-4">
							<div class="card card-custom gutter-b card-stretch">
								<div class="card-body d-flex flex-column rounded bg-light justify-content-between">
									<div class="text-center rounded mb-7">
										<img src="{{ asset('public/img/productos/'.$producto->imagen) }}" width="200" style="border-radius: 10px;">
									</div>
									<div>
										<h4 class="font-size-h5">
											<a href="{{ asset('/tienda/producto/'.$producto->id) }}" class="text-dark-75 font-weight-bolder">{{ $producto->nombre }}</a>
										</h4>
										<div class="font-size-h6 text-muted font-weight-bolder">${{ number_format($producto->precio) }}</div>
									</div>
								</div>
							</div>
						</div>
					</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection
