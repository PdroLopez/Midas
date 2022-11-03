<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="detalleproducto{{$res->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{$res->nombre}}
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
        <div class="modal-body">
                <div class="row" >
                    <div class="col-12">
                        <div class="form-group">
                            <label>Detalle</label>
                            <b>{{$res->detalle}}</b>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Altura (CM)</label>
                            <b>{{$res->altura}}</b>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Largo (CM)</label>
                            <b>{{$res->largo}}</b>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Ancho (CM)</label>
                            <b>{{$res->ancho}}</b>
                        </div>
                    </div>
                </div>
            <br>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>