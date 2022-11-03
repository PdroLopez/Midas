@extends('dgr::layouts.master')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Modulos</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ asset('dgr') }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Inicio</span></li>
                <li><span>Private</span></li>
                <li><span>Modulos</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col">
            @include('dgr::private.modulos.create') 
        </div>
    </div>
    <div class="row">
        <div class="col">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                    </div>
                    <h2 class="card-title">Lista de modulos</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Alias</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modulos as $modul)
                            <tr>
                                <td>{{$modul->id}}</td>
                                <td>
                                    @if ($modul->estado == 1)
                                        <div class="btn btn-success">
                                            Activo
                                        </div>
                                    @else
                                        <div class="btn btn-danger">
                                            Desactivado
                                        </div>
                                    @endif
                                </td>
                                <td>{{$modul->nombre}}</td>
                                <td>{{$modul->descripcion}}</td>
                                <td>
                                    <div class="f-l">
                                        @include('dgr::private.modulos.edit') 
                                    </div>
                                    <div class="f-l">
                                        @include('dgr::private.modulos.destroy') 
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>
@stop


