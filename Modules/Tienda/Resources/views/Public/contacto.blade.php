@extends('tienda::layouts.public.master')
@section('tienda::content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@if (Session::has('success'))
<div class="alert alert-success" role="alert" id="success">
    {!! Session::get('success') !!}
</div>
@endif
<script type="text/javascript">
setTimeout(function() {
    $('#success').fadeOut('fast');
}, 5000);
</script>

<div class="container">
    @if(Session::has('mensaje'))
    <div class="col-10 mt-5 mb-0 ml-auto mr-auto alert alert-custom alert-{{ Session::get('mensaje')['type'] }} fade show" role="alert" style="height: 60px;">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">{{ Session::get('mensaje')['content'] }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">{{-- <i class="ki ki-close"></i> --}}</span>
            </button>
        </div>
    </div>
@endif
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h5 class="card-label">Contacto</h5>
            </div>
        </div>
        {!!Form::open(['route' => 'mantenedor-mensajes.store', 'method' => 'POST','files'=>true])!!}
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese un nombre..." , 'required'])!!}
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Correo</label>
                        {!!Form::email('correo',null,['class'=>"form-control", 'placeholder'=>"Ingrese un correo..." , 'required'])!!}
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Asunto</label>
                        {!!Form::text('asunto',null,['class'=>"form-control", 'placeholder'=>"Ingrese un asunto..." , 'required'])!!}
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Mensaje</label>
                        <textarea class="form-control" name="mensaje" ></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{asset('/tienda')}}" class="btn btn-secondary">Volver</a>
            <button class="btn btn-primary">
                Registrar
            </button>
        </div>
        {!! Form::close() !!}

    </div>
</div>
</div>
@endsection
