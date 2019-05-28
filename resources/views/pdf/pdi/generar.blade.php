<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDI {{ $arrayPdi[0]->cNumeroInspeccion }} </title>
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
            font-size: .5rem;
            border: 1px solid black;
            width: 100% !important;
        }
    </style>
</head>

<body>
    <div class="information">
        <table width="100%" cellpadding="0" cellspacing="0">
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
        <table width="100%">
            <tr>
                <td>Fecha Inspección:</td>
                <td colspan="85"><strong>{{ $arrayPdi[0]->dFechaInspeccion }} - {{ $arrayPdi[0]->cHoraInspeccion }}</strong></td>
            </tr>
            <tr>
                <td>Tipo Inspección:</td>
                <td colspan="85"><strong>{{ $arrayPdi[0]->cNombreTipoInspeccion }}</strong></td>
            </tr>
            <tr>
                <td>Tipo Movimiento:</td>
                <td colspan="85"><strong>{{ $arrayPdi[0]->cFlagTipoMovimiento }}</strong></td>
            </tr>
            <tr>
                <td>VIN:</td>
                <td><strong>{{ $arrayPdi[0]->cNumeroVin }}</strong></td>
            </tr>
            <tr>
                <td>Nombre Comercial - Año:</td>
                <td><strong>{{ $arrayPdi[0]->cNombreComercial }} - {{ $arrayPdi[0]->nAnioModelo }} </strong></td>
            </tr>
            <tr>
                <td>Almacen - Código:</td>
                <td><strong>{{ $arrayPdi[0]->cWhsName }} - {{ $arrayPdi[0]->cWhsCode }} </strong></td>
            </tr>
        </table>

        <br/>

        <div class="invoice">
            @if (sizeof($arrayDetalleAccesorio) > 0)
                <table class="tblBanco" border="2px">
                    <thead style="background-color: lightgray;">
                        <tr align="center" valign="middle" >
                            <th colspan="5">LISTA DE ACCESORIOS</th >
                        </tr>
                        <tr>
                            <th>Tipo Elemento</th>
                            <th>ERP</th>
                            <th>Accesorio</th>
                            <th>Cantidad</th>
                            <th>Moneda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arrayDetalleAccesorio as $accesorio)
                            <tr>
                                <td> {{ $accesorio->cTipoElemenNombre }} </td>
                                <td> {{ $accesorio->cCodigoERP }} </td>
                                <td> {{ $accesorio->cNombre }} </td>
                                <td> {{ $accesorio->nCantidad }} </td>
                                <td> {{ $accesorio->cMonedaNombre }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table class="tblBanco" border="2px">
                    <thead style="background-color: lightgray;">
                        <tr align="center" valign="middle" >
                            <th colspan="5">NO EXISTE LISTA DE ACCESORIOS</th >
                        </tr>
                    </thead>
                </table>
            @endif
        </div>
    </div>
</body>