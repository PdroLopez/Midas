
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="agregarproducto" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Agregar Productos
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
        {!!Form::open(['url' => 'retiro-corto/agregar-producto', 'method' => 'POST','files'=>true])!!}
        <div class="modal-body">
          <div class="offcanvas-content pr-5 mr-n5 scroll ps ps--active-y">
               <label>Producto</label>
            <div class="row gutter-b">
              @foreach($residuo as $res)
                <div class="col-6" style="padding:5%;" data-toggle="modal" data-target="#detalleproducto{{ $res->id }}">
                  <input type="radio" name="producto" value="{{ $res->id }}" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5" onclick="radioProducto(this.value);">
                      <img style="width:50px" src="{{asset('storage/'.$res->imagen)}}"></img>
                    <span class="d-block font-weight-bold font-size-h6 mt-2">{{ $res->nombre }}<br>
                        <small>{{$res->altura}} cm x {{$res->largo}} cm x {{$res->ancho}} cm</small>
                    </span>
                </div>
                {{-- @include('retirocorto.detalleproducto') --}}
              @endforeach
              <div class="col-6" style="padding:5%;">
                  <input type="radio" name="producto" value="0" class="btn btn-block btn-light btn-hover-primary text-dark-50 text-center py-10 px-5" onclick="radioProducto(this.value);">
                      <img style="width:50px" src="{{asset('/otrascosas.jpg')}}"></img>
                    <span class="d-block font-weight-bold font-size-h6 mt-2">Otros</span>
                </div>
            </div>
          </div>
              <div class="row">
                  <div class="col-6">
                      <div class="form-group">
                        <label>Peso Aprox. (KG)</label>
                        <input type="number" name="peso" class="form-control" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-6">
                      <div class="form-group">
                          <label>Cantidad</label>
                          <input type="number" name="cantidad" value="1" class="form-control" placeholder="" required>
                      </div>
                  </div>
              </div>
              <div id="div_valoresnuevos" style="display:none;">
                <div class="row" >
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Altura (CM)</label>
                            <input type="number" name="altura" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Largo (CM)</label>
                            <input type="number" name="largo" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Ancho (CM)</label>
                            <input type="number" name="profundo" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
              </div>
              <div class="form-group">
                  <label for="exampleTextarea">Motivo</label>
                  <textarea class="form-control" name="motivo" id="exampleTextarea" rows="2" required></textarea>
              </div>
              <div class="form-group">
                  <label>Fotos</label>
                  <input type="file" name="imagen[]" id="fotos-producto" multiple class="form-control" required>
              </div>
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