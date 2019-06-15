<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REQUERIMIENTO VEHICULAR {{ $arrayDetallePedido[0]->cNumeroCotizacion }} </title>
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
        .tblBanco {
            font-size: .75rem;
            border: 1px solid black;
            width: 100% !important;
        }
    </style>
</head>
<body>
    <div class="padding">
        <table width="100%" class="tblBanco" align="right" cellspacing="0" cellpadding="1" border="1">
            <tr>
                <td colspan="2" class="text-align:'center';" align="center" >REQUERIMIENTO VEHICULAR</td>
            </tr>
            <tr>
                <td>RAZON SOCIAL</td>
                <td><strong>{{ $arrayDetallePedido[0]->cRazonSocialReq }}</strong></td>
            </tr>
            <tr>
                <td>N° RUC</td>
                <td><strong>{{ $arrayDetallePedido[0]->cRucReq }}</strong></td>
            </tr>
            <tr>
                <td>NOMBRES Y APELLIDOS</td>
                <td><strong>{{ $arrayDetallePedido[0]->cNombreCompletoReq }}</strong></td>
            </tr>
            <tr>
                <td>N° DNI</td>
                <td><strong>{{ $arrayDetallePedido[0]->cNumeroDocumentoReq }}</strong></td>
            </tr>
            <tr>
                <td>ESTADO CIVIL</td>
                <td><strong>{{ $arrayDetallePedido[0]->cEstadoCivilReq }}</strong></td>
            </tr>
            <tr>
                <td>DIRECCION</td>
                <td><strong>{{ $arrayDetallePedido[0]->cDireccion }}</strong></td>
            </tr>
            <tr>
                <td>E-MAIL</td>
                <td><strong>{{ $arrayDetallePedido[0]->cEmail }}</strong></td>
            </tr>
            <tr>
                <td>N° TELEFONICO</td>
                <td><strong>{{ $arrayDetallePedido[0]->cTelefonoMovil }}</strong></td>
            </tr>
            <tr>
                <td>TIPO COMPROBANTE</td>
                <td><strong>FACTURA <input type="checkbox" style="margin-top: .4rem"> BOLETA <input type="checkbox" style="margin-top: .4rem"> </strong></td>
            </tr>
            <tr>
                <td>COTIZACION</td>
                <td><strong>{{ $arrayDetallePedido[0]->cNumeroCotizacion }}</strong></td>
            </tr>
            <tr>
                <td>MARCA</td>
                <td><strong>{{ $arrayDetalleVIN[0]->cNombreMarca }}</strong></td>
            </tr>
            <tr>
                <td>MODELO</td>
                <td><strong>{{ $arrayDetalleVIN[0]->cNombreModelo }}</strong></td>
            </tr>
            <tr>
                <td>COLOR</td>
                <td><strong>{{ $arrayDetalleVIN[0]->cNombreColor }}</strong></td>
            </tr>
            <tr>
                <td>VIN</td>
                <td><strong>{{ $arrayDetalleVIN[0]->cNumeroVin }}</strong></td>
            </tr>
            <tr>
                <td>MOTOR</td>
                <td><strong>{{ $arrayDetalleVIN[0]->cNumeroMotor }}</strong></td>
            </tr>
            <tr>
                <td>AÑO MODELO</td>
                <td><strong>{{ $arrayDetalleVIN[0]->nAnioVersion }}</strong></td>
            </tr>
            <tr>
                <td>CONVERSION A GAS</td>
                <td><strong>SI <input type="checkbox" style="margin-top: .4rem"> NO <input type="checkbox" style="margin-top: .4rem"> </strong></td>
            </tr>
            <tr>
                <td>PRECIO CIERRE VEHICULO ($)</td>
                <td><strong>{{ $arrayDetallePedido[0]->fTotalCotizacionVehiculoDolarReq }}</strong></td>
            </tr>
            <tr>
                <td>PRECIO CIERRE VEHICULO (S/.)</td>
                <td><strong>{{ $arrayDetallePedido[0]->fTotalCotizacionVehiculoSolReq }}</strong></td>
            </tr>
            <tr>
                <td>DESCUENTO</td>
                <td><strong>{{ number_format($arrayDetallePedido[0]->fDescuentoReq, 2) }}</strong></td>
            </tr>
            <tr>
                <td>SOBRE PRECIO</td>
                <td><strong>{{ number_format($arrayDetallePedido[0]->fSobrePrecioReq, 2) }}</strong></td>
            </tr>
            <tr>
                <td>FECHA</td>
                <td><strong>{{ $arrayDetallePedido[0]->dFechaReq }}</strong></td>
            </tr>
            <tr>
                <td>VENDEDOR</td>
                <td><strong>{{ $arrayDetallePedido[0]->cNombreAsesorComercial }}</strong></td>
            </tr>
            <tr>
                <td colspan="2" style="height: 1.2rem;"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-align:'center';" align="center" >MODALIDAD DE PAGO</td>
            </tr>
            <tr>
                <td colspan="2" style="margin-right: 2rem;"><strong>
                        <span> LEASING <input type="checkbox" style="margin-top: .4rem; margin-right: 1rem;"> </span>
                        <span> CRED VEHICULAR <input type="checkbox" style="margin-top: .4rem; margin-right: 1rem;"> </span>
                        <span> CONTADO <input type="checkbox" style="margin-top: .4rem; margin-right: 1rem;"> </span>
                        <span> CRED AMICAR <input type="checkbox" style="margin-top: .4rem; margin-right: 1rem;"> </span>
                        <span> CRED LETRAS <input type="checkbox" style="margin-top: .4rem; margin-right: 1rem;"> </span>
                </strong></td>
            </tr>
            <tr>
                <td colspan="2" class="text-align:'center';" align="center" >Declaro que los datos consignados en el presente documentos, son fidedignos y corresponden a la realidad.</td>
            </tr>
            <tr>
                <td colspan="2" style="height: 7rem;"></td>
            </tr>
            <tr>
                <td align="left" style="width: 40%;">
                    <h5 class="center" style="margin-left: 6rem">Firma del Jefe de Ventas</h5>
                </td>
                <td align="right" style="width: 40%;">
                    <h5 class="center"  style="margin-right: 6rem">Firma del Vendedor</h5>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
