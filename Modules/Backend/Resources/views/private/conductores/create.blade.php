<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Conductor <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        {!!Form::open(['route' => 'mantenedor-conductores.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nuevo Conductor
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">


                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('name',null,['class'=>"form-control", 'placeholder'=>"Ingrese un Nombre..." , 'required'])!!}
                        </div>
                    </div>

                    <div class="col-9">
                        <div class="form-group">
                            <label for="">Rut</label>
                            {!!Form::number('rut',null,['min'=> '1','class'=>"form-control", 'placeholder'=>"Ingrese un Rut..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Dv</label>
                            {!!Form::text('dv',null,['class'=>"form-control", 'placeholder'=>"Ingrese dv" , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Correo</label>
                            {!!Form::text('email',null,['class'=>"form-control", 'placeholder'=>"Ingrese un Correo..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Teléfono</label>
                            {!!Form::number('telefono',null,['min'=> '1','class'=>"form-control", 'placeholder'=>"Ingrese un Teléfono..." , 'required'])!!}
                        </div>
                    </div>


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
