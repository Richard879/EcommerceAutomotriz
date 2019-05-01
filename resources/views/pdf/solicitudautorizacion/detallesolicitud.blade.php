<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>DETALLE SOLICITUD </title>
    <style type="text/css">
        @page {
            margin: 1.3rem;
            margin-top: 1.9rem;
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
             /*background-color: #60A7A6;*/
             background-color: #FEFEFE;
            color: #000;
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
                    <td align="center" style="width: 40%;">
                       <strong> {{ $objDetalleSolicitudAutorizacion['cTipoSolicitud'] }}</strong>
                    </td>
                </tr>
            </table>
            <br>

            <table width="100%">
                <tr>
                    <td>Tipo Solicitud:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cTipoSolicitud'] }}</strong></td>
                </tr>
                <tr>
                    <td>Marca:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cNombreMarca'] }}</strong></td>
                </tr>
                <tr>
                    <td>Modelo:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cNombreModelo'] }}</strong></td>
                </tr>
                <tr>
                    <td>Año/Modelo:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cAnioModelo'] }}</strong></td>
                </tr>
                <tr>
                    <td>Color:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cNombreColor'] }}</strong></td>
                </tr>
                <tr>
                    <td>Nª VIN:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cNroVehiculo'] }}</strong></td>
                </tr>
                <tr>
                    <td>Contacto:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cContacto'] }}</strong></td>
                </tr>
                <tr>
                    <td>Nª Documento:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cNumeroDocumento'] }}</strong></td>
                </tr>
                <tr>
                    <td>Asesor Encargado:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cAsesorEncargado'] }}</strong></td>
                </tr>
                <tr>
                    <td>Jefe de Ventas:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cNombreSupervisorInmediato'] }}</strong></td>
                </tr>
                <tr>
                    <td>Lugar de Partida:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cLugarPartida'] }}</strong></td>
                </tr>
                <tr>
                    <td>Lugar de Llegada:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cLugarLlegada'] }}</strong></td>
                </tr>
                <tr>
                    <td>Fecha:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cFechaSolicitud'] }}</strong></td>
                </tr>
                <tr>
                    <td>Hora:</td>
                    <td><strong>{{ $objDetalleSolicitudAutorizacion['cHoraMovimientoVehiculo'] }}</strong></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
