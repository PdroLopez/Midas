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
                    <span>1 de 4</span>
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
            {{-- Nav --}}
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-productos-tab" data-toggle="tab" href="#nav-productos" role="tab" aria-controls="nav-productos" aria-selected="true">Productos</a>
                    @if(Session::has('intento_carro'))
                    <a class="nav-item nav-link" id="nav-accesos-tab" data-toggle="tab" href="#nav-accesos" role="tab" aria-controls="nav-accesos" aria-selected="false">Accesos</a>
                    @endif
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-productos" role="tabpanel" aria-labelledby="nav-productos-tab">
                    {{-- Productos --}}
                    <div class="card-body pt-8 p-md-10 p-5">
                        <a href="{{ asset('/agregar-producto') }}" class="btn btn-sm btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr- mb-10">
                            <span class="svg-icon svg-icon-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                    </g>
                                </svg>
                            </span>Agregar Producto
                        </a>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(Session::has('intento_carro'))
                                        @foreach(Session::get('intento_carro') as $key => $solicitud)
                                            <tr>
                                                <td class="d-flex align-items-center font-weight-bolder">
                                                    <div class="symbol symbol-60 flex-shrink-0 mr-4 bg-light">
                                                        <div class="symbol-label" style="background-image: url('{{ asset('public/img/solicitudes').'/'.$imagen->where('sl_solicitudes_id', $solicitud['id'])->pluck('archivo')->first() }}')"></div>
                                                    </div>
                                                    <a href="#" class="text-dark text-hover-primary">{{ $solicitud['producto'] }}</a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <span class="mr-2 font-weight-bolder">{{ $solicitud['cantidad'] }}</span>
                                                </td>
                                                <td class="text-right align-middle">
                                                    <a href="{{ asset('/eliminar-producto') }}/{{ $key }}" class="btn btn-light font-weight-bolder font-size-sm">
                                                        <span class="svg-icon svg-icon-primary svg-icon-2x mr-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
                                                                    <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- EndProductos --}}
                </div>
                <div class="tab-pane fade" id="nav-accesos" role="tabpanel" aria-labelledby="nav-accesos-tab">
                    {{-- Accesos --}}
                    <div class="card-body pt-8 p-md-10 p-5">
                @if(!Session::has('acceso_carro'))
                <a href="{{ asset('/agregar-acceso') }}" class="btn btn-sm btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr- mb-10">
                    <span class="svg-icon svg-icon-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                            </g>
                        </svg>
                    </span>Agregar Acceso
                </a>
                @else
                solo se puede agregar 1 acceso
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Comentario</th>
                                <th class="">Foto</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(Session::has('acceso_carro'))
                                @foreach(Session::get('acceso_carro') as $key => $acceso)
                                    <tr>
                                        <td class="align-middle">
                                            <span class="mr-2 font-weight-bolder">{{ $acceso['comentario'] }}</span>
                                        </td>
                                        <td class="d-flex align-items-center font-weight-bolder">
                                            <div class="symbol symbol-60 flex-shrink-0 mr-4 bg-light">
                                                <div class="symbol-label" style="background-image: url('{{ asset('public/img/accesos').'/'.$img_acceso->where('accesos_id', $acceso['id'])->pluck('archivo')->first() }}')"></div>
                                            </div>
                                        </td>
                                        <td class="text-right align-middle">
                                            <a href="{{ asset('/eliminar-acceso') }}/{{ $key }}" class="btn btn-light font-weight-bolder font-size-sm">
                                                <span class="svg-icon svg-icon-primary svg-icon-2x mr-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
                                                            <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
                    {{-- EndAccesos --}}
                </div>
            </div>
            {{-- EndNav --}}

            <div class="row pb-10">
                <div class="col-6 text-right">
                    <a href="{{ asset('/pago-solicitud-cancelado') }}" class="btn btn-lg btn-light btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Cancelar
                    </a>
                </div>
                <div class="col-6 text-left">
                    <a href="{{ asset('/solicitud-paso-2') }}" class="btn btn-lg btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">Siguiente
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('intento_carro'))
        @if(count(Session::get('intento_carro'))==1)
            @if(Session::has('acceso_carro'))
            @else
                <script>
                  $(document).ready(function()
                  {
                     $("#mostrarmodal").modal("show");
                  });
                </script>

                <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                  <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h3>Hola! Has agregado un producto para el retiro</h3>
                           </div>
                           <div class="modal-body">
                                Por favor agregue los accesos por los cuales nuestros operadores tendran que sacar el producto. 
                            </div>
                           <div class="modal-footer">
                                <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
                           </div>
                      </div>
                   </div>
                </div>
            @endif
        @endif
    @endif
@endsection