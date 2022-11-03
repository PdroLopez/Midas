<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Qr para Boleta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <p style="text-align: center; ">
                <img src="{{ asset('img/midas1.png') }}" style="width: 300px;"/>
          </p>

        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12" align="center">
              <h3>Qr de Retiro</h3><br><br>
              <h5>Código de Boleta: {{$boleta->codigo}}</h5>
        </div>
      </div>
    </div>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-12" align="center">
          <img src="data:image/png;base64, {!! base64_encode($qr) !!}">
        </div>
      </div>
    </div>
  </body>
</html>