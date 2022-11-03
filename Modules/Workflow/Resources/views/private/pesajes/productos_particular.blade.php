<div class="modal fade" id="agregarproducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
          {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!!Form::open(['url' => 'workflow/pesaje/partagregar', 'method' => 'POST','files'=>true])!!}
        <div class="modal-body">
            <div class="row">
                  <div class="col-12">
                    <label>Residuos</label>
                  <select class="form-control" name="residuo" id="grupo" onchange="radioProducto(this.value);" required>
                      <option value="">Seleccionar</option>
                      @foreach($residuo as $res)
                          <option value="{{ $res->id }}">{{ $res->nombre }} - {{$res->altura}} cm x {{$res->largo}} cm x {{$res->ancho}} cm</option>
                      @endforeach
                      <option value="0">Otro</option>
                  </select>
                  </div>
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
                <input type="file" name="foto" id="fotos-producto" class="form-control">
            </div>
            <input type="hidden" name="boletas_id" value="{{$boleta->id}}">
            <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
          <button type="submit" class="btn btn-primary" >Guardar</button>
        </div>
        {!!Form::close()!!}
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

</script>