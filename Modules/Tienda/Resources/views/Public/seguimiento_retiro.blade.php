@extends('tienda::layouts.public.master')

@section('tienda::content')
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
                    @if($boleta->empresas_id == null)
                        @if($boleta->users_id != null)
                            @if($boleta->direccion != null)
                                {{ $boleta->direccion->nombre }}
                            @else
                                {{ $boleta->direccion_rc}}
                            @endif
                        @else
                            {{ $boleta->direccion_rc}}
                        @endif
                    @else
                        @if($boleta->bk_direcciones_empresa_id != null)
                            {{ $boleta->direccion_empresa->nombre }}
                        @endif
                    @endif
                </span>
                <span class="text-dark-50 font-weight-normal font-size-md">
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
                    @else
                        @if($boleta->bk_direcciones_empresa_id != null)
                            @if ($boleta->direccion_empresa->bk_comunas_id)
                                {{ $boleta->direccion_empresa->comuna->nombre }}
                            @endif
                             @if($boleta->direccion_empresa->bk_regiones_id != null)
                                {{ $boleta->direccion_empresa->region->nombre }}
                            @endif
                        @endif
                    @endif
                    <br> 
                    @if ($boleta->fecha_hora != null)
                      Fecha retiro: {{$boleta->fecha_hora}}
                    @else
                       Sin Programar
                    @endif
                    <br> 
                    @if ($boleta->camiones_id != null)
                        Vehículo: {{$boleta->camiones->patente}}.
                    @else
                       Sin Vehiculo.<br>
                    @endif
                </span>
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
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        {{-- @endif --}}
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Grupo</th>
                                    <th class="text-center">Clasificación</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($boleta->solicitudes as $solicitudes)
                                <tr>
                                    <td class="d-flex align-items-center font-weight-bolder">
                                        <a href="#" class="text-dark text-hover-primary">{{ $solicitudes->solicitud->grupo->nombre }}</a>
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="mr-2 font-weight-bolder">{{ $solicitudes->solicitud->clasificacion->nombre }}</span>
                                    </td>
                                    <td class="text-right align-middle">
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="table-responsive mt-5">
                        @if($boleta->solicitudes->first()->solicitud->accesos_id != null)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Acceso</th>
                                        <th class="text-center">Comentario</th>
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{dd($boleta->solicitudes->first()->solicitud)}} --}}
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
                        @else
                          <h3>El Usuario no ingreso ningun dato sobre el Acceso</h3>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection
