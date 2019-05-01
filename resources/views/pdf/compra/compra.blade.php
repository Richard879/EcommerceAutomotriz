<table>
    <thead>
        <tr>
            <th>Codigo Compra</th>
            <th>Anio</th>
            <th>Mes</th>
            <th>Linea</th>
            <th>Almacen</th>
            <th>VIN</th>
            <th>Color</th>
            <th>Forma Pago</th>
            <th>Anio Version</th>
            <th>Modelo</th>
            <th>Moneda</th>
            <th>Total Compra</th>
            <th>Serie Comprobante</th>
            <th>Numero Comprobante</th>
            <th>Numero Factura</th>
            <th>Fecha Facturado</th>
            <th>Fecha Compra</th>
            <th>Numero Comprobante</th>
        </tr>
    </thead>
    <tbody>
        @foreach($compras as $compra)
            <tr>
                <td>{{ $compra->nIdCompra }}</td>
                <td>{{ $compra->cAnio }}</td>
                <td>{{ $compra->cMes }}</td>
                <td>{{ $compra->cNombreLinea }}</td>
                <td>{{ $compra->cNombreAlmacen }}</td>
                <td>{{ $compra->cNumeroVin }}</td>
                <td>{{ $compra->cNombreColor }}</td>
                <td>{{ $compra->cFormaPago }}</td>
                <td>{{ $compra->nAnioVersion }}</td>
                <td>{{ $compra->cNombreModelo }}</td>
                <td>{{ $compra->cSimboloMoneda }}</td>
                <td>{{ $compra->fTotalCompra }}</td>
                <td>{{ $compra->cSerieComprobante }}</td>
                <td>{{ $compra->cNumeroComprobante }}</td>
                <td>{{ $compra->cNumeroFactura }}</td>
                <td>{{ $compra->dFechaFacturado }}</td>
                <td>{{ $compra->dFechaCompra }}</td>
                <td>{{ $compra->cNumeroComprobante }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
