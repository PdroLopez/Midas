<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Empresa <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade bd-example-modal-lg" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" action="{{ asset('backend/agregar-empresa') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nueva Empresa
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Nombre Empresa</label>

                            {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Razón Social</label>
                            {!!Form::text('razon_social',null,['class'=>"form-control", 'placeholder'=>"Ingrese razón social..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Rut</label>
                            {!!Form::text('rut',null,['class'=>"form-control", 'placeholder'=>"Ingrese un rut..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Estado</label>
                            {!!Form::select('bk_estados_id',$estado,23,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Contratista</label>
                            {!!Form::select('marcas_id',$marca,null,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Observarciones</label>
                            {!!Form::textarea('observaciones',null,['class'=>"form-control", 'rows'=>"2" ,'placeholder'=>"Ingrese Observaciones..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">RETC</label>
                            {!!Form::text('rect',null,['class'=>"form-control", 'placeholder'=>"Escribir retc"])!!}
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
                    Registrar
                </button>
            </div>
        </div>
        </form>
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
