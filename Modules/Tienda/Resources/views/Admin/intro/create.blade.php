<script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
<button class="btn btn-primary" data-toggle="modal" data-target="#create">Agregar Intro <i class="fas fa-plus"></i></button>

<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="create" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        {!!Form::open(['route' => 'mantenedor-intro.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nueva Intro
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Peso</label>
                            {!!Form::number('peso',null,['class'=>"form-control", 'placeholder'=>"Ingrese un peso..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="radio-inline">
                            <label class="radio radio-rounded">
                            <input type="radio" name="estado" value="Activo" onChange="perteneceValue(this)">
                            <span></span>Activo</label>
                            <label class="radio radio-rounded">
                            <input type="radio" checked="checked" name="estado" value="Inactivo" onChange="perteneceValue(this)">
                            <span></span>Inactivo</label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Tipo de archivo</label>
                            {!!Form::text('tipo_archivo',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Archivo</label>
                            <input type="file" name="archivo" class="form-control" placeholder="">
                            <span class="text-danger">{{ $errors->first('archivo') }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Texto 1</label>
                            <textarea class="form-control" col="4" name="texto1" placeholder="Ingrese  un Texto"></textarea>
                            <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Texto 2</label>
                            <textarea class="form-control" col="4" name="texto2" placeholder="Ingrese  un Texto"></textarea>
                            <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Parrafo</label>
                            <textarea class="form-control" col="4" name="parrafo" placeholder="Ingrese  un Parrafo"></textarea>
                            <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Botton</label>
                            {!!Form::text('boton',null,['class'=>"form-control", 'placeholder'=>"Ingrese  un botton..." , 'required'])!!}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Url</label>
                            {!!Form::text('url',null,['class'=>"form-control", 'placeholder'=>"Ingrese una url..." , 'required'])!!}
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
