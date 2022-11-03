@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-baseline mr-5">
            <h5 class="text-dark font-weight-bold my-2 mr-5">Empresas</h5>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <a href="" class="text-muted">Backend</a>
                </li>
            </ul>
        </div>

    </div>
</div>
@if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
<div class="container">

        @if (\Session::has('success'))
            <div class="alert alert-success" role="alert" id="success">
                {!! \Session::get('success') !!}
            </div>
        @endif

        <script type="text/javascript">
            setTimeout(function() {
                $('#success').fadeOut('fast');
            }, 5000);
        </script>

    <div class="card card-custom">
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
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label"> Empresas</h3>
                <div class="ml-10">@include('backend::private.empresa.create')</div>
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
                            <th>Estado</th>
                            <th>Contratista</th>
                            <th>Empresa</th>
                            <th>Rut</th>
                            <th>Razón Social</th>
                            <th>RETC</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empresa as $emp)


                            <tr>
                                <td>  {{$emp->id}} </td>
                            <td>{{$emp->estado->nombre}}</td>
                            <td>{{$emp->empresa_marca[0]->marcas->nombre}}</td>

                                <td>  {{$emp->nombre}} </td>
                                <td>  {{$emp->rut}} </td>
                                <td>  {{$emp->razon_social}} </td>
                                <td>  {{$emp->retc}} </td>
                                </td>
                                {{--     <td>  {{$emp->razon_social}} </td>  <td>   @if($emp->bk_estados_id != null)
                                    {{ $emp->estado->nombre }}
                                @endif --}}
                                <td>
                                    <a class="btn btn-warning mb-2" data-toggle="modal" data-target="#edit{{ $emp->id }}">Editar</a>
                                    {{-- <a class="btn btn-warning mb-2" data-toggle="modal" data-target="#direccion{{ $emp->id }}">direccion</a> --}}
                                    <a href="{{ asset('backend/private/empresas') }}/{{ $emp->id }}/direcciones" class="btn btn-info">Direcciones</a>
                                    <a href="{{ asset('backend/private/empresas') }}/{{ $emp->id }}/users" class="btn btn-info">Usuarios</a>

                                    {{-- @include('backend::private.empresa.destroy') --}}


                                    @if($emp->bk_estados_id == 23)
                                        <a href="{{ asset('backend/private/cambiar-estado') }}/{{ $emp->id }}" class="btn btn-info">Activar Empresa</a>
                                    @endif
                                    @if($emp->bk_estados_id == 22)
                                        <a href="{{ asset('backend/private/cambiar-estado-desactivar') }}/{{ $emp->id }}" class="btn btn-info">Desactivar Empresa</a>
                                    @endif


                                </td>


                                @include('backend::private.empresa.edit')
                                @include('backend::private.empresa.direcciones')

                            </tr>
                         @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
@endsection
