<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="edit{{$usuarios->id}}" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			{!! Form::open(['route' => ['mantenedor-usuarios.update',$usuarios->id],'files'=>true, 'method' => 'PUT']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Usuarios
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-control-label">
                        Nombre
                    </label>
                    {!!Form::text('name',$usuarios->name,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    {!!Form::text('apellido',$usuarios->apellido,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}

                </div>
                <div class="row">
                <div class="col-9">
                  <label>Rut</label>
                    <div class="form-group">
                        {!!Form::number('rut',$usuarios->rut,['class'=>"form-control", 'placeholder'=>"Ingrese su rut" , 'required','id'=>"rut",'maxlength'=>"8"])!!}
                    </div>
                </div>
                <div class="col-3">
                  <label>DV</label>
                    <div class="form-group">
                        {!!Form::text('dv',$usuarios->dv,['class'=>"form-control", 'placeholder'=>"DV" , 'required','id'=>"dv",'maxlength'=>"1"])!!}
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label>Fecha Nacimiento</label>
              {!!Form::date('fecha_nacimiento',$usuarios->fecha_nacimiento,['class'=>"form-control", 'placeholder'=>"Ingrese una fecha"])!!}
            </div>
                  <div class="form-group">
                    <label for="">Rol</label>
                    @if($usuarios->roles_id != null)
                    {!!Form::select('roles_id',$rol,$usuarios->rol->id,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                    @else
                    {!!Form::select('roles_id',$rol,null,['class'=>"form-control", 'placeholder'=>"Seleccionar"])!!}
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-control-label">
                        Email
                    </label>
                    {!!Form::email('email',$usuarios->email,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
                </div>
                <div class="form-group">
                  <label>Telefono</label>
                    {!!Form::number('telefono',$usuarios->telefono,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required'])!!}
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