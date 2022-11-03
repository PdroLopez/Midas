@extends('tienda::layouts.public.master2',['title' => $producto->nombre, 'description' => $producto->caracteristicas, 'image_short'=> asset('producto_short.jpg') ])
@section('tienda::content')
<div class="content">
    <center>
        <div class="row">
            <div class="col">
                <h1>
                    Bienvenid@ a Tienda Virtual MidasChile
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col" id="div_img">
                            <div class="card-body">
                                @if ($producto->id == 19)
                        {{--
                                <img alt="Card image cap" class="card-img-top" src="{{ asset('storage/public/productos/'.$producto->id.'/imagen') }}" style="width: 30%;">
                                    <img alt="Card image cap" class="card-img-top" src="{{ asset('storage/public/productos/'.$producto->id.'/imagen2') }}" style="width: 30%;">
                                        --}}
                                        <img alt="Card image cap" class="card-img-top" id="img_1" src="{{ asset('productos.png') }}">
                                            {{--
                                            <img alt="Card image cap" class="card-img-top" id="img_2" src="{{ asset('imagenventacorta.jpeg') }}">
                                                --}}
                          {{--
                                                <script>
                                                    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                                document.getElementById("img_1").style.width="20%"
                                // document.getElementById("img_2").style.width="20%"
                              }else{
                                document.getElementById("img_1").style.width="40%"
                                // document.getElementById("img_2").style.width="40%"
                              }
                                                </script>
                                                --}}
                      @endif
                      {{-- https://picsum.photos/200/300 --}}
                                            </img>
                                        </img>
                                    </img>
                                </img>
                            </div>
                        </div>
                        <div class="col" id="div_descripcion">
                            <div class="card-body" style="font-size:12px;">
                                <h5 class="card-title">
                                    {{$producto->nombre}}
                                </h5>
                                <p class="card-text">
                                    Precio
                                    <strong>
                                        ${{number_format($producto->precio, 0, ',', '.')}}
                                    </strong>
                                </p>
                                {{--
                                <p class="card-text">
                                    Kit Reciclaje
                                </p>
                                --}}
                                <p class="card-text">
                                    {{$producto->descripcion}}
                                </p>
                                <p class="card-text">
                                    {!!$producto->caracteristicas!!}
                                </p>
                                <div class="row">
                                    <div class="col-6" style="padding: 0% 0% 0% 15%;">
                                        <a class="btn btn-primary" href="{{ asset('/tienda/venta-corta/producto/'.$producto->id.'/paso-2') }}" style="color: #FFFFFF;background-color: #419f00;border-color: #419f00;">
                                            Iniciar compra
                                        </a>
                                    </div>
                                    <div class="col-6" style="padding: 0% 15% 0% 0%;">
                                        <a class="btn btn-danger" href="{{ asset('/tienda/venta-corta/cancelar') }}" onclick="return confirm('¿Quiere cancelar la compra?')" style="background-color: red;border-color:red;">
                                            Cancelar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                              document.getElementById("div_descripcion").className="col-12";
                              document.getElementById("div_img").className="col-12";
                              document.getElementById("div_descripcion").style.padding="0%";
                              document.getElementById("div_img").style.padding="0%";
                            }else{
                              document.getElementById("div_img").className="col";
                              document.getElementById("div_descripcion").className="col";
                              document.getElementById("div_img").style.padding="1% 0% 0% 15%";
                              document.getElementById("div_descripcion").style.padding="2% 20% 0% 0%";
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>
@endsection
