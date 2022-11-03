<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$emp->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			<form method="post" action="{{ asset('backend/editar-empresa') }}/{{ $emp->id }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Editar Recursos
                    </h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Nombre Empresa</label>

                                {!!Form::text('nombre',$emp->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                                @error('nombre')

                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Razón Social</label>
                                {!!Form::text('razon_social',$emp->razon_social,['class'=>"form-control", 'placeholder'=>"Ingrese razón social..." , 'required'])!!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Rut</label>
                                {!!Form::text('rut',$emp->rut,['class'=>"form-control", 'placeholder'=>"Ingrese un rut..." , 'required'])!!}
                            </div>
                        </div>
{{--                         <div class="col-6">
                            <div class="form-group">
                                <label for="">Estado</label>
                                {!!Form::select('bk_estados_id',$estado,$emp->estado->id,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                            </div>
                        </div> --}}

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Contratista</label>
                                {!!Form::select('marcas_id',$marca,3,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">RETC</label>
                                {!!Form::text('retc',$emp->retc,['class'=>"form-control", 'placeholder'=>"Escribir retc"])!!}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Observarciones</label>
                                {!!Form::textarea('observaciones',$emp->observaciones,['class'=>"form-control", 'rows'=>"2" ,'placeholder'=>"Ingrese Observaciones..." , 'required'])!!}
                            </div>
                        </div>

                        {{--
                             <div class="col-6">
                            <div class="form-group">
                                <label>Region</label>
                                <select name="bk_regiones_id" id="region_empresa" class="form-control" placeholder="Seleccione una Region" onchange="selectEmpresa(this.value)">
                                    <option value="">Seleccione una Región</option>
                                    @foreach($region as $regiones)
                                        <option value="{{ $regiones->id }}">{{ $regiones->nombre }}</option>
                                    @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Comuna</label>
                                <select name="bk_comunas_id" id="comuna_empresa" class="form-control" placeholder="Seleccione una Region">
                                  <option value="">Seleccione una Comuna</option>
                                </select>
                            </div>
                        </div>   <div class="col-6">
                            <div class="form-group">
                                <label for="">Nombre Encargado</label>
                                {!!Form::text('name',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                            </div>
                        </div>
                           <div class="col-6">
                            <div class="form-group">
                                <label for="">Telefono Encargado</label>
                                {!!Form::text('telefono',null,['class'=>"form-control", 'placeholder'=>"Ingrese un teléfono..." , 'required'])!!}
                            </div>
                        </div>
                             <div class="col-12">
                            <div class="form-group">
                                <label for="">Email Contacto</label>
                                {!!Form::text('email',null,['class'=>"form-control", 'placeholder'=>"Ingrese un email..." , 'required'])!!}
                            </div>
                        </div>
                         <div class="col-6">
                            <div class="form-group">
                                <label>Comuna</label>
                                <select name="bk_comunas_id" id="comuna_empresa" class="form-control" placeholder="Seleccione una Region">
                                  <option value="">Seleccione una Comuna</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Dirección</label>
                                 {!!Form::text('direccion',null,['class'=>"form-control", 'placeholder'=>"Ingrese una dirección..." , 'required'])!!}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Cargo</label>
                                <input type="text" name="cargo" class="form-control" id="cargo" required placeholder="Cargo" autocomplete="Cargo">
                            </div>
                        </div>
                          <div class="col-12">
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input id="password" type="password" placeholder="Contraseña" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                         --}}







                    </div>
            </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">
                        Cerrar
                    </button>
                    <button class="btn btn-primary">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function selectEmpresa(id) {
    $.get('{{ asset('api/region') }}/' + id + '/comuna', function(data, status) {
        //console.log(data);
        var producto_select = '<option value="">Seleccione Comuna</option>'
        for (var i = 0; i < data.length; i++)
            producto_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';

       document.getElementById('comuna_empresa').innerHTML = producto_select;

    });
}
</script>
