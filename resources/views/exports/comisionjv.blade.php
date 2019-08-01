<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $arrayComision[0]->JEFE_VENTAS }} </title>
</head>
<body>
    <table>
        <tr>
            {{--  colspan="85"  --}}
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $arrayComision[0]->JEFE_VENTAS }}</td>
            <td><strong>{{ number_format($arrayComision[0]->JEFE_VENTAS_COMISION, 2) }}</strong></td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>FECHA</th>
                <th>VIN</th>
                <th>PEDIDO</th>
                <th>CODV</th>
                <th>CLIENTE</th>
                <th>MODELO</th>
                <th>PRECIO_CIERRE_LISTA_DE_PRECIO</th>
                <th>SOBRE_PRECIO</th>
                <th>DESC_CONCESIONARIO</th>
                <th>COMP_COM</th>
                <th>COM_USD</th>
                <th>COM_SOLES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arrayComision as $key => $comision)
                <tr>
                    <td> {{ ($key+1) }} </td>
                    <td> {{ $comision->FECHA }} </td>
                    <td> {{ $comision->VIN }} </td>
                    <td> {{ $comision->PEDIDO }} </td>
                    <td> {{ $comision->VENDEDOR }} </td>
                    <td> {{ $comision->CLIENTE }} </td>
                    <td> {{ $comision->MODELO }} </td>
                    <td> {{ number_format($comision->PRECIO_CIERRE_LISTA_DE_PRECIO, 2) }} </td>
                    <td> {{ number_format($comision->SOBRE_PRECIO, 2) }} </td>
                    <td> {{ number_format($comision->DESC_CONCESIONARIO, 2) }} </td>
                    <td> {{ number_format($comision->COMP_COM, 2) }} </td>
                    <td> {{ number_format($comision->COM_USD, 2) }} </td>
                    <td> {{ number_format($comision->COM_SOLES, 2) }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table>
        <tr>
            {{--  colspan="85"  --}}
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>*T/C = Promedio de todas las ventas</td>
            <td><strong>{{ $arrayComision[0]->TIPOCAMBIO }}</strong></td>
        </tr>
    </table>
</body>
</html>
