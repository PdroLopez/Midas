@extends('dgr::layouts.master')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Nav</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ asset('dgr') }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Inicio</span></li>
                <li><span>Private</span></li>
                <li><span>Nav</span></li>
                <li><span>Nav</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col">
            @include('dgr::private.private_nav.create') 
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
                    <h2 class="card-title">Lista de nav</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Estado</th>
                                <th>Icono</th>
                                <th>Nombre</th>
                                <th>Peso</th>
                                <th>Url</th>
                                <th>Padre</th>
                                <th>Hijos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($private_nav as $nav)
                            <tr>
                                <td>{{$nav->id}}</td>
                                <td>
                                    @if ($nav->estado == 1)
                                        <div class="btn btn-xs btn btn-success">
                                            Activo
                                        </div>
                                    @else
                                        <div class="btn btn-xs btn btn-danger">
                                            Desactivado
                                        </div>
                                    @endif
                                </td>
                                <td>{{$nav->icono}}</td>
                                <td>{{$nav->nombre}}</td>
                                <td>{{$nav->peso}}</td>
                                <td>{{$nav->url}}</td>
                                <td>
                                    @if ($nav->sub_nav == 1)
                                        {{$nav->padre->nombre}}
                                    @else
                                        No aplica
                                    @endif
                                </td>
                                <td>
                                    @if ($nav->sub_nav == 0)
                                        @foreach ($nav->hijos as $hijos)
                                            <p>
                                                {{$hijos->nombre}}
                                            </p>
                                        @endforeach
                                    @else
                                        No aplica
                                    @endif
                                </td>
                                <td>
                                    <div class="f-l">
                                    @include('dgr::private.private_nav.edit') 

                                    </div>
                                    <div class="f-l">
                                    @include('dgr::private.private_nav.destroy') 
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


