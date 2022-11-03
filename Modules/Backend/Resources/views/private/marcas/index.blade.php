@extends('layouts.backend.master')
@section('content')
{{-- <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Marcas</h5>

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
                    <h3 class="card-label">Marcas</h3>
                    <div class="ml-10">@include('backend::private.marcas.create')</div>
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($marcas as $marca)
                        <tr>
                            <td>{{ $marca->id }}</td>
                            <td>{{ $marca->nombre }}</td>
                            <td>
                                <a class="btn btn-warning" data-toggle="modal" data-target="#edit{{$marca->id}}">Editar</a>
                                @include('backend::private.marcas.destroy')
                            </td>
                            @include('backend::private.marcas.edit')
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Marcas</h5>

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
                <h3 class="card-label"> Marcas</h3>
                <div class="ml-10">@include('backend::private.marcas.create')</div>
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
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marcas as $marca)
                        <tr>
                            <td>{{ $marca->id }}</td>
                            <td>{{ $marca->nombre }}</td>
                            <td>
                                @if ($marca->bk_estados_id != null)
                                    {{ $marca->estado->nombre }}


                                @else
                                    Sin estado
                                   {{-- {{$marca->estado->nombre}} --}}
                                @endif
                            </td>

                            <td>
                                <a class="btn btn-warning" data-toggle="modal" data-target="#edit{{$marca->id}}">Editar</a>
                                <a class="btn btn-danger" href="{{ asset('backend/private/marcas/activar') }}/{{ $marca->id }}">Activar</a>

                                <a class="btn btn-primary" href="{{ asset('backend/private/marcas/desactivar') }}/{{ $marca->id }}">Desactivar</a>

                                {{-- @include('backend::private.marcas.destroy') --}}
                            </td>
                            @include('backend::private.marcas.edit')
                        </tr>
                        @endforeach



                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>



@endsection
