<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$producto->solicitud->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['editpesaje.ticket',$producto->solicitud->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Peso
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Peso Bruto</label>
                            <input type="number" name="peso_bruto" value="{{$producto->solicitud->peso_bruto}}" id="peso_bruto_{{$producto->solicitud->id}}" onblur="calcularNetoEDIT()" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Peso Envase</label>
                            <input type="number" name="peso_interno" value="{{$producto->solicitud->peso_interno}}" id="peso_interno_{{$producto->solicitud->id}}" onblur="calcularNetoEDIT()" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Peso Neto</label>
                            <input type="number" name="peso_neto" value="{{$producto->solicitud->peso_neto}}" id="peso_neto_{{$producto->solicitud->id}}" class="form-control" readonly>
                        </div>
                    </div>
                    <input type="hidden" id="prod_id" value="{{$producto->solicitud->id}}">
                </div>
                @if($producto->solicitud->calidad->count() != 0)
                <h5 class="modal-title" id="exampleModalLabel">
                        Control Calidad
                    </h5>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Observación</label>
                            <textarea class="form-control" name="observacion" rows="2">{{$producto->solicitud->calidad->first()->observacion}}</textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <img src="{{ asset('storage/'.$producto->solicitud->calidad->first()->archivo)}}" style="width: 50%;">
                        </div>
                    </div>
                    <input type="hidden" id="calidad_id" value="{{$producto->solicitud->calidad->first()->id}}">
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button class="btn btn-primary">
                    Actualizar
                </button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
<script type="text/javascript">
    function calcularNetoEDIT(){
        var pro = document.getElementById('prod_id').value;
        
        var peso_bruto = document.getElementById("peso_bruto_"+pro).value;
        var peso_interno = document.getElementById('peso_interno_'+pro).value;
        peso_neto = Number.parseInt(peso_bruto)-Number.parseInt(peso_interno);

        document.getElementById('peso_neto_'+pro).value = peso_neto;
    }
</script>




