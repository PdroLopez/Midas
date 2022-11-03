<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="corta_url{{$producto->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                     URL para compra rápida por Redes Sociales
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" name="url_usar" value="{{$url_usar}}/v/pro/{{$producto->id}}/paso-1" style="width: 100%;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>