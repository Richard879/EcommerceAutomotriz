<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedido {{ $arrayDetallePedido[0]->cNumeroPedido }} </title>
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
        <table width="100%">
            <tr>
                <td valign="top">
                    <img src="{{$logo}}" alt="" width="210" height="75"/>
                </td>
                <td align="right">
                    <img src="{{$hyundai}}" alt="" width="175" height="75"/>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <h3>{{ $arrayDetallePedido[0]->cSucursal }} - {{ $arrayDetallePedido[0]->cDireccionSucursal }}</h3>
                </td>
                <td align="right">
                    <h3>{{ $arrayDetallePedido[0]->cFechaPedido }}</h3>
                    <pre>
                        {{ $arrayDetallePedido[0]->cNumeroPedido }}
                    </pre>
                </td>
            </tr>
        </table>
    </div>

    <div class="padding">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td>Nombre/Razón Social:</td>
                <td colspan="85"><strong>{{ $arrayDetallePedido[0]->cContacto }}</strong></td>
            </tr>
            <tr>
                <td>Dirección:</td>
                <td><strong>{{ $arrayDetallePedido[0]->cDireccion }}</strong></td>
            </tr>
            <tr>
                <td>DNI/RUC:</td>
                <td><strong>{{ $arrayDetallePedido[0]->cNumeroDocumento }}</strong></td>
            </tr>
            <tr>
                <td>Telf. Fijo:</td>
                <td><strong>{{ $arrayDetallePedido[0]->cTelefonoFijo }}</strong></td>
            </tr>
            <tr>
                <td>Telf. Celular:</td>
                <td><strong>{{ $arrayDetallePedido[0]->cTelefonoMovil }}</strong></td>
            </tr>
            <tr>
                <td>VIN</td>
                <td><strong> {{ $arrayDetallePedido[0]->cNumeroVin }} </strong></td>
            </tr>
        </table>

        <br/>

        <div class="invoice">
            <h3>{{ $arrayDetallePedido[0]->cNombreVehiculo }}</h3>

            <div class="center">
                <img src="{{ $arrayDetalleDocs[0]->cFotoImageUrl }}" alt="{{ $arrayDetalleDocs[0]->cNombreComercial }}" width="280" height="175" style="margin-left: 8rem">
            </div>

            <div class="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <h4>PRECIO DE LISTA:</h4>
                            <strong><h4> {{ $arrayDetallePedido[0]->cMonedaLista }}. {{ $arrayDetallePedido[0]->fPrecioLista }} </h4></strong>
                        </td>
                        <td>
                            <h2>PRECIO ESPECIAL:</h2>
                            <strong> <h2> {{ $arrayDetallePedido[0]->cMonedaLista }}. {{ $arrayDetallePedido[0]->fPrecioEspecial }} </h2></strong>
                        </td>
                    </tr>
                </table>
            </div>

            <table class="tblBanco" border="2px">
                <thead style="background-color: lightgray;">
                    <tr align="center" valign="middle" >
                        <th colspan="2">DOCUMENTOS ASOCIADOS</th >
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <th>Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arrayPedidoDoumento as $doc)
                        <tr>
                            <td> {{ $doc->cParNombre }} </td>
                            <td> {{ $doc->cArchivo }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table>
                <tr>
                    <td>Agradeceremos cancelar su vehiculo en las cuentas bancarias que a continuacion se detallan.</td>
                </tr>
            </table>

            <table class="tblBanco" border="2px">
                <thead style="background-color: lightgray;">
                    <tr align="center" valign="middle" >
                        <th colspan="5">CUENTAS CORRIENTES - CODIGOS DE CUENTA BANCARIA - GPS</th >
                    </tr>
                    <tr>
                        <th>Razon Social</th>
                        <th>Banco</th>
                        <th>Moneda</th>
                        <th>Código de Cuenta </th>
                        <th>Código de Cuenta Interbancario </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arrayDatosBanco as $banco)
                        <tr>
                            <td> {{ $banco->cNombreEmpresa }} </td>
                            <td> {{ $banco->cNombreBanco }} </td>
                            <td> {{ $banco->cNombreMoneda }} </td>
                            <td> {{ $banco->cNumeroCuenta }} </td>
                            <td> {{ $banco->cNumeroCuentaIn }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="tblBanco"  border="2px">
                <thead style="background-color: lightgray;">
                    <tr>
                        <th>Razon Social</th>
                        <th>Agente (CUENTAS RECAUDADORAS)</th>
                        <th>Banco</th>
                        <th>Moneda</th>
                        <th>Código a indicar  </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sociedad de Automotores INKA</td>
                        <td>AGENTE BCP (cta recaudadora, y código vendedor) </td>
                        <td>Bcp</td>
                        <td>Soles/dolares</td>
                        <td>17262</td>
                    </tr>
                    <tr>
                        <td>Sociedad de Automotores INKA</td>
                        <td>AGENTE CONTINENTAL (cta recaudadora, y código vendedor) </td>
                        <td>Bbva</td>
                        <td>Soles</td>
                        <td>10300</td>
                    </tr>
                    <tr>
                        <td>Sociedad de Automotores INKA</td>
                        <td>AGENTE CONTINENTAL (cta recaudadora, y código vendedor) </td>
                        <td>Bbva</td>
                        <td>Dolares</td>
                        <td>10301</td>
                    </tr>
                </tbody>
            </table>

            <table width="100%">
                <tr>
                    <td class="justify">
                        El cliente libera a la empresa de cualquier responsabilidad relacionada a plazos de entrega del producto adquirido, en tanto el proceso de importación del producto
                        se encuentra bajo la dirección del concesionario o distribuidor autorizado y además está sometido a factores climáticos que acortan o aletargan el traslado del
                        producto.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        El precio del producto objeto de venta considera los gastos de internamiento, aranceles e impuestos de ley vigentes a la fecha de la presente cotización. Cualquier
                        variación posterior será asumida por cuenta y cargo del cliente.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        El producto puede ser objeto de modificaciones en su diseño, estructura o funcionamiento, de acuerdo a los nuevos conceptos de innovación del modelo y marca
                        adquirida. Estas modificaciones se efectúan sin que sea necesario autorización por parte del cliente.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        El pago de cuota inicial u otro pago a cuenta del precio del producto otorgará a SAISAC la facultad de solicitar al concesionario o distribuidor autorizado la reserva
                        o cancelar parcial o totalmente el precio del vehículo, sin que sea necesario el consentimiento del cliente
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        El pago de adelantos o cuota inicial, dará derecho al cliente de reservar la unidad en stock o en proceso de importación hasta por un plazo de 15 días .
                        Transcurrido el plazo SAISAC podrá disponer de la unidad para una venta al contado. El cliente podrá optar por la devolución de su cuota inicial o la separación de
                        otra unidad a partir del cual se inician a computar los nuevos plazos de entrega.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        Cualquier tipo de reclamo por devolución de dinero, incluida la originada por pago en exceso, se encuentra afecta al descuento de USA $. 30.50 + IGV por gastos
                        administrativos. Este descuento no se aplica al supuesto de devolución por desistimiento en cuyo caso se procede de acuerdo al lineamiento siguiente.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        El cliente declara conocer y aceptar los costos que SAISAC cobra por cada mantenimiento obligatorio del vehículo adquirido.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        Luego de entregada la cuota inicial o cuota de separación o cualquier otro pago a cuenta del precio del producto, cualquier devolución por desistimiento de la
                        operación, está afecta al descuento de USA $. 500.00 + IGV por concepto de gastos administrativos y/u operativos y/o de inversión en los que tiene que incurrir la
                        empresa para cumplir con la solicitud y decisión de compra del cliente.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        Si el desistimiento de compra se debe al no otorgamiento de crédito vehicular solicitado a una entidad bancaria no se cobra la penalidad siempre y cuando el
                        cliente, previamente al primer depósito a cuenta del precio del producto informe por escrito a la Gerencia de Administración de la empresa, su voluntad de compra
                        mediante crédito bancario lo que impedirá a la empresa realizar reserva o pago alguno al proveedor de la marca. En esta situación solo se aplicará el descuento
                        de USA $. 30.50 + IGV por gastos administrativos.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        Se exonera del descuento por gastos administrativos las devoluciones por causas imputables al proveedor que pueden deberse a la imposibilidad de entrega del
                        producto por agotamiento de stock u otros.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        Los pagos realizados por el Cliente se efectuarán a través de cheque NO NEGOCIABLE, expresado en dólares americanos girado a nombre de SOCIEDAD DE
                        AUTOMOTORES INKA SAC o mediante depósito en cuanta bancaria de propiedad de SOCIEDAD DE AUTOMOTORES INKA SAC.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        Los pagos realizados en nuevos soles siguen el mismo procedimiento que el pago en dólares, debiéndose aplicar el tipo de cambio del día de pago publicado por
                        la empresa
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        Las devoluciones al cliente se pagarán mediante cheque no negociable y en la misma moneda en la que cancelo el cliente y si la devolución es solicitada en
                        nuevos soles, igualmente, se multiplicará por el tipo de cambio del día de la devolución publicado por la empresa.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        La empresa se reserva el derecho de "NO ACEPTAR DINERO EN EFECTIVO".
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        La tramitación de emisión de placas y tarjeta de identificación vehicular es una cortesía que otorgamos a nuestros clientes. Este procedimiento administrativo está
                        sujeto a plazos, condiciones y criterios de la autoridad pública; por lo tanto SAISAC no se hace responsable por los plazos que demore la emisión de los
                        documentos mencionados.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        SAISAC actúa frente al cliente solo y exclusivamente como concesionaria de "AUTOMOTORES GILDEMEISTER PERU S.A." empresa que es la
                        REPRESENTANTE autorizada de la marca, la que brinda la garantía de fabrica del producto y con quien el cliente contrata la garantía y con ello todo tipo de
                        responsabilidad por la falta de idoneidad del vehículo.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        El cliente reconoce que el producto ofertado es uno de producción masiva y por tanto puede presentar fallas a pesar de haber sido sometido a rigurosos controles
                        de calidad. De esta manera es consciente que AUTOMOTORES GILDEMEISTER PERU S.A. garantiza solucionar inmediatamente los desperfectos de fábrica que
                        se puedan presentar en cumplimiento de la garantía.
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        Los gastos adicionales, extraordinarios u otros que surjan, a los de placas y tarjeta de identificación vehicular, sean necesarios o no para el cumplimiento del
                        registro vehicular (legalización de firmas, formularios notariales, copias certificadas, garantías mobiliarias, etc.) no están cubiertos en la cortesía especificada en el
                        párrafo anterior y son de cuenta del cliente.
                        <br>
                        Sin otro particular quedamos de usted a su pleno servicio. Atentamente.
                    </td>
                </tr>
                <tr></tr>
            </table>

            <br/>

            <table width="100%">
                @if ($arrayDetallePedido[0]->cJefeVentas == '------')
                    <tr>
                        <td align="left" style="width: 40%;">
                            <h3>_____________________________</h3>
                            <h3>{{ $arrayDetallePedido[0]->cNombreAsesorComercial }}</h3>
                            <h5 class="center" style="margin-left: 19.5rem;">JEFE DE VENTAS</h5>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td align="left" style="width: 40%;">
                            <h3>_____________________________</h3>
                            <h3>{{ $arrayDetallePedido[0]->cNombreAsesorComercial }}</h3>
                            <h5 class="center">ASESOR COMERCIAL</h5>
                        </td>
                        <td align="center"></td>
                        <td align="right" style="width: 40%;">
                            <h3>_____________________________</h3>
                            <h3>{{ $arrayDetallePedido[0]->cJefeVentas }}</h3>
                            <h5 class="center" style="margin-right: 6rem">JEFE DE VENTAS</h5>
                        </td>
                    </tr>
                @endif
            </table>

            <br/>

            <table width="100%">
                <tr>
                    <td align="left" style="width: 40%;"></td>
                    <td align="center" style="width: 40%;">
                        <h3>_____________________________</h3>
                        <h3>CLIENTE : {{ $arrayDetallePedido[0]->cContacto }}</h3>
                        <pre>DOC IDEN: {{ $arrayDetallePedido[0]->cNumeroDocumento }}</pre>
                    </td>
                    <td align="right" style="width: 40%;">
                        <div class="cuadrado"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="information" style="position: absolute; bottom: 0;">
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    &copy; {{ date('Y') }} - All rights reserved.
                </td>
                <td align="right" style="width: 50%;">
                    {{ $arrayDetallePedido[0]->cEmpresa }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
