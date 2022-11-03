<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$direccion->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => ['mantenedor-direccion_empresas.update',$direccion->id],'files'=>true, 'method' => 'PUT']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar dirección
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',$direccion->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Región</label>
                            {!! Form::select('',$region,$direccion->region->id,['class'=>'form-control','onchange'=>"selectEmpresaRegion2(this.value,$direccion->id);",'placeholder'=>'Seleccione una region']) !!}
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Comuna</label>
                            <select name="bk_comunas_id" id="comuna_empresa{{$direccion->id}}" class="form-control" placeholder="Seleccione una Region">
                                @if($direccion->bk_comunas_id != null)
                                    <option value="{{$direccion->bk_comunas_id}}">{{$direccion->comuna->nombre}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                {{ Form::hidden('empresas_id',  $empresa_id) }}
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
        {!!Form::close()!!}
    </div>
</div>

<script>

function selectEmpresaRegion2(id,direccion) {

    var id_direccion = direccion;

    $.get('{{ asset('api/region') }}/' + id + '/comuna', function(data, status) {
        $("#comuna_empresa"+id_direccion).empty();
        $("#comuna_empresa"+id_direccion).append(`<option value ="">Selecciona`);
        data.forEach(element => {
            $("#comuna_empresa"+id_direccion).append(`<option value=${element.id}> ${element.nombre} </option>`);
        });

    });

}


</script>


