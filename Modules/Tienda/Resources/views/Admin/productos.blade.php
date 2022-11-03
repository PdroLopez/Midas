@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1 mt-5">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Productos</h5>

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
                    <h3 class="card-label">Productos</h3>
                    <div class="ml-10">@include('tienda::Admin.productos.create')</div>
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
                            <th>Descripción</th>
                            <th>Características</th>
                            <th>Valor</th>
                            <th>Stock</th>
                            <th>Marca</th>
                            <th>Categoria</th>
                            <th>Descuentos</th>
                            <th>Imagen 1</th>
                            <th>Imagen 2</th>
                            <th>Imagen 3</th>
                            <th>Imagen 4</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{!! $producto->caracteristicas !!}</td>
                            <td>{{ $producto->precio }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>
                                @if($producto->marca)
                                {{ $producto->marca->nombre}}
                                @endif
                            </td>
                            <td>
                                @if($producto->categoria)
                                {{ $producto->categoria->nombre }}
                                @endif
                            </td>

                            <td>


                                @if($producto->descuentos)
                                {{ $producto->descuentos['nombre'] }}</td>

                                @else
                                    Sin Descuento
                                @endif
                            <td>
                                {{-- <img class="img-fluid" src="{{ asset('storage/public/productos/'.$producto->id.'/imagen')}}" width="100"> --}}
                            </td>
                            <td>
                                {{-- <img class="img-fluid" src="{{ asset('storage/public/productos/'.$producto->id.'/imagen2') }}" width="100"> --}}
                            </td>
                            <td>
                                {{-- <img class="img-fluid" src="{{ asset('storage/public/productos/'.$producto->id.'/imagen3') }}" width="100"> --}}
                            </td>
                            <td>
                                {{-- <img class="img-fluid" src="{{ asset('storage/public/productos/'.$producto->id.'/imagen4') }}" width="100"> --}}
                            </td>
                            <td>
                                @if($producto->bk_estados_id != null)
                                    {{ $producto->estado->nombre }}
                                @else
                                    Sin Estado
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-warning" data-toggle="modal" data-target="#edit{{$producto->id}}">Editar</a>
                                {{-- @include('tienda::Admin.productos.destroy') --}}
                                @if($producto->bk_estados_id == 13)
                                    <a href="{{ asset('tienda/admin/publicar') }}/{{ $producto->id }}" class="btn btn-info">Publicar</a>
                                @endif
                                @if($producto->bk_estados_id == 12)
                                    <a href="{{ asset('tienda/admin/desactivar') }}/{{ $producto->id }}" class="btn btn-success">Desactivar</a>
                                @endif
                                <a href="{{ asset('tienda/admin/productos/') }}/{{ $producto->id }}/descuentos" class="btn btn-info">Descuentos</a>
                                <a class="btn btn-primary" data-toggle="modal" data-target="#corta_url{{$producto->id}}">Generar URL</a>
                            </td>
                            @include('tienda::Admin.productos.edit')
                            @include('tienda::Admin.productos.url')
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

