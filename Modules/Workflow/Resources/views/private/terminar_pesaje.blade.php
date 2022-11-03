<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="terminarpesaje" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['url' => 'workflow/pesado','files'=>true, 'method' => 'POST']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Terminar Pesaje
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
            	{{ Form::hidden('id_bol',$boleta->id) }}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                        	<label>N° Guía de Despacho</label>
                            {!!Form::number('n_guia_despacho',null,['class'=>"form-control", 'placeholder'=>"Ingrese Número" ])!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button class="btn btn-primary">
                    Terminar
                </button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>