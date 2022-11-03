@extends('tienda::layouts.public.master')

@section('tienda::content')
	<div class="container mb-0">
		<div class="card card-custom card-stretch gutter-b" style="height: auto;">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<div class="card card-custom gutter-b overflow-hidden">
							<div class="card-body p-0 d-flex rounded bg-light-success">
								<div class="py-18 px-12">
									<h3 class="font-size-h1">
                                    <a href="#" class="text-dark font-weight-bolder">{{$producto->nombre}}</a>
									</h3>
                                        <div class="font-size-h4 text-success">Detalle valoración del producto</div>

                                        </div>
								        {{-- <div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover" style="background-size: auto;margin: 25px;margin-left: 250px;background-image: url('{{ asset('img/reciclar.svg') }}')"></div> --}}

                                    </div>
						</div>
					</div>
				</div>

                <div class="row">
					<div class="col-12">
						<div class="card card-custom gutter-b card-stretch">
							<div class="card-body d-flex flex-column rounded bg-light justify-content-between">
                                <div class="">
                                    {!!Form::open(['route' => 'mantenedor-comentarios.store', 'method' => 'POST','files'=>true])!!}
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="form-group">
                                                <label for="">comentarios</label>
                                                {!!Form::textarea('comentario',null,['class'=>"form-control", 'placeholder'=>"Ingrese su comentario..." , 'required'])!!}
                                            </div>
                                            {{ Form::hidden('td_productos_id',  $productos->id) }}

                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <br>

                                            <br>
                                            <br>
                                                <label for="">Selecciona tu valoración</label>
                                                <br>

                                                <span class="font-size-h4 text-success"> <small></small> </span>
                                                <span class="fa fa-star " onclick="valoracion(this)" name="voto" value="1" style="cursor: pointer;" id="1estrella"></span>
                                                <span class="fa fa-star " onclick="valoracion(this)"  name="voto" value="2" style="cursor: pointer;" id="2estrella" ></span>
                                                <span class="fa fa-star " onclick="valoracion(this)"  name="voto" value="3" style="cursor: pointer;" id="3estrella" ></span>
                                                <span class="fa fa-star " onclick="valoracion(this)"  name="voto" value="4" style="cursor: pointer;" id="4estrella" ></span>
                                                <span class="fa fa-star " onclick="valoracion(this)" name="voto" value="5" style="cursor: pointer;" id="5estrella" ></span>
                                                <input type="hidden" id="voto" name="voto"/>
                                            </div>

                                            <script type="text/javascript">

                                            var contador;
                                                function valoracion(t)
                                                {
                                                contador= t.id[0];
                                                let nombre = t.id.substring(1);
                                                for(let i=0; i<5; i++)
                                                {
                                                    if(i<contador)
                                                    {
                                                       var prueba=  document.getElementById((i+1)+nombre).className ="fa fa-star checked";
                                                       var  prueba2 = document.getElementById("voto").value = t.id[0];
                                                    }
                                                    else
                                                    {
                                                        document.getElementById((i+1)+nombre).className ="fa fa-star";


                                                    }
                                                }

                                                }
                                            </script>




                                            <br>
											<button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit">Comentar</button>

                                        </div>
                                    </div>


                                    {!!Form::close()!!}
                                </div>
                             </div>
                        </div>
                    </div>



			</div>
		</div>
    </div>

    <style>
        * {
  box-sizing: border-box;
}



.heading {
  font-size: 25px;
  margin-right: 25px;
}

.fa {
  font-size: 25px;
}

.checked {
  color: orange;
}

/* Three column layout */
.side {
  float: left;
  width: 15%;
  margin-top: 10px;
}

.middle {
  float: left;
  width: 70%;
  margin-top: 10px;
}

/* Place text to the right */
.right {
  text-align: right;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* The bar container */
.bar-container {
  width: 100%;
  background-color: #f1f1f1;
  text-align: center;
  color: white;
}

/* Individual bars */
.bar-5 {width: 60%; height: 18px; background-color: #4CAF50;}
.bar-4 {width: 30%; height: 18px; background-color: #2196F3;}
.bar-3 {width: 10%; height: 18px; background-color: #00bcd4;}
.bar-2 {width: 4%; height: 18px; background-color: #ff9800;}
.bar-1 {width: 15%; height: 18px; background-color: #f44336;}

/* Responsive layout - make the columns stack on top of each other instead of next to each other */
@media (max-width: 400px) {
  .side, .middle {
    width: 100%;
  }
  /* Hide the right column on small screens */
  .right {
    display: none;
  }
}

    </style>
@endsection
