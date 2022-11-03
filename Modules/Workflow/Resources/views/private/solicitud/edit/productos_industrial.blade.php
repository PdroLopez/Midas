<div class="modal fade" id="agregarproducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Residuo a retirar</h5>
          <meta name="csrf-token" content="{{ csrf_token() }}">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <div class="form-group">
                  <label>Grupo</label>
                  <select class="form-control" name="grupo" id="grupo" onchange="clasificaciones(this.value)">
                      <option value="">Seleccionar</option>
                      @foreach($grupo as $group)
                          <option value="{{ $group->id }}">{{ $group->nombre }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <label>Categoria</label>
                  <select class="form-control" name="clasificacion" id="clasi" onchange="subcategoriaBuscar(this.value);">
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
                  <select class="form-control" name="tipo_producto" id="tipo_pro" onchange="otroEstado(this.value);">
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
                <div class="col-6">
                    <label>Destrucción Certificada</label><br>
                    <input type="radio" name="des_certificada" value="0" checked>
                    <label>Si</label>
                    <input type="radio" name="des_certificada" value="1">
                    <label>No</label><br>
                </div>
              </div>
              <div class="form-group">
                  <label>Observaciones/Detalle Retiro (Opcional)</label>
                  <textarea class="form-control" name="detalle_retiro" id="detalle_retiro">  </textarea>
              </div>
        </div>
        <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
              <button type="button" class="btn btn-primary" onclick="crear_session()" data-dismiss="modal" >Guardar</button>
        </div>
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

  function crear_session() {
    var clasi = document.getElementById('clasi').value;
    if (clasi != null) {

      var grupo = document.getElementById('grupo').value;
      var tipo_pro = document.getElementById('tipo_pro').value;
      if(tipo_pro == 'otro'){
        var otro_estado = document.getElementById('otro_estado').value;
      }else{
        var otro_estado = null;
      }
      // var cantidad = document.getElementById('cantidad').value;
      var subcate = document.getElementById('subcate').value;
      var des_certificada = $('input:radio[name=des_certificada]:checked').val();
      var peso = document.getElementById('peso').value;
      var boleta_id = document.getElementById('boleta_id').value;
      if (grupo != null) {

        var detalle_retiro = document.getElementById('detalle_retiro').value;

             const data = new FormData();
             data.append("_token", $("meta[name='csrf-token']").attr("content"));
             data.append("clasi",clasi);
             data.append("grupo",grupo);
             data.append("tipo_pro",tipo_pro);
             data.append("des_certificada",des_certificada);
             data.append("otro_estado",otro_estado);
             // data.append("cantidad",cantidad);
             data.append("subcate",subcate);
             data.append("peso",peso);
             data.append("detalle_retiro",detalle_retiro);
             data.append("boleta_id",boleta_id);
             console.log(data);

            $.ajax({
                url: '{{ asset('workflow/session-producto/edit') }}',
                type: 'post',
                dataType: 'json',
                data: data,
                processData: false,
                contentType: false,
                success: function(data, status)
                {
                  console.log(data);
                    var tabla = `<thead>
                      <tr>
                        <th>Grupo</th>
                          <th>Categoria</th>
                          <th>Subcategoria</th>
                          <th>Estado</th>
                          <th>Peso</th>
                          <th>Detalle</th>
                      </tr>
                    </thead>
                    <tbody>`;
                    for (var i = 0; i < data.length; i++) {
                      tabla += `
                        <tr>
                          <th>${data[i].nombre_grupo}</th>
                          <th>${data[i].nombre_clasi}</th>
                          <th>${data[i].nom_subcate}</th>
                          <th>${data[i].nom_tipo_producto}</th>
                          <th>${data[i].peso} Kg</th>
                          <th>${data[i].detalle_retiro}</th>
                        </tr>
                      `;
                    }
                    tabla += `</tbody>`;
                    document.getElementById('session_datos').innerHTML= tabla;
                    // document.getElementById('resumen').innerHTML= tabla;
                    // document.getElementById('empresa-user').innerHTML= empresa;
                    document.getElementById('session_datos_resumen').innerHTML= tabla;
                }
            });

      }
    }
  }
</script>