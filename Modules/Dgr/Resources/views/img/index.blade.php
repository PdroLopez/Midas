@extends('dgr::layouts.master')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Imagenes</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ asset('dgr') }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Inicio</span></li>
                <li><span>Imagenes</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col">
            @include('dgr::img.create') 
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
                    <h2 class="card-title">Lista Imagenes</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>src</th>
                                <th>Class</th>
                                <th>Style</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($img as $imagen)
                            <tr>
                                <td>{{$imagen->id}}</td>
                                <td>{{$imagen->nombre}}</td>
                                <td><img src="{{asset('storage/'.$imagen->src)}}" style="max-height: 100px">
                                </td>
                                <td>
                                    {{asset('storage/'.$imagen->src)}}
                                </td>
                                <td>{{$imagen->style}}</td>
                                <td>{{$imagen->class}}</td>
                                <td>
                                    <div class="f-l">
                                        @include('dgr::img.edit') 
                                    </div>
                                    <div class="f-l">
                                        @include('dgr::img.destroy') 
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


