@extends('dgr::layouts.master')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Pagina</h2>
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
                <li><span>Pagina Portal</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col">
            <a href="{{route('pagina.create')}}" class="btn btn-default">Portal Pagina</a>
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
                    <h2 class="card-title">Portal Pagina</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Titulo</th>
                                <th>Sub-Titulo</th>
                                <th>JS</th>
                                <th>Css</th>
                                <th>Mostrar titulo</th>
                                <th>Mostrar Menu</th>
                                <th>Mostrar Footer</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($portal_pagina as $portal_pag)
                            <tr>
                                <td>{{$portal_pag->id}}</td>
                                <td>{{$portal_pag->titulo}}</td>
                                <td>{{$portal_pag->sub_titulo}}</td>
                                <td>{{$portal_pag->js}}</td>
                                <td>{{$portal_pag->css}}</td>
                                <td>{{$portal_pag->titulos}}</td>
                                <td>{{$portal_pag->menu}}</td>
                                <td>{{$portal_pag->footer}}</td>
                                <td>
                                    <div class="f-l">
                                        <a class="mb-1 mt-1 mr-1 btn btn-xs btn btn-success" href="{{route('pagina.edit',$portal_pag->id)}}"><i class="fas fa-edit"></i></a>
                                    </div>
                                    <div class="f-l">
                                        @include('dgr::portal.portal_pagina.destroy') 
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