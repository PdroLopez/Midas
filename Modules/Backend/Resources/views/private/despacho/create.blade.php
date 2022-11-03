<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Despacho <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        {!!Form::open(['route' => 'mantenedor-comunas.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nueva Despacho
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Regiones</label>
                            {!!Form::select('bk_regiones_id',$regiones,null,['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'required','onchange'=>'BuscarComuna(this.value);'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Comunas</label>
                            {!!Form::select('bk_comunas_id',[],null,['class'=>"form-control", 'placeholder'=>"Seleccionar" ,'id'=>'comuna_select', 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Cobertura</label>
                            {!!Form::select('bk_cobertura_id',$coberturas,null,['class'=>"form-control", 'placeholder'=>"Seleccionar" , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Costo</label>
                            {!!Form::text('costo',null,['class'=>"form-control", 'placeholder'=>"Ingrese un costo" , 'required'])!!}
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
        {!!Form::close()!!}
    </div>
</div>

<script type="text/javascript">
  function BuscarComuna(id){
    $.get("{{ asset('backend/buscar-comuna') }}/"+id,function(response, compania){
        $("#comuna_select").empty();
        $("#comuna_select").append(`<option value="0">Seleccionar</option>`);
        response.forEach(element => {
          $("#comuna_select").append(`<option value="${element.id}"> ${element.nombre} </option>`);
        });
    });
  }
</script>
