@extends('tienda::layouts.public.master')

@section('tienda::content')
<style type="text/css">
	@media only screen and (max-width: 500px) {
        .precio {
        	font-size: 13px !important;
        }
    }
    .svg-icon.svg-icon-primary.svg-aux svg g [fill] {
	    -webkit-transition: fill 0.3s ease;
	    transition: fill 0.3s ease;
	    fill: white !important;
	}
</style>
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<div class="d-flex flex-column-fluid">
			<div class="container">
				<div class="card card-custom gutter-b">
					<div class="card-header flex-wrap border-0 pt-6 pb-0">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder font-size-h3 text-dark">Carro de Compras</span>
						</h3>
						<div class="card-toolbar">
							<div class="dropdown dropdown-inline">
								<a href="{{ asset('/tienda') }}" class="btn btn-primary font-weight-bolder font-size-sm">Continuar Comprando</a>
							</div>
						</div>
					</div>
					<div class="card-body px-sm-10 px-0">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Productos</th>
										<th class="text-center" style="padding-right: 20px;padding-left: 20px;">Cantidad</th>
										<th class="text-right">Precio</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									{{-- /////////////////////////////////////////////////////////////////////////////////////////// --}}
									<?php $total = 0; ?>
									@if(Session::has('carro'))
                                        @foreach(Session::get('carro') as $key => $producto)
											<tr>
												<td class="d-flex align-items-center font-weight-bolder">
													<div class="row">
														<div class="col-sm-6 col-12">
															<div class="symbol symbol-60 flex-shrink-0 mr-4 bg-light">
																<div class="symbol-label" style="background-image: url('{{ asset('public/img/productos/'.$producto['imagen']) }}')"></div>
															</div>
														</div>
														<div class="col-sm-6 col-12">
															<a href="#" class="text-dark text-hover-primary">{{ $producto['nombre'] }}</a>
														</div>
													</div>
												</td>
												<td class="text-center align-middle">
													<a href="{{ asset('/tienda/restar-producto') }}/{{ $key }}" class="btn btn-xs btn-light-success btn-icon mr-2">
														<i class="ki ki-minus icon-xs"></i>
													</a>
													<span class="mr-2 font-weight-bolder">{{ $producto['cantidad'] }}</span>
													<a href="{{ asset('/tienda/sumar-producto') }}/{{ $key }}" class="btn btn-xs btn-light-success btn-icon">
														<i class="ki ki-plus icon-xs"></i>
													</a>
												</td>
												<td class="precio text-right align-middle font-weight-bolder font-size-h5">${{ $producto['precio']*$producto['cantidad'] }}</td>
												<td class="text-left align-middle">
													<a href="{{ asset('/tienda/eliminar-producto') }}/{{ $key }}" class="btn btn-danger font-weight-bolder font-size-sm" style="padding: 3px 0px 4px 6px;">
														<span class="svg-icon svg-icon-primary svg-aux svg-icon-2x">
															<svg fill="white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															        <rect x="0" y="0" width="24" height="24"/>
															        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
															        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
															    </g>
															</svg>
														</span>
													</a>
												</td>
											</tr>
											<?php $total = $total + $producto['precio']*$producto['cantidad']; ?>
										@endforeach
                                    @endif
									{{-- //////////////////////////////////////////////////////////////////////////////////////// --}}
									<tr>
										<td colspan="1"></td>
										<td class="font-weight-bolder font-size-h4 text-right">Subtotal</td>
										<td class="font-weight-bolder font-size-h4 text-right">$<?php echo $total; ?></td>
										<td colspan="1"></td>
									</tr>
									<tr>
										<td colspan="4" class="border-0 text-muted text-right pt-0">No incluye despacho a domicilio.</td>
									</tr>
									<tr>
										<td colspan="2" class="border-0 pt-10">
											<form>
												<div class="form-group row">
													<div class="col-md-3 d-flex align-items-center">
														<label class="font-weight-bolder">Aplicar descuento</label>
													</div>
													<div class="col-md-9">
														<div class="input-group w-100">
															<input type="text" class="form-control" placeholder="Código">
															<div class="input-group-append">
																<button class="btn btn-secondary" type="button">aplicar</button>
															</div>
														</div>
													</div>
												</div>
											</form>
										</td>
										<td colspan="2" class="border-0 text-right pt-10">
											<a href="{{ asset('/tienda/compra') }}" class="btn btn-success font-weight-bolder px-8 mt-lg-0 mt-md-0 mt-sm-8 mt-8">Comprar</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection