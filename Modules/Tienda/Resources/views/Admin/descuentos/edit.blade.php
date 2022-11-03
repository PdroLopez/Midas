<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$desc->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-descuento.update',$desc->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Descuento
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Producto</label>
                            {!! Form::text('nombre', $desc->nombre, ['min'=>'1','class'=>'form-control','placeholder'=>'Ingrese Producto...']) !!}
                         </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Cantidad</label>
                            {!! Form::number('cantidad', $desc->cantidad, ['min'=>'1','class'=>'form-control','placeholder'=>'Ingrese cantidad...']) !!}
                         </div>
                    </div>



                    <div class="col-6">
                        <div class="form-group">
                            <label>Fecha vencimiento</label>
                            {!! Form::date('vencimiento', $desc->vencimiento, array('class' => 'form-control')) !!}
                         </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Fecha Inicio</label>
                            {!! Form::date('inicio', $desc->inicio, array('class' => 'form-control')) !!}
                         </div>

                    </div>



                     {{-- <div class="form-group">
                         <label>Productos</label>
                         {!! Form::select('td_productos_id', $productos, null,['class' => 'form-control']) !!}
                      </div> --}}




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
