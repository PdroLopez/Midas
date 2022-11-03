@extends('layouts.master')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
           Mis Certificados
        </div>
        <div class="card-body table-responsive">


            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Empresa</th>
                        <th>Acciones</th>
                        {{--
                        --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boleta as $boletas)
                    <tr>
                        <td>{{$boletas->id}}</td>
                        <td>
                            @if($boletas->empresas_id != null)
                                  {{ $boletas->empresas->nombre }}
                             @else
                                  {{ $boletas->user->name }}
                              @endif
                        </td>
                        <td>
                            <a class="btn btn-light-primary"href="{{asset('empresa/descargar-pdf')}}/{{$boletas->id}}">Descargar PDF</a>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
