<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>DETALLE SOLICITUD </title>
    <style>
        .modal-content {
            position: relative;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 0.3rem;
            outline: 0;
        }
        .modal-content {
            border-radius: 0;
        }
        .modal-body {
            position: relative;
            padding: 1rem;
        }
        form {
            display: block;
            margin-top: 0em;
        }
        .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col, .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm, .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md, .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg, .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl, .col-xl-auto {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }
        .card {
            background-color: #fff;
            border: 0 solid #eee;
            border-radius: 0;
        }
        .card {
            margin-bottom: 15px;
            -webkit-box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1), -1px 0 2px rgba(0, 0, 0, 0.05);
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1), -1px 0 2px rgba(0, 0, 0, 0.05);
        }
        .card {
            position: initial;
            -ms-flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }
        .card-header h1, .card-header h3, .card-header h4, .card-header h5, .card-header h6 {
            margin-bottom: 0;
            color: #fff;
            font-size: 0.9rem;
            font-family: 'DIN';
        }
        .card-header {
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
        .card-header {
            -webkit-box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.05);
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.05);
            padding: 0.20rem 1.25rem;
        }
        .card-header {
            background-color: #36A0FF;
            border-bottom: 1px solid #eee;
        }
        .card-header:first-child {
            border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
        }
        .card-header:first-child {
            border-radius: 0 0 0 0;
        }
        h4, .h4 {
            font-size: 1.1rem;
        }
        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
            margin-bottom: 0.5rem;
            font-family: inherit;
            font-weight: 700;
            line-height: 1.1;
            color: inherit;
        }
        h4, .h4 {
            font-size: 1.5rem;
        }
        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
            margin-bottom: 0.5rem;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.2;
            color: inherit;
        }
        .d-flex {
            text-align: center;
            float: initial
        }
        .card-body {
            padding: 0.35rem;
        }
        .form-group {
            margin-bottom: 0.25rem;
        }
        .row {
            margin-right: -15px;
            margin-left: -15px;
        }
        .inline-label{
            margin-bottom: .1rem;
        }
        label {
            cursor: default;
        }
        label {
            display: inline-block;
            margin-bottom: .25rem;
        }
        .form-control-label {
            font-size: 12px;
            color: rgba(118, 118, 118, 1.0);
            font-weight: 500;
            text-align: left;
        }
        .form-control-label-readonly {
            font-size: 12px;
            color: #495057;
            font-weight: 600;
            text-align: left;
            padding-top: 5px;
            background-color: #e9ecef;
            opacity: 1;
            width: 100%;
            padding: 0.25rem 0.5rem;
        }
        .menosPadding{
            padding: .21rem;
            font-size: 1.2rem;
        }
        .subCabecera{
            justify-content: center;
            padding: .21rem;
            background: white;
        }
        .subCabecera>h3{
            color: black;
            font-weight: bolder;
        }
        .flexLeft{
            width: 100%;
        }
        .flexLeft>h4{
            float: left;
            font-weight: bolder;
        }
        .flexRight{
            float: right;
        }
        @media (min-width: 576px){
            .col-sm-6 {
                max-width: 50%;
            }
            .col-sm-4 {
                max-width: 33.333333%;
            }
            .col-sm-8 {
                max-width: 66.666667%;
            }
        }
        @media (min-width: 768px){
            .col-md-5 {
                max-width: 41.666667%;
            }
            .offset-md-7 {
                margin-left: 58.333333%;
            }
        }
        @media (min-width: 992px){
            .col-lg-12 {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="modal-content">
        <div class="modal-body menosPadding">
            <form class="form-horizontal">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="h4">{{ $objDetalleSolicitudAutorizacion['cTipoSolicitud']}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <span class="form-control-label">Tipo Solicitud</span>
                                                        <strong  class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cTipoSolicitud']}}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <span class="form-control-label">Marca</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cNombreMarca']}}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <span class="form-control-label">Modelo</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cNombreModelo']}}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <span class="form-control-label">Año/Modelo</span>
                                                        <strong  class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cAnioModelo']}}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label >
                                                        <span class="form-control-label">Color</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cNombreColor']}}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label >
                                                        <span class="form-control-label">Nª VIN</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cNroVehiculo']}}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label >
                                                        <span class="form-control-label">Contacto</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cContacto']}}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label >
                                                        <span class="form-control-label">Nª Documento</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cNumeroDocumento']}} </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label >
                                                        <span class="form-control-label">Asesor Encargado</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cAsesorEncargado']}} </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label >
                                                        <span class="form-control-label">Jefe de Ventas</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cNombreSupervisorInmediato']}} </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label >
                                                        <span class="form-control-label">Lugar de Partida</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cLugarPartida']}} </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label >
                                                        <span class="form-control-label">Lugar de Llegada</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cLugarLlegada']}} </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label >
                                                        <span class="form-control-label">Fecha</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cFechaSolicitud']}} </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row inline-label">
                                                <div class="col-sm-12">
                                                    <label >
                                                        <span class="form-control-label">Hora</span>
                                                        <strong class="form-control-label-readonly">{{ $objDetalleSolicitudAutorizacion['cHoraMovimientoVehiculo']}} </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
