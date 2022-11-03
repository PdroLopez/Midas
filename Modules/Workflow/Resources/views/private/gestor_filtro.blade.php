@extends('layouts.backend.master')
@section('content')
<div class="container">
    <div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
        <div class="card card-custom card-stretch">
            <div class="card-body table-responsive">
                <!--begin::Items-->
                <table class="table table-bordered table-checkable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categoría</th>
                            {{-- <th>Nombre Cliente</th> --}}
                            <th>Solicitado Por</th>
                            <th>Estado</th>
                            <th>Fecha Solicitud</th>
                            <th>Retiro</th>
                            <th>Creado por</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boleta_filtrado as $boleta)
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
                                <th>
                                    @if($boleta->empresas_id != null)
                                    <span class="badge badge-secondary">Industrial</span>

                                    @else
                                    <span class="badge badge-primary">Particular</span>

                                    @endif

                                </th>
                                {{-- <th>
                                    @if($boleta->user)
                                        {{ $boleta->user->name }}
                                    @else
                                        @if($boleta->empresas_id == null)
                                            {{ $boleta->empresas->emp_usuario->first()->empresa->nombre }}
                                        @else
                                            Sin nombre
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
                                <th>
                                    @if($boleta->retiro_propio == null)
                                        @if($boleta->horarios_id && $boleta->horarios_dias_id)
                                        {{ $boleta->dia->nombre }}
                                         en {{ $boleta->horario->hora }}HRS ({{ $boleta->horario->nombre }})
                                         @endif
                                     @else
                                        @if($boleta->retiro_propio == 1)
                                            Retiro de la empresa solicitante
                                        @else
                                            Midas realizara el retiro
                                        @endif
                                     @endif
                                </th>
                                <th>
                                    @if($boleta->creador_id != null)
                                        {{$boleta->creador->name}}
                                    @else
                                        Sin Creador
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
                                                @if ($boleta->estado->id == 24)
                                                <li style="background-color: #ccc" class="nav-item">
                                                    <a href="{{ asset('workflow/aprobacion/'.$boleta->id) }}" class="nav-link">
                                                        <i class="nav-icon la la-file-excel-o"></i>
                                                        <span class="nav-text">{{$boleta->estado->id}} / Enviar a aprobación</span>
                                                    </a>
                                                </li>
                                                @elseif ($boleta->estado->id == 25 || $boleta->estado->id == 1)

                                                <li class="nav-item">
                                                    <a href="{{ asset('workflow/programacion/'.$boleta->id) }}" class="nav-link">
                                                        <i class="nav-icon la la-file-excel-o"></i>
                                                        <span class="nav-text"> Procesar</span>
                                                    </a>
                                                </li>



                                                @endif


                                               <li class="nav-item">
                                                    <a href="{{ asset('workflow/por-despacho/'.$boleta->id) }}" class="nav-link">
                                                        <i class="nav-icon la la-file-excel-o"></i>
                                                        <span class="nav-text">Por despacho</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ asset('workflow/cancelar/'.$boleta->id) }}" class="nav-link">
                                                        <i class="nav-icon la la-copy"></i>
                                                        <span class="nav-text">Cancelar</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ asset('workflow/finalizar/'.$boleta->id) }}" class="nav-link">
                                                        <i class="nav-icon la la-file-excel-o"></i>
                                                        <span class="nav-text">Finalizar</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{asset('workflow/solicitud/view/seguimiento/'.$boleta->id)}}" class="nav-link">
                                                        <i class="nav-icon la la-file-excel-o"></i>
                                                        <span class="nav-text">Seguimiento</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!--end::Dropdown Menu-->
                                    </div>
                                </th>
                                @include('workflow::private.modal.logistica.edit')
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end::Items-->
            </div>
        </div>
    </div>
</div>


@endsection
