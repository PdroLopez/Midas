<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>MidasChile</title>
  </head>
  <body>
    <div class="jumbotron text-center" style="filter: brightness(90%);background-color:#fff;" >
        <div class="container" style="background-color:#fff;padding: 15% 10%;background-image: url({{ asset('img/logotrans1.png') }});background-size:contain;background-repeat: no-repeat;background-position: center;">
          <p style="font-size: 45px;"><b>Gracias por tu reserva en<br>MidasChile</b></p>
          <p style="color:#404848; font-size: 22px;">Tu comprobante puedes descargarlo haciendo click en el botón<br> "<b>Descargar"</b>.<br> 
          Código de operación:<br> <strong>{{ $codigo}} </strong></p>
          <p>
            <a  style="font-size: 22px;" href="{{asset('sp/descarga')}}/{{$codigo}}" class="btn btn-primary my-2">Descargar</a>
          </p>
        </div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>