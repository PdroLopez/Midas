@extends('dgr::layouts.master')
@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Inicio</h2>
        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ asset('dgr') }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li><span>Inicio</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
        </div>
    </header>

    {{-- <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped mb-0" >
                <thead>
                    <tr>
                        <th style="width: 20%">Usuario</th>
                        <th style="width: 20%">Fecha</th>
                        <th style="width: 20%">Route</th>
                        <th style="width: 40%">Mensaje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($errors as $error)
                        <tr>
                            <td>
                                @foreach (json_decode($error->auth,true) as $key => $element)
                                <p>
                                    <strong>{{$key}}:</strong> {{$element}}
                                </p>
                                @endforeach
                            </td>
                            <td>
                                {{$error->created_at}}
                            </td>
                            <td>
                                {{$error->route}}
                            </td>
                            <td>
                                {{$error->error}}
                            </td>
                        </tr>
                    @endforeach   
                </tbody>
            </table>
           
                          
       </div>
    </div> --}}
</section>
@stop


