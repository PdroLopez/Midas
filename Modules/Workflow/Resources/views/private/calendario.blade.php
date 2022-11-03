@extends('layouts.backend.master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href='{{ asset('lib/main.css') }}' rel='stylesheet' />
    <script src='{{ asset('lib/main.js') }}'></script>
    <script src='{{ asset('lib/locales/es.js') }}'></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
@section('content')
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-baseline mr-5">
            <h5 class="text-dark font-weight-bold my-2 mr-5">Logistica</h5>
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item">
                    <a href="" class="text-muted">Workflow</a>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="container">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Calendario</h3>
                <div class="ml-10"> {{-- @include('backend::private.camiones.create') --}} </div>
            </div>
        </div>
        <div class="card-body">
            <div id="calendar"></div>
            <div class="modal fade" id="calendar-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Agenda</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="descripcion"></div>
                            <div id="resumen"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function capturaDatos(id) {
        $.get('{{ asset('workflow/solicitar-boletas') }}/'+id, function(data, status){
            var resumen = `
                <div>Boleta ID: ${data.boleta.id}</div>
                <div>Total: ${data.boleta.total}</div>
                <div>Codigo: ${data.boleta.codigo}</div>
                <div>Fecha: ${data.boleta.fecha_hora}</div>
            `;
            for (var i = 0; i < data.estados.length; i++) {
                if (data.boleta['bk_estados_id'] == data.estados[i]['id']) {
                    resumen += `<div>Estado: ${data.estados[i]['nombre']}</div>`;
                }
            }
            resumen += `
                <div>Solicitud ID: ${data.solicitud.id}</div>
                <div>Nombre: ${data.solicitud.nombre}</div>
                <div>Motivo: ${data.solicitud.motivo}</div>
                <div>Precio: ${data.solicitud.precio}</div>
            `;
            document.getElementById('resumen').innerHTML = resumen;
        });
    }

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var evt = [];
    $.ajax({
        url: 'workflow/evento/get',
        type: "GET",
        dateType:"JSON",
        async:false
    }).done(function(r){
        evt = r;
    })

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale:'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        navLinks: true,
        selectable: true,
        selectMirror: true,
        /*select: function(arg) {
            console.log(arg);
            $("#calendar-modal").modal();
            calendar.unselect()
        },*/
        eventClick:function(info){
            $("#descripcion").html(info.event.title);
            $("#calendar-modal").modal();
            capturaDatos(info.event.id);
        },
        editable: true,
        events: evt
        
    });

    calendar.render();
  });

</script>
