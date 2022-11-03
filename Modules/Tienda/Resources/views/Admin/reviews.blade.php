@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Reviews</h5>

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
                <h3 class="card-label">Reviews</h3>
                <div class="ml-10">
                    {{-- @include('tienda::Admin.intro.create') --}}
                </div>
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
                        <th>Nombre del Producto</th>
                        <th>Comentarios</th>
                        <th>Clasificación</th>
                        <th>Nombre del Cliente</th>
                        <th> Fecha</th>
                        <th> Acciones</th>
                        {{--


                      --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($producto as $productos)
                    <tr>
                        <td> {{$productos->id}}</td>
                        <td> {{$productos->producto->nombre}}</td>
                        <td>
                            {{$productos->comentario}}
                        </td>
                        <td>
                            @if ($productos->voto == 1)
                                <label for="radio1">★</label>
                            @elseif($productos->voto == 2)
                                <label for="radio1">★</label>
                                <label for="radio1">★</label>

                            @elseif($productos->voto == 3)
                                <label for="radio1">★</label>
                                <label for="radio1">★</label>
                                <label for="radio1">★</label>

                            @elseif($productos->voto == 4)
                                <label for="radio1">★</label>
                                <label for="radio1">★</label>
                                <label for="radio1">★</label>
                                <label for="radio1">★</label>

                            @elseif($productos->voto == 5)
                                <label for="radio1">★</label>
                                <label for="radio1">★</label>
                                <label for="radio1">★</label>
                                <label for="radio1">★</label>
                                <label for="radio1">★</label>
                            @endif

                         {{-- --><label for="radio2">★</label><!--
                         --><label for="radio3">★</label><!--
                         --><label for="radio4">★</label><!--
                         --><label for="radio5">★</label> --}}
                        </td>
                        <td>
                            {{$productos->user->name}}
                        </td>
                        <td> {{$productos->created_at}}</td>
                        <td>
                            <a class="btn btn-light-primary" href="{{asset('tienda/admin/ocultar-comentarios')}}/{{$productos->id}}">Ocultar Comentario</a>
                        </td>

                        {{--


                        --}}

                    </tr>

                    @endforeach
                    {{-- @foreach($intro as $intros)
                    <tr>
                        <td>{{ $intros->id }}</td>
                        <td>{{ $intros->nombre }}</td>
                        <td>
                            <a class="btn btn-warning" data-toggle="modal" data-target="#edit{{$intros->id}}">Editar</a>
                            @include('tienda::Admin.intro.destroy')
                        </td>
                        @include('tienda::Admin.intro.edit')
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
