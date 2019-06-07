<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carta de Responsabilidad {{ $arrayDetallePedido[0]->cNumeroPedido }} </title>
    <style type="text/css">
        @page {
            margin: 3rem;
            margin-top: 3.9rem;
            padding: 3rem;
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
            width:6rem !important;
            max-width:120px;
            height:7rem;
            max-height:40px;
            position:relative;
            border: 1px solid;
            margin-left: .5rem;
            font-weight: bolder;
        }
        .center{
            text-align: center;
        }
        .justify{
            text-align: justify !important;
            font-size: 1.1rem;
        }
        .right{
            text-align: right !important;
            font-size: 1.1rem;
        }
        .marginTB{
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
        .titulo{
            font-size: 1.3rem;
        }
    </style>
</head>
<body>
    <div class="padding center">
        <table width="100%" >
            <tr>
                <br><br><br><br>
                <br><br><br><br>
                <td colspan="2" class="marginTB titulo" align="center"><strong><ins>CARTA DE RESPONSABILIDAD</ins></strong></td>
            </tr>
            <tr>
                <td colspan="2" class="justify">Por el presente documento, yo {{ $arrayDetallePedido[0]->cContacto }} identificado(a) con Documento Nº {{ $arrayDetallePedido[0]->cNumeroDocumento }}, con domicilio en {{ $arrayDetallePedido[0]->cDireccion }}, declaro lo siguiente:</td>
            </tr>
            <tr>
                <td colspan="2">
                    <ol>
                        <li value="1" class="justify">
                            Haber recibido de {{ $arrayDetallePedido[0]->cNombreEmpresa }}., en adelante {{ $arrayDetallePedido[0]->cEmpresa }}, “El Vehículo” de mi propiedad sin tarjeta de propiedad y sin placa de rodaje, a mi expresa solicitud, a mi entera satisfacción y bajo mi exclusiva responsabilidad.
                        </li>
                        <br><br>
                        <li value="2" class="justify">
                            "El Vehículo" tiene las siguientes características y especificaciones:
                            <br>
                            <table>
                                <tr>
                                    <td>MARCA  : </td>
                                    <td<strong> {{ $arrayDetallePedido[0]->cNombreMarca }} </strong></td>
                                </tr>
                                <tr>
                                    <td>MODELO  : </td>
                                    <td<strong> {{ $arrayDetallePedido[0]->cNombreModelo }} </strong></td>
                                </tr>
                                <tr>
                                    <td>AÑO FAB/MOD  : </td>
                                    <td<strong> {{ $arrayDetallePedido[0]->cAnioFabMod }} </strong></td>
                                </tr>
                                <tr>
                                    <td>Nª CHASIS  : </td>
                                    <td<strong> {{ $arrayDetallePedido[0]->cNumeroVin }} </strong></td>
                                </tr>
                                <tr>
                                    <td>COLOR  : </td>
                                    <td<strong> {{ $arrayDetallePedido[0]->cNombreColor }} </strong></td>
                                </tr>
                            </table>
                            <br>
                        </li>
                        <li value="3" class="justify">
                            Acepto mi exclusiva responsabilidad por cualquier siniestro, accidente y/o indemnización por daños y perjuicios que pudieran producirse a terceros en su persona física o en sus bienes, con motivo del uso del vehículo o por cualquier otra persona que lo hiciere con o sin mi consentimiento. En el caso que; como consecuencia de alguno de los supuestos mencionados en el punto anterior; {{ $arrayDetallePedido[0]->cEmpresa }} se vea involucrado en algún proceso administrativo o judicial o de cualquier otra naturaleza, me comprometo a asumir los costos y costas del proceso, así como el monto que ordene la autoridad en pagar por cualquier concepto ya sea al suscrito o a {{ $arrayDetallePedido[0]->cEmpresa }}.
                            <br>
                        </li>
                        <li value="4" class="justify">
                            Acepto asumir ilimitadamente las obligaciones derivadas de la aplicación de las sanciones, penas o multas por infracciones de tránsito o de los reglamentos municipales, debiendo comparecer ante las autoridades que correspondan a afectos de asumir el compromiso declarado en el presente punto.
                            <br>
                        </li>
                        <li value="5" class="justify">
                            Acepto reembolsar cualquier suma que {{ $arrayDetallePedido[0]->cEmpresa }} tuviera que pagar en adelante, en relación al vehículo de mi propiedad.
                            <br>
                        </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="justify">Cumplo con legalizar mi firma en señal de conformidad.</td>
            </tr>
            <tr>
                <td colspan="1" class="justify"></td>
                <td colspan="1" class="right">{{ $arrayDetallePedido[0]->cFechaGenerado }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="invoice">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="left" style="width: 40%;"></td>
                                <td align="center" style="width: 40%;">
                                    <h3>_____________________________</h3>
                                    <h3>Firma Cliente</h3>
                                    <h3>DNI N°: __________________</h3>
                                </td>
                                <td align="right">
                                    <div class="cuadrado"></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <br/>
</body>
