<div class="modal fade" id="agregarproducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Residuo a retirar</h5>
          {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!!Form::open(['url' => 'workflow/pesaje/induagregar', 'method' => 'POST','files'=>true])!!}
        <div class="modal-body">
              <div class="form-group">
                  <label>Grupo</label>
                  <select class="form-control" name="grupo" id="grupo" onchange="clasificaciones(this.value)" required>
                      <option value="">Seleccionar</option>
                      @foreach($grupo as $group)
                          <option value="{{ $group->id }}">{{ $group->nombre }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <label>Categoria</label>
                  <select class="form-control" name="clasificacion" id="clasi" onchange="subcategoriaBuscar(this.value);" required>
                      <option value="">Seleccionar</option>
                  </select>
              </div>
              <div class="form-group">
                  <label>Subcategoria</label>
                  <select class="form-control" name="subcategoria" id="subcate">
                      <option value="">Seleccionar</option>
                  </select>
              </div>
              <div class="form-group">
                  <label>Estado de los Residuos</label>
                  <select class="form-control" name="tipo_producto" id="tipo_pro" onchange="otroEstado(this.value);" required>
                      <option value="">Seleccionar</option>
                      @foreach($tipo_producto as $tipo)
                          <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                      @endforeach
                      <option value="otro">Otro</option>
                  </select>
              </div>
              <div class="form-group" style="display:none;" id="div_otro_estado">
                  <label>Otro Estado</label>
                  <input type="text" class="form-control" name="otro_estado" id="otro_estado">
              </div>
{{--               <div class="form-group">
                  <label>Cantidad</label>
                  <input type="number" class="form-control" name="cantidad" id="cantidad">
              </div> --}}
              <div class="form-group row">
                <div class="col-6">
                  <label>Peso (En Kilos)</label>
                   <input type="number" class="form-control" name="peso" id="peso">
                </div>
              </div>
              <div class="form-group">
                  <label>Observaciones/Detalle Retiro (Opcional)</label>
                  <textarea class="form-control" name="detalle_retiro" id="detalle_retiro">  </textarea>
              </div>
              <input type="hidden" name="boletas_id" value="{{$boleta->id}}">
        </div>
        <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
              <button type="submit"  class="btn btn-primary" >Guardar</button>
        </div>
        {!!Form::close()!!}
      </div>
    </div>
  </div>

<script type="text/javascript">
  function otroEstado(id){
    if(id == 'otro'){
      document.getElementById('div_otro_estado').style.display = "block";
    }else{
      document.getElementById('div_otro_estado').style.display = "none";
    }
  }

  //clasificacion de producto
  function clasificaciones(id) {
    var select = `<option value="">Seleccionar</option>`;
    $.get('{{ asset('api/grupo-clasificacion') }}/'+id, function(data, status) {
      for (var i = 0; i < data.length; i++) {
        select += `<option value="${data[i].id}">${data[i].nombre}</option>`;
      }
      document.getElementById('clasi').innerHTML = select;
    });
  }

  //subcategoria de producto
  function subcategoriaBuscar(id) {
    var select = `<option value="">Seleccionar</option>`;
    $.get('{{ asset('api/clasificacion-subcategoria') }}/'+id, function(data, status) {
      for (var i = 0; i < data.length; i++) {
        select += `<option value="${data[i].id}">${data[i].nombre}</option>`;
      }
      document.getElementById('subcate').innerHTML = select;
    });
  }

</script>