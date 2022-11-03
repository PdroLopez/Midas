<a class="modal-with-form btn btn-default" href="#CreateUsuario">Nuevo usuario</a>

<div id="CreateUsuario" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Registro de Usuario</h2>
        </header>
            {!!Form::open(['route' => 'usuarios.store', 'method' => 'POST'])!!}
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        {!!Form::text('name',null,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Rol</label>
                        {!!Form::select('roles_id',$roles,null,['class'=>"form-control", 'placeholder'=>"Selecciona"])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Correo</label>
                        {!!Form::email('email',null,['class'=>"form-control", 'placeholder'=>"Ingrese texto..."])!!}
                    </div>
                    <div class="form-group">
                        <label for="">Contraseña</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                        <button class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </footer>
            {!!Form::close()!!}
    </section>
</div>