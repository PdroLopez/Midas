<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$residuo->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-residuos.update',$residuo->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Producto {{$residuo->nombre}}
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',$residuo->nombre,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Altura (CM)</label>
                            {!!Form::number('altura',$residuo->altura,['class'=>"form-control", 'required'])!!}
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Largo (CM)</label>
                            {!!Form::number('largo',$residuo->largo,['class'=>"form-control", 'required'])!!}
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Ancho (CM)</label>
                            {!!Form::number('ancho',$residuo->ancho,['class'=>"form-control", 'required'])!!}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Imagen</label>
                            <input type="file" name="imagen[]" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button class="btn btn-primary">
                    Actualizar
                </button>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>