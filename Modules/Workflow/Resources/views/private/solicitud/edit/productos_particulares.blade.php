<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
          <meta name="csrf-token" content="{{ csrf_token() }}">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="offcanvas-content pr-5 mr-n5 scroll ps ps--active-y">
               <label>Producto</label>
            <div class="row gutter-b">
              @foreach($residuo as $res)
                <div class="col-6" style="padding:5%;" data-toggle="modal" data-target="#detalleproducto{{ $res->id }}">
                <center>
                  <input type="radio" name="producto" value="{{ $res->id }}" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5" onclick="radioProducto(this.value);">
                      <img style="width:50px" src="{{asset('storage/'.$res->imagen)}}"></img>
                    <span class="d-block font-weight-bold font-size-h6 mt-2">{{ $res->nombre }}<br>
                        <small>{{$res->altura}} cm x {{$res->largo}} cm x {{$res->ancho}} cm</small>
                    </span>
              </center>
                </div>
                {{-- @include('retirocorto.detalleproducto') --}}
              @endforeach
              <div class="col-6" style="padding:5%;">
                <center>
                  <input type="radio" name="producto" value="0" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5" onclick="radioProducto(this.value);">
                      <img style="width:50px" src="{{asset('/otrascosas.jpg')}}"></img>
                    <span class="d-block font-weight-bold font-size-h6 mt-2">Otros</span>
                    </center>
                </div>
            </div>
            <input type="hidden" id="producto_elegido">
          </div>
            {{-- <div class="form-group">
                <label>Producto</label>
                <select class="form-control" name="producto" id="producto">
                  <option value="">Seleccione...</option>
                  @foreach($residuo as $res)
                    <option value="{{ $res->id }}">{{ $res->nombre }}</option>
                  @endforeach
                </select>
            </div> --}}
            <div class="row">
                  <div class="col-6">
                      <div class="form-group">
                        <label>Peso Aprox. (KG)</label>
                        <input type="number" name="peso" class="form-control" placeholder="" id="peso">
                    </div>
                  </div>
                  <div class="col-6">
                      <div class="form-group">
                          <label>Cantidad</label>
                          <input type="number" name="cantidad" value="1" class="form-control" placeholder="" id="cantidad">
                      </div>
                  </div>
              </div>
            <div id="div_valoresnuevos" style="display:none;">
                <div class="row" >
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="" id="nombre">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Altura (CM)</label>
                            <input type="number" name="altura" class="form-control" placeholder="" id="altura">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Largo (CM)</label>
                            <input type="number" name="largo" class="form-control" placeholder="" id="largo">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Ancho (CM)</label>
                            <input type="number" name="profundo" class="form-control" placeholder="" id="profundo">
                        </div>
                    </div>
                </div>
              </div>
              <div class="form-group">
                  <label for="exampleTextarea">Motivo</label>
                  <textarea class="form-control" name="motivo" id="motivo" rows="2"></textarea>
              </div>
            <div class="form-group">
                <label>Fotos</label>
                <input type="file" name="file" id="fotos-producto" class="form-control">
            </div>
            <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="crear_session_particular()" data-dismiss="modal" >Guardar</button>
        </div>
      </div>
    </div>
  </div>


  {{-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx funcionalidades xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx --}}

  <script>
    function radioProducto(id){
        document.getElementById('producto_elegido').value = id;
        if(id == 0){
            document.getElementById('div_valoresnuevos').style.display = "block";
        }else{
            document.getElementById('div_valoresnuevos').style.display = "none";
        }
  }

  function crear_session_particular() {
                  
              var producto = document.getElementById('producto_elegido').value;
              var peso = document.getElementById('peso').value;
              var altura = document.getElementById('altura').value;
              var largo = document.getElementById('largo').value;
              var profundidad = document.getElementById('profundo').value;
              var motivo = document.getElementById('motivo').value;
              var cantidad = document.getElementById('cantidad').value;
              var imagen = document.getElementById('fotos-producto');
              var nombre = document.getElementById('nombre').value;
              var boleta_id = document.getElementById('boleta_id').value;
             // alert(imagen);

             const data = new FormData();
             data.append("imagen", imagen.files[0],imagen.value);
             data.append("_token", $("meta[name='csrf-token']").attr("content"));
             data.append("producto",producto);
             data.append("peso",peso);
             data.append("largo",largo);
             data.append("altura",altura);
             data.append("motivo",motivo);
             data.append("cantidad",cantidad);
             data.append("profundidad",profundidad);
             data.append("nombre",nombre);
             data.append("boleta_id",boleta_id);

            $.ajax({
                url: '{{ asset('workflow/session-producto-particular/edit') }}',
                type: 'post',
                dataType: 'json',
                data: data,
                processData: false,
                contentType: false,
                success: function(data, status)
                {
                    var tabla = `<thead>
                            <tr>
                                <th>Producto</th>
                                <th>Imagen</th>
                                <th>Peso</th>
                                <th>Mt3</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>`;
                            var totalproducto = 0;
                            var mt3 = 0;
                            var mt3_total = 0;
                        for (var i = 0; i < data.length; i++) {
                            tabla += `
                                <tr>
                                    <th>${data[i].residuo}</th>
                                    <th><img src="{{ asset('/storage/${data[i].imagen}') }}" alt="Image de producto" width="100 " height="100"></th>
                                    <th>${data[i].peso}</th>
                                    <th>${data[i].mt3}</th>
                                    <th><a onclick="borrarproducto('${data[i].id_sol}')">X</a>
                                    </th>
                                </tr>
                            `;

                            var totalproducto = 29990;
                            var mt3 = data[i].mt3;
                            mt3_total = mt3_total+mt3;
                            if(mt3_total > 2){
                                mt3_restante = mt3_total-2;
                                valor_mt3 = (mt3_restante*29990)/2;
                                totalproducto  = totalproducto+valor_mt3;
                            }

                        }
                        tabla += `</tbody>`;
                        document.getElementById('session_datos_particulares').innerHTML= tabla;
                        document.getElementById('session_datos_particulares_resumen').innerHTML= tabla;

                        document.getElementById('totalproducto_id').value= parseInt(totalproducto);


                }
            });





      
}

</script>