@extends('layouts.master')

@section('content')
    <div class="position-relative overflow-hidden bg-light">
        <div class="col-md-8 p-lg-5 mx-auto my-5">
            <div class="row">
                <div class="col-md-6 col-10">
                    <h1 class="display-4 font-weight-normal">Bienvenid@ {{Auth::user()->name}} {{Auth::user()->apellido}}, {{Auth::user()->rol->name}}</h1>
                </div>
                <div class="d-md-none d-flex col-2">
                    <a href="{{ url()->previous() }}">
                        <span class="svg-icon svg-icon-lg svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <circle fill="#8fca00" opacity="0.3" cx="12" cy="12" r="10" style="fill: #8fca00;opacity: 1;"/>
                                    <path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" fill="#8fca00" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) " style="fill:white;"/>
                                </g>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="col-md-4 col-10 pt-5">
                    <span></span>
                </div>
                <div class="d-md-flex d-none col-2 pt-2">
                    <a href="{{ url()->previous() }}">
                        <span class="svg-icon svg-icon-lg svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <circle fill="#8fca00" opacity="0.3" cx="12" cy="12" r="10" style="fill: #8fca00;opacity: 1;"/>
                                    <path d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z" fill="#8fca00" fill-rule="nonzero" transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) " style="fill:white;"/>
                                </g>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="product-device box-shadow d-none d-md-block"></div>
        <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>

    <div class="container mt-md-20 mt-10 mb-0">
        <div class="card card-custom gutter-b">
            <div class="card-body pt-8 p-md-10 p-5">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="solicitudes-tab" data-toggle="tab" href="#solicitudes" role="tab" aria-controls="solicitudes" aria-selected="true">Solicitudes</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="calendario-tab" data-toggle="tab" href="#calendario" role="tab" aria-controls="calendario" aria-selected="false">Historial</a>
                    </li>
{{--                     <li class="nav-item" role="presentation">
                        <a class="nav-link" id="cancelado-tab" data-toggle="tab" href="#cancelado" role="tab" aria-controls="cancelado" aria-selected="false">Cancelados</a>
                    </li> --}}
                </ul>
                <div class="tab-content mt-10" id="myTabContent">
                    <div class="tab-pane fade show active" id="solicitudes" role="tabpanel" aria-labelledby="solicitudes-tab">
                        <div class="tab-content mt-5 px-md-10 px-0" id="myTabLIist18">
                            @foreach($retiros as $retiro)
                                    <div class="d-flex align-items-center pb-9">
                                        <div class="d-flex flex-column flex-grow-1">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a class="text-dark-75 font-weight-bolder text-hover-primary font-size-md text-hover-primary mb-1">
                                                        @if($retiro->empresas_id == null)
                                                            @if($retiro->users_id != null)
                                                                {{ $retiro->user->name }} {{ $retiro->user->apellido }}
                                                            @else
                                                                {{ $retiro->nombre }}
                                                            @endif
                                                        @else
                                                            {{ $retiro->empresas->nombre }}
                                                        @endif

                                                    <strong> ( #{{ $retiro->id }} / Código N°{{ $retiro->codigo }} )</strong>
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <span class="badge badge-primary">{{ $retiro->estado->nombre }}</span>

                                                </div>
                                            </div>
                                            <span class="text-dark-50 font-weight-normal font-size-sm">
                                                @if ($retiro->fecha_hora != null)
                                                  {{$retiro->fecha_hora}}
                                                @else
                                                   Sin Programar
                                                @endif
                                                @if ($retiro->camiones_id != null)
                                                    Vehículo: {{$retiro->camiones->patente}}.<br> 
                                                @else
                                                   Sin Vehiculo.<br>
                                                @endif
                                            </span>
                                            <span class="text-dark-50 font-weight-normal font-size-sm">
                                                @if($retiro->empresas_id == null)
                                                    @if($retiro->users_id != null)
                                                        @if($retiro->direccion != null)
                                                            {{ $retiro->direccion->nombre }}
                                                        @else
                                                            {{ $retiro->direccion_rc}}
                                                        @endif
                                                    @else
                                                        {{ $retiro->direccion_rc}}
                                                    @endif
                                                @else
                                                    @if($retiro->bk_direcciones_empresas_id != null)
                                                        {{$retiro->direccion_empresa->nombre }}
                                                    @endif
                                                @endif
                                            </span>
                                            <span class="text-dark-50 font-weight-normal font-size-sm">
                                                @if($retiro->empresas_id == null)
                                                    @if($retiro->users_id != null)
                                                        @if($retiro->direccion != null)
                                                            @if($retiro->direccion->bk_comunas_id != null)
                                                               {{ $retiro->direccion->comuna->nombre }}
                                                            @endif 
                                                            @if($retiro->direccion->bk_regiones_id != null)
                                                                {{ $retiro->direccion->region->nombre }}
                                                            @endif
                                                        @else
                                                           @if($retiro->comuna_id != null)
                                                               {{ $retiro->comuna->nombre }}, Metropolitana de Santiago.
                                                            @endif 
                                                        @endif
                                                    @else
                                                        @if($retiro->comuna_id != null)
                                                           {{ $retiro->comuna->nombre }}, Metropolitana de Santiago.
                                                        @endif 
                                                    @endif
                                                @else
                                                    @if($retiro->bk_direcciones_empresas_id != null)
                                                        @if ($retiro->direccion_empresa->bk_comunas_id)
                                                            {{ $retiro->direccion_empresa->comuna->nombre }}
                                                        @endif
                                                         @if($retiro->direccion_empresa->bk_regiones_id != null)
                                                            {{ $retiro->direccion_empresa->region->nombre }}
                                                        @endif 
                                                    @endif
                                                @endif
                                            </span>
                                            <div class="row mt-3">
                                                <div class="col-6">
                                                    <a href="{{ asset('/private/chofer/detalle-retiro') }}/{{ $retiro->id }}" class="btn btn-lg btn-light btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Ver retiro</a>
                                                </div>
                                                <div class="col-md-3 col-6">
                                                    <div class="form-group">
                                                        <div class="dropdown">
                                                        <button class="btn btn-lg btn-light btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Acciones
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                            @if ($retiro->estado->id == 27 )
                                                                <a class="dropdown-item" href="{{ asset('workflow/en-camion/'.$retiro->id) }}" onclick="return confirm('¿Esta seguro de querer cambiar el estado a En camino?');">En camino</a>
                                                                @endif

                                                        {{-- @if ($retiro->estado->id == 21 )

                                                        <a class="dropdown-item" href="{{ asset('workflow/retiro/'.$retiro->id) }}" onclick="return confirm('Esta seguro de querer cambiar el estado a: En camino?');">Retirado</a>

                                                        <a class="dropdown-item"href="{{ asset('workflow/cancelar-retiro/'.$retiro->id) }}" onclick="return confirm('Esta seguro de querer cambiar el estado a: En camino?');">Cancelar retiro</a>
                                                        @endif --}}
                                                        @if ($retiro->estado->id == 9 )

                                                        <a class="dropdown-item" data-toggle="modal" data-target="#retiro{{ $retiro->id }}">Retirado</a>

                                                        <a class="dropdown-item" data-toggle="modal" data-target="#cancelar{{ $retiro->id }}">Cancelar retiro</a>
                                                        @endif
                                                        @if ($retiro->estado->id == 21 )

                                                        <a class="dropdown-item" href="{{ asset('workflow/en-planta/'.$retiro->id) }}" onclick="return confirm('¿Esta seguro de querer cambiar el estado a En Planta?');">En Planta</a>

                                                        @endif

                                                        @if ($retiro->estado->id == 21 || $retiro->estado->id == 27 || $retiro->estado->id == 9)
                                                            <li class="nav-item">
                                                                <a href="{{ asset('/generar/qr/bol/'.$retiro->id) }}" class="dropdown-item" target="_blank">QR Retiro
                                                                </a>
                                                            </li>
                                                            @endif







                                                            {{-- @if($retiro->bk_estados_id != 17)
                                                                @if($retiro->bk_estados_id != 20)
                                                                    <a class="dropdown-item" href="{{ asset('/private/chofer/recibido') }}/{{ $retiro->id }}">Recibido</a>
                                                                @endif
                                                                @if($retiro->bk_estados_id != 21)
                                                                    <a style="cursor: pointer;" class="dropdown-item" data-toggle="modal" data-target="#retiro{{ $retiro->id }}" >Retirado</a>
                                                                @endif
                                                                <a style="cursor: pointer;" class="dropdown-item" data-toggle="modal" data-target="#exampleModal{{ $retiro->id }}">Cancelado</a>
                                                            @else
                                                                <a style="cursor: none;">El pedido esta cancelado</a>
                                                            @endif --}}
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('private.chofer.cancelar')
                                    @include('private.chofer.retirado')
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="calendario" role="tabpanel" aria-labelledby="calendario-tab">

                       <table class="table table-light">
                           <thead class="thead-light">
                               <tr>
                                   <th>ID</th>
                                   <th>Fecha de Retiro</th>
                                   <th>Nombre de Clientes</th>
                                   <th>Productos en Retiro</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach ($plantas as $planta)
                                    <tr>
                                        <td>{{$planta->id}}</td>
                                        <td>
                                            @if ($planta->fecha_hora != null)
                                              {{$planta->fecha_hora}}
                                            @else
                                               Sin fecha
                                            @endif
                                        </td>
                                        <td>
                                          @if($planta->empresas_id == null)
                                                @if($planta->users_id != null)
                                                    {{ $planta->user->name }} {{ $planta->user->apellido }}
                                                @else
                                                    {{ $planta->nombre }}
                                                @endif
                                            @else
                                                {{ $planta->empresas->nombre }}
                                            @endif
                                         </td>
                                         <td>
                                            <div class="col-6">
                                                <a href="{{ asset('/private/chofer/detalle-retiro') }}/{{ $planta->id }}" class="btn btn-lg btn-light btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Ver retiro</a>
                                            </div>
                                             {{-- @foreach($planta->solicitudes as $producto)
                                                 @if ($producto->solicitud->Residuos_id != null)
                                                    {{ $producto->solicitud->residuos->nombre}}<br>
                                                 @endif
                                                    Peso: {{$producto->solicitud->peso}}<br>
                                                    Cantidad: {{$producto->solicitud->cantidad}}<br>
                                                    Altura: {{$producto->solicitud->altura}}<br>
                                                    Largo: {{$producto->solicitud->largo}}<br>
                                                    Profundidad: {{$producto->solicitud->profundidad}}
                                             @endforeach --}}
                                         </td>
                                    </tr>
                               @endforeach

                           </tbody>
                       </table>
                    </div>
                    {{-- <div class="tab-pane fade" id="cancelado" role="tabpanel" aria-labelledby="cancelado-tab">

                       <table class="table table-light">
                           <thead class="thead-light">
                               <tr>
                                   <th>ID</th>
                                   <th>Fecha de Retiro</th>
                                   <th>Nombre de Clientes</th>
                                   <th>Productos en Retiro</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach ($plantas as $planta)
                                    <tr>
                                        <td>{{$planta->id}}</td>
                                        <td>
                                            @if ($planta->fecha_hora != null)
                                              {{$planta->fecha_hora}}
                                            @else
                                               Sin fecha
                                            @endif
                                        </td>
                                        <td>
                                          @if($planta->empresas_id == null)
                                                @if($planta->users_id != null)
                                                    {{ $planta->user->name }} {{ $planta->user->apellido }}
                                                @else
                                                    {{ $planta->nombre }}
                                                @endif
                                            @else
                                                {{ $planta->empresas->nombre }}
                                            @endif
                                         </td>
                                         <td>
                                            <div class="col-6">
                                                <a href="{{ asset('/private/chofer/detalle-retiro') }}/{{ $planta->id }}" class="btn btn-lg btn-light btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Ver retiro</a>
                                            </div>
                                         </td>
                                    </tr>
                               @endforeach

                           </tbody>
                       </table>
                    </div> --}}
                </div>
                {{-- {{ $retiros->links() }} --}}
            </div>
        </div>
    </div>
@endsection

