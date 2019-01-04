<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom"> PEDIDOS PARA REALIZAR DESCUENTO</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid" v-if="cflagVer">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">BUSCAR PEDIDO</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Empresa</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="cempresa" class="form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Sucursal</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="csucursal" class="form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                <div class="col-sm-8">
                                                    <el-date-picker
                                                        v-model="fillBusquedaPedido.dfechainicio"
                                                        type="date"
                                                        value-format="yyyy-MM-dd"
                                                        format="dd/MM/yyyy"
                                                        placeholder="dd/mm/aaaa">
                                                    </el-date-picker>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                <div class="col-sm-8">
                                                    <el-date-picker
                                                        v-model="fillBusquedaPedido.dfechafin"
                                                        type="date"
                                                        value-format="yyyy-MM-dd"
                                                        format="dd/MM/yyyy"
                                                        placeholder="dd/mm/aaaa">
                                                    </el-date-picker>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Nro Pedido</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="fillBusquedaPedido.cnumeropedido" @keyup.enter="listarPedidos(1)" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="fillBusquedaPedido.cnumerovin" @keyup.enter="listarPedidos(1)" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-md-4 form-control-label">Marca</label>
                                                <div class="col-md-8">
                                                    <el-select v-model="fillBusquedaPedido.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
                                                        <el-option
                                                        v-for="item in arrayMarca"
                                                        :key="item.nIdPar"
                                                        :label="item.cParNombre"
                                                        :value="item.nIdPar">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-md-4 form-control-label">Modelo</label>
                                                <div class="col-md-8">
                                                    <el-select v-model="fillBusquedaPedido.nidmodelo" filterable clearable placeholder="SELECCIONE">
                                                        <el-option
                                                        v-for="item in arrayModelo"
                                                        :key="item.nIdPar"
                                                        :label="item.cParNombre"
                                                        :value="item.nIdPar">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-5">
                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarPedidos(1)">
                                                <i class="fa fa-search"></i> Buscar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">LISTADO</h3>
                            </div>
                            <div class="card-body">
                                <template v-if="arrayPedidos.length">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Acciones</th>
                                                    <th>Nro Pedido</th>
                                                    <th>Contacto</th>
                                                    <th>Vehiculo</th>
                                                    <th>Número VIN</th>
                                                    <th>Número DUA</th>
                                                    <th>Fecha Pedido</th>
                                                    <th>Aprobación</th>
                                                    <th>Estado Pedido</th>
                                                    <th>Vendedor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="pedido in arrayPedidos" :key="pedido.nIdCabeceraPedido">
                                                    <td>
                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                            <div slot="content">Generar Dscto del Pedido {{ pedido.cNumeroPedido }}</div>
                                                            <i @click="generarDsctoPedido(0, pedido)" :style="'color:#796AEE'" class="fa-md fa fa-check"></i>
                                                        </el-tooltip>&nbsp;
                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                            <div slot="content">Ver Detalle Pedido {{ pedido.cNumeroPedido }}</div>
                                                            <i @click="abrirModal('pedido', 'detalle', pedido)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                        </el-tooltip>&nbsp;
                                                    </td>
                                                    <td v-text="pedido.cNumeroPedido"></td>
                                                    <td v-text="pedido.cContacto"></td>
                                                    <td v-text="pedido.cNombreComercial + ' ' + pedido.nAnioFabricacion + '-' + pedido.nAnioModelo"></td>
                                                    <td v-text="pedido.cNumeroVin"></td>
                                                    <td v-text="pedido.cNumeroDUA"></td>
                                                    <td v-text="pedido.dFechaPedido"></td>
                                                    <td v-text="pedido.cEstadoAprobacion"></td>
                                                    <td v-text="pedido.cEstadoPedido"></td>
                                                    <td v-text="pedido.cNombreVendedor"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <nav>
                                                    <ul class="pagination">
                                                        <li v-if="pagination.current_page > 1" class="page-item">
                                                            <a @click.prevent="cambiarPaginaPedido(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                        </li>
                                                        <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                        :class="[page==isActived?'active':'']">
                                                            <a class="page-link"
                                                            href="#" @click.prevent="cambiarPaginaPedido(page)"
                                                            v-text="page"></a>
                                                        </li>
                                                        <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                            <a @click.prevent="cambiarPaginaPedido(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template v-else>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td colspan="10">No existen registros!</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid" v-else>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">GENERAR DSCTO DEL PEDIDO {{ fillPedidoDscto.cNumeroPedido }} </h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-6 form-control-label">Monto a Descontar</label>
                                                        <div class="col-sm-6">
                                                            <input type="number"
                                                                   min="0"
                                                                   v-model="fillPedidoDscto.dMontoDescontar"
                                                                   @keyup="calcularNuevoMonto(2, fillPedidoDscto.dMontoDescontar)"
                                                                   class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="form-control-label">
                                                            <el-radio-group v-model="fillPedidoDscto.cTipoDscto" @change="cambiarTipoDscto">
                                                                <el-radio v-for="tipodsct in arrayTipoDscto" :key="tipodsct.id" :label="tipodsct.value"> {{ tipodsct.text }} </el-radio>
                                                            </el-radio-group>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-6 form-control-label">Tipo de Cambio</label>
                                                        <div class="col-sm-6">
                                                            <label class="form-control-label" v-text="fillPedidoDscto.dTipoCambioComercial"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <vs-divider border-style="solid" color="dark">
                                                CALCULO
                                            </vs-divider>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-6 form-control-label">Monto a Actual</label>
                                                        <div class="col-sm-6">
                                                            <label class="form-control-label" v-text="fillPedidoDscto.dMontoPedido" ></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-6 form-control-label">Monto a Descontar</label>
                                                        <div class="col-sm-6">
                                                            <label class="form-control-label">
                                                                USD/. {{ ((parseFloat(fillPedidoDscto.dMontoDescontarFlag)).toFixed(2)) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-6 form-control-label">Monto Nuevo</label>
                                                        <div class="col-sm-6">
                                                            <label class="form-control-label" >
                                                                USD/. {{ ((parseFloat(fillPedidoDscto.dMontoNuevoDolares)).toFixed(2)) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-6 form-control-label">Monto Nuevo</label>
                                                        <div class="col-sm-6">
                                                            <label class="form-control-label" >
                                                                S/. {{ ((parseFloat(fillPedidoDscto.dMontoNuevoSoles)).toFixed(2)) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="h4">HISTORIAL DE DESCUENTOS</h3>
                                                </div>
                                                <div class="card-body">
                                                    <template v-if="arrayHistorialPedidoDsctos.length">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Dolare</th>
                                                                        <th>Soles</th>
                                                                        <th>Descuento</th>
                                                                        <th>Tipo Cambio</th>
                                                                        <th>Tipo Historial</th>
                                                                        <th>Fecha</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(histodsctos, index) in arrayHistorialPedidoDsctos" :key="index">
                                                                        <td>{{ ((parseFloat(histodsctos.fMontoDolares)).toFixed(2)) }}</td>
                                                                        <td>{{ ((parseFloat(histodsctos.fMontoSoles)).toFixed(2)) }}</td>
                                                                        <td>{{ ((parseFloat(histodsctos.fDsctoActual)).toFixed(2)) }}</td>
                                                                        <td>{{ ((parseFloat(histodsctos.cTipoCambio)).toFixed(2)) }}</td>
                                                                        <td v-text="histodsctos.cTipoHistorial"></td>
                                                                        <td v-text="histodsctos.dFechaGeneracionDscto"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </template>
                                                    <template v-else>
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="10">No existen registros!</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button v-if="fillPedidoDscto.dMontoDescontar > 0" type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="registrarDsctoPedido()">
                                                <i class="fa fa-save"></i> REGISTRAR
                                            </button>
                                            <button type="button" class="btn btn-default btn-corner btn-sm" @click="generarDsctoPedido(1)">
                                                <i class="fa fa-arrow-left"></i> CANCELAR
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Modal Show Errors -->
            <div class="modal fade" v-if="accionmodal==1" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Automotores INKA</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detalle Pedido -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">DETALLE PEDIDO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro Pedido</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.cnumeropedido" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro Cotización</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.cnumerocotizacion" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.cdocumentocliente" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Cliente</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.cnombrecliente" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Cod. Vehículo</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.nidversionvehiculo" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Vehículo</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.cvehiculo" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* VIN</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.cnumerovin" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.cnombreproveedor" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Fecha Pedido</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.dfechapedido" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Vendedor</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.cnombrevendedor" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Total Pedido Soles</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.ftotalpedidosoles" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Total Pedido Dolares</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.ftotalpedidodolares" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <!-- DETALLE VEHICULO -->
                                        <template v-if="arrayDetallePedido.length">
                                            <vs-divider border-style="solid" color="dark">
                                                Detalle Vehículo
                                            </vs-divider>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Cod. Vehiculo</th>
                                                            <th>NombreComercial</th>
                                                            <th>Sobre Precio</th>
                                                            <th>Dscto</th>
                                                            <th>Total Soles</th>
                                                            <th>Total Dolares</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="vehiculo in arrayDetallePedido" :key="vehiculo.nIdPar" :v-if="vehiculo.cFlagTipoItem=='V'">
                                                            <td v-text="vehiculo.nIdCodigoArticulo"></td>
                                                            <td v-text="vehiculo.cNombreArticulo"></td>
                                                            <td v-text="vehiculo.fSobrePrecio"></td>
                                                            <td v-text="vehiculo.fDescuento"></td>
                                                            <td v-text="vehiculo.fSubTotalSoles"></td>
                                                            <td v-text="vehiculo.fSubTotalDolares"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                        <!-- DETALLE ELEMENTOS DE VENTA VENDIDOS -->
                                        <template v-if="arrayDetallePedido.length">
                                            <vs-divider border-style="solid" color="dark">
                                                Detalle Elementos Venta Vendidos
                                            </vs-divider>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Cod. Elemento</th>
                                                            <th>Nombre Elemento</th>
                                                            <th>Cantidad</th>
                                                            <th>Total Soles</th>
                                                            <th>Total Dolares</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="vehiculo in arrayDetallePedido" :key="vehiculo.nIdPar"
                                                            :v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='N' && vehiculo.cFlagActivaEventoCampania=='N'">
                                                            <td v-text="vehiculo.nIdCodigoArticulo"></td>
                                                            <td v-text="vehiculo.cNombreArticulo"></td>
                                                            <td v-text="vehiculo.nCantidad"></td>
                                                            <td v-text="vehiculo.fSubTotalSoles"></td>
                                                            <td v-text="vehiculo.fSubTotalDolares"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                        <!-- DETALLE ELEMENTOS DE VENTA REGALOS -->
                                        <template v-if="arrayDetallePedido.length">
                                            <vs-divider border-style="solid" color="dark">
                                                Detalle Regalos
                                            </vs-divider>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Cod. Elemento</th>
                                                            <th>Nombre Elemento</th>
                                                            <th>Cantidad</th>
                                                            <th>Total Soles</th>
                                                            <th>Total Dolares</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="vehiculo in arrayDetallePedido" :key="vehiculo.nIdPar"
                                                            :v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='S' && vehiculo.cFlagActivaEventoCampania=='N'">
                                                            <td v-text="vehiculo.nIdCodigoArticulo"></td>
                                                            <td v-text="vehiculo.cNombreArticulo"></td>
                                                            <td v-text="vehiculo.nCantidad"></td>
                                                            <td v-text="vehiculo.fSubTotalSoles"></td>
                                                            <td v-text="vehiculo.fSubTotalDolares"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                        <!-- DETALLE ELEMENTOS DE VENTA CAMPAÑAS -->
                                        <template v-if="arrayDetallePedido.length">
                                            <vs-divider border-style="solid" color="dark">
                                                Detalle Campaña
                                            </vs-divider>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Cod. Elemento</th>
                                                            <th>Nombre Elemento</th>
                                                            <th>Cantidad</th>
                                                            <th>Total Soles</th>
                                                            <th>Total Dolares</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="vehiculo in arrayDetallePedido" :key="vehiculo.nIdPar"
                                                            :v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='N' && vehiculo.cFlagActivaEventoCampania=='S'">
                                                            <td v-text="vehiculo.nIdCodigoArticulo"></td>
                                                            <td v-text="vehiculo.cNombreArticulo"></td>
                                                            <td v-text="vehiculo.nCantidad"></td>
                                                            <td v-text="vehiculo.fSubTotalSoles"></td>
                                                            <td v-text="vehiculo.fSubTotalDolares"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                        <!-- DETALLE DOCUMENTOS -->
                                        <template v-if="arrayPedidoDoumento.length">
                                            <vs-divider border-style="solid" color="dark">
                                                Documentos Asociados
                                            </vs-divider>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Archivo</th>
                                                            <th>Ver Documento</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="documento in arrayPedidoDoumento" :key="documento.nIdPar" :v-if="documento.nValida==1">
                                                            <td :style="documento.nValida==1 ? 'color:red' : ''" v-text="documento.cCaracter + ' ' + documento.cParNombre"></td>
                                                            <td v-text="documento.cArchivo"></td>
                                                            <td>
                                                                <el-tooltip class="item" :content="'Ver Pdf ' + documento.cArchivo" effect="dark" placement="top-start">
                                                                    <a :href="documento.cRutaDocumento" v-if="documento.cRutaDocumento !=''" target="_blank">
                                                                        <i class='fa-md fa fa-file'></i>
                                                                    </a>
                                                                </el-tooltip>&nbsp;
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="10">No existen registros!</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </transition>
</template>

<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                fillProveedor:{
                    nidproveedor: 0,
                    cproveedornombre: ''
                },
                arrayProveedor: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                fillBusquedaPedido:{
                    dfechainicio: '',
                    dfechafin: '',
                    cnumeropedido: '',
                    cnumerovin: '',
                    nidmarca: '',
                    nidmodelo: ''
                },
                arrayPedidos: [],
                // MODAL DETALLE PEDIDO
                fillDetallePedido:{
                    nidcabecerapedido: 0,
                    cnumeropedido: '',
                    cnumerocotizacion: '',
                    cdocumentocliente: '',
                    cnombrecliente: '',
                    nidversionvehiculo: 0,
                    cvehiculo: '',
                    cnumerovin: '',
                    cnombreproveedor: '',
                    dfechapedido: '',
                    nordencompra: '',
                    cnombrevendedor: '',
                    fpreciocierrefinalcliente: 0,
                    fflete: 0,
                    fpreciocierrelistaprecio: 0,
                    fpreciocierresistema: 0,
                    fsobreprecio: 0,
                    fdscto: 0,
                    ftotalpedidosoles: 0,
                    ftotalpedidodolares: 0
                },
                arrayDetallePedido: [],
                arrayPedidoDoumento: [],
                cflagVer: 1,
                fillPedidoDscto: {
                    nIdCabeceraPedido: '',
                    cNumeroPedido: '',
                    dMontoDescontar: 0,
                    dMontoDescontarFlag: 0,
                    dTipoCambioComercial: '',
                    cTipoDscto: '1',
                    dMontoPedido: '',
                    dMontoNuevoDolares: '',
                    dMontoNuevoSoles: '',
                    //Integración Dscto
                    nDocEntryPedido: '',
                    cItemCode: ''
                },
                arrayTipoDscto: [
                    { value: '1', text: 'USD'},
                    { value: '2', text: '%'}
                ],
                arrayHistorialPedidoDsctos: [],
                arraySapRptPedido: [],
                arraySapUpdPedido: [],
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                paginationModal: {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset:3,
                modal:0,
                accionmodal: 0,
                tituloModal:'',
                error: 0,
                errors: [],
                mensajeError: []
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
            isActivedModal: function(){
                return this.paginationModal.current_page;
            },
            pagesNumberModal: function() {
                if(!this.paginationModal.to) {
                    return [];
                }

                var from = this.paginationModal.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.paginationModal.last_page){
                    to = this.paginationModal.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
        },
        methods: {
            llenarComboMarca(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110032
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                    this.fillBusquedaPedido.nidmarca = '';
                    this.arrayModelo = [];
                    this.llenarComboModelo();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';
                axios.get(url, {
                    params: {
                        'nidmarca': this.fillBusquedaPedido.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillBusquedaPedido.nidmodelo = '';
                }).catch(error => {
                    console.log(error);
                });
            },
            listarPedidos(page){
                if(this.validarBuscarPedidos()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/pedido/GetListPedidoForDscto';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'dfechainicio': this.fillBusquedaPedido.dfechainicio,
                        'dfechafin': this.fillBusquedaPedido.dfechafin,
                        'cnumeropedido': this.fillBusquedaPedido.cnumeropedido,
                        'cnumerovin': this.fillBusquedaPedido.cnumerovin,
                        'nidmarca' : this.fillBusquedaPedido.nidmarca,
                        'nidmodelo': this.fillBusquedaPedido.nidmodelo,
                        'nidestadopedido': '',
                        'page': page
                    }
                }).then(response => {
                    this.arrayPedidos              =    response.data.arrayPedido.data;
                    this.pagination.current_page   =    response.data.arrayPedido.current_page;
                    this.pagination.total          =    response.data.arrayPedido.total;
                    this.pagination.per_page       =    response.data.arrayPedido.per_page;
                    this.pagination.last_page      =    response.data.arrayPedido.last_page;
                    this.pagination.from           =    response.data.arrayPedido.from;
                    this.pagination.to             =    response.data.arrayPedido.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            validarBuscarPedidos(){
                this.error = 0;
                this.mensajeError =[];

                /*if(!this.fillBusquedaPedido.dfechainicio){
                    this.mensajeError.push('Debe ingresar una fecha de inicio');
                }

                if(!this.fillBusquedaPedido.dfechafin){
                    this.mensajeError.push('Debe ingresar una fecha de fin');
                }*/

                let fecha_ini = moment(this.fillBusquedaPedido.dfechainicio);
                let fecha_fin = moment(this.fillBusquedaPedido.dfechafin);

                if(fecha_fin.diff(fecha_ini, 'days') < 0){
                    this.mensajeError.push('La Fecha de Fin no puede ser menor a la fecha de inicio');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarPaginaPedido(page){
                this.paginationModal.current_page=page;
                this.listarPedidos(page);
            },
            // =================================================================
            // GENERAR DESCUENO DEL PEDIDO
            // =================================================================
            limpiarFormulario(){
                this.fillPedidoDscto.nIdCabeceraPedido = '';
                this.fillPedidoDscto.cNumeroPedido = '';
                this.fillPedidoDscto.dMontoDescontar = 0;
                this.fillPedidoDscto.dMontoDescontarFlag = 0;
                this.fillPedidoDscto.dTipoCambioComercial = '';
                this.fillPedidoDscto.cTipoDscto = '1';
                this.fillPedidoDscto.dMontoPedido = '';
                this.fillPedidoDscto.dMontoNuevoDolares = '';
                this.fillPedidoDscto.dMontoNuevoSoles = '';
                this.fillPedidoDscto.nDocNum = '';
                this.arrayHistorialPedidoDsctos = [];
            },
            generarDsctoPedido(op, data = null){
                let me = this;
                this.limpiarFormulario();
                this.cflagVer = op;
                // console.log(data);

                if(op == 0) {
                    this.mostrarProgressBar();

                    this.getTipoCambio();
                    this.getHistorialDsctos(1, data);
                    this.getDatosPedido(data);
                    // this.calcularNuevoMonto(1);
                    setTimeout(function() {
                        me.calcularNuevoMonto(1);
                    }, 1200);
                }
            },
            getHistorialDsctos(page, data = null){
                var url = this.ruta + '/pedido/GetListHistorialPedidoDscto';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nIdCabeceraPedido': data.nIdCabeceraPedido,
                        'page': page
                    }
                }).then(response => {
                    this.arrayHistorialPedidoDsctos   =   response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            getTipoCambio(){
                var url = this.ruta + '/gescotizacion/GetTipoCambio';
                axios.get(url).then(response => {
                    this.fillPedidoDscto.dTipoCambioComercial = response.data[0].fValorTipoCambioComercial;
                }).then(function (response) {
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            getDatosPedido(data){
                this.fillPedidoDscto.nIdCabeceraPedido = data.nIdCabeceraPedido
                this.fillPedidoDscto.cNumeroPedido = data.cNumeroPedido
                this.fillPedidoDscto.dMontoPedido = data.fTotalPedidoDolares
                //Integración Dscto
                this.fillPedidoDscto.nDocEntryPedido = data.nDocEntryPedido
                this.fillPedidoDscto.cItemCode = data.cItemCode
            },
            calcularNuevoMonto(op, value = null){
                if(op == 1) {
                    this.fillPedidoDscto.dMontoNuevoDolares = parseFloat(this.fillPedidoDscto.dMontoPedido) - parseFloat(this.fillPedidoDscto.dMontoDescontar);
                    let montoDolares = this.fillPedidoDscto.dMontoNuevoDolares;
                    this.fillPedidoDscto.dMontoNuevoSoles   = montoDolares * parseFloat(this.fillPedidoDscto.dTipoCambioComercial);
                }
                if (op == 2) {
                    let me = this;

                    if (me.fillPedidoDscto.cTipoDscto == '1') {
                        if(parseInt(value) == '' || parseInt(value) < 0){
                            me.$message.error(`El Monto ha descontar no puede ser vacío ó menor a cero`);
                            me.fillPedidoDscto.dMontoDescontar = 0;
                            me.fillPedidoDscto.dMontoDescontarFlag = 0;
                            me.$forceUpdate();
                        }
                        me.fillPedidoDscto.dMontoDescontarFlag  = value;
                        me.fillPedidoDscto.dMontoNuevoDolares   = parseFloat(me.fillPedidoDscto.dMontoPedido) - parseFloat(me.fillPedidoDscto.dMontoDescontar);
                        let montoDolares = me.fillPedidoDscto.dMontoNuevoDolares;
                        me.fillPedidoDscto.dMontoNuevoSoles     = montoDolares * parseFloat(me.fillPedidoDscto.dTipoCambioComercial);
                    } else {
                        if(parseInt(value) < 0 || parseInt(value) > 100 || parseInt(value) == ''){
                            me.$message.error(`El Porcentaje del Monto a Descontar debe estar entre 0 - 100 %`);
                            me.fillPedidoDscto.dMontoDescontar = 0;
                            me.fillPedidoDscto.dMontoDescontarFlag = 0;
                            me.$forceUpdate();
                        }
                        let montoPorcent    =   parseFloat(me.fillPedidoDscto.dMontoDescontar) / 100;
                        let montoNuevo      =   montoPorcent * parseFloat(me.fillPedidoDscto.dMontoPedido);

                        me.fillPedidoDscto.dMontoDescontarFlag  = montoNuevo;
                        me.fillPedidoDscto.dMontoNuevoDolares   = parseFloat(me.fillPedidoDscto.dMontoPedido) - montoNuevo;
                        let montoDolares = me.fillPedidoDscto.dMontoNuevoDolares;
                        me.fillPedidoDscto.dMontoNuevoSoles     = montoDolares * parseFloat(me.fillPedidoDscto.dTipoCambioComercial);
                    }
                }
                $("#myBar").hide();
            },
            cambiarTipoDscto(){
                this.fillPedidoDscto.dMontoDescontar = 0;
                this.fillPedidoDscto.dMontoDescontarFlag = 0;
                this.calcularNuevoMonto(2, this.fillPedidoDscto.dMontoDescontarFlag);
            },
            //REGISTRO DSCTO PEDIDO//NOTA CREDITO EN SAP
            registrarDsctoPedidoSAP(){
                var url = this.ruta + '/pedido/SapSetPedidoNotaCreditoDscto';
                axios.post(url, {
                    nDocEntryPedido: this.fillPedidoDscto.nDocEntryPedido,
                    cItemCode: this.fillPedidoDscto.cItemCode,
                    dMontoNuevoSoles: this.fillPedidoDscto.dMontoNuevoSoles,
                }).then(response => {
                    console.log(response.data);
                    me.arraySapRptPedido = response.data;
                    me.arraySapRptPedido.map(function(x) {
                        me.jsonPedido= JSON.parse(x);
                        //Verifico que devuelva DocEntry
                        if(me.jsonPedido.DocEntry) {
                            console.log("Integración Nota de Credito SAP : OK");
                            console.log(me.jsonPedido.DocEntry);
                            me.arraySapUpdPedido.push({
                                'nIdCabeceraPedido': me.fillPedidoDscto.nIdCabeceraPedido.toString(),
                                'nDocEntry': parseInt(me.jsonPedido.DocEntry),
                                'nDocNum': parseInt(me.jsonPedido.DocNum),
                                'cDocType': me.jsonPedido.DocType.toString(),
                                'cLogRespuesta': response.data.toString(),
                                'cItemCode': me.jsonPedido.DocumentLines[0].ItemCode.toString()
                            });
                            //==============================================================
                            //================== ACTUALIZAR DOCENTRY PEDIDO ===============
                            setTimeout(function() {
                                me.registraroDocEntryCreditNotePedido();
                            }, 3800);
                        }
                    });
                }).catch(error => {
                    $("#myBar").hide();
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Error al Generar la Nota de Crédito Pedido SapB1!',
                    });
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            //REGISTRO DOCENTRY-PEDIDO EN SQLSERVER
            registraroDocEntryCreditNotePedido(){
                var url = this.ruta + '/pedido/SapSetPedidoNotaCreditoDscto';
                axios.post(url, {
                    'data': me.arraySapUpdPedido
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1){
                        setTimeout(function() {
                            me.registrarDsctoPedido();
                        }, 3800);
                    }else{
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Error en Actualizar Dscto Pedido!',
                        })
                    }
                }).catch(error => {
                    $("#myBar").hide();
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Error en Registrar DocEntry Nota Credito del Pedido SapB1!',
                    });
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            //GENERAR DSCTO EN PEDIDO-HISTORIAL EN SQLSERVER
            registrarDsctoPedido(){
                var url = this.ruta + '/pedido/SetHistorialPedidoDscto';
                axios.post(url, {
                    nIdCabeceraPedido: this.fillPedidoDscto.nIdCabeceraPedido,
                    dMontoNuevoDolares: this.fillPedidoDscto.dMontoNuevoDolares,
                    dMontoNuevoSoles: this.fillPedidoDscto.dMontoNuevoSoles,
                    dMontoDescontarFlag: this.fillPedidoDscto.dMontoDescontarFlag,
                    dTipoCambioComercial: this.fillPedidoDscto.dTipoCambioComercial
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1){
                        swal(response.data[0].cMensaje);
                        this.arrayPedidos = [];
                        this.generarDsctoPedido(1);
                    }else{
                        swal('Ocurrio un error al generar el descuento del pedido' + this.fillPedidoDscto.cNumeroPedido);
                    }

                    this.$forceUpdate();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            // =================================================================
            // VER DETALLE PEDIDO
            // =================================================================
            verPedido(pedido){
                this.fillDetallePedido.nidcabecerapedido = pedido.nIdCabeceraPedido,
                this.fillDetallePedido.cnumeropedido = pedido.cNumeroPedido,
                this.fillDetallePedido.cnumerocotizacion = pedido.cNumeroCotizacion,
                this.fillDetallePedido.cdocumentocliente = pedido.cPerDocumento,
                this.fillDetallePedido.cnombrecliente = pedido.cContacto,
                this.fillDetallePedido.nidversionvehiculo = pedido.nIdVersionVeh,
                this.fillDetallePedido.cvehiculo = pedido.cNombreComercial + ' ' + pedido.nAnioFabricacion + '-' + pedido.nAnioModelo,
                this.fillDetallePedido.cnumerovin = pedido.cNumeroVin,
                this.fillDetallePedido.cnombreproveedor = pedido.cNombreProveedor,
                this.fillDetallePedido.cnombrevendedor = pedido.cNombreVendedor,
                this.fillDetallePedido.dfechapedido = pedido.dFechaPedido,
                this.fillDetallePedido.ftotalpedidosoles = pedido.fTotalPedidoSoles,
                this.fillDetallePedido.ftotalpedidodolares = pedido.fTotalPedidoDolares,
                this.verDetallePedido(pedido);
                this.verDocumentosPedido(pedido);
            },
            verDetallePedido(pedido){
                this.mostrarProgressBar();
                var url = this.ruta + '/pedido/GetLstDetallePedido';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcabecerapedido': pedido.nIdCabeceraPedido
                    }
                }).then(response => {
                    this.arrayDetallePedido = response.data.arrayDetallePedido.data;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            verDocumentosPedido(pedido){
                var url = this.ruta + '/pedido/GetDocumentosById';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcabecerapedido': pedido.nIdCabeceraPedido,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayPedidoDoumento = response.data.arrayPedidoDoumento;
                }).catch(error => {
                    console.log(error);
                });
            },
            // =================================================================
            // MODAL
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "pedido":
                    {
                        switch(accion){
                            case 'detalle':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.verPedido(data);
                                break;
                            }
                        }
                    }break;
                }
            },
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
            },
            //Limpiar Paginación
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            },
            limpiarPaginacionModal(){
                this.paginationModal.current_page =  0,
                this.paginationModal.total = 0,
                this.paginationModal.per_page = 0,
                this.paginationModal.last_page = 0,
                this.paginationModal.from  = 0,
                this.paginationModal.to = 0
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            }
        },
        mounted(){
            this.llenarComboMarca();
            this.llenarComboModelo();
        }
    }
</script>

<style>
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: fixed !important;
        background-color: #3c29297a !important;
        overflow-y: scroll;
    }
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .error{
        display: flex;
        justify-content: center;
    }
    .text-center{
        color: red;
        font-weight: bold;
        font-size: 0.75rem;
        text-align: center;
        margin: auto;
    }
</style>
