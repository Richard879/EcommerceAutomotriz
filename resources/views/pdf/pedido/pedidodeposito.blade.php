<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedido {{ $arrayDepositosPorPedido[0]->cNumeroPedido }} </title>
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
                <td align="top">
                    <img src="{{$logo}}" alt="" width="210" height="75"/>
                </td>
                <td align="right">
                    <img src="{{$hyundai}}" alt="" width="175" height="75"/>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <h3>{{ $arrayDepositosPorPedido[0]->cSucursal }} - {{ $arrayDepositosPorPedido[0]->cDireccionSucursal }}</h3>
                </td>
                <td align="right">
                    <h3>{{ $arrayDepositosPorPedido[0]->dFechaPedido }}</h3>
                    <pre>
                        {{ $arrayDepositosPorPedido[0]->cNumeroPedido }}
                    </pre>
                </td>
            </tr>
        </table>
    </div>

    <div class="padding">
        <table width="100%">
            <tr>
                <td>Nombre/Razón Social:</td>
                <td colspan="85"><strong>{{ $arrayDepositosPorPedido[0]->cContacto }}</strong></td>
            </tr>
            <tr>
                <td>Dirección:</td>
                <td><strong>{{ $arrayDepositosPorPedido[0]->cDireccion }}</strong></td>
            </tr>
            <tr>
                <td>DNI/RUC:</td>
                <td><strong>{{ $arrayDepositosPorPedido[0]->cNumeroDocumento }}</strong></td>
            </tr>
            <tr>
                <td>Telf. Fijo:</td>
                <td><strong>{{ $arrayDepositosPorPedido[0]->cTelefonoFijo }}</strong></td>
            </tr>
            <tr>
                <td>Telf. Celular:</td>
                <td><strong>{{ $arrayDepositosPorPedido[0]->cTelefonoMovil }}</strong></td>
            </tr>
        </table>
    </div>

    <br/>

    @if (count($arrayDepositosPorPedido) > 0)
        <div class="invoice">
            <table width="100%">
                <thead style="background-color: lightgray;">
                    <tr align="center" align="middle" >
                        <th colspan="8">BANDEJA DE DEPOSITOS</th >
                    </tr>
                    <tr>
                        <th>BANCO</th>
                        <th>N° OPERACIÓN</th>
                        <th>MONEDA</th>
                        <th>FECHA</th>
                        <th>TC</th>
                        <th>MONTO S/</th>
                        <th>MONTO USD/</th>
                        <th>ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($arrayDepositosPorPedido) > 0)
                        @foreach ($arrayDepositosPorPedido as $deposito)
                            <tr>
                                <td> {{ $deposito->cNombreBanco }} </td>
                                <td> {{ $deposito->nNumeroOperacion }} </td>
                                <td> {{ $deposito->cNombreMoneda }} </td>
                                <td> {{ $deposito->dFechaDeposito }} </td>
                                <td> {{ $deposito->fTipoCambio }} </td>
                                <td> {{ number_format($deposito->fMontoSoles, 2)  }} </td>
                                <td> {{ number_format($deposito->fMontoDolares, 2) }} </td>
                                <td> {{ $deposito->cEstadoDeposito }} </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            @if ($fMontoPedido > 0)
                <table width="100%" >
                    <tr>
                        <td align="right" colspan="1">
                            <span>Monto Depositado</span>
                            <br>
                            <strong><span>{{ number_format($fMontoDepositado, 2) }}</span></strong>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" colspan="1">
                            <span>Monto del Pedido</span>
                            <br>
                            <strong><span>{{ number_format($fMontoPedido, 2) }}</span></strong>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" colspan="1">
                            <span>Saldo Cancelado</span>
                            <br>
                            <strong><span>{{ number_format($fMontoCancelado, 2) }}</span></strong>
                        </td>
                    </tr>
                </table>
            @endif
        </div>
    @endif
</body>
