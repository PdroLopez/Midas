{{--<button class="btn btn-primary" data-toggle="modal" data-target="#Programar{{$boleta->id}}">Actualizar Boleta <i class="fas fa-plus"></i></button>
  --}}
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade bd-example-modal-lg" id="Programar{{$boleta->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
    <form action="{{ asset('workflow/actualizar-boleta') }}/{{ $boleta->id }}" method="post">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Asignar Fecha y Conductor
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    x
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Fecha y Hora de Retiro</label>
                    {!!Form::text('fecha_hora',null,['class'=>"form-control", 'placeholder'=>"Ingrese Fecha" , 'required','id'=>"kt_datetimepicker_2"])!!}
                </div>
                <div class="form-group">
                    <label>Conductor</label>
                    {!!Form::select('user_id',$choferes,null,['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'required'])!!}
                </div>
                <div class="form-group">
                    <label>Tipo Vehículo</label>
                     <select class="form-control" name="tipo_camiones_id" onchange="buscarCamion(this.value,{{$boleta->id}})" required>
                        <option>Seleccionar</option>
                        @foreach($tipo_camiones as $tipo_camion)
                            <option value="{{ $tipo_camion->id }}">{{ $tipo_camion->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Vehículo</label>
                    <select class="form-control" name="camiones_id" id="camion_id{{$boleta->id}}" required>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$boleta->id}}" id="id_boletas">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button type="submit" class="btn btn-primary">Asignar Datos</button>
            </div>
        </div>
    </form>
    </div>
</div>
<script type="text/javascript">
    function buscarCamion(id,bol) {
        var select = `<option value="">Seleccionar</option>`;
        $.get('{{ asset('private/buscar-camion') }}/'+id, function(data, status) {
            for (var i = 0; i < data.length; i++) {
                select += `<option value="${data[i].id}">${data[i].nombre} / ${data[i].patente}</option>`;
            }
            document.getElementById('camion_id'+bol).innerHTML = select;
        });
    }
</script>