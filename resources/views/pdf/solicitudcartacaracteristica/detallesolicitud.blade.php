<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Carta de Caracteristicaas N° {{ $CartaDetalleSolicitud[0]->cNumCarta }}</title>
    <style type="text/css">
        @page {
            margin: 0px;
            padding: 1rem;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        .padding{
            padding: 1rem;
        }
        .padding-cabecera {
            padding: 2rem;
        }
        .information {
            background-color: #F7FFFF;
            color: #FFF;
            padding: 2rem;
            padding-bottom: 0px;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 1px;
        }
        .invoice table {
            margin: 15px;
        }
        .information table tr td p,
        .information table tr td span {
            color: black !important;
        }
        .invoice h3 {
            text-align: center;
        }
        .invoice .center {
            margin-left: 5rem;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
        .justify{
            text-align: justify;
            margin-bottom: .1rem;
            font-size: .75rem;
        }
        .cuadrado {
            width:5rem;
            max-width:100px;
            height:5rem;
            max-height:30px;
            position:relative;
            border: 1px solid;
        }
    </style>
</head>
<body>
    <div class="information">
        <table width="100%">
            <tr>
                <td valign="top">
                    <img src="{{$logo}}" alt="" width="210" height="75"/>
                </td>
                <td align="right">
                    <img src="{{$hyundai}}" alt="" width="175" height="75"/>
                </td>
            </tr>
        </table>
    </div>

    <div class="padding">
        <div class="invoice">
            <table width="100%">
                <tr>
                    <td align="right" style="width: 40%;">
                        {{ $CartaDetalleSolicitud[0]->Fecha }}
                    </td>
                </tr>
            </table>
            <br>

            <table width="100%">
                <tr>
                    <td align="left" style="width: 40%;">
                        <h4>Señores</h4>
                        <strong>
                            {{ $CartaDetalleSolicitud[0]->cNombreBanco }}
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="width: 40%;">
                        <h4>Presente.-</h4>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="width: 40%;">
                        <h4>Atención :</h4>
                        <strong>
                            {{ $CartaDetalleSolicitud[0]->cRef }}  {{ $CartaDetalleSolicitud[0]->cAtencion }}
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="width: 40%;">
                        <h4>Referencia - Cliente :</h4>
                        <strong>
                            {{ $CartaDetalleSolicitud[0]->cContacto }}
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="width: 40%;">
                        <h4>Estimados Señores</h4>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="width: 100%;">
                        <p>
                            Mediante la presente, cumplimos con informar las características del vehículo asignado a nuestro mutuo cliente <strong>{{ $CartaDetalleSolicitud[0]->cContacto }}</strong> , identificado con DNI  <strong>{{ $CartaDetalleSolicitud[0]->cNumDocumento }}</strong>
                        </p>
                    </td>
                </tr>
            </table>

            <table width="100%">
                <tr>
                    <td>Marca:</td>
                    <td><strong>{{ $CartaDetalleSolicitud[0]->cNombreMarca }}</strong></td>
                </tr>
                <tr>
                    <td>Modelo:</td>
                    <td><strong>{{ $CartaDetalleSolicitud[0]->cNombreModelo }}</strong></td>
                </tr>
                <tr>
                    <td>Año Fabricación:</td>
                    <td><strong>{{ $CartaDetalleSolicitud[0]->nAnioFabricacion }}</strong></td>
                </tr>
                <tr>
                    <td>Año Modelo:</td>
                    <td><strong>{{ $CartaDetalleSolicitud[0]->nAnioModelo }}</strong></td>
                </tr>
                <tr>
                    <td>Número de Chasis/Serie:</td>
                    <td><strong>{{ ($CartaDetalleSolicitud[0]->cNumeroChasis) ? $CartaDetalleSolicitud[0]->cNumeroChasis : '-' }}</strong></td>
                </tr>
                <tr>
                    <td>Número de Motor:</td>
                    <td><strong>{{ ($CartaDetalleSolicitud[0]->cNumeroMotor) ? $CartaDetalleSolicitud[0]->cNumeroMotor : '-' }}</strong></td>
                </tr>
                <tr>
                    <td>Color:</td>
                    <td><strong>{{ ($CartaDetalleSolicitud[0]->cNombreColor) ? $CartaDetalleSolicitud[0]->cNombreColor : '-' }}</strong></td>
                </tr>
                <tr>
                    <td>Clase:</td>
                    <td><strong>{{ ($CartaDetalleSolicitud[0]->cNombreClase) ? $CartaDetalleSolicitud[0]->cNombreClase : '-' }}</strong></td>
                </tr>
                <tr>
                    <td>Carrocería:</td>
                    <td><strong>{{ ($CartaDetalleSolicitud[0]->cNombreSubClase) ? $CartaDetalleSolicitud[0]->cNombreSubClase : '-' }}</strong></td>
                </tr>
            </table>

            <table width="100%">
                <tr>
                    <td align="left" style="width: 40%;">
                        <h4><strong>VALORES</strong></h4>
                    </td>
                </tr>
                <tr>
                    <td>Precio del Vehículo:</td>
                    <td><strong>{{ $CartaDetalleSolicitud[0]->cMoneda }} {{ $CartaDetalleSolicitud[0]->fPrecioBase }}</strong></td>
                </tr>
                <tr>
                    <td>Cuota Inicial:</td>
                    <td><strong>{{ $CartaDetalleSolicitud[0]->cMoneda }} {{ $CartaDetalleSolicitud[0]->fCuotaInicial }}</strong></td>
                </tr>
                <tr>
                    <td>Monto a Desembolsar:</td>
                    <td><strong>{{ $CartaDetalleSolicitud[0]->cMoneda }} {{ $CartaDetalleSolicitud[0]->fMontoDesembolsado }}</strong></td>
                </tr>
            </table>

            <table width="100%">
                <td>
                    Nos compremetemos a gestionar la Tarjeta de Propiedad del Vehículo a nombre de
                </td>
            </table>
            <table width="100%">
                <tr>
                    <td align="center" style="width: 40%;">
                        {{ $CartaDetalleSolicitud[0]->cContacto }}
                    </td>
                </tr>
            </table>

            <table width="100%">
                <tr>
                    Quedamos de ustedes
                </tr>
                <tr>
                    Atentamente,
                </tr>
            </table>
        </div>
    </div>

    <div class="information" style="position: absolute; bottom: 0;">
        <table width="100%">
            <tr>
                <td align="center" style="width: 100%;">
                    <p>
                        Av. Panamericana Norte S**N Ex Fundo Iris - J.L.O - Teléfono (074) - 606400
                    </p>
                </td>
            </tr>
            <tr>
                <td align="center" style="width: 100%;">
                    <span>
                        <u>contactanos@gpsinka.com</u>,
                        <u>atencion.cliente@gpsinka.com</u>
                    </span>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
