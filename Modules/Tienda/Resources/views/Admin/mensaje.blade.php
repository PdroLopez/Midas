@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Mensajes</h5>

                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	                <li class="breadcrumb-item">
	                    <a href="" class="text-muted">Administrador </a>
	                </li>
	            </ul>
	            <br><br>&nbsp;
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
	                <li class="breadcrumb-item">
	                    <a href="" class="text-muted"> Tienda</a>
	                </li>
	            </ul>

            </div>

        </div>

    </div>
</div>
<div class="container">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Mensajes</h3>
                {{-- <div class="ml-10">@include('tienda::Admin.mensajes.create')</div> --}}
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
            <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Asunto</th>
                        <th>Mensaje</th>
                        <th>Estado del Mensaje</th>

                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mensaje as $mensajes)
                    <tr>
                        <td>{{ $mensajes->id }}</td>
                        <td>{{ $mensajes->nombre }}</td>
                        <td>{{ $mensajes->correo }}</td>
                        <td>{{ $mensajes->asunto }}</td>
                        <td>{{ $mensajes->mensaje }}</td>
                        <td>
                            @if ($mensajes->estado != null)
                              {{ $mensajes->estado->nombre }}
                            @else
                                Sin estado
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-outline-primary" href="{{ asset('tienda/admin/mensajes/no-leido/'.$mensajes->id)}}">No Leido </a>
                            <a class="btn btn-outline-info" href="{{ asset('tienda/admin/mensajes/respondido/'.$mensajes->id)}}">Respondido</a>                            {{-- <a class="btn btn-warning" data-toggle="modal" data-target="#edit{{$mensajes->id}}">Editar</a> --}}
                            <a class="btn btn-outline-danger" href="{{ asset('tienda/admin/mensajes/leido/'.$mensajes->id)}}">Leido</a>                            {{-- <a class="btn btn-warning" data-toggle="modal" data-target="#edit{{$mensajes->id}}">Editar</a> --}}
                            {{-- @include('tienda::Admin.mensajes.destroy') --}}
                        </td>
                        {{-- @include('tienda::Admin.mensajes.edit') --}}
                    </tr>
                    @endforeach
                    {{-- @foreach($marcas as $marca)

                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
