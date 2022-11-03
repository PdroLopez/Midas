<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="direccion{{ $emp->id }}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			<form method="post" action="{{ asset('backend/agregar-direccion-empresa') }}/{{ $emp->id }}">
                @csrf
                <input name="empresas_id" type="hidden" value="{{ $emp->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Agregar Dirección
                    </h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nombre Dirección</label>
                                {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                            </div>
                        </div>
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
                                 <select name="bk_comunas_id" id="comuna_empresa" class="form-control" placeholder="Seleccione una Region"></select>
                             </div>
                         </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">
                        Cerrar
                    </button>
                    <button class="btn btn-primary">
                        Agregar
                    </button>
                </div>
            </form>
        </div>
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