@extends('tienda::layouts.public.master')
@section('tienda::content')


<div class="container">


        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-direcciones.update',$direcciones->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Direcciones
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-control-label">
                        Nombre
                    </label>
                    {!!Form::text('nombre',$direcciones->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
                </div>

                <div class="form-group ">
                    <label class="form-control-label">Region</label>

                    {!! Form::select('bk_regiones_id', $region, $direcciones->bk_regiones_id, [ 'onchange'=>'region4(this.value)', 'id'=>'bk_regiones_id','name'=>'bk_regiones_id','class' => 'form-control']) !!}

                        {{-- <select name="bk_regiones_id" id="region" class="form-control" placeholder="Seleccione una Region" onchange="select(this.value)">

                            <option value="">Seleccione una Región</option>
                            @foreach($region as $regiones)
                                <option value="{{ $regiones->id }}">{{ $regiones->nombre }}
                                </option>
                            @endforeach
                        </select> --}}

                </div>

                <div class="form-group ">
                    <label class="form-control-label">Comuna</label>

                    {!! Form::select('bk_comunas_id', $comuna, $direcciones->comuna->id, ['id'=>'comunas4','class' => 'form-control']) !!}


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
                    Actualizar
                </button>
            </div>
            {!!Form::close()!!}
        </div>

</div>

@endsection


{{-- <script>
    function select(id) {
        $.get('{{ asset('api/region') }}/' + id + '/comuna', function(data, status) {
            //console.log(data);
            var producto_select = '<option value="">Seleccione Comuna</option>'
            for (var i = 0; i < data.length; i++)
                producto_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';

           document.getElementById('comuna').innerHTML = producto_select;

        });
    }
</script> --}}

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

