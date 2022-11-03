@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Categoria</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Editor</a>
                    </li>

                </ul>
            </div>
        </div>

    </div>
</div>

    <style type="text/css">
        .datatable-pager.datatable-paging-loaded{
            display: none !important;
        }
    </style>
    <style type="text/css">
      .label.label-info {
        color: #ffffff;
        background-color: #8950FC;
        width: auto;
        border-radius: 4px;
        padding: 6px;
      }
    </style>
    <div class="container">
        <div class="card card-custom">
            <div class="card-body">
                <div class="btn-group my-5">
                    @include('contenido::private.editor.modal.categoria.create')
                </div>
                <div class="mb-7">
                    <div class="row align-items-center mb-5">
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
                <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoria_noticia as $item)
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>

                                <td>
                                    {{ $item->nombre }}
                                </td>
                                <td>
                                    <div class="dropdown dropdown-inline mr-2">
                                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones</button>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="nav flex-column nav-hover">
                                                <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp; Escoge una opción:</li>


                                                <li class="nav-item">
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#edit{{$item->id}}">Editar</a>
                                                    @include('contenido::private.editor.modal.categoria.destroy')
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @include('contenido::private.editor.modal.categoria.edit')
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
