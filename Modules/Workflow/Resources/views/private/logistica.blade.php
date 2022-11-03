@extends('layouts.backend.master')
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-baseline mr-5">
            <h5 class="text-dark font-weight-bold my-2 mr-5">Logistica</h5>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <a href="" class="text-muted">Workflow</a>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="container">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label"> Logistica</h3>
                <div class="ml-10"> {{-- @include('backend::private.camiones.create') --}} </div>
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
            <div class="card-body">
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            {{-- <th>Nombre Cliente</th> --}}
                            <th>Solicitado Por</th>
                            <th>Estado</th>
                            <th>Fecha Solicitud</th>
                            <th>Fecha Retiro</th>
                            <th>Retiro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boletas as $boleta)
                        <?php
                            $numero = (string)$boleta->total;
                            $puntos = floor((strlen($numero)-1)/3);
                            $tmp = "";
                            $pos = 1;
                            for($i=strlen($numero)-1; $i>=0; $i--){
                                $tmp = $tmp.substr($numero, $i, 1);
                                if($pos%3==0 && $pos!=strlen($numero))
                                $tmp = $tmp.".";
                                $pos = $pos + 1;
                            }
                            $otraOnda = "$ ".strrev($tmp);
                        ?>
                            <tr>
                                <th>{{ $boleta->id }}</th>
                                {{-- <th>
                                    @if($boleta->user)
                                        {{ $boleta->user->name }}
                                    @else
                                        @if($boleta->empresas_id != null)
                                         Sin nombre

                                        @else
                                            {{ $boleta->empresas->emp_usuario->first()->empresa->nombre }}

                                        @endif
                                    @endif
                                </th> --}}
                                <th>
                                    @if($boleta->empresas_id != null)
                                        {{ $boleta->empresas->nombre }}
                                    @else
                                        @if($boleta->user)
                                            {{ $boleta->user->name }}
                                        @else
                                            Sin nombre
                                        @endif
                                    @endif
                                </th>
                                <th>
                                    @if($boleta->estado)
                                        {{ $boleta->estado->nombre }}
                                    @else
                                        Sin estado
                                    @endif
                                </th>

                                <th>{{ $boleta->created_at }}</th>
                                <th>{{ $boleta->fecha_hora }}</th>
                                <th>
                                    @if($boleta->retiro_propio != null)
                                        @if($boleta->horarios_id && $boleta->horarios_dias_id)
                                        {{ $boleta->dia->nombre }}
                                         en {{ $boleta->horario->hora }}HRS ({{ $boleta->horario->nombre }})
                                         @endif
                                     @else
                                        @if($boleta->retiro_propio==1)
                                            Retiro de la empresa solicitante
                                        @else
                                            Midas realizara el retiro
                                        @endif
                                     @endif
                                </th>
                                <th>
                                    <div class="dropdown dropdown-inline mr-2">
                                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones</button>
                                        <!--begin::Dropdown Menu-->
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="nav flex-column nav-hover">
                                                <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp;&nbsp;Escoge una opción:</li>
                                                <li class="nav-item">
                                                    <a class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target="#edit{{$boleta->id}}">Ver Detalles</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!--end::Dropdown Menu-->
                                    </div>
                                </th>
                               @include('workflow::private.create')

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
@endsection
