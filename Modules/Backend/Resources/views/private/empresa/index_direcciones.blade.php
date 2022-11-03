@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-baseline mr-5">
            <h5 class="text-dark font-weight-bold my-2 mr-5">Empresa <small>{{$empresa->nombre}}</small></h5>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <a href="" class="text-muted">Backend</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="" class="text-muted">Empresas</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="" class="text-muted">Direcciones</a>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="container">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Dirección de la  Empresa <small>{{$empresa->nombre}}</small></h3>
                <button class="btn btn-primary" data-toggle="modal" data-target="#create_direccion_empresa">Agregar Dirección  <i class="fas fa-plus"></i></button>
                {{-- <div class="ml-10">@include('backend::private.empresa.create')</div> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Buscar..." id="kt_datatable_search_query" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dirección</th>
                            <th>Región</th>
                            <th>Comuna</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($direcciones as $direccion)


                            <tr>
                                <td>  {{$direccion->id}} </td>
                                <td>  {{$direccion->nombre}} </td>
                                <td> {{ $direccion->region->nombre }}  </td>
                                <td>  {{$direccion->comuna->nombre}}</td>


                                </td>
                                {{--     <td>  {{$emp->razon_social}} </td>  <td>   @if($emp->bk_estados_id != null)
                                    {{ $emp->estado->nombre }}
                                @endif --}}
                                <td>
                                    <a class="btn btn-warning mb-2" data-toggle="modal" data-target="#edit{{ $direccion->id }}">Editar</a>
                                    <a class="btn btn-primary mb-2" href="{{ asset('/backend/private/desactivar-direccion') }}/{{ $direccion->id }}">Desactivar</a>

                                    {{-- @include('backend::private.empresa.destroy_direcciones') --}}
                                    {{--  --}}


                                    {{-- @if($emp->bk_estados_id == 18)
                                        <a href="{{ asset('backend/private/cambiar-estado') }}/{{ $emp->id }}" class="btn btn-info">Activar Empresa</a>
                                    @endif --}}


                                </td>
                                @include('backend::private.empresa.direccion_edit')

{{--

                                @include('backend::private.empresa.direcciones') --}}

                            </tr>
                         @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>


<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="create_direccion_empresa" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        {!!Form::open(['route' => 'mantenedor-direccion_empresas.store', 'method' => 'POST','files'=>true])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nueva dirección
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Dirección</label>
                            {!!Form::text('nombre',null,['class'=>"form-control", 'placeholder'=>"Ingrese Dirección..." , 'required'])!!}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Región</label>
                            {!! Form::select('bk_regiones_id',$region,null,['class'=>'form-control','onchange'=>"selectEmpresaRegion(this.value);",'placeholder'=>'Seleccione una region']) !!}
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Comuna</label>
                            <select name="bk_comunas_id" id="comuna_empresa" class="form-control" placeholder="Seleccione una Region">

                            </select>
                        </div>
                    </div>
                </div>
                {{ Form::hidden('empresas_id',  $empresa_id) }}
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

<script>

function selectEmpresaRegion(id) {

    $.get('{{ asset('api/region') }}/' + id + '/comuna', function(data, status) {

        $("#comuna_empresa").empty();
        $("#comuna_empresa").append(`<option value ="">Selecciona`);
        data.forEach(element => {
            $("#comuna_empresa").append(`<option value=${element.id}> ${element.nombre} </option>`);
        });

    });
}


</script>


@endsection
