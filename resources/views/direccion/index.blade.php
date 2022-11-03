@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card card-custom">

        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label"> Direcciones</h3>
                <div class="ml-10">@include('direccion.create')</div>
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

            <div class="card-body table-responsive">
                {{-- <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Regiones</th>
                            <th>Comunas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table> --}}
                <table class="table table-light"  id="kt_datatable">
                   <thead>
                       <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Regiones</th>
                        <th>Comunas</th>
                        <th>Acciones</th>
                       </tr>
                   </thead>
                    <tbody>
                        @foreach ($direccion as $direcciones)
                        <tr>
                            <td>
                                {{$direcciones->id}}
                            </td>
                            <td>
                                {{$direcciones->nombre}}
                            </td>
                            <td>
                                @if ($direcciones->region != null)
                                   {{$direcciones->region->nombre}}
                                @else

                                @endif

                            </td>

                            <td>
                                @if ($direcciones->comuna != null)
                                   {{$direcciones->comuna->nombre}}
                                @else

                                @endif

                            </td>

                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu">
                                        {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit{{$direcciones->id}}">Editar</a> --}}
                                        <a class="dropdown-item" href="{{asset('/quitar')}}/{{$direcciones->id}}" >Quitar </a>
                                        <a class="dropdown-item" href="{{asset('/direccion/edit')}}/{{$direcciones->id}}" >Editar </a>
                                    </div>
                                </div>


                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
@endsection
