@extends('layouts.backend.master')
@section('content')

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Slider</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Editor</a>
                    </li>

                </ul>
            </div>
        </div>

    </div>
</div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Slider principal
            </div>
            <div class="card-body table-responsive">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Nuevo
                </button>
                <br>
                <br>

                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Archivo</th>
                            <th>Estado</th>
                            <th>Texto Principal</th>
                            <th>Texto Secundario</th>
                            <th>Texto Botón</th>
                            <th>URL Botón</th>
                            <th>Categoria slider</th>
                            <th>Acciones</th>
                            {{--
                            --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($imagenes as $imagen)
                            <tr>
                                <td>{{$imagen->id}}</td>
                                <th>
                                    <img src="{{asset('storage/'.$imagen->ruta)}}"  width="200" height="100">
                                </th>
                                <th>{{ $imagen->estado->nombre }}</th>
                                <th>{{ $imagen->texto_principal }}</th>
                                <th>{{ $imagen->texto_secundario }}</th>
                                <th>{{ $imagen->btn_texto }}</th>
                                <th>{{ $imagen->btn_url }}</th>
                                <th>
                                    @if ($imagen->ct_categoria_slider_id != null)
                                      {{ $imagen->categoria_slider->nombre }}

                                    @else
                                        Sin Categoria
                                    @endif
                                </th>
                                <th>
                                    <div class="dropdown dropdown-inline mr-2">
                                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones</button>
                                        <!--begin::Dropdown Menu-->
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="nav flex-column nav-hover">
                                                <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp; Escoge una opción:</li>
                                                <li class="nav-item">
                                                    @if($imagen->bk_estados_id == 13)
                                                        <a class="dropdown-item" href="{{ asset('contenido/editor/publicar') }}/{{ $imagen->id }}" >Publicar</a>
                                                    @endif
                                                    @if($imagen->bk_estados_id == 12)
                                                        <a class="dropdown-item" href="{{ asset('contenido/editor/bajar-publicacion') }}/{{ $imagen->id }}" >Quitar publicación</a>
                                                    @endif
                                                </li>
                                                <li class="nav-item">
                                                    @if ($imagen->bk_estados_id != 12)
                                                        @include('contenido::private.editor.modal.slider.destroy')

                                                    @else


                                                    @endif
                                                </li>
                                                <li class="nav-item">
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#edit{{$imagen->id}}">Editar</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!--end::Dropdown Menu-->
                                    </div>
                                </th>
                            </tr>
                            @include('contenido::private.editor.modal.slider.edit')

                        @endforeach
                    </tbody>
                </table>
                {{-- <table class="table table-bordered table-checkable" id="kt_datatable">
                    <thead>
                        <tr>
                              <th>{{ $imagen->id }}</th>
                            <th>
                                <img src="{{asset('storage/'.$imagen->ruta)}}"  width="200" height="100">

                            </th>
                            <th>{{ $imagen->estado->nombre }}</th>
                            <th>{{ $imagen->texto_principal }}</th>
                            <th>{{ $imagen->texto_secundario }}</th>
                            <th>{{ $imagen->btn_texto }}</th>
                            <th>{{ $imagen->btn_url }}</th>
                            <th>{{ $imagen->categoria_slider->nombre }}</th>
                            <th>
                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones</button>
                                    <!--begin::Dropdown Menu-->
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="nav flex-column nav-hover">
                                            <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp; Escoge una opción:</li>
                                            <li class="nav-item">
                                                @if($imagen->bk_estados_id == 13)
                                                    <a class="dropdown-item" href="{{ asset('contenido/editor/publicar') }}/{{ $imagen->id }}" >Publicar</a>
                                                @endif
                                                @if($imagen->bk_estados_id == 12)
                                                    <a class="dropdown-item" href="{{ asset('contenido/editor/bajar-publicacion') }}/{{ $imagen->id }}" >Quitar publicación</a>
                                                @endif
                                            </li>
                                            <li class="nav-item">
                                                @include('contenido::private.editor.modal.slider.destroy')
                                            </li>
                                        </ul>
                                    </div>
                                    <!--end::Dropdown Menu-->
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($imagenes as $imagen)
                        <tr>
                            <th>{{ $imagen->id }}</th>
                            <th>
                                <img src="{{asset('storage/'.$imagen->ruta)}}"  width="200" height="100">

                            </th>
                            <th>{{ $imagen->estado->nombre }}</th>
                            <th>{{ $imagen->texto_principal }}</th>
                            <th>{{ $imagen->texto_secundario }}</th>
                            <th>{{ $imagen->btn_texto }}</th>
                            <th>{{ $imagen->btn_url }}</th>
                            <th>{{ $imagen->categoria_slider->nombre }}</th>
                            <th>
                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones</button>
                                    <!--begin::Dropdown Menu-->
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="nav flex-column nav-hover">
                                            <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">&nbsp; Escoge una opción:</li>
                                            <li class="nav-item">
                                                @if($imagen->bk_estados_id == 13)
                                                    <a class="dropdown-item" href="{{ asset('contenido/editor/publicar') }}/{{ $imagen->id }}" >Publicar</a>
                                                @endif
                                                @if($imagen->bk_estados_id == 12)
                                                    <a class="dropdown-item" href="{{ asset('contenido/editor/bajar-publicacion') }}/{{ $imagen->id }}" >Quitar publicación</a>
                                                @endif
                                            </li>
                                            <li class="nav-item">
                                                @include('contenido::private.editor.modal.slider.destroy')
                                            </li>
                                        </ul>
                                    </div>
                                    <!--end::Dropdown Menu-->
                                </div>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
    @include('contenido::private.editor.modal.slider.create')
@endsection
