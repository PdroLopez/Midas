@extends('layouts.master')

@section('content')
    <div class="position-relative overflow-hidden bg-light">
        <div class="col-md-8 p-lg-5 mx-auto my-5">
            <div class="row">
                <div class="col-md-6 col-10">
                    <h1 class="display-4 font-weight-normal">Solicitud de Retiro</h1>
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
                    <span>3 de 4</span>
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
<form action="{{ asset('/solicitud-paso-4') }}" method="post">
    @csrf
    <div class="container mt-md-20 mt-10 mb-0">
        <div class="card card-custom gutter-b">
            <div class="card-body pt-8 p-md-10 p-5 mb-5">
                <h2 class="mb-10">Tipo de Retiro</h2>
                <div class="form-group">
                    <label for="tiporetiro">Retiro</label>
                    <select class="form-control" name="tiporetiro" required>
                        <option value="" selected>Seleccione</option>
                        @foreach($horario as $hrs)
                            <option value="{{ $hrs->id }}">{{ $hrs->nombre }}: {{ $hrs->hora }}Hrs (${{ $hrs->precio }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="horario">Horario</label>
                    <select class="form-control" name="horario" required>
                        <option value="">Seleccione</option>
                        @foreach($hr_dia as $hora)
                            <option value="{{ $hora->id }}">{{ $hora->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- ///////////////////////////////////// --}}
                @if(count(Auth::user()->direccion)>=1)
                    <h2 class="mb-10 mt-10">Dirección de Retiro</h2>
                    <label>Dirección de Usuario</label>
                    <select class="form-control" name="direccionUser">
                        <option value="" selected>Seleccione</option>
                        @foreach(Auth::user()->direccion as $direccion)
                            <option value="{{ $direccion->id }}">
                                @if($direccion->nombre != null)
                                {{ $direccion->nombre }}
                                @endif
                                @if($direccion->bk_comunas_id != null)
                                ,{{ $direccion->comuna->nombre }}
                                @endif
                                @if($direccion->bk_regiones_id != null)
                                ,{{ $direccion->region->nombre }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                @else
                    <h2 class="mb-10 mt-10">Dirección de Retiro</h2>
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Región</label>
                                <select name="regiones" class="form-control form-control-solid form-control-lg" id="regiones" onchange="region(this.value)" required>
                                    <option value="">Seleccione region</option>
                                    @foreach($region as $reg)
                                        <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Comuna</label>
                                <select name="comunas" class="form-control form-control-solid form-control-lg" id="comunas" required>
                                    <option value="">Seleccione Comuna</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control form-control-solid form-control-lg" name="direccion" id="direccion" required/>
                        <span class="form-text text-muted">Escribe tu dirección Por favor.</span>
                    </div>
                @endif
                {{-- /////////////////Agregar Direccion//////////////////// --}}
                <br>
                <div style="text-align: right;">
                    <a href="{{ asset('/agregar-direccion') }}" class="btn btn-sm btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr- mb-10">
                        <span class="svg-icon svg-icon-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                </g>
                            </svg>
                        </span>Agregar Dirección
                    </a>
                </div>
            </div>
            <div class="row pb-10">
                <div class="col-6 text-right">
                    <a href="{{ asset('/pago-solicitud-cancelado') }}" class="btn btn-lg btn-light btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Cancelar
                    </a>
                </div>
                <div class="col-6 text-left">
                    <button class="btn btn-lg btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Siguiente
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

<script>
    function region(id) {
        $.get('{{ asset('api/comunas') }}/'+id, function(data, status) {
            var select = `<option value="">Seleccione comuna</option>`;
            for(var i = 0; i < data.length; i++){
                select +=  `<option value="${data[i].id}">${data[i].nombre}</option>`;
            }   
            
            document.getElementById('comunas').innerHTML = select;

        });
    }
</script>