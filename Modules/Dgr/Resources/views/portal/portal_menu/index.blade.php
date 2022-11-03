@extends('dgr::layouts.master')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Menú</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ asset('dgr') }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Inicio</span></li>
                <li><span>Portal</span></li>
                <li><span>Menú</span></li>
                <li><span>Menú</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col">
            @include('dgr::portal.portal_menu.create') 
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
                    <h2 class="card-title">Lista Portal</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Url</th>
                                <th>Peso</th>
                                <th>Sub Menú</th>
                                <th>Pagina</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($portal_menu as $menu)
                            <tr>
                                <td>{{$menu->id}}</td>
                                <td>{{$menu->nombre}}</td>
                                <td>{{$menu->url}}</td>
                                <td>{{$menu->peso}}</td>
                                <td>{{$menu->sub_menu}}</td>
                                <td>{{$menu->portal_pagina->titulo}}</td>
                                <td>{{$menu->estado}}</td>
                                <td>

                                    <div class="f-l">
                                        @include('dgr::portal.portal_menu.edit') 
                                    </div>
                                    <div class="f-l">
                                        @include('dgr::portal.portal_menu.destroy') 
                                    
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


