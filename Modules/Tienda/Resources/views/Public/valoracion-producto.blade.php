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

                                        <span class="font-size-h4 text-success"> <small>valorización</small> </span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <p>{{$total_estrella}} Promedio basado en  {{$count_votostotales}} valorazacones.</p>
                                        <hr style="border:3px solid #f1f1f1">
                                <div><a href="{{asset('tienda/private/producto/')}}/{{$producto->id}}/valoracion/comentar"  class="btn btn-danger">Crear un comentario</a></div>



								        </div>
								        {{-- <div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover" style="background-size: auto;margin: 25px;margin-left: 250px;background-image: url('{{ asset('img/reciclar.svg') }}')"></div> --}}

                                    </div>
						</div>
					</div>
                </div>
                {{--  --}}
				<div class="row">
					<div class="col-12">
						<div class="card card-custom gutter-b card-stretch">
							<div class="card-body d-flex flex-column rounded bg-light justify-content-between">



                                {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}


                                    <div class="row">
                                    <div class="side">
                                        <div>5 Estrellas</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                        <div class="bar-{{$numero_5}}"></div>
                                        </div>
                                    </div>

                                    <div class="side right">
                                        <div></div>
                                    </div>
                                    <div class="side">
                                        <div>4 Estrellas</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                        <div class="bar-{{$numero_4}}"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div></div>
                                    </div>
                                    <div class="side">
                                        <div>3 Estrellas</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                        <div class="bar-{{$numero_3}}"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div></div>
                                    </div>
                                    <div class="side">
                                        <div>2 Estrellas</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                        <div class="bar-{{$numero_2}}"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div></div>
                                    </div>
                                    <div class="side">
                                        <div>1 Estrellas</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                        <div class="bar-{{$numero_1}}"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div></div>
                                    </div>
                                    </div>


							</div>
						</div>
					</div>


                </div>
                <div class="row">
                    @foreach ($comentario as $comentarios)
                    <div class="col-6">
						<div class="card card-custom gutter-b card-stretch">
							<div class="card-body d-flex flex-column rounded bg-light justify-content-between">
                                <div class="d-flex pt-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40 symbol-light-success mr-5 mt-1">
                                        @if($comentarios->user->foto != null)



                                        @else
                                            <span class="symbol-label">
                                                <img src="/metronic/theme/html/demo1/dist/assets/media/svg/avatars/009-boy-4.svg" class="h-75 align-self-end" alt="">
                                            </span>


                                        @endif
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column flex-row-fluid">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center flex-wrap">
                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder pr-6">{{ $comentarios->user->name }}</a>

                                            <span class="text-muted font-weight-normal flex-grow-1 font-size-sm">1 dia atras</span>
                                            @include('tienda::Public.denuncia')
                                        </div>
                                        @if ($comentarios->voto == 1 )
                                          <p><span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span></p>
                                        @elseif($comentarios->voto == 2)
                                         <p><span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span></p>
                                        @elseif($comentarios->voto == 3)
                                         <p><span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span></p>
                                        @elseif($comentarios->voto == 4)
                                         <p><span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span></p>
                                        @elseif($comentarios->voto == 5)
                                         <p><span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span></p>
                                        @endif
                                        {{-- <p><span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span></p>--}}

                                        <span class="text-dark-75 font-size-sm font-weight-normal pt-1">{{ $comentarios->comentario }}</span>
                                        <!--end::Info-->
                                        <br><hr>
                                        <span class="text-muted font-weight-normal font-size-sm">
                                             ¿Le ha resultado útil?
                                             @if ($comentarios->si_util != null)
                                                <a href="{{asset('tienda')}}/{{$comentarios->id}}/{{'si-util'}}" name="si">Si({{$comentarios->si_util}})</a>
                                             @else
                                                <a href="{{asset('tienda')}}/{{$comentarios->id}}/{{'si-util'}}" name="si">Si(0)</a>
                                             @endif

                                             @if ($comentarios->no_util != null)
                                                 <a href="{{asset('tienda')}}/{{$comentarios->id}}/{{'no-util'}}" name="no">No({{$comentarios->no_util}})</a>
                                            @else
                                                <a href="{{asset('tienda')}}/{{$comentarios->id}}/{{'no-util'}}" name="no">No(0)</a>
                                            @endif
                                        </span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                             </div>
                        </div>
                    </div>

                    @endforeach


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
