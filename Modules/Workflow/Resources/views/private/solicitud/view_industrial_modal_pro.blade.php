<div class="modal fade bd-example-modal-lg" id="detalle{{ $productos->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      	<h5>Producto</h5>
      </div>
      <div class="modal-body">
      	<div class="row">
	      	<div class="col-4">
	      		<div class="form-group">
		      		<label>Nombre</label>
		      		<br>
		      		@if($productos->solicitud->residuos != null)
		      			{{ $productos->solicitud->residuos->nombre }}
		      		@else
		      			{{ $productos->solicitud->nombre }}
		      		@endif
	      		</div>
	      	</div>
	      	<div class="col-4">
	      		<div class="form-group">
		      		<label>Cantidad</label>
		      		<br>
		      		{{ $productos->solicitud->cantidad }}
	      		</div>
	      	</div>
	      	<div class="col-4">
	      		<div class="form-group">
		      		<label>Motivo</label>
		      		<br>
		      		{{ $productos->solicitud->motivo }}
	      		</div>
	      	</div>
	      	<div class="col-3">
	      		<div class="form-group">
	      			<label>Altura</label>
	      			<br>
	      			{{ $productos->solicitud->altura }} CM
	      		</div>
	      	</div>
	      	<div class="col-3">
	      		<div class="form-group">
	      			<label>Ancho</label>
	      			<br>
	      			{{ $productos->solicitud->profundidad }} CM
	      		</div>
	      	</div>
	      	<div class="col-3">
	      		<div class="form-group">
	      			<label>Largo</label>
	      			<br>
	      			{{ $productos->solicitud->largo }} CM
	      		</div>
	      	</div>
	      	<div class="col-3">
	      		<div class="form-group">
	      			<label>Peso</label>
	      			<br>
	      			{{ $productos->solicitud->peso }} KG
	      		</div>
	      	</div>
	      </div>
	      <h5>Imagenes</h5>
	    	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
                @foreach($productos->solicitud->imagen as $imag)
				    <div class="carousel-item active">
				      <img class="d-block w-50" width="100px" src="{{ asset($imag->url.'/'.$imag->archivo)}}">
				    </div>
	      		@endforeach
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Anterior</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Siguiente</span>
			  </a>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>