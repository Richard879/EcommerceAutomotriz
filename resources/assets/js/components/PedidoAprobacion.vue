<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">
                        <vs-divider color="dark">MODULO APROBACIÓN DEL PEDIDO</vs-divider>
                    </h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#TabBuscaPedidoAprobado" @click="tabBuscaPedidoAprobado()" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> BUSCAR PEDIDOS APROBADOS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabAprobarPedido" @click="tabAprobarPedido()" role="tab" data-toggle="tab">
                                            <i class="fa fa-bus"></i> APROBAR PEDIDOS
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="TabBuscaPedidoAprobado">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR PEDIDOS APROBADOS</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Empresa</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="cempresa" class="form-control form-control-sm" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="csucursal" class="form-control form-control-sm" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <!--<div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                                            <div class="col-sm-8">
                                                                                <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.id">
                                                                                    <input type="radio" class="radio-template" v-model="fillPedido.ntipopersona" :value="tipo.value">
                                                                                    <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>-->
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillPedido.ccontacto" @keyup.enter="listarPedidosAprobados(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillPedido.cnrodocumento" @keyup.enter="listarPedidosAprobados(1)" class="form-control form-control-sm">
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
                                                                                    v-model="fillPedido.dfechainicio"
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
                                                                                    v-model="fillPedido.dfechafin"
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
                                                                                <input type="text" v-model="fillPedido.cnumeropedido" @keyup.enter="listarPedidosAprobados(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillPedido.cnumerovin" @keyup.enter="listarPedidosAprobados(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Marca</label>
                                                                            <div class="col-sm-8">
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
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Modelo</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillBusquedaPedido.nidmodelo" filterable clearable placeholder="SELECCIONE">
                                                                                    <el-option
                                                                                        v-for="item in arrayModelo"
                                                                                        :key="item.nIdModelo"
                                                                                        :label="item.cModeloNombre"
                                                                                        :value="item.nIdModelo">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarPedidosAprobados(1)">
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
                                                            <template v-if="arrayPedidosAprobados.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Nro Pedido</th>
                                                                                <th>#Doc SAP</th>
                                                                                <th>Contacto</th>
                                                                                <th>Vehiculo</th>
                                                                                <th>Número VIN</th>
                                                                                <th>Número DUA</th>
                                                                                <th>Fecha Pedido</th>
                                                                                <th>Aprobación</th>
                                                                                <th>Estado Pedido</th>
                                                                                <th>Vendedor</th>
                                                                                <th>DocEntry</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="pedido in arrayPedidosAprobados" :key="pedido.nIdCabeceraPedido">
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Ver Detalle Pedido {{ pedido.cNumeroPedido }}</div>
                                                                                        <i @click="abrirModal('pedido', 'detalle', pedido)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                                                    </el-tooltip>&nbsp;&nbsp;
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Detalle de Depósitos {{ pedido.cNumeroPedido }}</div>
                                                                                        <i @click="abrirModal('pedido', 'deposito', pedido)" :style="'color:green'" class="fa-md fa fa-eye"></i>
                                                                                    </el-tooltip>&nbsp;&nbsp;
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Reporte Pedido {{ pedido.cNumeroPedido }}</div>
                                                                                        <i @click="generarPedidoPDF(pedido.nIdCabeceraPedido)" :style="'color:red'" class="fa-md fa fa-file-pdf-o"></i>
                                                                                    </el-tooltip>&nbsp;&nbsp;
                                                                                    <template v-if="pedido.nValidaIntegracion==0">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">{{ pedido.cFlagVistaIntegracion }}</div>
                                                                                            <i @click="validarSapPedido(pedido)" :style="'color:green'" class="fa-spin fa-md fa fa-cube"></i>
                                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                                    </template>
                                                                                </td>
                                                                                <td v-text="pedido.cNumeroPedido"></td>
                                                                                <td v-text="pedido.nDocNum"></td>
                                                                                <td v-text="pedido.cContacto"></td>
                                                                                <td v-text="pedido.cNombreComercial + ' ' + pedido.nAnioModelo"></td>
                                                                                <td v-text="pedido.cNumeroVin"></td>
                                                                                <td v-text="pedido.cNumeroDUA"></td>
                                                                                <td v-text="pedido.dFechaPedido"></td>
                                                                                <td v-text="pedido.cEstadoAprobacion"></td>
                                                                                <td v-text="pedido.cEstadoPedido"></td>
                                                                                <td v-text="pedido.cNombreVendedor"></td>
                                                                                <td v-text="pedido.nDocEntryDetallePedido"></td>
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
                                                                                        <a @click.prevent="cambiarPagina(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                    </li>
                                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                    :class="[page==isActived?'active':'']">
                                                                                        <a class="page-link"
                                                                                        href="#" @click.prevent="cambiarPagina(page)"
                                                                                        v-text="page"></a>
                                                                                    </li>
                                                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                        <a @click.prevent="cambiarPagina(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="TabAprobarPedido">
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
                                                                            <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillBusquedaPedido.ccontacto" @keyup.enter="listarPedidos(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillBusquedaPedido.cnrodocumento" @keyup.enter="listarPedidos(1)" class="form-control form-control-sm">
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
                                                                                        :key="item.nIdModelo"
                                                                                        :label="item.cModeloNombre"
                                                                                        :value="item.nIdModelo">
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
                                                                                <th>Código</th>
                                                                                <th>Contacto</th>
                                                                                <th>Nro Documento</th>
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
                                                                                <td v-text="pedido.nIdContacto"></td>
                                                                                <td v-text="pedido.cContacto"></td>
                                                                                <td v-text="pedido.cPerDocumento"></td>
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
                                    </div>
                                </div>
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
                                                        <label class="col-sm-4 form-control-label">* Vehículo</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.cvehiculo" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* VIN</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetallePedido.cnumerovin" class="form-control form-control-sm" readonly>
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
                                        <!--<div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="aprobarPedidoModal()">
                                                    <i class="fa fa-save"></i> Aprobar
                                                </button>
                                            </div>
                                        </div>-->
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
                                                                <th>Ubigeo</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(direccion, index) in arrayDireccionesFiscales" :key="index">
                                                                <td> {{ direccion.AddressName = direccion.AddressID + 0 + (index+1) }} </td>
                                                                <td><input type="text" class="form-control form-control-sm" v-model="direccion.Street"/></td>
                                                                <td>
                                                                    <el-select v-model="direccion.cUbigeo"
                                                                                filterable
                                                                                clearable
                                                                                placeholder="SELECCIONE">
                                                                        <el-option
                                                                            v-for="item in arrayUbigeos"
                                                                            :key="item.cCode"
                                                                            :label="item.cUbigeo"
                                                                            :value="item.cCode">
                                                                        </el-option>
                                                                    </el-select>
                                                                </td>
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
                                                                <th>Ubigeo</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(direccion, index) in arrayDireccionesDespacho" :key="index">
                                                                <td> {{ direccion.AddressName = direccion.AddressID + 0 + (index+1) }} </td>
                                                                <td><input type="text" class="form-control form-control-sm" v-model="direccion.Street"/></td>
                                                                <td>
                                                                    <el-select v-model="direccion.cUbigeo"
                                                                                filterable
                                                                                clearable
                                                                                placeholder="SELECCIONE">
                                                                        <el-option
                                                                            v-for="item in arrayUbigeos"
                                                                            :key="item.cCode"
                                                                            :label="item.cUbigeo"
                                                                            :value="item.cCode">
                                                                        </el-option>
                                                                    </el-select>
                                                                </td>
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

            <!-- Modal Ver Detalle Depositos del Pedido -->
            <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">PEDIDO: CLIENTE {{ fillDetalleDeposito.cnombrecontacto }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal">
                                            <div class="col-lg-12">
                                                <template v-if="arrayDetalleDepositosPorPedido.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>BANCO</th>
                                                                    <th>N° OPERACIÓN</th>
                                                                    <th>MONEDA</th>
                                                                    <th>FECHA</th>
                                                                    <th>TTPO CAMBIO</th>
                                                                    <th>MONTO s./</th>
                                                                    <th>MONTO US$</th>
                                                                    <th>ESTADO</th>
                                                                    <th>VOUCHER</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="depositos in arrayDetalleDepositosPorPedido" :key="depositos.nIdDepositoPedido"
                                                                        :style="{ background : depositos.colorearEstadoDeposito}">
                                                                    <td v-text="depositos.cNombreBanco"></td>
                                                                    <td v-text="depositos.nNumeroOperacion"></td>
                                                                    <td v-text="depositos.cNombreMoneda"></td>
                                                                    <td v-text="depositos.dFechaDeposito"></td>
                                                                    <td v-text="depositos.fTipoCambio"></td>
                                                                    <td v-text="Number((parseFloat(depositos.fMontoSoles)).toFixed(2))"></td>
                                                                    <td v-text="Number((parseFloat(depositos.fMontoDolares)).toFixed(2))"></td>
                                                                    <td v-text="depositos.cEstadoDeposito"></td>
                                                                    <td>
                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                            <div slot="content">Voucher del Deposito {{ depositos.nNumeroOperacion }}</div>
                                                                            <i @click="descargaVoucher(depositos.cRutaDocumento)" class="fa-md fa fa-file-pdf-o" :style="'color:red'"></i>
                                                                        </el-tooltip>
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
                                            <div class="col-lg-12">
                                                <el-row :gutter="10">
                                                    <el-col :span="6" :offset="12"><div class="grid-content bg-purple">IMPORTE CANCELADO</div></el-col>
                                                    <el-col :span="6">
                                                        <div class="grid-content bg-purple">
                                                            US$. {{ Number((parseFloat(fillDetalleDeposito.flagMontoTotalDepositos)).toFixed(2)) }}
                                                        </div>
                                                    </el-col>
                                                </el-row>
                                                <el-row :gutter="10">
                                                    <el-col :span="6" :offset="12"><div class="grid-content bg-purple"> MONTO PEDIDO</div></el-col>
                                                    <el-col :span="6">
                                                        <div class="grid-content bg-purple">
                                                            US$. {{ Number((parseFloat(fillDetalleDeposito.flagMontoTotalCotizacion)).toFixed(2)) }}
                                                        </div>
                                                    </el-col>
                                                </el-row>
                                                <el-row :gutter="10">
                                                    <el-col :span="6" :offset="12"><div class="grid-content bg-purple"> SALDO CANCELAR</div></el-col>
                                                    <el-col :span="6">
                                                        <div class="grid-content bg-purple">
                                                            USD. {{ Number((parseFloat(fillDetalleDeposito.flagMontoCancelar)).toFixed(2)) }}
                                                        </div>
                                                    </el-col>
                                                </el-row>
                                            </div>
                                        </form>
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
                ccustomercode: 'C20480683839',
                nSolutionCode:  0,
                fillProveedor:{
                    nidproveedor: 0,
                    cproveedornombre: ''
                },
                arrayProveedor: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
                //========================  TAB PEDIDOS APROBADOS ====================
                fillPedido:{
                    dfechainicio: '',
                    dfechafin: '',
                    cnumeropedido: '',
                    cnumerovin: '',
                    nidestadopedido: '',
                    ntipopersona: 1,
                    ccontacto: '',
                    cnrodocumento: '',
                    nidmarca: '',
                    nidmodelo: ''
                },
                arrayPedidosAprobados: [],
                //========================  TAB APROBAR PEDIDO ====================
                fillBusquedaPedido:{
                    dfechainicio: '',
                    dfechafin: '',
                    cnumeropedido: '',
                    cnumerovin: '',
                    nidmarca: '',
                    nidmodelo: '',
                    ccontacto: '',
                    cnrodocumento: ''
                },
                arrayPedidos: [],
                //=========================== MODAL DETALLE PEDIDO ===================
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
                //====================================================================
                // MODAL ASIGNACIÓN DIRECCIONES
                cFlagOpcion: '',
                arrayDireccionesExisten: [],
                cFlagDireccionCU: 1,
                arrayUbigeos: [],
                arrayDireccionesFiscales: [],
                arrayDireccionesDespacho: [],
                fillDirecciones: {
                    nIdCabeceraPedido: '',
                    nIdPersona: '',
                    nIdContacto: '',
                    cContacto: '',
                    cDireccion: '',
                    cUbigeo: '',
                    cCardCode: '',//Valida si hay cardcode
                    cTipoPersona: ''//Valida que tipo persona para integrarla
                },
                arrayContacto: [],
                SAPNuevoContactoJson: '',
                //===========================================================
                // ==================  VARIABLES SAP ========================
                formSap:{
                    nidcabecerapedido: 0,
                    ccardcode: '',
                    igv: 0,
                    cnumerovin: '',
                    ndocentry: 0
                },
                //=====Variables SAP para OrdenVenta Vehiculo
                arraySapRespuestaVehiculo: [],
                arraySapUpdSgcVehiculo: [],
                jsonRespuestaVehiculo: '',
                arraySapItemCodeVehiculo: [],
                arrayVINPedidoVehiculo: [],//Almacena VINES
                arraySapActividadVehiculo: [],
                fillLlamadaServicio: {
                    cCustomerCode: '',
                    cInternalSerialNum: '',
                    cItemCode: '',
                    cSubject: ''
                },
                arrayServiceCallActivities: [],
                //=====Variables SAP para OrdenVenta Elemento Venta
                arraySapRespuestaEV: [],
                jsonRespuestaEV: '',
                arraySapUpdSgcEV: [],
                arraySapItemCodeEV: [],
                arrayCodSAPPedidoEV: [],//Almacena CodSAP
                arraySapActividadEV: [],
                //=====Variables SAP Antiguas OrdenVenta
                arraySapRespuesta: [],
                arraySapItemCode: [],
                jsonRespuesta: '',
                arraySapUpdSgc: [],
                arraySapPedido: [],
                arraySapEVPedido: [],
                arraySapActividad: [],
                arraySapLlamadaServicio: [],
                arraySapCostoEV: [],
                arraySapCostoServicio: [],
                arraySapElementoVenta: [],
                arraySapEVArticulosEnvia: [],
                arraySapEVServiciosEnvia: [],
                arraySapSolucion: [],
                arrayPatchLlamadaServicios: [],
                fAvgPrice: 0,
                fImporte: 0,
                //===========================================================
                // =============  VARIABLES ALMACEN ========================
                formAlmacen:{
                    nidlocalidad: 0,
                    cwhscode: '',
                    cwhsname: ''
                },
                arrayAlmacen: [],
                // =============================================================================
                // ================ VARIABLES MODAL DETALLE DEPOSITOS POR PEDIDO ===============
                fillDetalleDeposito: {
                    nidcabecerapedido: 0,
                    cnombrecontacto: '',
                    flagMontoTotalCotizacion: 0,
                    flagMontoTotalDepositos: 0,
                    flagMontoCancelar: 0
                },
                arrayDetalleDepositosPorPedido: [],
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
        mounted(){
            this.llenarComboMarca();
            this.llenarComboModelo();
            this.obtenerAlmacenPorDefecto();
            this.obtenerCodigoSapEmpresa();
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
            tabBuscaPedidoAprobado(){
                this.arrayPedidosAprobados= [];
            },
            listarPedidosAprobados(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/pedido/GetListPedidoAprobados';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       :   parseInt(sessionStorage.getItem("nIdSucursal")),
                        'dfechainicio'      :   this.fillPedido.dfechainicio,
                        'dfechafin'         :   this.fillPedido.dfechafin,
                        'cnumeropedido'     :   this.fillPedido.cnumeropedido,
                        'cnumerovin'        :   this.fillPedido.cnumerovin,
                        'nidmarca'          :   this.fillBusquedaPedido.nidmarca,
                        'nidmodelo'         :   this.fillBusquedaPedido.nidmodelo,
                        'nidestadopedido'   :   this.fillPedido.nidestadopedido,
                        'ccontacto'         :   this.fillPedido.ccontacto,
                        'cnrodocumento'     :   this.fillPedido.cnrodocumento,
                        'ntipopersona'      :   this.fillPedido.ntipopersona,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayPedidosAprobados      = response.data.arrayPedido.data;
                    this.pagination.current_page    = response.data.arrayPedido.current_page;
                    this.pagination.total           = response.data.arrayPedido.total;
                    this.pagination.per_page        = response.data.arrayPedido.per_page;
                    this.pagination.last_page       = response.data.arrayPedido.last_page;
                    this.pagination.from            = response.data.arrayPedido.from;
                    this.pagination.to              = response.data.arrayPedido.to;
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
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarPedidosAprobados(page);
            },
            //==========================================================
            //=================== REGISTRO SAP INDIVIDUAL ==============
            validarSapPedido(objPedido){
                this.getPedidoById(objPedido);
            },
            getPedidoById(objPedido){
                var url = this.ruta + '/pedido/GetPedidoById';
                axios.get(url, {
                    params: {
                        'nidempresa'        : objPedido.nIdEmpresa,
                        'nidsucursal'       : objPedido.nIdSucursal,
                        'nidcabecerapedido' : objPedido.nIdCabeceraPedido
                    }
                }).then(response => {
                    this.arraySapPedido = response.data.arrayCabeceraPedido.data;
                    this.getEVById(objPedido);
                    this.getObsequiosCampaniasByIdPedido(objPedido);
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
            getEVById(objPedido){
                var url = this.ruta + '/pedido/GetPedidoEVById';
                axios.get(url, {
                    params: {
                        'nidempresa'        : objPedido.nIdEmpresa,
                        'nidsucursal'       : objPedido.nIdSucursal,
                        'nidcabecerapedido' : objPedido.nIdCabeceraPedido
                    }
                }).then(response => {
                    this.arraySapEVPedido = response.data.arrayEVPedido.data;
                    this.generaSapBusinessPedido(objPedido);
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
            getObsequiosCampaniasByIdPedido(objPedido){
                let me = this;
                var url = me.ruta + '/pedido/GetCampaniaObsequioByIdPedido';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   objPedido.nIdEmpresa,
                        'nidsucursal'       :   objPedido.nIdSucursal,
                        'nidcabecerapedido' :   objPedido.nIdCabeceraPedido,
                        'opcion'            :   1
                    }
                }).then(response => {
                    me.arraySapElementoVenta = response.data.arrayEVPedido;

                    if (me.arraySapElementoVenta.length > 0) {
                        me.arraySapElementoVenta.map(function(value, key) {
                            //Amaceno Solo Articulos para Costo Promedio
                            if(value.nIdTipoElementoVenta != 1300025){
                                me.arraySapEVArticulosEnvia.push({
                                    'nWhsCode'  :  me.formAlmacen.cwhscode ? parseInt(me.formAlmacen.cwhscode) : parseInt('00'),
                                    'cItemCode' :  value.cCodigoERP
                                });
                            }
                            //Almaceno Servicios para envar el Costo de Sgc
                            else {
                                me.arraySapEVServiciosEnvia.push({
                                    'nWhsCode'  : me.formAlmacen.cwhscode ? parseInt(me.formAlmacen.cwhscode) : parseInt('00'),
                                    'cItemCode' : value.cCodigoERP,
                                    'fImporte'  : value.fImporte
                                });
                            }
                        });
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
            //REGISTRA PEDIDO EN SAP
            generaSapBusinessPedido(objPedido){
                let me = this;

                 //Verifico Si No existe OrdenVenta del Vehiculo
                if(objPedido.nDocEntryDetallePedido == 0) {
                    //==============================================================
                    //================== REGISTRO PEDIDO EN SAP ====================
                    me.loadingProgressBar("INTEGRANDO EL PEDIDO CON SAP BUSINESS ONE...");

                    var sapUrl = me.ruta + '/pedido/SapSetPedido';
                    axios.post(sapUrl, {
                        'fDocDate'          :   moment().format('YYYY-MM-DD'),
                        'fDocDueDate'       :   moment().add(30, 'days').format('YYYY-MM-DD'),
                        'WarehouseCode'     :   me.formAlmacen.cwhscode,
                        'nIdSapSucursal'    :   parseInt(sessionStorage.getItem("nIdSapSucursal")),
                        'arraySapPedido'    :   me.arraySapPedido,
                        'arraySapEVPedido'  :   me.arraySapEVPedido
                    }).then(response => {
                        // ======================================================================
                        // GUARDAR ORDEN VENTA PARA EL VEHÍCULO EN SQL SERVER
                        // ======================================================================
                        me.arraySapRespuestaVehiculo = [];
                        me.arraySapUpdSgcVehiculo = [];

                        me.arraySapRespuestaVehiculo = response.data.arrayVehiculo;//arreglar
                        if(me.arraySapRespuestaVehiculo.length > 0) {
                            me.arraySapRespuestaVehiculo.map(function(value, key){
                                me.jsonRespuestaVehiculo = '';
                                me.jsonRespuestaVehiculo = JSON.parse(value);
                                //Verifico que devuelva DocEntry
                                if(me.jsonRespuestaVehiculo.DocEntry){
                                    console.log("Integración Pedido Vehiculo SAP : OK");
                                    //console.log(me.jsonRespuestaVehiculo.DocEntry);
                                    //Guardo el VIN del Pedido del Vehìculo
                                    me.arrayVINPedidoVehiculo.push({
                                        'nDocEntry' : parseInt(me.jsonRespuestaVehiculo.DocEntry),
                                        'cItemCode' : me.jsonRespuestaVehiculo.DocumentLines[0].ItemCode.toString()
                                    });

                                    me.arraySapUpdSgcVehiculo.push({
                                        'nIdCabeceraPedido' :   (me.cFlagOpcion == 1) ? me.fillDirecciones.nIdCabeceraPedido.toString() : me.formSap.nidcabecerapedido.toString(),
                                        'cItemCode'         :   me.jsonRespuestaVehiculo.DocumentLines[0].ItemCode.toString(),
                                        'nDocEntry'         :   parseInt(me.jsonRespuestaVehiculo.DocEntry),
                                        'nDocNum'           :   parseInt(me.jsonRespuestaVehiculo.DocNum),
                                        'cDocType'          :   me.jsonRespuestaVehiculo.DocType.toString(),
                                        'cLogRespuesta'     :   me.arraySapRespuestaVehiculo[key].toString()
                                    });

                                    me.arraySapActividadVehiculo.push({
                                        'dActivityDate' :   moment().format('YYYY-MM-DD'),
                                        'hActivityTime' :   moment().format('HH:mm:ss'),
                                        'cCardCode'     :   me.ccustomercode,
                                        'cNotes'        :   'OrdenVenta',
                                        'nDocEntry'     :   me.jsonRespuestaVehiculo.DocEntry.toString(),
                                        'nDocNum'       :   me.jsonRespuestaVehiculo.DocNum.toString(),
                                        'nDocType'      :   '17',
                                        'nDuration'     :   '15',
                                        'cDurationType' :   'du_Minuts',
                                        'dEndDueDate'   :   moment().format('YYYY-MM-DD'),
                                        'hEndTime'      :   moment().add(15, 'minutes').format('HH:mm:ss'),
                                        'cReminder'     :   'tYES',
                                        'nReminderPeriod':  '15',
                                        'cReminderType' :   'du_Minuts',
                                        'dStartDate'    :   moment().format('YYYY-MM-DD'),
                                        'hStartTime'    :   moment().format('HH:mm:ss')
                                    });
                                }
                            });
                        }

                        // ======================================================================
                        // GUARDAR ORDEN VENTA PARA LOS ELEMENTOS DE VENTA EN SQL SERVER
                        // ======================================================================
                        me.arraySapRespuestaEV = [];
                        me.arraySapUpdSgcEV = [];

                        me.arraySapRespuestaEV = response.data.arrayEV;
                        if(me.arraySapRespuestaEV.length > 0) {
                            me.arraySapRespuestaEV.map(function(value, key){
                                me.jsonRespuestaEV = '';
                                me.jsonRespuestaEV= JSON.parse(value);
                                //Verifico que devuelva DocEntry
                                if(me.jsonRespuestaEV.DocEntry){
                                    console.log("Integración Pedido Ele.Venta SAP : OK");
                                    //console.log(me.jsonRespuestaEV.DocEntry);

                                    //Generar varias lineas de la misma Orden Venta para actualizar DOCENTRY en cada detalle de Pedido en SQL SERVER
                                    let arrayDocumentLines = me.jsonRespuestaEV.DocumentLines;
                                    //console.log(arrayDocumentLines);
                                    arrayDocumentLines.map(function(linea) {
                                        //console.log(linea);
                                        //Guardo el Codigo SAP de los Elemento Venta
                                        me.arrayCodSAPPedidoEV.push({
                                            'nDocEntry' :   parseInt(me.jsonRespuestaEV.DocEntry),
                                            'cItemCode' :   linea.ItemCode.toString()
                                        });

                                        me.arraySapUpdSgcEV.push({
                                            'nIdCabeceraPedido' :   (me.cFlagOpcion == 1) ? me.fillDirecciones.nIdCabeceraPedido.toString() : me.formSap.nidcabecerapedido.toString(),
                                            'cItemCode'         :   linea.ItemCode.toString(),
                                            'nDocEntry'         :   parseInt(me.jsonRespuestaEV.DocEntry),
                                            'nDocNum'           :   parseInt(me.jsonRespuestaEV.DocNum),
                                            'cDocType'          :   me.jsonRespuestaEV.DocType.toString(),
                                            'cLogRespuesta'     :   me.arraySapRespuestaEV[key].toString()
                                        });
                                    });

                                    me.arraySapActividadEV.push({
                                        'dActivityDate' :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                        'hActivityTime' :   '08:13:00',
                                        'cCardCode'     :   me.ccustomercode,
                                        'cNotes'        :   'OrdenVenta',
                                        //'cCardCode'   :   'P20506006024',
                                        'nDocEntry'     :   me.jsonRespuestaEV.DocEntry.toString(),
                                        'nDocNum'       :   me.jsonRespuestaEV.DocNum.toString(),
                                        'nDocType'      :   '17',
                                        'nDuration'     :   '15',
                                        'cDurationType' :   'du_Minuts',
                                        'dEndDueDate'   :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                        'hEndTime'      :   '08:28:00',
                                        'cReminder'     :   'tYES',
                                        'nReminderPeriod':  '15',
                                        'cReminderType' :   'du_Minuts',
                                        'dStartDate'    :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                        'hStartTime'    :   '08:13:00'
                                    });
                                }
                            });
                        }

                        //==============================================================
                        //================== ACTUALIZAR DOCENTRY PEDIDO ================
                        setTimeout(function() {
                            me.generaSgcPedido(objPedido);
                        }, 800);
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
                } else {
                     //==============================================================
                    //================== REGISTRO ACTIVIDAD EN SAP ==================
                    setTimeout(function() {
                        me.generaSapBusinessActividad(objPedido);
                    }, 800);
                }
            },
            generaSgcPedido(objPedido){
                let me = this;

                var sapUrl = me.ruta + '/pedido/SapUpdPedidoByDocEntry';
                axios.post(sapUrl, {
                    'arraySapUpdSgcVehiculo': me.arraySapUpdSgcVehiculo,
                    'arraySapUpdSgcEV'      : me.arraySapUpdSgcEV
                }).then(response => {
                    if (response.data[0].nFlagMsje == 1) {
                        setTimeout(function() {
                            me.generaSapBusinessActividad(objPedido);
                        }, 800);
                    } else {
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
            generaSapBusinessActividad(objPedido){
                let me = this;

                //Verificar si el Detalle del Pedido esta integrado
                if(objPedido.nDocEntryDetallePedido!=0) {
                    //Guardo el/los VIN(es) del Pedido del/los Vehìculo(s)
                    me.arrayVINPedidoVehiculo.push({
                        'nDocEntry' : objPedido.nDocEntryDetallePedido,
                        'cItemCode' : objPedido.cItemCode
                    });

                    me.arraySapActividadVehiculo.push({
                        'dActivityDate' :   moment().format('YYYY-MM-DD'),
                        'hActivityTime' :   moment().format('HH:mm:ss'),
                        'cCardCode'     :   objPedido.cCustomerCode,
                        'cNotes'        :   objPedido.cNotes,
                        'nDocEntry'     :   objPedido.nDocEntryDetallePedido.toString(),
                        'nDocNum'       :   objPedido.nDocNumDetallePedido.toString(),
                        'nDocType'      :   '17',
                        'nDuration'     :   '15',
                        'cDurationType' :   'du_Minuts',
                        'dEndDueDate'   :   moment().format('YYYY-MM-DD'),
                        'hEndTime'      :   moment().add(15, 'minutes').format('HH:mm:ss'),
                        'cReminder'     :   'tYES',
                        'nReminderPeriod':  '15',
                        'cReminderType' :   'du_Minuts',
                        'dStartDate'    :   moment().format('YYYY-MM-DD'),
                        'hStartTime'    :   moment().format('HH:mm:ss')
                    });

                    me.arraySapEVPedido.map(function(value, key){
                        //Guardo el Codigo SAP de los Elemento Venta
                        me.arrayCodSAPPedidoEV.push({
                            'nDocEntry' :   parseInt(value.nDocEntryDetallePedido),
                            'cItemCode' :   value.cNumeroVin.toString()
                        });

                        /**
                         * Solo la primera iteración debido que es la misma actividad para todos los EV
                         * ya que estos pertenecen a una sola OV
                         */
                        if(key == 0)
                        {
                            me.arraySapActividadEV.push({
                                'dActivityDate' :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                'hActivityTime' :   '08:13:00',
                                'cCardCode'     :   value.cCustomerCode,
                                'cNotes'        :   'OrdenVenta',
                                //'cCardCode'   :   'P20506006024',
                                'nDocEntry'     :   value.nDocEntryDetallePedido.toString(),
                                'nDocNum'       :   value.nDocNumDetallePedido.toString(),
                                'nDocType'      :   '17',
                                'nDuration'     :   '15',
                                'cDurationType' :   'du_Minuts',
                                'dEndDueDate'   :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                'hEndTime'      :   '08:28:00',
                                'cReminder'     :   'tYES',
                                'nReminderPeriod':  '15',
                                'cReminderType' :   'du_Minuts',
                                'dStartDate'    :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                'hStartTime'    :   '08:13:00'
                            });
                        }
                    })
                }

                //Verificar si no existe Actividad registrada
                if(objPedido.nActivityCode == 0){
                    var sapUrl = me.ruta + '/actividad/SapSetActividadVenta';
                    axios.post(sapUrl, {
                        'arraySapActividadVehiculo' : me.arraySapActividadVehiculo,
                        'arraySapActividadEV'       : me.arraySapActividadEV
                    }).then(response => {
                        // ======================================================================
                        // GUARDAR ACTIVIDAD DE LA ORDEN DE VENTA PARA VEHÍCULO EN SQL SERVER
                        // ======================================================================
                        me.arraySapRespuestaVehiculo = [];
                        me.arraySapUpdSgcVehiculo = [];

                        me.arraySapRespuestaVehiculo = response.data.arrayVehiculo;
                        if(me.arraySapRespuestaVehiculo.length > 0) {
                            me.arraySapRespuestaVehiculo.map(function(value, key){
                                me.jsonRespuestaVehiculo = '';
                                me.jsonRespuestaVehiculo= JSON.parse(value);
                                //Si el valor de respuesta Code tiene un valor
                                if(me.jsonRespuestaVehiculo.ActivityCode){
                                    me.arraySapUpdSgcVehiculo.push({
                                        'nActividadTipo': 17,
                                        'cActividadTipo': 'OrdenVenta',
                                        'nActivityCode' : parseInt(me.jsonRespuestaVehiculo.ActivityCode),
                                        'cCardCode'     : me.jsonRespuestaVehiculo.CardCode.toString(),
                                        'nDocEntry'     : parseInt(me.jsonRespuestaVehiculo.DocEntry),
                                        'nDocNum'       : parseInt(me.jsonRespuestaVehiculo.DocNum),
                                        'cLogRespuesta' : me.arraySapRespuestaVehiculo[key].toString()
                                    });
                                }
                            });
                        }

                        // ======================================================================
                        // GUARDAR ACTIVIDAD DE LA ORDEN DE VENTA PARA ELEMENTO VENTA EN SQL SERVER
                        // ======================================================================
                        me.arraySapRespuestaEV = [];
                        me.arraySapUpdSgcEV = [];

                        me.arraySapRespuestaEV = response.data.arrayEV;
                        if(me.arraySapRespuestaEV.length > 0) {
                            me.arraySapRespuestaEV.map(function(value, key){
                                me.jsonRespuestaEV = '';
                                me.jsonRespuestaEV = JSON.parse(value);
                                //Si el valor de respuesta Code tiene un valor
                                if(me.jsonRespuestaEV.ActivityCode){
                                    me.arraySapUpdSgcEV.push({
                                        'nActividadTipo': 17,
                                        'cActividadTipo': 'OrdenVenta',
                                        'nActivityCode' : parseInt(me.jsonRespuestaEV.ActivityCode),
                                        'cCardCode'     : me.jsonRespuestaEV.CardCode.toString(),
                                        'nDocEntry'     : parseInt(me.jsonRespuestaEV.DocEntry),
                                        'nDocNum'       : parseInt(me.jsonRespuestaEV.DocNum),
                                        'cLogRespuesta' : me.arraySapRespuestaEV[key].toString()
                                    });
                                }
                            });
                        }

                        //================================================================
                        //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                        setTimeout(function() {
                            me.generaSgcActividad(objPedido);
                        }, 800);
                    }).catch(error => {
                        console.log(error);
                        if (error.response) {
                            if (error.response.status == 401) {
                                swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                location.reload('0');
                            }
                        }
                    });
                } else {
                    //================================================================
                    //=========== REGISTRO SOLUCION SAP ==========
                    setTimeout(function() {
                        me.registroSapBusinessSolucion(objPedido);
                    }, 800);
                }
            },
            generaSgcActividad(objPedido){
                let me = this;
                var sapUrl = me.ruta + '/actividad/SetIntegraActividadVenta';
                axios.post(sapUrl, {
                    'arraySapUpdSgcVehiculo': me.arraySapUpdSgcVehiculo,
                    'arraySapUpdSgcEV'      : me.arraySapUpdSgcEV
                }).then(response => {
                    setTimeout(function() {
                        me.generaSapBusinessSolucion(objPedido);
                    }, 800);
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
            generaSapBusinessSolucion(objPedido){
                let me = this;
                if(objPedido.nSolutionCode == 0) {
                    me.arraySapSolucion.push({
                        'cItemCode' : objPedido.cNumeroVin,
                        'cSubject'  : objPedido.cSubjectSolution
                    });

                    var sapUrl = me.ruta + '/solucion/SapSetSolucion';
                    axios.post(sapUrl, {
                        'data': me.arraySapSolucion
                    }).then(response => {
                        me.arraySapRespuesta = [];
                        me.arraySapUpdSgc = [];

                        me.arraySapRespuesta = response.data;
                        me.arraySapRespuesta.map(function(x){
                            me.jsonRespuesta = '';
                            me.jsonRespuesta= JSON.parse(x);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuesta.SolutionCode){
                                me.arraySapUpdSgc.push({
                                    'nSolutionCode' : parseInt(me.jsonRespuesta.SolutionCode),
                                    'cItemCode'     : me.jsonRespuesta.ItemCode.toString(),
                                    'cFlagTipo'     : 'C',
                                    'cLogRespuesta' : response.data.toString()
                                });

                                me.arraySapLlamadaServicio = [];
                                me.arraySapLlamadaServicio.push({
                                    'nActivityCode'     : me.nactivitycode,
                                    'cCustomerCode'     : objPedido.cCustomerCode,
                                    'cInternalSerialNum': objPedido.cNumeroVin,
                                    'cItemCode'         : objPedido.cNumeroVin,
                                    'nSolutionCode'     : me.jsonRespuesta.SolutionCode,
                                    'cSubject'          : objPedido.cSubject
                                });

                                //================================================================
                                //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                                setTimeout(function() {
                                    me.generaSgcSolucion(objPedido);
                                }, 800);
                            }
                        });
                    }).catch(error => {
                        console.log(error);
                        if (error.response) {
                            if (error.response.status == 401) {
                                swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                location.reload('0');
                            }
                        }
                    });
                } else {
                    //==============================================================
                    //============ REGISTRO LLAMADA DE SERVICIO EN SAP =============
                    setTimeout(function() {
                        me.generaSapBusinessLlamadaServicio(objPedido);
                    }, 800);
                }
            },
            generaSgcSolucion(objPedido){
                let me = this;
                var sapUrl = me.ruta + '/solucion/SetIntegraSolucion';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.obtenerOrdenVentaActividad(objPedido);
                    }, 800);
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
            obtenerOrdenVentaActividad(objPedido){
                let me = this;
                var sapUrl = me.ruta + '/actividad/GetIntegraActividadVentaByItemCode';
                axios.post(sapUrl, {
                    'arrayVINPedidoVehiculo': me.arrayVINPedidoVehiculo,
                    'arrayCodSAPPedidoEV'   : me.arrayCodSAPPedidoEV,
                    'nactividadtipo'        : 17
                }).then(response => {
                    // ======================================================================
                    // OBTENER INFORMACIÓN DE LA ACTIVIDAD DEL VEHÍCULO PARA LLAMADA SERVICIOS
                    // ======================================================================
                    me.arraySapRespuestaVehiculo = [];
                    me.arraySapLlamadaServicio = [];

                    me.arraySapRespuestaVehiculo = response.data.arrayInfoVehiculoActividad;
                    if(me.arraySapRespuestaVehiculo.length > 0) {
                        me.arraySapRespuestaVehiculo.map(function(value, key){
                            //Guardar Cabecera Llamada Servicios
                            me.fillLlamadaServicio.cCustomerCode        = value.cCustomerCode;
                            me.fillLlamadaServicio.cInternalSerialNum   = value.cItemCode;
                            me.fillLlamadaServicio.cItemCode            = value.cItemCode;
                            me.fillLlamadaServicio.cSubject             = value.cSubject;
                            //Guardar Detalle de Actividades del Servicio
                            me.arraySapLlamadaServicio.push({
                                'nActivityCode': value.nActivityCode
                            });
                        });
                    }

                    // ======================================================================
                    // OBTENER INFORMACIÓN DE LA ACTIVIDAD DEL E.V PARA LLAMADA SERVICIOS
                    // ======================================================================
                    me.arraySapRespuestaEV = [];

                    me.arraySapRespuestaEV = response.data.arrayInfoEVActividad;
                    if(me.arraySapRespuestaEV.length > 0) {
                        me.arraySapRespuestaEV.map(function(value, key){
                            //Guardar Detalle de Actividades del Servicio
                            if(key == 0) {
                                me.arraySapLlamadaServicio.push({
                                    'nActivityCode': value.nActivityCode
                                });
                            }
                        });
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
                setTimeout(function() {
                    me.registroSapBusinessLlamadaServicio(objPedido);
                }, 800);
            },
            generaSapBusinessLlamadaServicio(objPedido){
                let me = this;

                me.loading.close();
                me.loadingProgressBar("INTEGRANDO LLAMADA DE SERVICIO CON SAP BUSINESS ONE...");

                var sapUrl = me.ruta + '/llamadaservicio/SapSetLlamadaServicioVenta';
                axios.post(sapUrl, {
                    'arraySapLlamadaServicio'   : me.arraySapLlamadaServicio,
                    'cCustomerCode'             : me.fillLlamadaServicio.cCustomerCode,
                    'cInternalSerialNum'        : me.fillLlamadaServicio.cInternalSerialNum,
                    'cItemCode'                 : me.fillLlamadaServicio.cItemCode,
                    'cSubject'                  : me.fillLlamadaServicio.cSubject,
                    'nSolutionCode'             : me.nSolutionCode
                }).then(response => {
                    // ======================================================================
                    // GUARDAR LLAMADA DE SERVICIOS DE LA O.V DEL VEHICULO EN SQL SERVER
                    // ======================================================================
                    me.arraySapRespuestaVehiculo = [];
                    me.arraySapUpdSgcVehiculo = [];

                    me.arraySapRespuestaVehiculo = response.data.arrayVehiculo;
                    if(me.arraySapRespuestaVehiculo.length > 0) {
                        me.arraySapRespuestaVehiculo.map(function(value, key){
                            me.jsonRespuestaVehiculo = '';
                            me.jsonRespuestaVehiculo = JSON.parse(value);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuestaVehiculo.ItemCode){

                                //Arreglo de Actividades para Actualizar por Llamada de Servicios en SQL SERVER
                                let listServiceCallActivities = me.jsonRespuestaVehiculo.ServiceCallActivities;
                                listServiceCallActivities.map(function(linea) {
                                    me.arrayServiceCallActivities.push({
                                        'nServiceCallID':   me.jsonRespuestaVehiculo.ServiceCallID.toString(),
                                        'nActivityCode' :   linea.ActivityCode.toString()
                                    });
                                });
                                me.arraySapUpdSgcVehiculo.push({
                                    'nServiceCallID'    : me.jsonRespuestaVehiculo.ServiceCallID.toString(),
                                    'cFlagTipo'         : 'V',
                                    'nActivityCode'     : 0,
                                    'cItemCode'         : me.jsonRespuestaVehiculo.ItemCode.toString(),
                                    'cInternalSerialNum': me.jsonRespuestaVehiculo.InternalSerialNum.toString(),
                                    'cLogRespuesta'     : me.arraySapRespuestaVehiculo[key].toString()
                                });
                            }
                        });
                    }
                    //=========================================================================
                    //============ ACTUALIZO TABLA INTEGRACION LLAMADA SERVICIO SGC ===========
                    setTimeout(function() {
                        me.generaSgcLlamadaServicio(objPedido);
                    }, 800);
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
            generaSgcLlamadaServicio(objPedido){
                let me = this;
                var sapUrl = me.ruta + '/llamadaservicio/SetIntegraLlamadaServicioVenta';
                axios.post(sapUrl, {
                    'arraySapUpdSgcVehiculo'    : me.arraySapUpdSgcVehiculo,
                    'arrayServiceCallActivities': me.arrayServiceCallActivities
                }).then(response => {
                    setTimeout(function() {
                        me.getLlamadasServicios(objPedido);
                    }, 800);
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
            getLlamadasServicios(objPedido){
                let me = this;
                var url = me.ruta + '/pedido/GetLlamadasServiciosByPedido';
                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       : parseInt(sessionStorage.getItem("nIdSucursal")),
                        //Si es 1 (Desde Form Direcciones) / Si es 2 desde Aprobación Directa
                        'nidcabecerapedido' : (this.cFlagOpcion == 1) ? this.fillDirecciones.nIdCabeceraPedido : this.formSap.nidcabecerapedido
                    }
                }).then(response => {
                    me.arrayPatchLlamadaServicios = response.data.arrayLlamadaServicios;
                    setTimeout(function() {
                        me.closeLlamadasServicios(objPedido);
                    }, 800);
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
            closeLlamadasServicios(objPedido){
                let me = this;

                var url = me.ruta + '/llamadaservicio/SapCloseLlamadaServicio';
                axios.post(url, {
                    'data'  : me.arrayPatchLlamadaServicios
                }).then(response => {
                    setTimeout(function() {
                        me.updTarjetaEquipo(objPedido);
                    }, 800);
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
            updTarjetaEquipo(objPedido){
                let me = this;

                var url = me.ruta + '/tarjetaequipo/SapUpdSocioNegocio';
                axios.post(url, {
                    'data'  : me.arraySapPedido
                }).then(response => {
                    setTimeout(function() {
                        me.getSapCostoPromedio(objPedido);
                    }, 800);
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
            getSapCostoPromedio(objPedido){
                let me = this;
                me.loading.close();
                me.loadingProgressBar("INTEGRANDO COSTOS CON SAP BUSINESS ONE...");
                var sapUrl = me.ruta + '/articulo/SapGetCostoPromedio';
                axios.post(sapUrl, {
                    'data': me.arraySapEVArticulosEnvia
                }).then(response => {
                    me.arraySapRespuestaVehiculo = [];
                    me.arraySapUpdSgcVehiculo = [];

                    me.arraySapRespuestaVehiculo = response.data;
                    me.arraySapRespuestaVehiculo.map(function(value, key){
                        me.fAvgPrice = me.fAvgPrice + value.fAvgPrice;
                    });

                    me.arraySapCostoEV = [];
                    // ====================== CONCEPTO =========================
                    // ======================== ACCESORIOS ==========================
                    me.arraySapCostoEV.push({
                        U_SYP_VIN           :   me.formSap.cnumerovin,
                        DocEntry            :   me.formSap.ndocentry,
                        U_SYP_CCONCEPTO     :   '06',
                        U_SYP_DCONCEPTO     :   'Accesorios',
                        U_SYP_CDOCUMENTO    :   '03',
                        U_SYP_DDOCUMENTO    :   'Salida de Almacén',
                        U_SYP_IMPORTE       :   me.fAvgPrice,
                        U_SYP_COSTO         :   'Si',
                        U_SYP_ESTADO        :   'Pendiente'
                    });

                    //VERIFICAR QUE EL COSTO PROMEDIO > 0 Y EL nDocEntry TblCosto
                    if(me.fAvgPrice > 0 && me.formSap.ndocentry != 0){
                        setTimeout(function() {
                            me.generaSapBusinessTblCostoEV(objPedido);
                        }, 800);
                    } else {
                        setTimeout(function() {
                            me.getSgcCostoServicio(objPedido);
                        }, 800);
                    }
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Costos SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            generaSapBusinessTblCostoEV(objPedido){
                let me = this;

                var url = me.ruta + '/tablacosto/SapPachTablaCosto';
                axios.post(url, {
                    'data'  : me.arraySapCostoEV
                }).then(response => {
                    setTimeout(function() {
                        me.getSgcCostoServicio(objPedido);
                    }, 800);
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
            getSgcCostoServicio(objPedido){
                let me = this;
                me.arraySapEVServiciosEnvia.map(function(value, key){
                    me.fImporte = me.fImporte + value.fImporte;
                });

                me.arraySapCostoServicio = [];
                // ====================== CONCEPTO =========================
                // ======================== SERVICIOS ==========================
                me.arraySapCostoServicio.push({
                    U_SYP_VIN           :   me.formSap.cnumerovin,
                    DocEntry            :   me.formSap.ndocentry,
                    U_SYP_CCONCEPTO     :   '07',
                    U_SYP_DCONCEPTO     :   'Servicios',
                    U_SYP_CDOCUMENTO    :   '02',
                    U_SYP_DDOCUMENTO    :   'Factura Proveedor',
                    U_SYP_IMPORTE       :   me.fImporte,
                    U_SYP_COSTO         :   'Si',
                    U_SYP_ESTADO        :   'Pendiente'
                });

                //VERIFICAR QUE EL COSTO PROMEDIO > 0 Y EL nDocEntry TblCosto
                if(me.fImporte > 0 && me.formSap.ndocentry != 0){
                    setTimeout(function() {
                        me.generaSapBusinessTblCostoServicios(objPedido);
                    }, 800);
                } else {
                    setTimeout(function() {
                        me.confirmaMiPedido(objPedido);
                    }, 800);
                }

            },
            generaSapBusinessTblCostoServicios(objPedido){
                let me = this;

                var url = me.ruta + '/tablacosto/SapPachTablaCosto';
                axios.post(url, {
                    'data'  : me.arraySapCostoServicio
                }).then(response => {
                    me.confirmaMiPedido(objPedido);
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
            confirmaMiPedido(objPedido){
                let me = this;
                me.limpiarFormulario();
                me.listarPedidos(1);
                swal(
                    'Aprobado!',
                    'El pedido ha sido APROBADO con éxito.',
                    'success'
                );
                $("#myBar").hide();
                me.loading.close();
            },
            //================================================================
            //====================== TAB APROBAR PEDIDOS =====================
            tabAprobarPedido(){
                this.arrayPedidos= [];
            },
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
                        'nidmarca': this.fillBusquedaPedido.nidmarca,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayModelo = response.data.arrayModelo;
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
                        'nidempresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'dfechainicio'  : this.fillBusquedaPedido.dfechainicio,
                        'dfechafin'     : this.fillBusquedaPedido.dfechafin,
                        'cnumeropedido' : this.fillBusquedaPedido.cnumeropedido,
                        'cnumerovin'    : this.fillBusquedaPedido.cnumerovin,
                        'nidmarca'      : this.fillBusquedaPedido.nidmarca,
                        'nidmodelo'     : this.fillBusquedaPedido.nidmodelo,
                        'ccontacto'     : this.fillBusquedaPedido.ccontacto,
                        'cnrodocumento' : this.fillBusquedaPedido.cnrodocumento,
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
            obtenerAlmacenPorDefecto(){
                var url = this.ruta + '/almacen/GetAlmacenPorDefecto';
                axios.get(url, {
                    params: {
                        'nidsucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cflagtipo'     : 'VE'
                    }
                }).then(response => {
                    if(response.data.length){
                        this.formAlmacen.cwhscode = response.data[0].cWhsCode;
                        this.formAlmacen.cwhsname = response.data[0].cWhsName;
                    } else {
                        this.formAlmacen.cwhscode = '';
                        this.formAlmacen.cwhsname = 'Sin Almacén Definido';
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
            obtenerCodigoSapEmpresa(){
                this.ccustomercode = sessionStorage.getItem("cCustomerCode");
            },
            //METODOS ASIGNACIÓN DIRECCIONES
            obtenerDireccionesPorContacto(data){
                var url = this.ruta + '/pedido/GetDireccionesByPersona';
                axios.get(url, {
                    params: {
                        'nIdPersona': data.nIdPersona,
                        'cTipoPersona': data.cTipoPersona
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
                console.log("entro");
                this.fillDirecciones.cCardCode = data.cCardCode;

                //===========================================================================================
                // ====================================  CASO 01 ============================================
                //SI EL CARDCODE NO ESTA INTEGRADO (POR ENDE TAMPOCO LAS DIRECCIONES)
                if ((this.fillDirecciones.cCardCode == '' || this.fillDirecciones.cCardCode == null) && this.arrayDireccionesExisten.length == 0) {
                    console.log("caso01");
                    this.listarUbigeos();
                    this.cFlagOpcion = 1;//Flag Requiere Registrar Direcciones/Integración Contacto/Pedido
                    this.cFlagDireccionCU = 1;
                    //Abrir Modal
                    this.accionmodal=4;
                    this.modal = 1;
                    //Info para Integracion
                    this.fillDirecciones.nIdCabeceraPedido = data.nIdCabeceraPedido;
                    this.fillDirecciones.nIdPersona = data.nIdPersona;
                    this.fillDirecciones.nIdContacto = data.nIdContacto;
                    this.fillDirecciones.cTipoPersona = data.cTipoPersona;
                    this.fillDirecciones.cContacto = data.cContacto;
                }

                //===========================================================================================
                // ====================================  CASO 02 ============================================
                //SI EL CARDCODE ESTA INTEGRADO Y HAY DIRECCIONES
                if (this.fillDirecciones.cCardCode && this.arrayDireccionesExisten.length > 0) {
                    console.log("caso02");
                    //INTEGRAR PEDIDO
                    this.cFlagOpcion = 2;//Flag Requiere Integración Pedido
                    this.aprobarPedido(data);
                }

                //===========================================================================================
                // ====================================  CASO 03 ============================================
                //SI EL CARDCODE ESTA INTEGRADO Y NO HAY DIRECCIONES (CONTACOS ANTIGUOS)
                if (this.fillDirecciones.cCardCode && this.arrayDireccionesExisten.length == 0) {
                    console.log("caso03");
                    this.listarUbigeos();
                    this.cFlagOpcion = 1;
                    this.cFlagDireccionCU = 2;//Flag Requiere Actualizar Direcciones/Integración Direcciones (Actualizar Contacto)/Pedido
                    //Abrir Modal
                    this.accionmodal=4;
                    this.modal = 1;
                    //Info para Integracion
                    this.fillDirecciones.nIdCabeceraPedido = data.nIdCabeceraPedido;
                    this.fillDirecciones.nIdPersona = data.nIdPersona;
                    this.fillDirecciones.nIdContacto = data.nIdContacto;
                    this.fillDirecciones.cTipoPersona = data.cTipoPersona;
                    this.fillDirecciones.cContacto = data.cContacto;
                }
            },
            listarUbigeos(){
                var url = this.ruta + '/ubigeo/GetUbigeo';
                axios.get(url, {
                    params: {
                        'nopcion': 0,
                        'cfiltro': '',
                        'opcion' : 1
                    }
                }).then(response => {
                    this.arrayUbigeos = response.data.arrayUbigeo;
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
            agregarDireccion(op){
                if(this.validarAgregarDireccion(op)){
                    return;
                }
                let me = this;
                if (op == 1) {
                    me.arrayDireccionesFiscales.push({
                        'AddressID'     : 'Dirección Fiscal',
                        'AddressName'   : '',
                        'Street'        : '',
                        'cUbigeo'       : ''
                    });
                    toastr.success('Se Agregó una Nueva Dirección Fiscal');
                }
                if (op == 2) {
                    me.arrayDireccionesDespacho.push({
                        'AddressID'     : 'Dirección Despacho',
                        'AddressName'   : '',
                        'Street'        : '',
                        'cUbigeo'       : ''
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
                        if(x.cUbigeo == ''){
                            me.mensajeError.push('Debe seleccionar un Ubigeo' + (y+1));
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
                        if(x.cUbigeo == ''){
                            me.mensajeError.push('Debe seleccionar un Ubigeo' + (y+1));
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
                var url = this.ruta + '/pedido/GetDireccionPersonaByPersona';
                axios.get(url, {
                    params: {
                        'nIdPersona': this.fillDirecciones.nIdPersona,
                        'cTipoPersona': this.fillDirecciones.cTipoPersona
                    }
                }).then(response => {
                    this.fillDirecciones.cDireccion = response.data[0].cDireccion;
                    this.fillDirecciones.cUbigeo    = response.data[0].cUbigeo;
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
                        Street: this.fillDirecciones.cDireccion,
                        cUbigeo: this.fillDirecciones.cUbigeo
                    });
                    toastr.success('Se PreCargo la Dirección Fiscal');
                }
                if (op == 2) {
                    this.arrayDireccionesDespacho = [];
                    this.arrayDireccionesDespacho.push({
                        AddressID : 'Dirección Despacho ',
                        AddressName : '',
                        Street: this.fillDirecciones.cDireccion,
                        cUbigeo: this.fillDirecciones.cUbigeo
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
                var url = this.ruta + '/pedido/SetRegistrarDireccionPersona';
                axios.post(url, {
                    'nIdPersona'                : this.fillDirecciones.nIdPersona,
                    'arrayDireccionesFiscales'  : this.arrayDireccionesFiscales,
                    'arrayDireccionesDespacho'  : this.arrayDireccionesDespacho
                }).then(response => {
                    console.log(response.data);
                    //VERIFICA SI ES DESDE EL CASO 01 (1) O SI ES DESDE EL CASO 03 (2)
                    (this.cFlagDireccionCU == 1) ? this.listarContactoSinCarteraMes() : this.actualizarDireccionesByContacto();
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

                var url = this.ruta + '/gescontacto/SapSetUpdDireccionesContacto';
                axios.post(url, {
                    'nIdPersona'    : this.fillDirecciones.nIdPersona,
                    'cTipoPersona'  : this.fillDirecciones.cTipoPersona,
                    'cCardCode'     : this.fillDirecciones.cCardCode
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
            /*
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
            */
            //SI EL CARDCODE NO ESTA INTEGRADO Y NO HAY DIRECCIONES - ACTUALIZAR DIRECCIONES
            listarContactoSinCarteraMes(){
                var url = this.ruta + '/pedido/GetListContactoBySinCarteraMes';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcronograma' :   220016,
                        'ntipopersona'  :   this.fillDirecciones.cTipoPersona,
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
                    'nIdPersona': this.fillDirecciones.nIdPersona,
                    'cTipoPersona': this.fillDirecciones.cTipoPersona,
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
                    'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nidsucursal'       : parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nidcabecerapedido' : parseInt(me.fillDirecciones.nIdCabeceraPedido)
                }).then(function (response) {
                    if (response.data[0].nFlagMsje == 1) {
                        me.obtenerPedidoById();
                        //me.obtenerIgv();
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
                                me.obtenerPedidoById();
                                //me.obtenerIgv();
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
                        'nidpar'        : 1300477,
                        'ctipoparametro': 'P',
                        'nidtipopar'    : 51
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
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       : parseInt(sessionStorage.getItem("nIdSucursal")),
                        //Si es 1 (Desde Form Direcciones) / Si es 2 desde Aprobación Directa
                        'nidcabecerapedido' : (this.cFlagOpcion == 1) ? this.fillDirecciones.nIdCabeceraPedido : this.formSap.nidcabecerapedido
                    }
                }).then(response => {
                    this.arraySapPedido = response.data.arrayCabeceraPedido.data;
                    //console.log("Cantidad Pedidos: " + this.arraySapPedido.length);
                    this.obtenerEVById();
                    this.obtenerObsequiosCampaniasByIdPedido();
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
            obtenerEVById(){
                var url = this.ruta + '/pedido/GetPedidoEVById';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        //Si es 1 (Desde Form Direcciones) / Si es 2 desde Aprobación Directa
                        'nidcabecerapedido': (this.cFlagOpcion == 1) ? this.fillDirecciones.nIdCabeceraPedido : this.formSap.nidcabecerapedido
                    }
                }).then(response => {
                    this.arraySapEVPedido = response.data.arrayEVPedido.data;
                    this.registroSapBusinessPedido();
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
            obtenerObsequiosCampaniasByIdPedido(){
                let me = this;
                var url = me.ruta + '/pedido/GetCampaniaObsequioByIdPedido';
                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       : parseInt(sessionStorage.getItem("nIdSucursal")),
                        //Si es 1 (Desde Form Direcciones) / Si es 2 desde Aprobación Directa
                        'nidcabecerapedido' : (this.cFlagOpcion == 1) ? this.fillDirecciones.nIdCabeceraPedido : this.formSap.nidcabecerapedido,
                        'opcion'            : 1
                    }
                }).then(response => {
                    me.arraySapElementoVenta = response.data.arrayEVPedido;

                    if (me.arraySapElementoVenta.length > 0) {
                        me.arraySapElementoVenta.map(function(value, key) {
                            //Amaceno Solo Articulos para Costo Promedio
                            if(value.nIdTipoElementoVenta != 1300025){
                                me.arraySapEVArticulosEnvia.push({
                                    'nWhsCode'  :  me.formAlmacen.cwhscode ? parseInt(me.formAlmacen.cwhscode) : parseInt('00'),
                                    'cItemCode' :  value.cCodigoERP
                                });
                            }
                            //Almaceno Servicios para envar el Costo de Sgc
                            else{
                                me.arraySapEVServiciosEnvia.push({
                                    'nWhsCode'  : me.formAlmacen.cwhscode ? parseInt(me.formAlmacen.cwhscode) : parseInt('00'),
                                    'cItemCode' : value.cCodigoERP,
                                    'fImporte'  : value.fImporte
                                });
                            }
                        });
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
            //REGISTRA PEDIDO EN SAP
            registroSapBusinessPedido(){
                let me = this;
                me.loadingProgressBar("INTEGRANDO EL PEDIDO CON SAP BUSINESS ONE...");

                var sapUrl = me.ruta + '/pedido/SapSetPedido';
                axios.post(sapUrl, {
                    'fDocDate'          :   moment().format('YYYY-MM-DD'),
                    'fDocDueDate'       :   moment().add(30, 'days').format('YYYY-MM-DD'),
                    'WarehouseCode'     :   me.formAlmacen.cwhscode,
                    'Igv'               :   1 + parseFloat((me.formSap.igv)),
                    'nIdSapSucursal'    :   parseInt(sessionStorage.getItem("nIdSapSucursal")),
                    'arraySapPedido'    :   me.arraySapPedido,
                    'arraySapEVPedido'  :   me.arraySapEVPedido
                }).then(response => {
                    // ======================================================================
                    // GUARDAR ORDEN VENTA PARA EL VEHÍCULO EN SQL SERVER
                    // ======================================================================
                    me.arraySapRespuestaVehiculo = [];
                    me.arraySapUpdSgcVehiculo = [];

                    me.arraySapRespuestaVehiculo = response.data.arrayVehiculo;//arreglar
                    if(me.arraySapRespuestaVehiculo.length > 0) {
                        me.arraySapRespuestaVehiculo.map(function(value, key){
                            me.jsonRespuestaVehiculo = '';
                            me.jsonRespuestaVehiculo = JSON.parse(value);
                            //Verifico que devuelva DocEntry
                            if(me.jsonRespuestaVehiculo.DocEntry){
                                console.log("Integración Pedido Vehiculo SAP : OK");
                                //console.log(me.jsonRespuestaVehiculo.DocEntry);
                                //Guardo el VIN del Pedido del Vehìculo
                                me.arrayVINPedidoVehiculo.push({
                                    'nDocEntry' : parseInt(me.jsonRespuestaVehiculo.DocEntry),
                                    'cItemCode' : me.jsonRespuestaVehiculo.DocumentLines[0].ItemCode.toString()
                                });

                                me.arraySapUpdSgcVehiculo.push({
                                    'nIdCabeceraPedido' :   (me.cFlagOpcion == 1) ? me.fillDirecciones.nIdCabeceraPedido.toString() : me.formSap.nidcabecerapedido.toString(),
                                    'cItemCode'         :   me.jsonRespuestaVehiculo.DocumentLines[0].ItemCode.toString(),
                                    'nDocEntry'         :   parseInt(me.jsonRespuestaVehiculo.DocEntry),
                                    'nDocNum'           :   parseInt(me.jsonRespuestaVehiculo.DocNum),
                                    'cDocType'          :   me.jsonRespuestaVehiculo.DocType.toString(),
                                    'cLogRespuesta'     :   me.arraySapRespuestaVehiculo[key].toString()
                                });

                                me.arraySapActividadVehiculo.push({
                                    'dActivityDate' :   moment().format('YYYY-MM-DD'),
                                    'hActivityTime' :   moment().format('HH:mm:ss'),
                                    'cCardCode'     :   me.ccustomercode,
                                    'cNotes'        :   'OrdenVenta',
                                    'nDocEntry'     :   me.jsonRespuestaVehiculo.DocEntry.toString(),
                                    'nDocNum'       :   me.jsonRespuestaVehiculo.DocNum.toString(),
                                    'nDocType'      :   '17',
                                    'nDuration'     :   '15',
                                    'cDurationType' :   'du_Minuts',
                                    'dEndDueDate'   :   moment().format('YYYY-MM-DD'),
                                    'hEndTime'      :   moment().add(15, 'minutes').format('HH:mm:ss'),
                                    'cReminder'     :   'tYES',
                                    'nReminderPeriod':  '15',
                                    'cReminderType' :   'du_Minuts',
                                    'dStartDate'    :   moment().format('YYYY-MM-DD'),
                                    'hStartTime'    :   moment().format('HH:mm:ss')
                                });
                            }
                        });
                    }

                    // ======================================================================
                    // GUARDAR ORDEN VENTA PARA LOS ELEMENTOS DE VENTA EN SQL SERVER
                    // ======================================================================
                    me.arraySapRespuestaEV = [];
                    me.arraySapUpdSgcEV = [];

                    me.arraySapRespuestaEV = response.data.arrayEV;
                    if(me.arraySapRespuestaEV.length > 0) {
                        me.arraySapRespuestaEV.map(function(value, key){
                            me.jsonRespuestaEV = '';
                            me.jsonRespuestaEV= JSON.parse(value);
                            //Verifico que devuelva DocEntry
                            if(me.jsonRespuestaEV.DocEntry){
                                console.log("Integración Pedido Ele.Venta SAP : OK");
                                //console.log(me.jsonRespuestaEV.DocEntry);

                                //Generar varias lineas de la misma Orden Venta para actualizar DOCENTRY en cada detalle de Pedido en SQL SERVER
                                let arrayDocumentLines = me.jsonRespuestaEV.DocumentLines;
                                //console.log(arrayDocumentLines);
                                arrayDocumentLines.map(function(linea) {
                                    //console.log(linea);
                                    //Guardo el Codigo SAP de los Elemento Venta
                                    me.arrayCodSAPPedidoEV.push({
                                        'nDocEntry' :   parseInt(me.jsonRespuestaEV.DocEntry),
                                        'cItemCode' :   linea.ItemCode.toString()
                                    });

                                    me.arraySapUpdSgcEV.push({
                                        'nIdCabeceraPedido' :   (me.cFlagOpcion == 1) ? me.fillDirecciones.nIdCabeceraPedido.toString() : me.formSap.nidcabecerapedido.toString(),
                                        'cItemCode'         :   linea.ItemCode.toString(),
                                        'nDocEntry'         :   parseInt(me.jsonRespuestaEV.DocEntry),
                                        'nDocNum'           :   parseInt(me.jsonRespuestaEV.DocNum),
                                        'cDocType'          :   me.jsonRespuestaEV.DocType.toString(),
                                        'cLogRespuesta'     :   me.arraySapRespuestaEV[key].toString()
                                    });
                                });

                                me.arraySapActividadEV.push({
                                    'dActivityDate' :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                    'hActivityTime' :   '08:13:00',
                                    'cCardCode'     :   me.ccustomercode,
                                    'cNotes'        :   'OrdenVenta',
                                    //'cCardCode'   :   'P20506006024',
                                    'nDocEntry'     :   me.jsonRespuestaEV.DocEntry.toString(),
                                    'nDocNum'       :   me.jsonRespuestaEV.DocNum.toString(),
                                    'nDocType'      :   '17',
                                    'nDuration'     :   '15',
                                    'cDurationType' :   'du_Minuts',
                                    'dEndDueDate'   :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                    'hEndTime'      :   '08:28:00',
                                    'cReminder'     :   'tYES',
                                    'nReminderPeriod':  '15',
                                    'cReminderType' :   'du_Minuts',
                                    'dStartDate'    :   moment().format('YYYY-MM-DD'),//'2019-01-29'
                                    'hStartTime'    :   '08:13:00'
                                });
                            }
                        });
                    }

                    //==============================================================
                    //================== ACTUALIZAR DOCENTRY PEDIDO ================
                    setTimeout(function() {
                        me.registroSgcPedido();
                    }, 800);
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
            registroSgcPedido(){
                let me = this;

                var sapUrl = me.ruta + '/pedido/SapUpdPedidoByDocEntry';
                axios.post(sapUrl, {
                    'arraySapUpdSgcVehiculo': me.arraySapUpdSgcVehiculo,
                    'arraySapUpdSgcEV'      : me.arraySapUpdSgcEV
                }).then(response => {
                    if (response.data[0].nFlagMsje == 1) {
                        setTimeout(function() {
                            me.registroSapBusinessActividad();
                        }, 800);
                    } else {
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
            registroSapBusinessActividad(){
                let me = this;

                var sapUrl = me.ruta + '/actividad/SapSetActividadVenta';
                axios.post(sapUrl, {
                    'arraySapActividadVehiculo' : me.arraySapActividadVehiculo,
                    'arraySapActividadEV'       : me.arraySapActividadEV
                }).then(response => {
                    // ======================================================================
                    // GUARDAR ACTIVIDAD DE LA ORDEN DE VENTA PARA VEHÍCULO EN SQL SERVER
                    // ======================================================================
                    me.arraySapRespuestaVehiculo = [];
                    me.arraySapUpdSgcVehiculo = [];

                    me.arraySapRespuestaVehiculo = response.data.arrayVehiculo;
                    if(me.arraySapRespuestaVehiculo.length > 0) {
                        me.arraySapRespuestaVehiculo.map(function(value, key){
                            me.jsonRespuestaVehiculo = '';
                            me.jsonRespuestaVehiculo= JSON.parse(value);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuestaVehiculo.ActivityCode){
                                me.arraySapUpdSgcVehiculo.push({
                                    'nActividadTipo': 17,
                                    'cActividadTipo': 'OrdenVenta',
                                    'nActivityCode' : parseInt(me.jsonRespuestaVehiculo.ActivityCode),
                                    'cCardCode'     : me.jsonRespuestaVehiculo.CardCode.toString(),
                                    'nDocEntry'     : parseInt(me.jsonRespuestaVehiculo.DocEntry),
                                    'nDocNum'       : parseInt(me.jsonRespuestaVehiculo.DocNum),
                                    'cLogRespuesta' : me.arraySapRespuestaVehiculo[key].toString()
                                });
                            }
                        });
                    }

                    // ======================================================================
                    // GUARDAR ACTIVIDAD DE LA ORDEN DE VENTA PARA ELEMENTO VENTA EN SQL SERVER
                    // ======================================================================
                    me.arraySapRespuestaEV = [];
                    me.arraySapUpdSgcEV = [];

                    me.arraySapRespuestaEV = response.data.arrayEV;
                    if(me.arraySapRespuestaEV.length > 0) {
                        me.arraySapRespuestaEV.map(function(value, key){
                            me.jsonRespuestaEV = '';
                            me.jsonRespuestaEV = JSON.parse(value);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuestaEV.ActivityCode){
                                me.arraySapUpdSgcEV.push({
                                    'nActividadTipo': 17,
                                    'cActividadTipo': 'OrdenVenta',
                                    'nActivityCode' : parseInt(me.jsonRespuestaEV.ActivityCode),
                                    'cCardCode'     : me.jsonRespuestaEV.CardCode.toString(),
                                    'nDocEntry'     : parseInt(me.jsonRespuestaEV.DocEntry),
                                    'nDocNum'       : parseInt(me.jsonRespuestaEV.DocNum),
                                    'cLogRespuesta' : me.arraySapRespuestaEV[key].toString()
                                });
                            }
                        });
                    }

                    //================================================================
                    //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                    setTimeout(function() {
                        me.registroSgcActividad();
                    }, 800);
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
            registroSgcActividad(){
                let me = this;
                var sapUrl = me.ruta + '/actividad/SetIntegraActividadVenta';
                axios.post(sapUrl, {
                    'arraySapUpdSgcVehiculo': me.arraySapUpdSgcVehiculo,
                    'arraySapUpdSgcEV'      : me.arraySapUpdSgcEV
                }).then(response => {
                    setTimeout(function() {
                        me.registroSapBusinessSolucion();
                    }, 800);
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
            registroSapBusinessSolucion(){
                let me = this;

                //Depurar Array para registrar en SAP
                me.arraySapPedido.map(function(value, key){
                    me.arraySapSolucion.push({
                        'cItemCode' : value.cNumeroVin,
                        'cSubject'  : "Cierre De Servicio"
                    });
                });

                var sapUrl = me.ruta + '/solucion/SapSetSolucion';
                axios.post(sapUrl, {
                    'data': me.arraySapSolucion
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(value, key){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(value);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.SolutionCode){
                            me.arraySapUpdSgc.push({
                                'nSolutionCode' : parseInt(me.jsonRespuesta.SolutionCode),
                                'cItemCode'     : me.jsonRespuesta.ItemCode.toString(),
                                'cFlagTipo'     : 'V',
                                'cLogRespuesta' : me.arraySapRespuesta[key].toString()
                            });

                            me.nSolutionCode = me.jsonRespuesta.SolutionCode;
                        }
                    });
                    //================================================================
                    //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                    setTimeout(function() {
                        me.registroSgcSolucion();
                    }, 800);
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
            registroSgcSolucion(){
                let me = this;
                var sapUrl = me.ruta + '/solucion/SetIntegraSolucion';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.getOrdenVentaActividad();
                    }, 800);
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
            getOrdenVentaActividad(){
                let me = this;
                var sapUrl = me.ruta + '/actividad/GetIntegraActividadVentaByItemCode';
                axios.post(sapUrl, {
                    'arrayVINPedidoVehiculo': me.arrayVINPedidoVehiculo,
                    'arrayCodSAPPedidoEV'   : me.arrayCodSAPPedidoEV,
                    'nactividadtipo'        : 17
                }).then(response => {
                    console.log(response.data);
                    // ======================================================================
                    // OBTENER INFORMACIÓN DE LA ACTIVIDAD DEL VEHÍCULO PARA LLAMADA SERVICIOS
                    // ======================================================================
                    me.arraySapRespuestaVehiculo = [];
                    me.arraySapLlamadaServicio = [];

                    me.arraySapRespuestaVehiculo = response.data.arrayInfoVehiculoActividad;
                    if(me.arraySapRespuestaVehiculo.length > 0) {
                        me.arraySapRespuestaVehiculo.map(function(value, key){
                            //Guardar Cabecera Llamada Servicios
                            me.fillLlamadaServicio.cCustomerCode        = value.cCustomerCode;
                            me.fillLlamadaServicio.cInternalSerialNum   = value.cItemCode;
                            me.fillLlamadaServicio.cItemCode            = value.cItemCode;
                            me.fillLlamadaServicio.cSubject             = value.cSubject;
                            //Guardar Detalle de Actividades del Servicio
                            me.arraySapLlamadaServicio.push({
                                'nActivityCode': value.nActivityCode
                            });
                        });
                    }

                    // ======================================================================
                    // OBTENER INFORMACIÓN DE LA ACTIVIDAD DEL E.V PARA LLAMADA SERVICIOS
                    // ======================================================================
                    me.arraySapRespuestaEV = [];

                    me.arraySapRespuestaEV = response.data.arrayInfoEVActividad;
                    if(me.arraySapRespuestaEV.length > 0) {
                        me.arraySapRespuestaEV.map(function(value, key){
                            //Guardar Detalle de Actividades del Servicio
                            if(key == 0) {
                                me.arraySapLlamadaServicio.push({
                                    'nActivityCode': value.nActivityCode
                                });
                            }
                        });
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
                setTimeout(function() {
                    me.registroSapBusinessLlamadaServicio();
                }, 800);
            },
            registroSapBusinessLlamadaServicio(){
                let me = this;

                me.loading.close();
                me.loadingProgressBar("INTEGRANDO LLAMADA DE SERVICIO CON SAP BUSINESS ONE...");

                var sapUrl = me.ruta + '/llamadaservicio/SapSetLlamadaServicioVenta';
                axios.post(sapUrl, {
                    'arraySapLlamadaServicio'   : me.arraySapLlamadaServicio,
                    'cCustomerCode'             : me.fillLlamadaServicio.cCustomerCode,
                    'cInternalSerialNum'        : me.fillLlamadaServicio.cInternalSerialNum,
                    'cItemCode'                 : me.fillLlamadaServicio.cItemCode,
                    'cSubject'                  : me.fillLlamadaServicio.cSubject,
                    'nSolutionCode'             : me.nSolutionCode
                }).then(response => {
                    // ======================================================================
                    // GUARDAR LLAMADA DE SERVICIOS DE LA O.V DEL VEHICULO EN SQL SERVER
                    // ======================================================================
                    me.arraySapRespuestaVehiculo = [];
                    me.arraySapUpdSgcVehiculo = [];

                    me.arraySapRespuestaVehiculo = response.data.arrayVehiculo;
                    if(me.arraySapRespuestaVehiculo.length > 0) {
                        me.arraySapRespuestaVehiculo.map(function(value, key){
                            me.jsonRespuestaVehiculo = '';
                            me.jsonRespuestaVehiculo = JSON.parse(value);
                            //Si el valor de respuesta Code tiene un valor
                            if(me.jsonRespuestaVehiculo.ItemCode){

                                //Arreglo de Actividades para Actualizar por Llamada de Servicios en SQL SERVER
                                let listServiceCallActivities = me.jsonRespuestaVehiculo.ServiceCallActivities;
                                listServiceCallActivities.map(function(linea) {
                                    me.arrayServiceCallActivities.push({
                                        'nServiceCallID':   me.jsonRespuestaVehiculo.ServiceCallID.toString(),
                                        'nActivityCode' :   linea.ActivityCode.toString()
                                    });
                                });
                                me.arraySapUpdSgcVehiculo.push({
                                    'nServiceCallID'    : me.jsonRespuestaVehiculo.ServiceCallID.toString(),
                                    'cFlagTipo'         : 'V',
                                    'nActivityCode'     : 0,
                                    'cItemCode'         : me.jsonRespuestaVehiculo.ItemCode.toString(),
                                    'cInternalSerialNum': me.jsonRespuestaVehiculo.InternalSerialNum.toString(),
                                    'cLogRespuesta'     : me.arraySapRespuestaVehiculo[key].toString()
                                });
                            }
                        });
                    }
                    //=========================================================================
                    //============ ACTUALIZO TABLA INTEGRACION LLAMADA SERVICIO SGC ===========
                    setTimeout(function() {
                        me.registroSgcLlamadaServicio();
                    }, 800);
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
            registroSgcLlamadaServicio(){
                let me = this;
                var sapUrl = me.ruta + '/llamadaservicio/SetIntegraLlamadaServicioVenta';
                axios.post(sapUrl, {
                    'arraySapUpdSgcVehiculo'    : me.arraySapUpdSgcVehiculo,
                    'arrayServiceCallActivities': me.arrayServiceCallActivities
                }).then(response => {
                    setTimeout(function() {
                        me.obtenerLlamadasServicios();
                    }, 800);
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
            obtenerLlamadasServicios(){
                let me = this;
                var url = me.ruta + '/pedido/GetLlamadasServiciosByPedido';
                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       : parseInt(sessionStorage.getItem("nIdSucursal")),
                        //Si es 1 (Desde Form Direcciones) / Si es 2 desde Aprobación Directa
                        'nidcabecerapedido' : (this.cFlagOpcion == 1) ? this.fillDirecciones.nIdCabeceraPedido : this.formSap.nidcabecerapedido
                    }
                }).then(response => {
                    me.arrayPatchLlamadaServicios = response.data.arrayLlamadaServicios;
                    setTimeout(function() {
                        me.cerrarLlamadasServicios();
                    }, 800);
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
            cerrarLlamadasServicios(){
                let me = this;

                var url = me.ruta + '/llamadaservicio/SapCloseLlamadaServicio';
                axios.post(url, {
                    'data'  : me.arrayPatchLlamadaServicios
                }).then(response => {
                    setTimeout(function() {
                        me.actualizarTarjetaEquipo();
                    }, 800);
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
            actualizarTarjetaEquipo(){
                let me = this;

                var url = me.ruta + '/tarjetaequipo/SapUpdSocioNegocio';
                axios.post(url, {
                    'data'  : me.arraySapPedido
                }).then(response => {
                    setTimeout(function() {
                        me.obtenerSapCostoPromedio();
                    }, 800);
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
            obtenerSapCostoPromedio(){
                let me = this;
                me.loading.close();
                me.loadingProgressBar("INTEGRANDO COSTOS CON SAP BUSINESS ONE...");
                var sapUrl = me.ruta + '/articulo/SapGetCostoPromedio';
                axios.post(sapUrl, {
                    'data': me.arraySapEVArticulosEnvia
                }).then(response => {
                    me.arraySapRespuestaVehiculo = [];
                    me.arraySapUpdSgcVehiculo = [];

                    me.arraySapRespuestaVehiculo = response.data;
                    me.arraySapRespuestaVehiculo.map(function(value, key){
                        me.fAvgPrice = me.fAvgPrice + value.fAvgPrice;
                    });

                    me.arraySapCostoEV = [];
                    // ====================== CONCEPTO =========================
                    // ======================== ACCESORIOS ==========================
                    me.arraySapCostoEV.push({
                        U_SYP_VIN           :   me.formSap.cnumerovin,
                        DocEntry            :   me.formSap.ndocentry,
                        U_SYP_CCONCEPTO     :   '06',
                        U_SYP_DCONCEPTO     :   'Accesorios',
                        U_SYP_CDOCUMENTO    :   '03',
                        U_SYP_DDOCUMENTO    :   'Salida de Almacén',
                        U_SYP_IMPORTE       :   me.fAvgPrice,
                        U_SYP_COSTO         :   'Si',
                        U_SYP_ESTADO        :   'Pendiente'
                    });

                    //VERIFICAR QUE EL COSTO PROMEDIO > 0 Y EL nDocEntry TblCosto
                    if(me.fAvgPrice > 0 && me.formSap.ndocentry != 0){
                        setTimeout(function() {
                            me.registroSapBusinessTblCostoEV();
                        }, 800);
                    } else {
                        setTimeout(function() {
                            me.obtenerSgcCostoServicio();
                        }, 800);
                    }
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Costos SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            registroSapBusinessTblCostoEV(){
                let me = this;

                var url = me.ruta + '/tablacosto/SapPachTablaCosto';
                axios.post(url, {
                    'data'  : me.arraySapCostoEV
                }).then(response => {
                    setTimeout(function() {
                        me.obtenerSgcCostoServicio();
                    }, 800);
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
            obtenerSgcCostoServicio(){
                let me = this;
                me.arraySapEVServiciosEnvia.map(function(value, key){
                    me.fImporte = me.fImporte + value.fImporte;
                });

                me.arraySapCostoServicio = [];
                // ====================== CONCEPTO =========================
                // ======================== SERVICIOS ==========================
                me.arraySapCostoServicio.push({
                    U_SYP_VIN           :   me.formSap.cnumerovin,
                    DocEntry            :   me.formSap.ndocentry,
                    U_SYP_CCONCEPTO     :   '07',
                    U_SYP_DCONCEPTO     :   'Servicios',
                    U_SYP_CDOCUMENTO    :   '02',
                    U_SYP_DDOCUMENTO    :   'Factura Proveedor',
                    U_SYP_IMPORTE       :   me.fImporte,
                    U_SYP_COSTO         :   'Si',
                    U_SYP_ESTADO        :   'Pendiente'
                });

                //VERIFICAR QUE EL COSTO PROMEDIO > 0 Y EL nDocEntry TblCosto
                if(me.fImporte > 0 && me.formSap.ndocentry != 0){
                    setTimeout(function() {
                        me.registroSapBusinessTblCostoServicios();
                    }, 800);
                } else {
                    setTimeout(function() {
                        me.confirmaPedido();
                    }, 800);
                }

            },
            registroSapBusinessTblCostoServicios(){
                let me = this;

                var url = me.ruta + '/tablacosto/SapPachTablaCosto';
                axios.post(url, {
                    'data'  : me.arraySapCostoServicio
                }).then(response => {
                    me.confirmaPedido();
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
            confirmaPedido(){
                let me = this;
                me.limpiarFormulario();
                me.listarPedidos(1);
                swal(
                    'Aprobado!',
                    'El pedido ha sido APROBADO con éxito.',
                    'success'
                );
                $("#myBar").hide();
                me.loading.close();
            },
            anularPedido(pedido){
                swal({
                    title: '¿Esta seguro de ANULAR el pedido N°' + pedido.nIdCabeceraPedido + '?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Anular!',
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
                this.fillDetallePedido.cvehiculo = pedido.cNombreComercial + ' ' + pedido.nAnioModelo,
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
            // VER DETALLE DEPOSITOS
            // =================================================================
            limpiarModalDetalleDepositosPorPedido(){
                this.arrayDetalleDepositosPorPedido = [];
                this.fillDetalleDeposito.nidcabecerapedido = '';
                this.fillDetalleDeposito.cnombrecontacto = '';
                this.fillDetalleDeposito.flagMontoTotalCotizacion = 0;
                this.fillDetalleDeposito.flagMontoTotalDepositos = 0;
                this.fillDetalleDeposito.flagMontoCancelar = 0;
            },
            cargarDatosDetalleDeposito(pedido){
                this.limpiarModalDetalleDepositosPorPedido();

                var url = this.ruta + '/deposito/GetMontoTotalDepositos';
                axios.get(url, {
                    params: {
                        'nidempresa'            : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'           : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nIdCabeceraPedido'     : pedido.nIdCabeceraPedido,
                        'cFlagEstadoAprobacion' : 'A'
                    }
                }).then(response => {
                    this.fillDetalleDeposito.nidcabecerapedido          =   pedido.nIdCabeceraPedido;
                    this.fillDetalleDeposito.cnombrecontacto            =   pedido.cContacto;
                    this.fillDetalleDeposito.flagMontoTotalCotizacion   =   pedido.fTotalPedido;//Monto del Deposito
                    this.fillDetalleDeposito.flagMontoTotalDepositos    =   response.data[0].fMontoTotalDepositos;//Monto de lo Depositado

                    // Resto el Total a pagar - El Total Pagado
                    var flagMontoTotalCotizacion                = Number(parseFloat(this.fillDetalleDeposito.flagMontoTotalCotizacion).toFixed(4))
                    var flagMontoTotalDepositosAprobados        = Number(parseFloat(this.fillDetalleDeposito.flagMontoTotalDepositos).toFixed(4))
                    var resultadoMontoCancelar                  = flagMontoTotalCotizacion - flagMontoTotalDepositosAprobados
                    this.fillDetalleDeposito.flagMontoCancelar  = resultadoMontoCancelar;
                    (this.fillDetalleDeposito.flagMontoCancelar < 0 ) ? this.fillDetalleDeposito.flagMontoCancelar = 0 : this.fillDetalleDeposito.flagMontoCancelar;
                    this.listarDetalleDepositosPorPedido(pedido);
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
            listarDetalleDepositosPorPedido(pedido){
                let me = this;

                var url = this.ruta + '/deposito/GetListDepositosPorPedido';
                axios.get(url, {
                    params: {
                        'nIdCabeceraPedido' : pedido.nIdCabeceraPedido
                    }
                }).then(response => {
                    this.arrayDetalleDepositosPorPedido  = response.data;

                    //Verifica si existen depositos
                    if(this.arrayDetalleDepositosPorPedido.length > 0) {
                        //recorre los depositos
                        this.arrayDetalleDepositosPorPedido.map(function(value, key){
                            //agrega un atributo de color por cada deposito dependiendo su estado
                            if(value.cFlagEstadoAprobacion == 'A') {
                                me.arrayDetalleDepositosPorPedido[key].colorearEstadoDeposito = 'rgb(188, 238, 188)';
                            }
                            if(value.cFlagEstadoAprobacion == 'D') {
                                me.arrayDetalleDepositosPorPedido[key].colorearEstadoDeposito = 'rgb(233, 177, 151)';
                            }
                            if(value.cFlagEstadoAprobacion == 'P') {
                                me.arrayDetalleDepositosPorPedido[key].colorearEstadoDeposito = 'rgba(233, 240, 96, 0.795)';
                            }
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
                            }break;
                            case 'deposito':
                            {
                                this.accionmodal=5;
                                this.modal = 1;
                                this.cargarDatosDetalleDeposito(data);
                                break;
                            }break;
                        }
                    }
                    break;
                    case "contacto":
                    {
                        switch(accion){
                            case 'direcciones':
                            {
                                this.formSap.cnumerovin = data['cNumeroVin'];
                                this.formSap.ndocentry = data['nDocEntry'];
                                this.obtenerDireccionesPorContacto(data);
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
                //=====Variables SAP para OrdenVenta Vehiculo
                this.arraySapRespuestaVehiculo= [],
                this.arraySapUpdSgcVehiculo= [],
                this.jsonRespuestaVehiculo= '',
                this.arraySapItemCodeVehiculo= [],
                this.arrayVINPedidoVehiculo= [],//Almacena VINES
                this.arraySapActividadVehiculo = [];

                //=====Variables SAP para OrdenVenta Elemento Venta
                this.arraySapRespuestaEV = [],
                this.jsonRespuestaEV = '',
                this.arraySapUpdSgcEV = [],
                this.arraySapItemCodeEV = [],
                this.arrayCodSAPPedidoEV = [],//Almacena CodSAP
                this.arraySapActividadEV = [];

                this.fillLlamadaServicio.cCustomerCode = '';
                this.fillLlamadaServicio.cInternalSerialNum = '';
                this.fillLlamadaServicio.cItemCode = '';
                this.fillLlamadaServicio.cSubject = '';

                //Limpiar Variables SAP
                this.arraySapRespuesta = [];
                this.arraySapItemCode = [];
                this.jsonRespuesta = '';
                this.arraySapUpdSgc= [];
                this.arraySapPedido= [];
                this.arraySapActividad= [];
                this.arraySapLlamadaServicio= [];
                this.formSap.nidcabecerapedido= 0;
                this.formSap.ccardcode= ''
                this.formSap.igv = '';
                this.formSap.cnumerovin = '';
                this.formSap.ndocentry = 0;
                this.arraySapCostoEV= [];
                this.arraySapCostoServicio= [];
                this.arraySapElementoVenta= [];
                this.arraySapEVArticulosEnvia= [];
                this.arraySapEVServiciosEnvia= [];
                this.arraySapSolucion= [];
                this.arrayPatchLlamadaServicios= [];
                this.nSolutionCode= 0;

                //Direcciones
                this.cerrarModal();
                this.arrayDireccionesFiscales = [];
                this.arrayDireccionesDespacho = [];
                this.cFlagOpcion = '';
                this.arrayDireccionesExisten = [];
                this.arrayUbigeos = [];
                this.cFlagDireccionCU = 1;
                this.fillDirecciones.nIdCabeceraPedido = '';
                this.fillDirecciones.nIdPersona = '';
                this.fillDirecciones.nIdContacto = '';
                this.fillDirecciones.cContacto = '';
                this.fillDirecciones.cDireccion = '';
                this.fillDirecciones.cUbigeo = '';
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
            limpiarPorError(cDescripcion){
                $("#myBar").hide();
                swal({
                    type: 'error',
                    title: 'Error...',
                    text: cDescripcion,
                });
                this.loading.close();
                this.limpiarFormulario();
                this.listarPedidos(1);
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
