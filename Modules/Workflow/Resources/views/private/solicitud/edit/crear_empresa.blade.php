<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade bd-example-modal-lg" id="agregar-empresa" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" action="{{ asset('workflow/edit/agregar-empresa-modal') }}">
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
                            <label for="">Observarciones (Opcional)</label>
                            {!!Form::textarea('observaciones',null,['class'=>"form-control", 'rows'=>"2" ,'placeholder'=>"Ingrese Observaciones..."])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">RETC</label>
                            {!!Form::text('retc',null,['class'=>"form-control",'placeholder'=>"Código Retc"])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Región</label>
                            <select name="bk_regiones_id" id="region_empresa" class="form-control" placeholder="Seleccione una Region" onchange="selectRegionEmpresa(this.value)">
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
                            <select name="bk_comunas_id" id="comuna_empresa_id" class="form-control" placeholder="Seleccione una Region">
                              <option value="">Seleccione una Comuna</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Dirección</label>
                            {!!Form::text('direccion_nombre',null,['class'=>"form-control",'placeholder'=>"Escriba Dirección",'required'])!!}
                        </div>
                    </div>  
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
function selectRegionEmpresa(id) {
    $.get('{{ asset('api/region') }}/' + id + '/comuna', function(data, status) {
        //console.log(data);
        var producto_select = '<option value="">Seleccione Comuna</option>'
        for (var i = 0; i < data.length; i++)
            producto_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';

       document.getElementById('comuna_empresa_id').innerHTML = producto_select;

    });
}
</script>