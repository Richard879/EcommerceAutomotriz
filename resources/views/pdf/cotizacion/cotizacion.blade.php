<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cotización</title>
    <style type="text/css">
        @page {
            margin: 0px;
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
            background-color: #60A7A6;
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
                <td valign="top">
                    <img src="{{$logo}}" alt="" width="210" height="75"/>
                </td>
                <td align="right">
                    <img src="{{$hyundai}}" alt="" width="175" height="75"/>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <h3>Chiclayo - Av. Mariscal Nieto #480 CC Boulevard</h3>
                </td>
                <td align="right">
                    <h3>Chiclayo Jueves, 15 de Noviembre de 2018</h3>
                    <pre>
                        N°: 22018-052079
                    </pre>
                </td>
            </tr>
        </table>
    </div>

    <div class="padding">
        <table width="100%">
            <tr>
                <td>Nombre/Razón Social: <strong>LINARES ACUNA GRICERIO</strong></td>
            </tr>
            <tr>
                <td>Dirección: <strong>CALLE 28 DE JULIO 170 POSOPE CENTRO:</strong></td>
            </tr>
            <tr>
                <td>DNI/RUC: <strong>40438902</strong></td>
                <td>Telf. Fijo: <strong>948224267</strong></td>
                <td>Telf. Fijo: <strong></strong></td>
            </tr>
            <br/>
            <tr>
                <td>
                    Estimado cliente de acuerdo con sus indicaciones se le extiende la cotización con los datos técnicos de su elección.
                </td>
            </tr>
        </table>

        <br/>

        <div class="invoice">
            <h3>GRAND I10 - GRAND I10 1.0 GL PLUS MT + ML E4 2018-2018</h3>

            <div class="center">
                <table width="80%">
                    <tr>
                        <td><h4>PRECIO DE LISTA:</h4> <strong> <h4> USD. 14090.00 </h4></strong></td>
                        <td><h3>PRECIO ESPECIAL:</h3> <strong> <h3> USD. 12790.00 </h3></strong></td>
                    </tr>
                </table>
                <table width="90%" border="2">
                    <tr align="center" valign="middle" style="background-color: lightgray;">
                        <th colspan="3">DIMENSIONES</th >
                    </tr>
                    <tr>
                        <td>RADIO MIMO DE GIRO (M.) </td>
                        <td>4.88</td>
                    </tr>
                    <tr>
                        <td>CAPACIDAD DE LA MALETERA (LTS.) </td>
                        <td>4.88</td>
                    </tr>
                </table>
                <table width="90%" border="2">
                    <tr align="center" valign="middle" style="background-color: lightgray;">
                        <th colspan="3">EQUIPAMIENTO</th >
                    </tr>
                    <tr>
                        <td>AIRE ACONDICIONADO </td>
                        <td>Si</td>
                    </tr>
                    <tr>
                        <td>AROS DE FIERRO CON VASOS 14 PULGADAS  </td>
                        <td>Si</td>
                    </tr>
                </table>
                <table width="90%" border="2">
                    <tr align="center" valign="middle" style="background-color: lightgray;">
                        <th colspan="3">FRENOS</th >
                    </tr>
                    <tr>
                        <td>FRENOS DELANTEROS </td>
                        <td>DISCOS VENTILADOS</td>
                    </tr>
                    <tr>
                        <td>FRENOS POSTERIORES</td>
                        <td>TAMBOR</td>
                    </tr>
                </table>
                <table width="90%" border="2">
                    <tr align="center" valign="middle" style="background-color: lightgray;">
                        <th colspan="3">GENERAL</th >
                    </tr>
                    <tr>
                        <td>VERSI</td>
                        <td>GL</td>
                    </tr>
                    <tr>
                        <td>NOMBRE DEL FABRICANTE</td>
                        <td>HYUNDAI MOTOR INDIA LTD</td>
                    </tr>
                </table>
                <table width="90%" border="2">
                    <tr align="center" valign="middle" style="background-color: lightgray;">
                        <th colspan="3">MOTOR</th >
                    </tr>
                    <tr>
                        <td>TIPO DE COMBUSTIBLE</td>
                        <td>GASOLINA</td>
                    </tr>
                    <tr>
                        <td>CAPACIDAD DEL TANQUE DE COMBUSTIBLE (LT/GL) </td>
                        <td>43 LT</td>
                    </tr>
                </table>
                <table width="90%" border="2">
                    <tr align="center" valign="middle" style="background-color: lightgray;">
                        <th colspan="3">SEGURIDAD</th >
                    </tr>
                    <tr>
                        <td>BARRA DE ACERO EN PUERTAS LATERALES </td>
                        <td>Si</td>
                    </tr>
                    <tr>
                        <td>CHASIS REFORZADO</td>
                        <td>Si</td>
                    </tr>
                </table>
                <table width="90%" border="2">
                    <tr align="center" valign="middle" style="background-color: lightgray;">
                        <th colspan="3">SUSPENSI</th >
                    </tr>
                    <tr>
                        <td>SUSPENSI DELANTERA </td>
                        <td>MC PHERSON</td>
                    </tr>
                    <tr>
                        <td>DIRECCI</td>
                        <td>Eltrica</td>
                    </tr>
                </table>
                <table width="90%" border="2">
                    <tr align="center" valign="middle" style="background-color: lightgray;">
                        <th colspan="3">EQUIPAMIENTO EXTERIOR</th >
                    </tr>
                    <tr>
                        <td>PARACHOQUES DEL COLOR DE LA CARROCER</td>
                        <td>Si</td>
                    </tr>
                    <tr>
                        <td>TERCERA LUZ DE FRENO </td>
                        <td>Si</td>
                    </tr>
                </table>
            </div>

            <table width="100%">
                <tr>
                    <td>Agradeceremos cancelar su vehiculo en las cuentas bancarias que a continuacion se detallan.</td>
                </tr>
            </table>

            <table width="100%">
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
                    <tr>
                        <td>Sociedad de Automotores Inka sac</td>
                        <td>Bcp (cta recaudadora, con código DNI vendedor) </td>
                        <td>Soles</td>
                        <td>305-1804427-0-42</td>
                        <td>002-305-001804427042-11 </td>
                    </tr>
                    <tr>
                        <td>Sociedad de Automotores Inka sac</td>
                        <td>Bcp (cta recaudadora, con código DNI vendedor) </td>
                        <td>Dolares</td>
                        <td>305-1841523-1-59 </td>
                        <td>002-305-001841523159-18 </td>
                    </tr>
                </tbody>
            </table>
            <table width="100%">
                <thead style="background-color: lightgray;">
                    <tr>
                        <th>Razon Social</th>
                        <th>Agente</th>
                        <th>Banco</th>
                        <th>Moneda</th>
                        <th>Código a indicar  </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sociedad de Automotores Inka sac</td>
                        <td>AGENTE BCP (cta recaudadora, con código DNI vendedor) </td>
                        <td>Bcp</td>
                        <td>Soles/dolares</td>
                        <td>17262</td>
                    </tr>
                    <tr>
                        <td>Sociedad de Automotores Inka sac</td>
                        <td>AGENTE CONTINENTAL (cta recaudadora, con código DNI vendedor) </td>
                        <td>Bbva</td>
                        <td>Soles</td>
                        <td>10300</td>
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
                    </td>
                </tr>
                <tr>
                    <td class="justify">
                        Sin otro particular quedamos de usted a su pleno servicio. Atentamente.
                    </td>
                </tr>
            </table>

            <br/>

            <table width="100%">
                <tr>
                    <td align="left" style="width: 40%;">
                        <span>_____________________________</span>
                        <h3>JOSE FERNANDO ANDALUZ SCHAUS</h3>
                        <pre>
                            ASESOR COMERCIAL
                            Telf : (051)(074)271036
                            Cel : 978728115
                            Email : jose.andaluz@gpsinka.com
                        </pre>
                    </td>
                    <td align="center">

                    </td>
                    <td align="right" style="width: 40%;">
                        <span>____________________________________</span>
                        <h3>FRANCISCO ALBERTO GUZMAN VALERA</h3>
                        <pre>
                            Jefe de Ventas
                        </pre>
                    </td>
                </tr>
            </table>

            <br/>

            <table width="100%">
                <tr>
                    <td align="left" style="width: 40%;">
                    </td>
                    <td align="center" style="width: 40%;">
                        <span>____________________________________</span>
                        <h3>CLIENTE : LINARES ACUNA GRICERIO</h3>
                        <pre>
                            DOC IDEN: 40438902
                        </pre>
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
                    Esta cotización vencerá en 5 días Nro Cotización: 22018-052079.<br>
                    &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
                </td>
                <td align="right" style="width: 50%;">
                    Sociedad de Automotores Inka sac
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
