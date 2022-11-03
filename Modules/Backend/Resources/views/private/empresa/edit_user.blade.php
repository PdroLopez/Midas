<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$usuario->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => ['mantenedor-empresas_user.update',$usuario->id],'files'=>true, 'method' => 'PUT']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Usuario
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    {{--<div class="col-6">
                            <div class="form-group">
                               <label for="">Nombre</label>
                               {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                           </div>
                       </div>--}}

                       <div class="col-6">
                           <div class="form-group">
                               <label for="">Usuario</label>
                               {!! Form::select('users_id',$users,$usuario->user->id,['class'=>'form-control','onchange'=>"selectEmpresaRegion(this.value);",'placeholder'=>'Seleccione un Usuario']) !!}
                           </div>

                       </div>
                       <div class="col-6">
                           {{-- <div class="form-group">
                               <label>Comuna</label>
                               <select name="bk_comunas_id" id="comuna_empresa" class="form-control" placeholder="Seleccione una Region"></select>
                           </div> --}}
                       </div>
                   </div>
                   @csrf
                {{ Form::hidden('empresas_id',  $empresa_id) }}
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button class="btn btn-primary">
                    Actualizar
                </button>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>

<script>

function selectEmpresaRegion(id) {



    $.get('{{ asset('api/region') }}/' + id + '/comuna', function(data, status) {
        //console.log(data);
        var producto_select = '<option value="">Seleccione Comuna</option>'
        for (var i = 0; i < data.length; i++)
            producto_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';

       document.getElementById('comuna_empresa').innerHTML = producto_select;

    });
}


</script>


