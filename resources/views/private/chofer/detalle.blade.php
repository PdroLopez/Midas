@extends('layouts.master')

@section('content')
    <div class="position-relative overflow-hidden bg-light">
        <div class="col-md-8 p-lg-5 mx-auto my-5">
            <div class="row">
                <div class="col-md-6 col-10">
                    <h1 class="display-4 font-weight-normal">Detalle Retiro</h1>
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
                <div class="row">
                    <div class="col-md-5">
                        <span class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg text-hover-primary mb-1">
                            @if($boleta->empresas_id == null)
                                @if($boleta->users_id != null)
                                    {{ $boleta->user->name }} {{ $boleta->user->apellido }}
                                @else
                                    {{ $boleta->nombre }}
                                @endif
                            @else
                                {{ $boleta->empresas->nombre }}
                            @endif
                        </span>
                        <br>
                        <span class="text-dark-50 font-weight-normal font-size-md">
                            Dirección: <strong> 
                            @if($boleta->empresas_id == null)
                                @if($boleta->users_id != null)
                                    @if($boleta->direccion != null)
                                        {{ $boleta->direccion->nombre }}, 
                                    @else
                                        {{ $boleta->direccion_rc}}, 
                                    @endif
                                @else
                                    {{ $boleta->direccion_rc}}, 
                                @endif
                            @else
                                @if($boleta->direccion_empresa != null)
                                    {{ $boleta->direccion_empresa->nombre }}, 
                                @endif
                            @endif
                            @if($boleta->empresas_id == null)
                                @if($boleta->users_id != null)
                                    @if($boleta->direccion != null)
                                        @if($boleta->direccion->bk_comunas_id != null)
                                           {{ $boleta->direccion->comuna->nombre }}
                                        @endif 
                                        @if($boleta->direccion->bk_regiones_id != null)
                                            {{ $boleta->direccion->region->nombre }}
                                        @endif
                                    @else
                                        @if($boleta->comuna_id != null)
                                           {{ $boleta->comuna->nombre }}, Metropolitana de Santiago.
                                        @endif
                                    @endif
                                @else
                                    @if($boleta->comuna_id != null)
                                       {{ $boleta->comuna->nombre }}, Metropolitana de Santiago.
                                    @endif
                                @endif
                                </strong>
                            @else
                                @if($boleta->direccion_empresa != null)
                                    @if ($boleta->direccion_empresa->bk_comunas_id)
                                        {{ $boleta->direccion_empresa->comuna->nombre }}
                                    @endif
                                     @if($boleta->direccion_empresa->bk_regiones_id != null)
                                        {{ $boleta->direccion_empresa->region->nombre }}
                                    @endif
                                @endif
                                </strong>
                            @endif
                            <br> 
                            @if ($boleta->fecha_hora != null)
                              Fecha retiro: <strong>{{$boleta->fecha_hora}}</strong>
                            @else
                               Sin Programar
                            @endif
                            <br>
                            @if($boleta->empresas_id != null)
                                @if ($boleta->camiones->tipo_camion != null)
                                    Tipo Vehículo: <strong>{{$boleta->camiones->tipo_camion->nombre}}.</strong>
                                @else
                                   Sin Tipo Vehiculo.
                                @endif
                                <br> 
                                @if ($boleta->camiones_id != null)
                                    Vehículo: <strong>{{$boleta->camiones->patente}}.</strong>
                                @else
                                   Sin Vehiculo.
                                @endif
                                <br> 
                                @if ($boleta->chofer != null)
                                    Chofer: <strong>{{$boleta->chofer->name}} {{$boleta->chofer->apellido}}.</strong>
                                @else
                                   Sin Chofer.<br>
                                @endif
                            @endif
                        </span>
                    </div>
                    @if($boleta->empresas_id != null)
                        
                        <div class="col-md-4">
                            <span class="text-dark-50 font-weight-normal font-size-md">
                                <br>
                                Nombre Contacto : <strong>{{$boleta->nombre}}</strong><br>
                                Teléfono Contacto : <strong>{{$boleta->telefono}}</strong><br>
                                Email Contacto : <strong>{{$boleta->correo}}</strong>
                            </span>
                        </div>
                        <div class="col-md-3">
                            @if($boleta->empresas_id != null)
                                <span class="text-dark-50 font-weight-normal font-size-md">
                                    @if($boleta->tipo_servicio_id != null)
                                    <br>
                                       Servicio : <strong> {{ $boleta->tipo_servicio->nombre}}</strong>
                                    @endif
                                    <br>
                                    @if($boleta->destino == 0)
                                        @if($boleta->destino_id != null)
                                        Destino : <strong> {{ $boleta->destino_resi->nombre}}</strong>
                                        @endif
                                    @else
                                        Destino : <strong> Terceros.</strong>
                                    @endif
                                    <br>
                                    Jornada Estimada:<b>
                                    @if($boleta->horarios_dias_id != null)
                                        {{$boleta->dia->nombre}}
                                    @else
                                        Por definir 
                                    @endif
                                    desde {{$boleta->desde}} hasta {{$boleta->hasta}}.</b>
                                </span>
                            @endif
                        </div>
                    @else
                        <div class="col-md-3">
                            <span class="text-dark-50 font-weight-normal font-size-md">
                                <br>
                                @if ($boleta->camiones->tipo_camion != null)
                                    Tipo Vehículo: <strong>{{$boleta->camiones->tipo_camion->nombre}}.</strong>
                                @else
                                   Sin Tipo Vehiculo.
                                @endif
                                <br> 
                                @if ($boleta->camiones_id != null)
                                    Vehículo: <strong>{{$boleta->camiones->patente}}.</strong>
                                @else
                                   Sin Vehiculo.
                                @endif
                                <br> 
                                @if ($boleta->chofer != null)
                                    Chofer: <strong>{{$boleta->chofer->name}} {{$boleta->chofer->apellido}}.</strong>
                                @else
                                   Sin Chofer.<br>
                                @endif
                            </span>
                        </div>
                        <div class="col-md-3">
                            <span class="text-dark-50 font-weight-normal font-size-md">
                                <br>
                                Horario: <b>
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
                                 </b>
                                 <br>
                                 @if($boleta->venta->count() != 0)
                                    Incluye <b>{{$boleta->venta->first()->cantidad}} {{$boleta->venta->first()->producto->nombre}}.</b>
                                 @endif
                            </span>
                        </div>
                    @endif
                </div>
                <div class="table-responsive mt-5">
                    @if($boleta->empresas_id == null)
                        {{-- @if($boleta->users_id != null) --}}
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th colspan="2" class="text-center">Detalles</th>
                                        {{-- <th class="text-center">Cantidad</th> --}}
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($boleta->solicitudes as $solicitudes)
                                    <tr>
                                        <td class="d-flex align-items-center font-weight-bolder">
                                            <a href="#" class="text-dark text-hover-primary">
                                                @if($solicitudes->solicitud->Residuos_id != null )
                                                    {{ $solicitudes->solicitud->residuos->nombre }}
                                                @else
                                                    {{ $solicitudes->solicitud->nombre }}
                                                @endif
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                                <img style="width: 150px" src="{{ asset($solicitudes->solicitud->imagen->pluck('url')->first().'/'.$solicitudes->solicitud->imagen->pluck('archivo')->first())}}"></img>
                                        </td>
                                        <td class="text-center align-middle">
                                                <span class="mr-2 font-weight-bolder">
                                                Peso: {{$solicitudes->solicitud->peso}}<br>
                                                Cantidad: {{$solicitudes->solicitud->cantidad}}<br>
                                                Altura: {{$solicitudes->solicitud->altura}} cm<br>
                                                Largo: {{$solicitudes->solicitud->largo}} cm<br>
                                                Ancho: {{$solicitudes->solicitud->profundidad}} cm<br>
                                                Mt3: {{$solicitudes->solicitud->mt3}}
                                                </span>
                                        </td>
                                        {{-- <td class="text-right align-middle">
                                            <a href="{{ asset('/private/chofer/detalle-producto') }}/{{ $solicitudes->solicitud->id }}" class="btn btn-light font-weight-bolder font-size-sm">
                                                <span class="svg-icon svg-icon-primary svg-icon-2x mr-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        {{-- @endif --}}
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Grupo</th>
                                    <th class="text-center">Categoria</th>
                                    <th class="text-center">SubCategoria</th>
                                    <th class="text-center">Peso</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($boleta->solicitudes as $solicitudes)
                                <tr>
                                    <td class="d-flex align-items-center font-weight-bolder">
                                        <a href="#" class="text-dark text-hover-primary">{{ $solicitudes->solicitud->grupo->nombre }}</a>
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="mr-2 font-weight-bolder">
                                            @if($solicitudes->solicitud->clasificacion != null)
                                                {{ $solicitudes->solicitud->clasificacion->nombre }}
                                            @else
                                                Sin Categoria
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-right align-middle">
                                        <span class="mr-2 font-weight-bolder">
                                            @if($solicitudes->solicitud->subcategoria != null)
                                                {{ $solicitudes->solicitud->subcategoria->nombre }}
                                            @else
                                                Sin SubCategoria
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-right align-middle">
                                        <span class="mr-2 font-weight-bolder">{{ $solicitudes->solicitud->peso }}</span>
                                    </td>
                                    <td class="text-right align-middle">
                                        <span class="mr-2 font-weight-bolder">
                                            @if($solicitudes->solicitud->tipo_producto_id != null)
                                            {{ $solicitudes->solicitud->tipo_producto->nombre }}
                                            @else
                                            {{ $solicitudes->solicitud->otro_estado}}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-right align-middle">
                                        <span class="mr-2 font-weight-bolder">
                                            
                                            {{ $solicitudes->solicitud->detalle_retiro }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="table-responsive mt-5">
                        @if($boleta->solicitudes->first()->solicitud->accesos_id != null)
                            @if($boleta->empresas_id != null)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Acceso Detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center align-middle">
                                                @if($boleta->grua == 0)
                                                    Dispone Grúa Horquilla : <strong>No.</strong>
                                                @elseif($boleta->grua == 1)
                                                    Dispone Grúa Horquilla : <strong>Si.</strong>
                                                    Encargado Grúa Horquilla : <strong>{{$boleta->encargado_grua}}.</strong>
                                                @else
                                                     Dispone Grúa Horquilla : <strong>No Aplica.</strong>
                                                @endif
                                                <br>
                                                @if($boleta->encargado_grua == 0)
                                                    Operario de Carga : <strong>No.</strong>
                                                @elseif($boleta->encargado_grua == 1)
                                                    Operario de Carga : <strong>Si.</strong>
                                                @else
                                                     Operario de Carga : <strong>No Aplica.</strong>
                                                @endif
                                                <br>
                                                @if($boleta->estacion_camion == 0)
                                                    Estacionamiento para camiones : <strong>No.</strong>
                                                @elseif($boleta->estacion_camion == 1)
                                                    Estacionamiento para camiones : <strong>Si.</strong>
                                                @else
                                                     Estacionamiento para camiones : <strong>No Aplica.</strong>
                                                @endif
                                                <br>
                                                {{-- Destrucción Certificada :
                                                @if($boleta->solicitud->destruccion_certificada == 0)
                                                   <strong>Si.</strong>
                                                @else
                                                   <strong>No.</strong>
                                                @endif --}} 
                                                <br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Acceso</th>
                                            <th class="text-center">Comentario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center align-middle">
                                                @foreach($boleta->solicitudes->first()->solicitud->accesos->imagen as $img_acc)
                                                    <img style="width: 150px" src="{{ asset('storage/'.$img_acc->url)}}"></img>
                                                @endforeach
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="mr-2 font-weight-bolder">{{ $boleta->solicitudes->first()->solicitud->accesos->comentario}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        @else
                          <h3>El Usuario no ingreso ningun dato sobre el Acceso</h3>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection