@extends('contenido::layouts.backend.master')
@section('contenido::content')
@foreach($usuario as $usuarios)
    <div class="container">
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
                    {!!Form::text('name',$usuarios->name,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required','disabled'])!!}
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    {!!Form::text('apellido',$usuarios->apellido,['class'=>"form-control", 'placeholder'=>"Ingrese texto" , 'required','disabled'])!!}

                </div>
                <div class="row">
                <div class="col-9">
                <label>Rut</label>
                    <div class="form-group">
                        {!!Form::number('rut',$usuarios->rut,['class'=>"form-control", 'placeholder'=>"Ingrese su rut" , 'disabled','required','id'=>"rut",'maxlength'=>"8"])!!}
                    </div>
                </div>
                <div class="col-3">
                <label>DV</label>
                    <div class="form-group">
                        {!!Form::text('dv',$usuarios->dv,['class'=>"form-control", 'disabled','placeholder'=>"DV" , 'required','id'=>"dv",'maxlength'=>"1"])!!}
                    </div>
                </div>
            </div>
            <div class="form-group">
            <label>Fecha Nacimiento</label>
            {!!Form::date('fecha_nacimiento',$usuarios->fecha_nacimiento,['class'=>"form-control", 'disabled','placeholder'=>"Ingrese una fecha" , 'required'])!!}
            </div>
                <div class="form-group">
                    <label for="">Rol</label>
                    @if($usuarios->roles_id != null)
                    {!!Form::select('roles_id',$rol,$usuarios->rol->id,['class'=>"form-control", 'disabled','placeholder'=>"Seleccionar"])!!}
                    @else
                    {!!Form::select('roles_id',$rol,null,['class'=>"form-control", 'disabled','placeholder'=>"Seleccionar"])!!}
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-control-label">
                        Email
                    </label>
                    {!!Form::email('email',$usuarios->email,['class'=>"form-control", 'disabled','placeholder'=>"Ingrese texto" , 'required'])!!}
                </div>
                <div class="form-group">
                <label>Telefono</label>
                    {!!Form::number('telefono',$usuarios->telefono,['class'=>"form-control", 'disabled','placeholder'=>"Ingrese texto" , 'required'])!!}
                </div>
            <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <img src="{{ asset('public/img/foto/'.$usuarios->foto) }}" width="200" style="border-radius: 10px;">

                
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" disabled>
                    Actualizar
                </button>
            </div>
            {!!Form::close()!!}
        </div>


    </div>
{{-- <div class="modal-dialog" role="document">
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
            {!!Form::date('fecha_nacimiento',$usuarios->fecha_nacimiento,['class'=>"form-control", 'placeholder'=>"Ingrese una fecha" , 'required'])!!}
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
            <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control">
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
    </div> --}}
    
@endforeach
@endsection