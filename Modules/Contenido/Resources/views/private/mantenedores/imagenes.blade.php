@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Imagenes</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Mantenedores</a>
                    </li>
                    
                </ul>
            </div>
        </div>

    </div>
</div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Página
            </div>
            <div class="card-body table-responsive">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Nuevo
                </button>
                <br>
                <br>
                <table class="table table-bordered table-checkable" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre o URL</th>
                            <th>Archivo</th>
                            <th>Ruta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <th>prueba</th>
                            <th>
                                <input type="checkbox" name="archivo">
                            </th>
                            <th>    http://localhost/portal_flixmedia/public/storage/img-portal/(3277)1920x1080_game_hero_smash.jpg</th>
                            <th>
                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones</button>
                                    <!--begin::Dropdown Menu-->
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="nav flex-column nav-hover">
                                            <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp; Escoge una opción:</li>
                                            <li class="nav-item">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit1">Editar</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon la la-copy"></i>
                                                    <span class="nav-text">Eliminar</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--end::Dropdown Menu-->
                                </div>
                            </th>
            @include('contenido::private.mantenedores.modal.imagenes.edit')
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('contenido::private.mantenedores.modal.imagenes.create')

@endsection