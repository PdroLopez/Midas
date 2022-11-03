<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$conductor->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-conductores.update',$conductor->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Conductor
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">


                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('name',$conductor->name,['class'=>"form-control", 'placeholder'=>"Ingrese un Nombre..." , 'required'])!!}
                        </div>
                    </div>

                    <div class="col-9">
                        <div class="form-group">
                            <label for="">Rut</label>
                            {!!Form::number('rut',$conductor->rut,['min'=> '1','class'=>"form-control", 'placeholder'=>"Ingrese un Rut..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Dv</label>
                            {!!Form::text('dv',$conductor->dv,['class'=>"form-control", 'placeholder'=>"Ingrese dv" , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Correo</label>
                            {!!Form::text('email',$conductor->email,['class'=>"form-control", 'placeholder'=>"Ingrese un Correo..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Teléfono</label>
                            {!!Form::number('telefono',$conductor->telefono,['min'=> '1','class'=>"form-control", 'placeholder'=>"Ingrese un Teléfono..." , 'required'])!!}
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






















