@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-baseline mr-5">
            <h5 class="text-dark font-weight-bold my-2 mr-5">Cancelar Solicitud N°{{$boleta->id}}</h5>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <a href="" class="text-muted"></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="card card-custom">
        <div class="card-body">
            <form action="{{ asset('workflow/comentario-cancelar') }}" method="post">
             @csrf
                <div class="form-group">
                    <label>Asunto</label>
                    {!!Form::select('asunto_cancelar',['Rechazo'=>'Rechazo','Cliente no se encontraba'=>'Cliente no se encontraba'],null,['class'=>"form-control", 'placeholder'=>"Seleccione"])!!}
                </div>
                <div class="form-group">
                    <label>Motivo</label>
                    {!!Form::textarea('comentario_cancelar',null,['class'=>"form-control", 'placeholder'=>"Escriba el motivo",'rows'=>'2'])!!}
                </div>
                {{ Form::hidden('id', $boleta->id) }}
                <div class="form-group" style="text-align: right;">
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                </div>
           </form>
        </div>
    </div>
</div>
@endsection