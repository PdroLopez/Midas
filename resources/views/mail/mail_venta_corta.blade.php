<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">

    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { -ms-interpolation-mode: bicubic; }

    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
    table { border-collapse: collapse !important; }
    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    @media screen and (max-width: 480px) {
        .mobile-hide {
            display: none !important;
        }
        .mobile-center {
            text-align: center !important;
        }
    }

    div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</head>
<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            <tr>
                <td align="center" valign="top" style="background-color: #ffffff" >
                    <img src="{{ asset('img/midascorreoheader1.png') }}" style="width: 100%">    
                </td>
            </tr>
            <tr>
                <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif;padding: 0px 50px 0px 50px; background-color: #ffffff;"><br>
                    <h2 style="font-size: 22px; font-weight: 800;color: #333333; margin: 0;">
                        ??Se acaba de realizar una reserva de Kit!
                    </h2>
                </td>
            </tr>
            <tr>
                <td align="center" style="padding: 0px 40px 0px 40px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                            <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                                <b>Datos de la reserva</b><br>
                                ID Venta:  {{ $venta->id }}<br>
                                N?? Venta: {{ $venta->codigo }}<br>
                                Nombre: {{ $venta->ventas_fuera->nombre }}<br>
                                Direcci??n: {{ $venta->ventas_fuera->direccion }} @if($venta->ventas_fuera->bk_comunas_id != null),{{$venta->ventas_fuera->comuna->nombre}} @endif @if($venta->ventas_fuera->bk_regiones_id != null), {{$venta->ventas_fuera->region->nombre}} @endif<br>
                                Despacho:@if($venta->despacho->bk_cobertura_id == 1)
                                            ${{$venta->despacho_valor}}<br>
                                        @else
                                            Envio por pagar via Starken<br>
                                        @endif
                                Forma Pago:@if($venta->tipo_pago == 'efectivo')
                                            Efectivo
                                        @elseif($venta->tipo_pago == 'transbank')
                                            Pos M??vil Transbank
                                        @endif<br>
                                Cantidad: {{ $venta->cantidad }}
                            </p>
                        </td>
                    </tr>
                     {{-- <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                            <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                                A continuaci??n, te dejamos un adjunto con el comprobante de tu compra.
                            </p>
                        </td>
                    </tr> --}}
                </table>
                </td>
            </tr>
            <tr>
                <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif;background: #ffffff">
                    <p style="font-size: 16px; font-weight: 800; color: #333333;">
                        Reciclamos Futuro con Energ??as Limpias.
                    </p>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top" style="background-color: #ffffff;" >
                   <img src="{{ asset('img/midascorreofooter1.png') }}" style="width: 100%">     
                </td>
            </tr>
            <tr>
                <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; background-color: #ffffff;">
{{--                     <p style="font-size: 14px; color: #777777;">
                        Te invitamos a imprimir este comprobante solo si es necesario
                    </p>
                    <p style="font-size: 14px; color: #777777;">
                        Manual de kit de reciclaje, descargar <a href="{{ asset('Manual de Uso Kit de Reciclaje.pdf') }}">aqu??</a>
                    </p> --}}
                    <p style="color: #777777;">
                        <img style="width: 18%" src="{{ asset('img/logoinstagrammidas.png') }}">
                    </p>
                </td>
            </tr>
        </table>
        </td>
    </tr>
</table>
</body>
</html>
