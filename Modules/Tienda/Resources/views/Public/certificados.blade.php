@extends('tienda::layouts.public.master')

@section('tienda::content')
	<style type="text/css">
		.dt-buttons{
			display: none;
		}
		.table.table-head-custom thead tr, .table.table-head-custom thead th {
		    color: black !important;
		    border-bottom-color: white;
		}
		.table.table-head-custom tbody tr td{
			border-bottom-color: white;
			border-top-color: white;
		}
		span.red {
			  background: red;
			   border-radius: 0.8em;
			  -moz-border-radius: 0.8em;
			  -webkit-border-radius: 0.8em;
			  color: #ffffff;
			  display: inline-block;
			  font-weight: lighter;
			  line-height: 1.6em;
			  margin-right: 10px;
			  margin-left: 4px;
			  text-align: center;
			  width: 18px;
    		height: 18px;
		}
	</style>
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<div class="d-flex flex-column-fluid">
			<div class="container">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
					<div class="card-title">
						<h3 class="card-label">Certificados Obtenidos</h3>
					</div>
				</div>
				<div class="card-body pt-0">
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
						<thead>
                    	<tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Fecha Retiro</th>
                    		<th>Descargar</th>
                    	</tr>
                	</thead>
                	<tbody>
                        @foreach($boletas as $boleta)
                    		<tr>
                                <th>{{ $boleta->id }}</th>
                                <th>{{ $boleta->codigo }}</th>
                    			<th>{{ $boleta->fecha_hora }}</th>
                    			<th>
                    				<a href="{{ asset('workflow/descargar/'.$boleta->id) }}" class="dropdown-item" ><i class="fa fa-file-pdf fa-2x" style="color:#8fca00;"></i></a>
                    			</th>
                    		</tr>
                        @endforeach
                	</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection
