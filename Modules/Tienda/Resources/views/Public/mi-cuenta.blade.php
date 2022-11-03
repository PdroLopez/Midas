@extends('tienda::layouts.public.master')

@section('tienda::content')
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<div class="d-flex flex-column-fluid">
			<div class="container">
				<div class="d-flex flex-row">
					<div class="flex-row-fluid ml-lg-8">
						<div class="card card-custom card-stretch">

							<div class="card-header py-3 mt-3">
								<div class="card-title align-items-start flex-column">
									<h3 class="card-label font-weight-bolder text-dark">Información Personal</h3>
									<span class="text-muted font-weight-bold font-size-sm mt-1">Actualiza tus datos</span>
								</div>
								{!!Form::open(array('url' => 'tienda/mi-cuenta/actualizar', 'method' => 'post','files' => 'true'))!!}
								<div class="card-toolbar">
									<button type="submit" class="btn btn-success mr-2">Guardar Cambios</button>
                                    {{-- <button type="reset" class="btn btn-secondary">Cancelar</button> --}}
                                    <a class="btn btn-success mr-2" href="{{asset('/')}}">Cancelar</a>
								</div>
							</div>
							<div class="card-body">
								<div class="row">
									<label class="col-xl-3"></label>
									<div class="col-lg-9 col-xl-6">
										<h5 class="font-weight-bold mb-6">Información de Usuario</h5>
									</div>
								</div>
								{{-- <div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Imagen</label>
									<div class="col-lg-9 col-xl-6">
										<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url()">
											<div class="image-input-wrapper" style="background-image: url()"></div>
											<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Cambiar">
												<i class="fa fa-pen icon-sm text-muted"></i>
												<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
												<input type="hidden" name="profile_avatar_remove" />
											</label>
											<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancelar">
												<i class="ki ki-bold-close icon-xs text-muted"></i>
											</span>
											<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Eliminar">
												<i class="ki ki-bold-close icon-xs text-muted"></i>
											</span>
										</div>
										<span class="form-text text-muted">Tipos de imagen: png, jpg, jpeg.</span>
									</div>
								</div> --}}
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Nombre</label>
									<div class="col-lg-9 col-xl-6">
										<input class="form-control form-control-lg form-control-solid" name="name" type="text" value="{{ Auth::user()->name }}" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Apellido</label>
									<div class="col-lg-9 col-xl-6">
										<input class="form-control form-control-lg form-control-solid" name="apellido" type="text" value="{{ Auth::user()->apellido }}" />
									</div>
                                </div>

                                @if (Auth::user()->foto)
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Imagen</label>
                                        <div class="col-lg-9 col-xl-6">
                                            @foreach ($foto as $item)
                                                <img src="{{asset('storage/'.$item->foto)}}" width="50%" height="auto">
                                            @endforeach

                                       </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Foto</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" name="foto[]" type="file"  />
                                        </div>
                                    </div>
                                @else
                                <div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Foto</label>
									<div class="col-lg-9 col-xl-6">
										<input class="form-control form-control-lg form-control-solid" name="foto[]" type="file"  />
									</div>
                                </div>


                                @endif
{{--                                 <div class="row">
									<label class="col-xl-3"></label>
									<div class="col-lg-9 col-xl-6">
                                        <h5 class="font-weight-bold mb-6"> Direcciones </h5>
                                        <span class="text-muted font-weight-bold font-size-sm mt-1"> Crear Direcciones</span>
									</div>
                                </div>
                                <br>
                                <div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Region</label>
									<div class="col-lg-9 col-xl-6">
                                        <select name="bk_regiones_id" id="region" class="form-control h-auto form-control-solid py-4 px-8" placeholder="Seleccione una Region" onchange="select(this.value)">

                                            <option value="">Seleccione una Región</option>
                                            @foreach($region as $regiones)
                                                <option value="{{ $regiones->id }}">{{ $regiones->nombre }}
                                                </option>
                                            @endforeach
                                          </select>
									</div>
                                </div>

                                <div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Comuna</label>
									<div class="col-lg-9 col-xl-6">
                                        <select name="bk_comunas_id" id="comuna" class="form-control h-auto form-control-solid py-4 px-8" placeholder="Seleccione una Region">
                                            <option value="">Seleccione una Comuna</option>
                                          </select>
                                	</div>
                                </div>


                                <div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Dirección</label>
									<div class="col-lg-9 col-xl-6">
                                        {!!Form::text('direccion',null,['class'=>"form-control h-auto form-control-solid py-4 px-8", 'placeholder'=>"Ingrese dirección..."])!!}
									</div>
                                </div> --}}


                                {{-- <div class="row">
									<label class="col-xl-3"></label>
									<div class="col-lg-9 col-xl-6">
                                        <a  href="{{asset('tienda/ver-direcciones')}}/{{Auth::user()->id}}" class="btn btn-success mr-2">Ver Direcciones </a>
									</div>
                                </div> --}}

                                {{-- <div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Foto</label>
									<div class="col-lg-9 col-xl-6">
										<input class="form-control form-control-lg form-control-solid" name="foto" type="file"  />
									</div>
								</div> --}}
								<div class="row">
									<label class="col-xl-3"></label>
									<div class="col-lg-9 col-xl-6">
										<h5 class="font-weight-bold mt-10 mb-6">Información de Contacto</h5>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Teléfono</label>
									<div class="col-lg-9 col-xl-6">
										<div class="input-group input-group-lg input-group-solid">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="la la-phone"></i>
												</span>
											</div>
											<input type="text" name="telefono" class="form-control form-control-lg form-control-solid" value="{{ Auth::user()->telefono }}" placeholder="Phone" />
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Email</label>
									<div class="col-lg-9 col-xl-6">
										<div class="input-group input-group-lg input-group-solid">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="la la-at"></i>
												</span>
											</div>
											<input type="text" name="email" class="form-control form-control-lg form-control-solid" value="{{ Auth::user()->email }}" placeholder="Email" />
										</div>
									</div>
								</div>
								{!!Form::close()!!}
								{!!Form::open(array('url' => 'tienda/mi-cuenta/actualizar-contraseña', 'method' => 'post'))!!}
								<div class="row">
									<label class="col-xl-3"></label>
									<div class="col-lg-9 col-xl-6">
										<h5 class="font-weight-bold mt-10 mb-6">Contraseña de Usuario</h5>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Antigua Contraseña</label>
									<div class="col-lg-9 col-xl-6">
										<div class="input-group input-group-lg input-group-solid">
											<div class="input-group-prepend">
												<span class="input-group-text">
												</span>
											</div>
											<input type="password" name="old_ps" class="form-control form-control-lg form-control-solid" placeholder="" required="" />
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Nueva Contraseña</label>
									<div class="col-lg-9 col-xl-6">
										<div class="input-group input-group-lg input-group-solid">
											<div class="input-group-prepend">
												<span class="input-group-text">
												</span>
											</div>
											<input type="password" name="password1" class="form-control form-control-lg form-control-solid" placeholder="" id="inputPassword1" onchange="validacion();" required="" />
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Confirma Contraseña</label>
									<div class="col-lg-9 col-xl-6">
										<div class="input-group input-group-lg input-group-solid">
											<div class="input-group-prepend">
												<span class="input-group-text">
												</span>
											</div>
											<input type="password" name="password2" class="form-control form-control-lg form-control-solid" placeholder="" id="inputPassword2" onchange="validacion();" required="" />
										</div>
									</div>
								</div>
								<div class="form-group row" id="buton" style="display:none;">
									<label class="col-xl-3 col-lg-3 col-form-label text-right"></label>
									<div class="col-lg-9 col-xl-6">
										<button type="submit" class="btn btn-success">Cambiar Contraseña</button>
									</div>
								</div>
		                        {!!Form::close()!!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
<script>
    function select(id) {
        $.get('{{ asset('api/region') }}/' + id + '/comuna', function(data, status) {
            //console.log(data);
            var producto_select = '<option value="">Seleccione Comuna</option>'
            for (var i = 0; i < data.length; i++)
                producto_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';

           document.getElementById('comuna').innerHTML = producto_select;

        });
    }
</script>
<script type="text/javascript">
	function validacion(){
	    var pw1 = document.getElementById("inputPassword1");
	    var pw2 = document.getElementById("inputPassword2");
	    if(pw1.value != null){
	        if(pw1.value == pw2.value){
	            document.getElementById("buton").style.display = 'block';
	            // document.getElementById("inputPassword2").style.borderColor = '#47a447';
	        }else{

	            document.getElementById("buton").style.display = 'none';
	            // document.getElementById("inputPassword2").style.borderColor = '#d2322d';

	        }
	    }
	}
</script>
