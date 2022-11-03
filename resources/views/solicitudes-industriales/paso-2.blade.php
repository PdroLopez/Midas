@extends('layouts.master')

@section('content')
    <div class="position-relative overflow-hidden bg-light">
        <div class="col-md-8 p-lg-5 mx-auto my-5">
            <div class="row">
                <div class="col-md-6 col-10">
                    <h1 class="display-4 font-weight-normal">Solicitud de Retiro Industrial</h1>
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
                    <span>2 de 3</span>
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
        <form action=" {{ asset('solicitud-retiro-industrial-3') }} " method="post">
            @csrf
            <div class="card card-custom gutter-b">
                <div class="card-body pt-8 p-md-10 p-5" align="center">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Empresas</label>
                            <select class="form-control" name="empresa" id="empresa" {{-- onchange="obtenerDirecciones(this.value)" --}} onchange="obtenerMarcas(this.value)">
                                <option value="">Seleccione..</option>
                                @foreach($empresas as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-5" id="lista-marcas">
                                
                        </div>
                    </div>
                    <h2 class="mb-10">¿Retiro por midas?</h2>
                    <div class="form-group">
                        <label for="tiporetiro">Retiro</label>
                        <br>
                          <input type="radio" id="propio" name="retiro" value="1">
                          <label for="propio">Retiro por medios de la empresa solicitante</label><br>
                          <input type="radio" id="midas" name="retiro" value="2">
                          <label for="midas">Retiro de midas</label><br>
                    </div>
                </div>
                <div class="row pb-10">
                    <div class="col-6 text-right">
                        <a href="{{ asset('/solicitud-retiro-industrial-error') }}" class="btn btn-lg btn-light btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Cancelar
                        </a>
                    </div>
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-lg btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Siguiente
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

<script>
    function obtenerMarcas(id){
        $.get("{{ asset('/api/get-marca') }}/"+id, function(data, status){
            if (data.marcas.length > 0) {
                var select = `<label>Seleccione Marca</label>
                <select class="form-control" name="marca" id="marca">
                    <option value="">Seleccione Marca</option>
                `;
                for (var i = 0; i < data.marcas.length; i++) {
                    if (data.marcas[i]['marcas_id'] == data.marca[i]['id']) {
                        select += `<option value="${data.marcas[i]['id']}">${data.marca[i]['nombre']}</option>`;
                    }
                }
                select += `</select>`;
                document.getElementById('lista-marcas').innerHTML = select;
            }
        });
    }
</script>