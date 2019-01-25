<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom"> APROBACIÓN DEL PEDIDO</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
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
                                                        <!-- <el-tooltip class="item" effect="dark" placement="top-start">
                                                            <div slot="content">Aprobar Pedido {{ pedido.cNumeroPedido }}</div>
                                                            <i @click="aprobarPedido(pedido)" :style="'color:#796AEE'" class="fa-md fa fa-check"></i>
                                                        </el-tooltip>&nbsp;&nbsp; -->
                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                            <div slot="content">Aprobar Pedido {{ pedido.cNumeroPedido }}</div>
                                                            <i @click="abrirModal('contacto', 'direcciones', pedido)" :style="'color:#796AEE'" class="fa-md fa fa-check"></i>
                                                        </el-tooltip>&nbsp;&nbsp;
                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                            <div slot="content">Ver Detalle Pedido {{ pedido.cNumeroPedido }}</div>
                                                            <i @click="abrirModal('pedido', 'detalle', pedido)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                        </el-tooltip>&nbsp;&nbsp;
                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                            <div slot="content">Anular Pedido {{ pedido.cNumeroPedido }}</div>
                                                            <i @click="anularPedido(pedido)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                        </el-tooltip>&nbsp;&nbsp;
                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                            <div slot="content">Reporte Pedido {{ pedido.cNumeroPedido }}</div>
                                                            <i @click="generarPedidoPDF(pedido.nIdCabeceraPedido)" :style="'color:red'" class="fa fa fa-file-pdf-o"></i>
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
                                                        <tr v-for="vehiculo in arrayDetallePedido" :key="vehiculo.nIdPar">
                                                            <template v-if="vehiculo.cFlagTipoItem=='V'">
                                                                <td v-text="vehiculo.nIdCodigoArticulo"></td>
                                                                <td v-text="vehiculo.cNombreArticulo"></td>
                                                                <td v-text="vehiculo.fSobrePrecio"></td>
                                                                <td v-text="vehiculo.fDescuento"></td>
                                                                <td v-text="vehiculo.fSubTotalSoles"></td>
                                                                <td v-text="vehiculo.fSubTotalDolares"></td>
                                                            </template>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                        <!-- DETALLE ELEMENTOS DE VENTA VENDIDOS -->
                                        <template v-if="cFlagActivaElemento">
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
                                                        <tr v-for="vehiculo in arrayDetallePedido" :key="vehiculo.nIdPar">
                                                            <template v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='N' && vehiculo.cFlagActivaEventoCampania=='N'">
                                                                <td v-text="vehiculo.nIdCodigoArticulo"></td>
                                                                <td v-text="vehiculo.cNombreArticulo"></td>
                                                                <td v-text="vehiculo.nCantidad"></td>
                                                                <td v-text="vehiculo.fSubTotalSoles"></td>
                                                                <td v-text="vehiculo.fSubTotalDolares"></td>
                                                            </template>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                        <!-- DETALLE ELEMENTOS DE VENTA REGALOS -->
                                        <template v-if="cFlagActivaObsequio">
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
                                                        <tr v-for="vehiculo in arrayDetallePedido" :key="vehiculo.nIdPar">
                                                            <template v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='S' && vehiculo.cFlagActivaEventoCampania=='N'">
                                                                <td v-text="vehiculo.nIdCodigoArticulo"></td>
                                                                <td v-text="vehiculo.cNombreArticulo"></td>
                                                                <td v-text="vehiculo.nCantidad"></td>
                                                                <td v-text="vehiculo.fSubTotalSoles"></td>
                                                                <td v-text="vehiculo.fSubTotalDolares"></td>
                                                            </template>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </template>
                                        <!-- DETALLE ELEMENTOS DE VENTA CAMPAÑAS -->
                                        <template v-if="cFlagActivaCampania">
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
                                                        <tr v-for="vehiculo in arrayDetallePedido" :key="vehiculo.nIdPar">
                                                            <template v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='N' && vehiculo.cFlagActivaEventoCampania=='S'">
                                                                <td v-text="vehiculo.nIdCodigoArticulo"></td>
                                                                <td v-text="vehiculo.cNombreArticulo"></td>
                                                                <td v-text="vehiculo.nCantidad"></td>
                                                                <td v-text="vehiculo.fSubTotalSoles"></td>
                                                                <td v-text="vehiculo.fSubTotalDolares"></td>
                                                            </template>
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
                                                        <tr v-for="documento in arrayPedidoDoumento" :key="documento.nIdPar">
                                                            <template v-if="documento.nValida==1">
                                                                <td :style="documento.nValida==1 ? 'color:red' : ''" v-text="documento.cCaracter + ' ' + documento.cParNombre"></td>
                                                                <td v-text="documento.cArchivo"></td>
                                                                <td>
                                                                    <el-tooltip class="item" :content="'Ver Pdf ' + documento.cArchivo" effect="dark" placement="top-start">
                                                                        <a :href="documento.cRutaDocumento" v-if="documento.cRutaDocumento !=''" target="_blank">
                                                                            <i class='fa-md fa fa-file'></i>
                                                                        </a>
                                                                    </el-tooltip>&nbsp;
                                                                </td>
                                                            </template>
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
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="aprobarPedidoModal()">
                                                    <i class="fa fa-save"></i> Aprobar
                                                </button>
                                            </div>
                                        </div>
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

            <!-- MODAL ASIGNACIÓN DIRECCIONES -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">ASIGNACIÓN DE DIRECCIONES DEL SOCIO DE NEGOCIO  {{ fillDirecciones.cContacto }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="text-center">
                                                        <div v-for="(e, index) in mensajeError" :key="index" v-text="e"></div>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                            <vs-divider border-style="solid" color="dark">
                                                Direcciones Fiscales
                                                &nbsp;&nbsp;
                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                    <div slot="content">Agregar Dirección Fiscal</div>
                                                    <i @click="agregarDireccion(1)" :style="'color:#796AEE'" class="fa-md fa fa-plus"></i>
                                                </el-tooltip>&nbsp;&nbsp;
                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                    <div slot="content">Asignar Dirección</div>
                                                    <i @click="asignarDireccion(1)" :style="'color:#796AEE'" class="fa-md fa fa-refresh"></i>
                                                </el-tooltip>&nbsp;&nbsp;
                                            </vs-divider>
                                            <template v-if="arrayDireccionesFiscales.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>ID Fiscal</th>
                                                                <th>Nombre Dirección</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(direccion, index) in arrayDireccionesFiscales" :key="index">
                                                                <td> {{ direccion.AddressName = direccion.AddressID + 0 + (index+1) }} </td>
                                                                <td><input type="text" class="form-control form-control-sm" v-model="direccion.Street"/></td>
                                                                <td>
                                                                    <el-tooltip content="Eliminar Dirección Fiscal" placement="top">
                                                                        <button type="button" rel="tooltip" class="btn btn-info" @click.prevent="removerDireccion(1, index)">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </template>
                                            <vs-divider border-style="solid" color="dark">
                                                Direcciones de Despacho
                                                &nbsp;&nbsp;
                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                    <div slot="content">Agregar Dirección de Despacho</div>
                                                    <i @click="agregarDireccion(2)" :style="'color:#796AEE'" class="fa-md fa fa-plus"></i>
                                                </el-tooltip>&nbsp;&nbsp;
                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                    <div slot="content">Asignar Dirección</div>
                                                    <i @click="asignarDireccion(2)" :style="'color:#796AEE'" class="fa-md fa fa-refresh"></i>
                                                </el-tooltip>&nbsp;&nbsp;
                                            </vs-divider>
                                            <template v-if="arrayDireccionesDespacho.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>ID Despacho</th>
                                                                <th>Nombre Dirección</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(direccion, index) in arrayDireccionesDespacho" :key="index">
                                                                <td> {{ direccion.AddressName = direccion.AddressID + 0 + (index+1) }} </td>
                                                                <td><input type="text" class="form-control form-control-sm" v-model="direccion.Street"/></td>
                                                                <td>
                                                                    <el-tooltip content="Eliminar Dirección Despacho" placement="top">
                                                                        <button type="button" rel="tooltip" class="btn btn-info" @click.prevent="removerDireccion(2, index)">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </template>
                                            <template v-if="arrayDireccionesFiscales.length || arrayDireccionesDespacho.length">
                                                <div class="form-group row">
                                                    <div class="col-sm-9 offset-sm-4">
                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="registrarDireccion">
                                                            <i class="fa fa-save"></i> ASIGNAR DIRECCIONES
                                                        </button>
                                                        <button type="button" class="btn btn-secundary btn-corner btn-sm" @click.prevent="limpiarDireccion">
                                                            <i class="fa fa-recycle"></i> LIMPIAR
                                                        </button>
                                                    </div>
                                                </div>
                                            </template>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModalDirecciones()">Cerrar</button>
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
                cFlagActivaElemento: 0,
                cFlagActivaObsequio: 0,
                cFlagActivaCampania: 0,
                // MODAL ASIGNACIÓN DIRECCIONES
                cFlagOpcion: '',
                arrayDireccionesExisten: [],
                cFlagDireccionCU: 1,
                arrayDireccionesFiscales: [],
                arrayDireccionesDespacho: [],
                fillDirecciones: {
                    nIdCabeceraPedido: '',
                    nIdContacto: '',
                    cContacto: '',
                    cDireccion: '',
                    cCardCode: '',
                    cTipoPersona: ''
                },
                arrayContacto: [],
                SAPNuevoContactoJson: '',
                //===========================================================
                // ==================  VARIABLES SAP ========================
                formSap:{
                    nidcabecerapedido: 0,
                    ccardcode: '',
                    igv: 0
                },
                arraySapPedido: [],
                arraySapRptPedido: [],
                jsonPedido: '',
                arraySapUpdPedido: [],
                arraySapFactura: [],
                arraySapRptFactura: [],
                jsonFactura: '',
                arraySapUpdFactura: [],
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
                mensajeError: [],
                loading: false
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            listarPedidos(page){
                if(this.validarBuscarPedidos()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/pedido/GetLstPedidosPendienteAprobacion';
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
                        'page': page
                    }
                }).then(response => {
                    this.arrayPedidos = response.data.arrayPedido.data;
                    this.pagination.current_page   =  response.data.arrayPedido.current_page;
                    this.pagination.total          = response.data.arrayPedido.total;
                    this.pagination.per_page       = response.data.arrayPedido.per_page;
                    this.pagination.last_page      = response.data.arrayPedido.last_page;
                    this.pagination.from           = response.data.arrayPedido.from;
                    this.pagination.to             = response.data.arrayPedido.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
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
            //METODOS ASIGNACIÓN DIRECCIONES
            obtenerDireccionesPorContacto(nIdContacto, data){
                var url = this.ruta + '/pedido/GetDireccionByContacto';
                axios.get(url, {
                    params: {
                        'nIdContacto': nIdContacto,
                    }
                }).then(response => {
                    this.arrayDireccionesExisten = response.data;
                    this.flujoAprobarPedido(data);
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            flujoAprobarPedido(data){
                this.fillDirecciones.cCardCode = data.cCardCode;

                //===========================================================================================
                // ====================================  CASO 01 ============================================
                //SI EL CARDCODE NO ESTA INTEGRADO (POR ENDE TAMPCO LAS DIRECCIONES)
                if (this.fillDirecciones.cCardCode == '' || this.fillDirecciones.cCardCode == null && this.arrayDireccionesExisten.length > 0) {
                    this.cFlagOpcion = 1;//Flag Requiere Registrar Direcciones/Integración Contacto/Pedido
                    //Abrir Modal
                    this.accionmodal=4;
                    this.modal = 1;
                    //Info para Integracion
                    this.fillDirecciones.nIdCabeceraPedido = data.nIdCabeceraPedido;
                    this.fillDirecciones.nIdContacto = data.nIdContacto;
                    this.fillDirecciones.cContacto = data.cContacto;
                }

                //===========================================================================================
                // ====================================  CASO 02 ============================================
                //SI EL CARDCODE ESTA INTEGRADO Y HAY DIRECCIONES
                if (this.fillDirecciones.cCardCode && this.arrayDireccionesExisten.length > 0) {
                    //INTEGRAR PEDIDO
                    this.cFlagOpcion = 2;//Flag Requiere Integración Pedido
                    this.aprobarPedido(data);
                }

                //===========================================================================================
                // ====================================  CASO 03 ============================================
                //SI EL CARDCODE ESTA INTEGRADO Y NO HAY DIRECCIONES (CONTACOS ANTIGUOS)
                if (this.fillDirecciones.cCardCode && this.arrayDireccionesExisten.length == 0) {
                    this.cFlagOpcion = 1;
                    this.cFlagDireccionCU = 2;//Flag Requiere Actualizar Direcciones/Integración Direcciones (Actualizar Contacto)/Pedido
                    //Abrir Modal
                    this.accionmodal=4;
                    this.modal = 1;
                    //Info para Integracion
                    this.fillDirecciones.nIdCabeceraPedido = data.nIdCabeceraPedido;
                    this.fillDirecciones.nIdContacto = data.nIdContacto;
                    this.fillDirecciones.cContacto = data.cContacto;
                }
            },
            agregarDireccion(op){
                if(this.validarAgregarDireccion(op)){
                    return;
                }
                let me = this;
                if (op == 1) {
                    me.arrayDireccionesFiscales.push({
                        AddressID : 'Dirección Fiscal ',
                        AddressName : '',
                        Street: '',
                        nIdFiltro: '',
                        nIdUbigeo: ''
                    });
                    toastr.success('Se Agregó una Nueva Dirección Fiscal');
                }
                if (op == 2) {
                    me.arrayDireccionesDespacho.push({
                        AddressID : 'Dirección Despacho ',
                        AddressName : '',
                        Street: '',
                        nIdFiltro: '',
                        nIdUbigeo: ''
                    });
                    toastr.success('Se Agregó una Nueva Dirección Despacho');
                }
            },
            validarAgregarDireccion(op){
                let me = this;
                this.error = 0;
                this.mensajeError =[];

                if(op == 1) {
                    this.arrayDireccionesFiscales.map(function (x, y) {
                        if(x.AddressName == ''){
                            me.mensajeError.push('ID Dirección Fiscal, campo obligatorio ' + (y+1));
                        }
                        if(x.Street == ''){
                            me.mensajeError.push('Ingresa la Dirección Fiscal N° ' + (y+1));
                        }
                    });
                }
                if(op == 2){
                    this.arrayDireccionesDespacho.map(function (x, y) {
                        if(x.AddressName == ''){
                            me.mensajeError.push('ID Dirección Despacho, campo obligatorio ' + (y+1));
                        }
                        if(x.Street == ''){
                            me.mensajeError.push('Ingresa la Dirección Despacho N° ' + (y+1));
                        }
                    });
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            removerDireccion(op, index){
                if (op == 1){
                    this.$delete(this.arrayDireccionesFiscales, index);
                    toastr.success('Se Removio la Dirección Fiscal N° ' + (parseInt(index)+1));
                }
                if (op == 2) {
                    this.$delete(this.arrayDireccionesDespacho, index);
                    toastr.success('Se Removio la Dirección de Despacho N° ' + (parseInt(index)+1));
                }
            },
            asignarDireccion(op){
                var url = this.ruta + '/pedido/GetDireccionContactoByPedido';
                axios.get(url, {
                    params: {
                        'nIdContacto': this.fillDirecciones.nIdContacto,
                    }
                }).then(response => {
                    this.fillDirecciones.cDireccion = response.data[0].cDireccion;
                    this.cargarDireccionContacto(op);
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            cargarDireccionContacto(op){
                if (op == 1) {
                    this.arrayDireccionesFiscales = [];
                    this.arrayDireccionesFiscales.push({
                        AddressID : 'Dirección Fiscal ',
                        AddressName : '',
                        Street: this.fillDirecciones.cDireccion
                    });
                    toastr.success('Se PreCargo la Dirección Fiscal');
                }
                if (op == 2) {
                    this.arrayDireccionesDespacho = [];
                    this.arrayDireccionesDespacho.push({
                        AddressID : 'Dirección Despacho ',
                        AddressName : '',
                        Street: this.fillDirecciones.cDireccion
                    });
                    toastr.success('Se PreCargo la Dirección Despacho');
                }
            },
            registrarDireccion(){
                if(this.validarDireccion()){
                    return;
                }
                let me = this;
                me.loadingProgressBar("SINCRONIZANDO DIRECCIONES CON EL CLIENTE...");

                this.mostrarProgressBar();
                var url = this.ruta + '/pedido/SetRegistrarDireccionContacto';
                axios.post(url, {
                    'nIdContacto': this.fillDirecciones.nIdContacto,
                    'arrayDireccionesFiscales': this.arrayDireccionesFiscales,
                    'arrayDireccionesDespacho': this.arrayDireccionesDespacho
                }).then(response => {
                    console.log(response.data);
                    //VERIFICA SI ES DESDE EL CASO 01 (1) O SI ES DESDE EL CASO 03 (2)
                    (this.cFlagDireccionCU == 1) ? this.obtenerTipoPersona() : this.actualizarDireccionesByContacto();
                    // this.obtenerTipoPersona();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            //SI EL CARDCODE ESTA INTEGRADO Y NO HAY DIRECCIONES - ACTUALIZAR DIRECCIONES
            actualizarDireccionesByContacto(){
                let me = this;
                me.loadingProgressBar("INTEGRANDO DIRECCIONES DEL CLIENTE...");

                var url = this.ruta + '/pedido/SapSetUpdDireccionesContacto';
                axios.post(url, {
                    'nIdContacto': this.fillDirecciones.nIdContacto,
                    'cCardCode': this.fillDirecciones.cCardCode
                }).then(response => {
                    console.log(response.data);
                    this.aprobarPedido2();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            //REGISTRAR CONTACTO
            obtenerTipoPersona(){
                var url = this.ruta + '/pedido/GetObtenerTipoPersona';
                axios.get(url, {
                    params: {
                        'nIdContacto': this.fillDirecciones.nIdContacto,
                    }
                }).then(response => {
                    console.log(response.data);
                    this.fillDirecciones.cTipoPersona = response.data[0].cFlagTipoPersona;
                    this.listarContactoSinCarteraMes();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            listarContactoSinCarteraMes(){
                var url = this.ruta + '/pedido/GetListContactoBySinCarteraMes';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcronograma' :   220016,
                        'ntipopersona'  :   (this.fillDirecciones.cTipoPersona == 'N') ? 1 : 2,
                        'nIdContacto'   :   this.fillDirecciones.nIdContacto
                    }
                }).then(response => {
                    console.log(response.data);
                    this.arrayContacto = response.data;
                    this.SapRegistrarNuevoContacto();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            SapRegistrarNuevoContacto(){
                let me = this;
                me.loadingProgressBar("INTEGRANDO CONTACTO CON SAP BUSINESS ONE...");

                var url = this.ruta + '/gescontacto/SapSetContacto';
                axios.post(url, {
                    'contacto': this.arrayContacto[0]
                }).then(response => {
                    // console.log(response.data);

                    let data = response.data;
                    this.SAPNuevoContactoJson  =  JSON.parse(data);
                    this.actualizarCardCodeContacto(this.arrayContacto[0].nIdContacto, this.SAPNuevoContactoJson, response.data.toString());
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            actualizarCardCodeContacto(nIdContacto, dataJSON, logRpta){
                let me = this;

                this.fillDirecciones.cCardCode = dataJSON.CardCode.toString();

                var url = this.ruta + '/gescontacto/UpdCardCodeContacto';
                axios.post(url, {
                    'nIdContacto'   : nIdContacto,
                    'CardCode'      : dataJSON.CardCode.toString(),
                    'CardType'      : dataJSON.CardType.toString(),
                    'LogRespuesta'  : logRpta
                }).then(response => {
                    // console.log(response);
                    if(response.data[0].nFlagMsje==1){
                        // swal(response.data[0].cMensaje);
                        me.loadingProgressBar(response.data[0].cMensaje);
                        this.aprobarPedido2();
                    } else {
                        swal(response.data[0].cMensaje);
                    }
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            aprobarPedido2(){
                let me = this;
                var url = me.ruta + '/pedido/SetAprobarPedido';
                axios.put(url,{
                    'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nidcabecerapedido': parseInt(me.fillDirecciones.nIdCabeceraPedido)
                }).then(function (response) {
                    if (response.data[0].nFlagMsje == 1) {
                        me.obtenerIgv();
                    } else {
                        swal(
                            'ERROR!',
                            response.data[0].cMensaje
                        )
                    }
                }).catch(function (error) {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            validarDireccion(){
                let me = this;
                me.mensajeError =[];

                if( me.arrayDireccionesFiscales.length == 0) {
                    me.mensajeError.push('Debe agregar al menos una dirección fiscal, campo obligatorio ' + (y+1));
                } else {
                    me.arrayDireccionesFiscales.map(function (x, y) {
                        if(x.AddressID == '' || x.AddressName == ''){
                            me.mensajeError.push('ID Dirección Fiscal se encuentra vacío, campo obligatorio ' + (y+1));
                        }
                        if(x.Street == ''){
                            me.mensajeError.push('Debe ingresar una Dirección Fiscal, campo obligatorio ' + (y+1));
                        }
                    });
                }

                me.arrayDireccionesDespacho.map(function (x, y) {
                    if(x.AddressID == '' || x.AddressName == ''){
                        me.mensajeError.push('ID Dirección Despacho se encuentra vacío, campo obligatorio ' + (y+1));
                    }
                    if(x.Street == ''){
                        me.mensajeError.push('Debe ingresar una Dirección Despacho, campo obligatorio ' + (y+1));
                    }
                });
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarDireccion(){
                this.arrayDireccionesFiscales = [];
                this.arrayDireccionesDespacho = [];
            },
            //Aprobar Pedido
            aprobarPedido(pedido){
                this.formSap.nidcabecerapedido  = pedido.nIdCabeceraPedido;
                this.formSap.ccardcode          = pedido.cCardCode;
                swal({
                    title: '¿Esta seguro de APROBAR el pedido N°' + pedido.nIdCabeceraPedido + '?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Aprobar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        var url = me.ruta + '/pedido/SetAprobarPedido';
                        axios.put(url,{
                            'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                            'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                            'nidcabecerapedido': parseInt(me.formSap.nidcabecerapedido)
                        }).then(function (response) {
                            if (response.data[0].nFlagMsje == 1) {
                                me.mostrarProgressBar();
                                me.obtenerIgv();
                                //me.obtenerPedidoById();
                            } else {
                                swal(
                                    'ERROR!',
                                    response.data[0].cMensaje
                                )
                            }
                        }).catch(function (error) {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {}
                })
            },
            //GENERAR REPORTE PEDIDO
            generarPedidoPDF(nIdCabeceraPedido){
                var config = {
                    responseType: 'blob'
                };
                var url = this.ruta + '/pedido/GetDetallePedido';
                axios.post(url, {
                    'nIdEmpresa'            :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal'           :   parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nIdCabeceraPedido'     :   parseInt(nIdCabeceraPedido)
                }, config).then(response => {
                    console.log(response.data);
                    //Create a Blob from the PDF Stream
                    const file = new Blob(
                        [response.data],
                        {type: 'application/pdf'}
                    );
                    //Construye la URL del Archivo
                    const fileURL = URL.createObjectURL(file);
                    //Abre la URL en una nueva Ventana
                    window.open(fileURL);
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            obtenerIgv(){
                var url = this.ruta + '/tipoparametro/GetTipoByIdParametro';
                axios.get(url, {
                    params: {
                        'nidpar': 1300477,
                        'ctipoparametro': 'P',
                        'nidtipopar': 51
                    }
                }).then(response => {
                    this.formSap.igv = response.data.arrayTipoParametro.data[0].fDatoParPorcentual;
                    if(this.formSap.igv > 0){
                        this.obtenerPedidoById();
                    } else {
                        swal(
                            'ERROR!',
                            'OCURRIÓ UN ERROR AL OBTENER EL IGV'
                        )
                    }
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            obtenerPedidoById(){
                var url = this.ruta + '/pedido/GetPedidoById';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcabecerapedido': (this.cFlagOpcion = 1) ? this.fillDirecciones.nIdCabeceraPedido : this.formSap.nidcabecerapedido//Si es 1 (Desde Form Direcciones) / Si es 2 desde Aprobación Directa
                    }
                }).then(response => {
                    this.arraySapPedido = response.data.arrayCabeceraPedido.data;
                    console.log("Cantidad Pedidos: " + this.arraySapPedido.length);
                    this.registroSapPedido();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            //REGISTRA PEDIDO EN SAP
            registroSapPedido(){
                let me = this;
                me.loadingProgressBar("INTEGRANDO EL PEDIDO CON SAP BUSINESS ONE...");

                var sapUrl = me.ruta + '/pedido/SapSetPedido';
                axios.post(sapUrl, {
                    'fDocDate'      :   moment().format('YYYY-MM-DD'),
                    'fDocDueDate'   :   moment().add(30, 'days').format('YYYY-MM-DD'),
                    'Igv'           :   1 + parseFloat((me.formSap.igv)),
                    'data'          :   me.arraySapPedido
                }).then(response => {
                    me.arraySapRptPedido = response.data;
                    me.arraySapRptPedido.map(function(x){
                        me.jsonPedido= JSON.parse(x);
                        //Verifico que devuelva DocEntry
                        if(me.jsonPedido.DocEntry){
                            console.log("Integración Pedido SAP : OK");
                            console.log(me.jsonPedido.DocEntry);
                            me.arraySapUpdPedido.push({
                                'nIdCabeceraPedido' :   (me.cFlagOpcion = 1) ? me.fillDirecciones.nIdCabeceraPedido.toString() : me.formSap.nidcabecerapedido.toString(),
                                'nDocEntry'         :   parseInt(me.jsonPedido.DocEntry),
                                'nDocNum'           :   parseInt(me.jsonPedido.DocNum),
                                'cDocType'          :   me.jsonPedido.DocType.toString(),
                                'cLogRespuesta'     :   response.data.toString(),
                                'cItemCode'         :   me.jsonPedido.DocumentLines[0].ItemCode.toString()
                            });
                            //==============================================================
                            //================== ACTUALIZAR DOCENTRY PEDIDO ===============
                            setTimeout(function() {
                                me.registroDocEntryPedido();
                            }, 3800);

                        }
                    });
                }).catch(error => {
                    $("#myBar").hide();
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Error en la Integración de Pedido SapB1!',
                    });
                    me.limpiarFormulario();
                    me.listarPedidos(1);
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            //REGISTRA DOCENTRY-PEDIDO EN SQLSERVER
            registroDocEntryPedido(){
                let me = this;

                var sapUrl = me.ruta + '/pedido/SapUpdPedidoByDocEntry';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdPedido
                }).then(response => {
                    if (response.data[0].nFlagMsje == 1) {
                        me.limpiarFormulario();
                        me.listarPedidos(1);
                        swal(
                            'Aprobado!',
                            'El pedido ha sido APROBADO con éxito.',
                            'success'
                        );
                        $("#myBar").hide();
                        me.loading.close();
                    } else {
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Error en el registro de Pedido!',
                        })
                    }
                    /*if(response.data[0].nFlagMsje == 1){
                        setTimeout(function() {
                            me.registroSapComprobante();
                        }, 3800);
                    }else{
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Error en Actualizar Pedido!',
                        })
                    }*/
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            //REGISTRA COMPROBANTE SAP
            registroSapComprobante(){
                let me = this;

                var sapUrl = me.ruta + '/comprobante/SapSetFactura';
                axios.post(sapUrl, {
                    'cCardCode': me.formSap.ccardcode.toString(),
                    'fDocDate': moment().format('YYYY-MM-DD'),
                    'data': me.arraySapUpdPedido
                }).then(response => {
                    me.arraySapRptFactura = response.data;
                    me.arraySapRptFactura.map(function(x){
                        me.jsonFactura= JSON.parse(x);
                        //Verifico que devuelva DocEntry
                        if(me.jsonFactura.DocEntry){
                            console.log("Integración Factura SAP : OK");
                            console.log(me.jsonFactura.DocEntry);
                            me.arraySapUpdFactura.push({
                                'nIdCabeceraPedido': me.formSap.nidcabecerapedido.toString(),
                                'nDocEntry': parseInt(me.jsonFactura.DocEntry),
                                'nDocNum': parseInt(me.jsonFactura.DocNum),
                                'cDocType': me.jsonFactura.DocType.toString(),
                                'cLogRespuesta': response.data.toString(),
                                'cItemCode': me.jsonFactura.DocumentLines[0].ItemCode.toString()
                            });
                            //==============================================================
                            //================== ACTUALIZAR DOCENTRY FACTURA ===============
                            setTimeout(function() {
                                me.registroDocEntryComprobante();
                            }, 3800);
                        }
                    });
                }).catch(error => {
                    $("#myBar").hide();
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Error en la Integración de Comprobante SapB1!',
                    });
                    me.limpiarFormulario();
                    me.listarPedidos(1);
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            //REGISTRA DOCENTRYCOMPROBANTE EN SQLSERVER
            registroDocEntryComprobante(){
                let me = this;

                var sapUrl = me.ruta + '/pedido/SapUpdFacturaByDocEntry';
                axios.post(sapUrl, {
                    data: me.arraySapUpdFactura
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1){
                        me.limpiarFormulario();
                        me.listarPedidos(1);
                        $("#myBar").hide();
                        swal(
                            'Aprobado!',
                            'El pedido ha sido APROBADO con éxito.',
                            'success'
                        );
                    }else{
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Error en el registro de Pedido!',
                        })
                    }
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            anularPedido(pedido){
                swal({
                    title: '¿Esta seguro de ANULAR el pedido N°' + pedido.nIdCabeceraPedido + '?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Aprobar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        var url = me.ruta + '/pedido/SetAnularPedido';
                        axios.put(url,{
                            'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                            'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                            'nidcabecerapedido': parseInt(pedido.nIdCabeceraPedido)
                        }).then(function (response) {
                            if(response.data[0].nFlagMsje == 1)
                            {
                                swal(
                                    'Anulado!',
                                    'El pedido ' + pedido.nIdCabeceraPedido +' ha sido ANULADO con éxito.',
                                    'success'
                                )
                            }
                            else
                            {
                                swal(
                                    'Anulado!',
                                    'Error en la Anulación.',
                                )
                            }
                            me.listarPedidos(1);
                        }).catch(function (error) {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {}
                })
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
                    this.verificaDetallePedido();
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            verificaDetallePedido(){
                let me = this;
                me.cFlagActivaElemento = 0;
                me.cFlagActivaObsequio = 0;
                me.cFlagActivaCampania = 0;

                me.arrayDetallePedido.map(function(value, key) {
                    if(value.cFlagVista == 'E'){
                        me.cFlagActivaElemento = 1;
                    };
                    if(value.cFlagVista == 'O'){
                        me.cFlagActivaObsequio = 1;
                    };
                    if(value.cFlagVista == 'C'){
                        me.cFlagActivaCampania = 1;
                    };
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            aprobarPedidoModal(){
                this.aprobarPedido(parseInt(this.fillDetallePedido.nidcabecerapedido));
                this.cerrarModal();
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
                    }
                    break;
                    case "contacto":
                    {
                        switch(accion){
                            case 'direcciones':
                            {
                                this.obtenerDireccionesPorContacto(data.nIdContacto, data);

                                //SI EL CARDCODE NO ESTA INTEGRADO
                                // if (this.fillDirecciones.cCardCode == '' || this.fillDirecciones.cCardCode == null) {
                                //     this.cFlagOpcion = 1;//Flag Requiere Integración Contacto/Pedido
                                //     this.accionmodal=4;
                                //     this.modal = 1;
                                //     this.fillDirecciones.nIdCabeceraPedido = data.nIdCabeceraPedido;
                                //     this.fillDirecciones.nIdContacto = data.nIdContacto;
                                //     this.fillDirecciones.cContacto = data.cContacto;
                                // } else {
                                //     //INTEGRAR PEDIDO
                                //     this.cFlagOpcion = 2;//Flag Requiere Integración Pedido
                                //     this.aprobarPedido(data);
                                // }
                                console.log(data);
                                break;
                            }
                        }
                    }
                }
            },
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
            },
            cerrarModalDirecciones(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.arrayDireccionesFiscales = [];
                this.arrayDireccionesDespacho = [];
                this.cFlagOpcion = '';
                this.fillDirecciones.nIdCabeceraPedido = '';
                this.fillDirecciones.nIdContacto = '';
                this.fillDirecciones.cContacto = '';
                this.fillDirecciones.cDireccion = '';
                this.fillDirecciones.cCardCode = '';
                this.fillDirecciones.cTipoPersona = '';
                this.arrayContacto = [],
                this.SAPNuevoContactoJson = ''
            },
            limpiarFormulario(){
                //Limpiar Variables SAP
                this.arraySapPedido=  [],
                this.arraySapRptPedido= [],
                this.jsonPedido= '',
                this.arraySapUpdPedido= [],
                this.arraySapFactura= [],
                this.arraySapRptFactura= [],
                this.jsonFactura= '',
                this.arraySapUpdFactura= [],
                this.formSap.nidcabecerapedido= 0,
                this.formSap.ccardcode= ''
                this.formSap.igv = '';
                //Direcciones
                this.cerrarModal();
                this.arrayDireccionesFiscales = [];
                this.arrayDireccionesDespacho = [];
                this.cFlagOpcion = '';
                this.arrayDireccionesExisten = [];
                this.cFlagDireccionCU = 1;
                this.fillDirecciones.nIdCabeceraPedido = '';
                this.fillDirecciones.nIdContacto = '';
                this.fillDirecciones.cContacto = '';
                this.fillDirecciones.cDireccion = '';
                this.fillDirecciones.cCardCode = '';
                this.fillDirecciones.cTipoPersona = '';
                this.arrayContacto = [],
                this.SAPNuevoContactoJson = ''
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
            },
            loadingProgressBar(texto){
                this.loading = this.$loading({
                    lock: true,
                    text: texto,
                    spinner: 'fa-spin fa-md fa fa-cube',
                    background: 'rgba(0, 0, 0, 0.7)'
                });
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
