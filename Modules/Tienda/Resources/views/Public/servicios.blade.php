@extends('tienda::layouts.public.master')

@section('tienda::content')
	<div class="container mb-0">
		<div class="card card-custom card-stretch gutter-b" style="height: auto;">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<div class="card card-custom gutter-b overflow-hidden">
							<div class="card-body p-0 d-flex rounded bg-light-success">
								<div class="py-18 px-12">
									<h3 class="font-size-h1">
										<a href="#" class="text-dark font-weight-bolder">Servicios</a>
									</h3>
									<div class="font-size-h4 text-success">Contrata nuestros servicios</div>
								</div>
								<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover" style="background-size: auto;margin: 25px;margin-left: 250px;background-image: url('{{ asset('img/reciclar.svg') }}')"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-6 col-md-4">
						<div class="card card-custom gutter-b card-stretch">
							<div class="card-body d-flex flex-column rounded bg-light justify-content-between">
								<div class="text-center rounded mb-7">
									<img src="{{ asset('img/reciclar.svg') }}" width="100">
								</div>
								<div>
									<h4 class="font-size-h5 text-center">
										<a href="#" class="text-dark-75 font-weight-bolder">Destrucción Certificada de Productos</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4">
						<div class="card card-custom gutter-b card-stretch">
							<div class="card-body d-flex flex-column rounded bg-light justify-content-between">
								<div class="text-center rounded mb-7">
									<img src="{{ asset('img/reciclar.svg') }}" width="100">
								</div>
								<div>
									<h4 class="font-size-h5 text-center">
										<a href="#" class="text-dark-75 font-weight-bolder">Reciclaje de Residuos</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4">
						<div class="card card-custom gutter-b card-stretch">
							<div class="card-body d-flex flex-column rounded bg-light justify-content-between">
								<div class="text-center rounded mb-7">
									<img src="{{ asset('img/reciclar.svg') }}" width="100">
								</div>
								<div>
									<h4 class="font-size-h5 text-center">
										<a href="#" class="text-dark-75 font-weight-bolder">Almacenamiento y transporte de residuos</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4">
						<div class="card card-custom gutter-b card-stretch">
							<div class="card-body d-flex flex-column rounded bg-light justify-content-between">
								<div class="text-center rounded mb-7">
									<img src="{{ asset('img/reciclar.svg') }}" width="100">
								</div>
								<div>
									<h4 class="font-size-h5 text-center">
										<a href="#" class="text-dark-75 font-weight-bolder">Asesoría en sustentabilidad</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4">
						<div class="card card-custom gutter-b card-stretch">
							<div class="card-body d-flex flex-column rounded bg-light justify-content-between">
								<div class="text-center rounded mb-7">
									<img src="{{ asset('img/reciclar.svg') }}" width="100">
								</div>
								<div>
									<h4 class="font-size-h5 text-center">
										<a href="#" class="text-dark-75 font-weight-bolder">Disposición Puntos de Reciclaje en colegios y empresas</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4">
						<div class="card card-custom gutter-b card-stretch">
							<div class="card-body d-flex flex-column rounded bg-light justify-content-between">
								<div class="text-center rounded mb-7">
									<img src="{{ asset('img/reciclar.svg') }}" width="100">
								</div>
								<div>
									<h4 class="font-size-h5 text-center">
										<a href="#" class="text-dark-75 font-weight-bolder">Operación sustentable</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
