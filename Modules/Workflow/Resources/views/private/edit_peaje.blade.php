<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$producto->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-comentario.update',$producto->id],'files'=>true, 'method' => 'PUT']) !!}
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
                            <input type="number" name="peso_bruto" value="{{$producto->peso_bruto}}" id="peso_bruto_{{$producto->id}}" onblur="calcularNetoEDIT()" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Peso Envase</label>
                            <input type="number" name="peso_interno" value="{{$producto->peso_interno}}" id="peso_interno_{{$producto->id}}" onblur="calcularNetoEDIT()" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Peso Neto</label>
                            <input type="number" name="peso_neto" value="{{$producto->peso_neto}}" id="peso_neto_{{$producto->id}}" class="form-control" readonly>
                        </div>
                    </div>
                    <input type="hidden" id="prod_id" value="{{$producto->id}}">
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




