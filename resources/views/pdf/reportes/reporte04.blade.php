<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tiempo medio invertido desde la prospección hasta el pedido por vendedor y a nivel general </title>
    <style>
        section {
            padding: 20px 0;
            display: block;
        }
        .container-fluid {
            padding: 0 5px;
            width: 100%;;
            margin-right: auto;
            margin-left: auto;
        }
        .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col, .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm, .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md, .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg, .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl, .col-xl-auto{
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }
        .card {
            position: relative;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-clip: border-box;
        }
        .card {
            margin-bottom: 15px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1), -1px 0 2px rgba(0, 0, 0, 0.05);
        }
        .card {
            background-color: #fff;
            border: 0 solid #eee;
            border-radius: 0;
        }
        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }
        .card-body {
            padding: 0.75rem;
        }
        .card-header{
            margin-bottom: 0;
        }
        .card-header {
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.05);
            padding: 0.40rem 1.25rem;
        }
        .card-header {
            border-bottom: 1px solid #eee;
        }
        .card-header:first-child {
            border-radius: 0 0 0 0;
        }
        .card-header h1, .card-header h3, .card-header h4, .card-header h5, .card-header h6 {
            margin-bottom: 0;
            color: #fff;
            font-size: 0.9rem;
            font-family: 'DIN';
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        table {
            border-collapse: collapse;
        }
        table {
            font-size: 0.7em;
            color: #666;
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        td, th {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
        }
        th {
            text-align: inherit;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table-sm th, .table-sm td {
            padding: 0.3rem;
            white-space: nowrap;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        @media (min-width: 992px) {
            .col-lg-12 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <section class="form">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">REPORTE</h3>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Cargo</th>
                                                            <th>Fecha Cotización</th>
                                                            <th>Fecha Pedido Culminado</th>
                                                            <th>Tiempo Invertido</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($reportes as $a)
                                                        <tr>
                                                            <td>{{$a->cUsuarioCotizacion}}</td>
                                                            <td>{{$a->cGrupoPertenece}}</td>
                                                            <td>{{$a->cFechaCotizacion}}</td>
                                                            <td>{{$a->cFechaPedidoCerradoPorVenta}}</td>
                                                            <td>{{$a->dTiempoInvertido}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
