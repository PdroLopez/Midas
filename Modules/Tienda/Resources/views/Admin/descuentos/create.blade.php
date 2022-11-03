<button class="btn btn-primary" data-toggle="modal" data-target="#DescuentosProductos">Agregar Descuento <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade bd-example-modal-lg" id="DescuentosProductos" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        {!!Form::open(['route' => 'mantenedor-descuento.store', 'method' => 'POST'])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nuevo Descuento
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            {!! Form::text('nombre', null, ['min'=>'1','class'=>'form-control','placeholder'=>'Ingrese Producto...']) !!}
                         </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>%</label>
                            {!! Form::number('cantidad', null, ['min'=>'1','class'=>'form-control','placeholder'=>'Ingrese un Porcentaje(%)...']) !!}
                         </div>
                    </div>

                    {!! Form::hidden('descuento_final', $producto_valor, ['min'=>'1','class'=>'form-control','placeholder'=>'idif']) !!}

                    <div class="col-6">
                        <div class="form-group">
                            <label>Fecha inicio</label>
                            {!! Form::date('vencimiento', null, array('class' => 'form-control')) !!}
                         </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Fecha fin</label>
                            {!! Form::date('inicio', null, array('class' => 'form-control')) !!}
                         </div>

                    </div>



                     {{-- <div class="form-group">
                         <label>Productos</label>
                         {!! Form::select('td_productos_id', $productos, null,['class' => 'form-control']) !!}
                      </div> --}}


                     {{ Form::hidden('td_productos_id',  $producto->id) }}


                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">
                    Cerrar
                </button>
                <button class="btn btn-primary">
                    Registrar
                </button>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
