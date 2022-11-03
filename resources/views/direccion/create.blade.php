<button class="btn btn-primary btn-icon-sm" data-target="#create" data-toggle="modal" type="button">
    <i class="flaticon2-plus"></i>
    Nueva Direccion
</button>
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!!Form::open(['route' => 'mantenedor-direcciones.store', 'method' => 'POST','files'=>true])!!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nueva Direccion
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="">Dirección</label>
                    {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese direccion..." , 'required'])!!}
                </div>

                <div class="form-group">
                    <label for="">Region</label>
                    {!! Form::select('bk_regiones_id', $region, null, [ 'onchange'=>'region4(this.value)', 'id'=>'bk_regiones_id','name'=>'bk_regiones_id','class' => 'form-control']) !!}
                </div>

                <div class="form-group ">
                    <label class="form-control-label">Comuna</label>

                    {!! Form::select('bk_comunas_id', $comuna, null, ['id'=>'comunas4','class' => 'form-control']) !!}


                        {{-- <select name="bk_comunas_id" id="comuna" class="form-control" placeholder="Seleccione una Region">
                            <option value="">Seleccione una Comuna</option>
                          </select> --}}

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
            {!!Form::close()!!}
        </div>
    </div>
</div>
<script>
	function region4(id) {


		$.get('{{ asset('backend/region') }}/'+id+'/comuna', function(data, status) {
            console.dir(data);
            $('#comunas4').empty();
			var select = `<option value="">Seleccione comuna</option>`;
			for(var i = 0; i < data.length; i++){
                select +=  `<option value="${data[i].id}">${data[i].nombre}</option>`;
            }
            console.dir(select);

            //document.getElementById('comunas').value = select;
            $("#comunas4").append(select);

        });


	}
</script>
