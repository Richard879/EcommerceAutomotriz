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
                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                            <div slot="content">Aprobar Pedido {{ pedido.cNumeroPedido }}</div>
                                                            <i @click="aprobarPedido(pedido.nIdCabeceraPedido)" :style="'color:#796AEE'" class="fa-md fa fa-check"></i>
                                                        </el-tooltip>&nbsp;
                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                            <div slot="content">Ver Detalle Pedido {{ pedido.cNumeroPedido }}</div>
                                                            <i @click="abrirModal('pedido', 'detalle', pedido)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                        </el-tooltip>&nbsp;
                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                            <div slot="content">Anular Pedido {{ pedido.cNumeroPedido }}</div>
                                                            <i @click="anularPedido(pedido)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
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
                                                        <tr v-for="vehiculo in arrayDetallePedido" :key="vehiculo.nIdPar" v-if="vehiculo.cFlagTipoItem=='V'">
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
                                                            v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaEVPorRegalar=='N' && vehiculo.cFlagActivaEventoCampania=='N'">
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
                                                            v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaEVPorRegalar=='S' && vehiculo.cFlagActivaEventoCampania=='N'">
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
                                                            v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaEVPorRegalar=='N' && vehiculo.cFlagActivaEventoCampania=='S'">
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
                                                        <tr v-for="documento in arrayPedidoDoumento" :key="documento.nIdPar" v-if="documento.nValida==1">
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

                var url = this.ruta + '/pedido/GetLstPedidosPendienteAprobacion';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
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
            aprobarPedido(nIdCabeceraPedido){
                swal({
                    title: '¿Esta seguro de APROBAR el pedido N°' + nIdCabeceraPedido + '?',
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
                            'nidempresa': 1300011,
                            'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                            'nidcabecerapedido': parseInt(nIdCabeceraPedido)
                        }).then(function (response) {
                            if(response.data[0].nFlagMsje == 1)
                            {
                                swal(
                                    'Aprobado!',
                                    'El pedido ' + nIdCabeceraPedido +' ha sido APROBADO con éxito.',
                                    'success'
                                )
                            }
                            else
                            {
                                swal(
                                    'ERROR!',
                                    response.data[0].cMensaje
                                )
                            }
                            me.listarPedidos(1);
                        }).catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {}
                })
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
                            'nidempresa': 1300011,
                            'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                            'nidcabecerapedido': parseInt(pedido.nIdCabeceraPedido)
                        }).then(function (response) {
                            if(response.data[0].nFlagMsje == 1)
                            {
                                swal(
                                    'Aprobado!',
                                    'El pedido ' + pedido.nIdCabeceraPedido +' ha sido APROBADO con éxito.',
                                    'success'
                                )
                            }
                            else
                            {
                                swal(
                                    'Anulado!',
                                    'El pedido ' + pedido.nIdCabeceraPedido +' ha sido ANULADO con éxito.',
                                )
                            }
                            me.listarPedidos(1);
                        }).catch(function (error) {
                            console.log(error);
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
                        'nidempresa': 1300011,
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
                        'nidempresa': 1300011,
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