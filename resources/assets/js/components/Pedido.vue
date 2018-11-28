<template>
     <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">GENERAR PEDIDO</h2>
                </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#TabBuscaPedido" @click="tabBuscarPedido()" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> BUSCAR PEDIDOS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#TabGeneraPedido" @click="tabGenerarPedido()" role="tab" data-toggle="tab">
                                            <i class="fa fa-list-alt"></i> GENERAR PEDIDO
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="TabBuscaPedido">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR PEDIDOS</h3>
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
                                                                                <input type="text" v-model="fillPedido.cnumeropedido" @keyup.enter="listarPedidos(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillPedido.cnumerovin" @keyup.enter="listarPedidos(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Marca</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="formPedido.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelos()">
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
                                                                                <el-select v-model="formPedido.nidmodelo" filterable clearable placeholder="SELECCIONE">
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
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Estado Pedido</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillPedido.nidestadopedido" filterable clearable placeholder="SELECCIONE">
                                                                                    <el-option
                                                                                    v-for="item in arrayEstadoPedido"
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
                                                            <template v-if="arrayMisPedido.length">
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
                                                                            <tr v-for="pedido in arrayMisPedido" :key="pedido.nIdCabeceraPedido">
                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                    <div slot="content">Ver Detalle Pedido {{ pedido.cNumeroPedido }}</div>
                                                                                    <i @click="abrirModal('pedido', 'detalle', pedido)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                                                </el-tooltip>&nbsp;
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
                                    <div role="tabpanel" class="tab-pane fade" id="TabGeneraPedido">
                                        <template v-if="vistaFormularioPedido">
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="h4">BUSCAR COTIZACIONES</h3>
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
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-date-picker
                                                                                        v-model="formPedido.dfechainicio"
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
                                                                                        v-model="formPedido.dfechafin"
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
                                                                                <label class="col-sm-4 form-control-label">Marca</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="formPedido.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelos()">
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
                                                                                    <el-select v-model="formPedido.nidmodelo" filterable clearable placeholder="SELECCIONE">
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
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Nro Cotización</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="formPedido.cnumerocotizacion" @keyup.enter="listarCotizacionesIngresadas(1)" class="form-control form-control-sm">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-5">
                                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarCotizacionesIngresadas(1)">
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
                                                                <h3 class="h4">LISTADO COTIZACIONES</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <template v-if="arrayPedido.length">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Acciones</th>
                                                                                    <th>Nro Cotizacion</th>
                                                                                    <th>Contacto</th>
                                                                                    <th>Vehiculo</th>
                                                                                    <th>Dirección</th>
                                                                                    <th>Celular</th>
                                                                                    <th>Email</th>
                                                                                    <th>Fecha Inicio</th>
                                                                                    <th>Fecha Venc.</th>
                                                                                    <th>Aprobación</th>
                                                                                    <th>Estado Cotización</th>
                                                                                    <th>Vendedor</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="cotizacion in arrayPedido" :key="cotizacion.nIdCabeceraCotizacion">
                                                                                    <td>
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Ver Detalle Cotizacion {{ cotizacion.nIdCabeceraCotizacion }}</div>
                                                                                            <i @click="abrirModal('cotizacion', 'detalle', cotizacion)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Generar Pedido {{ cotizacion.cNumeroCotizacion }}</div>
                                                                                            <i @click="generarPedido(cotizacion)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                        </el-tooltip>
                                                                                    </td>
                                                                                    <td v-text="cotizacion.cNumeroCotizacion"></td>
                                                                                    <td v-text="cotizacion.cContacto"></td>
                                                                                    <td v-text="cotizacion.cNombreComercial + ' ' + cotizacion.nAnioFabricacion + '-' + cotizacion.nAnioModelo"></td>
                                                                                    <td v-text="cotizacion.cDireccion"></td>
                                                                                    <td v-text="cotizacion.nTelefonoMovil"></td>
                                                                                    <td v-text="cotizacion.cEmail"></td>
                                                                                    <td v-text="cotizacion.dFechaCotizacion"></td>
                                                                                    <td v-text="cotizacion.dFechaVencimientoCotizacion"></td>
                                                                                    <td v-text="cotizacion.cEstadoAprobacion"></td>
                                                                                    <td v-text="cotizacion.cEstadoCotizacion"></td>
                                                                                    <td v-text="cotizacion.cNombreVendedor"></td>
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
                                                                                            <a @click.prevent="cambiarPaginaCotizacion(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                        </li>
                                                                                        <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                        :class="[page==isActived?'active':'']">
                                                                                            <a class="page-link"
                                                                                            href="#" @click.prevent="cambiarPaginaCotizacion(page)"
                                                                                            v-text="page"></a>
                                                                                        </li>
                                                                                        <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                            <a @click.prevent="cambiarPaginaCotizacion(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                        </template>
                                        <template v-else>
                                            <section class="forms">
                                                <div class="container-fluid">
                                                    <div class="col-lg-12">
                                                        <h2 class="no-margin-bottom" v-text="formPedido.cnombrecontacto"></h2>
                                                        <hr/>
                                                        <ul class="nav nav-tabs">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="Tab1" href="#TabAsignarCompra" @click="tabAsignarCompra()" role="tab" data-toggle="tab">
                                                                    <i class="fa fa fa-bus"></i> ASIGNAR VEHÍCULO
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link disabled" id="Tab2" href="#TabDocReferencias" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-book"></i> DOCUMENTOS REFERENCIAS
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link disabled" id="Tab3" href="#TabDocAsociados" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-book"></i> DOCUMENTOS ASOCIADOS
                                                                </a>
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content">
                                                            <div class="tab-pane fade in active show" id="TabAsignarCompra">
                                                                <section class="forms">
                                                                    <div class="container-fluid">
                                                                        <div class="col-lg-12">
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <h3 class="h4">ASIGNAR VEHÍCULO</h3>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <form class="form-horizontal">
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Número VIN</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="hidden" v-model="formCompra.nidcabeceracotizacion">
                                                                                                        <input type="text" v-model="formCompra.cnumerovin" @keyup.enter="listarCompras(1)" class="form-control form-control-sm">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Nombre Comercial</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="text" v-model="formCompra.cnombrecomercial" @keyup.enter="listarCompras(1)" class="form-control form-control-sm">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-9 offset-sm-5">
                                                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarCompras(1)"><i class="fa fa-search"></i> Buscar</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <h3 class="h4">LISTADO UNIDADES</h3>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <template v-if="arrayCompra.length">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-striped table-sm">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Acciones</th>
                                                                                                        <th>Cód Comp.</th>
                                                                                                        <th>O/C</th>
                                                                                                        <th>Nombre Comercial</th>
                                                                                                        <th>Año Fab.</th>
                                                                                                        <th>Año Modelo</th>
                                                                                                        <th>Nro VIN</th>
                                                                                                        <th>Color</th>
                                                                                                        <th>Motor</th>
                                                                                                        <th>Almacén</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr v-for="compra in arrayCompra" :key="compra.nIdCompra">
                                                                                                        <td>
                                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                                <div slot="content">Seleccionar Compra {{ compra.cNumeroVin }}</div>
                                                                                                                <i @click="activarTabDocReferencias(compra)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                                            </el-tooltip>
                                                                                                        </td>
                                                                                                        <td v-text="compra.nIdCompra"></td>
                                                                                                        <td v-text="compra.nOrdenCompra"></td>
                                                                                                        <td v-text="compra.cNombreComercial"></td>
                                                                                                        <td v-text="compra.nAnioFabricacion"></td>
                                                                                                        <td v-text="compra.nAnioVersion"></td>
                                                                                                        <td v-text="compra.cNumeroVin"></td>
                                                                                                        <td v-text="compra.cNombreColor"></td>
                                                                                                        <td v-text="compra.cNumeroMotor"></td>
                                                                                                        <td v-text="compra.cNombreAlmacen"></td>
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
                                                                                                                <a @click.prevent="cambiarPaginaCompra(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                                            </li>
                                                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                                            :class="[page==isActived?'active':'']">
                                                                                                                <a class="page-link"
                                                                                                                href="#" @click.prevent="cambiarPaginaCompra(page)"
                                                                                                                v-text="page"></a>
                                                                                                            </li>
                                                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                                <a @click.prevent="cambiarPaginaCompra(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                                            <div role="tabpanel" class="tab-pane fade" id="TabDocReferencias">
                                                                <section class="forms">
                                                                    <div class="container-fluid">
                                                                        <div class="col-lg-12">
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <h3 class="h4">DATOS DE PEDIDO</h3>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <form class="form-horizontal">
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Nro Cotización</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="hidden" v-model="formDocRef.nidcompra">
                                                                                                        <label v-text="formDocRef.cnrocotizacion" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Nombre Comercial</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.cnombrecomercial" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Año Fabricación</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.naniofabricacion" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Año Modelo</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.naniomodelo" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Nro VIN</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.cnrovin" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">O/C</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.nordencompra" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Color</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.ccolor" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Motor</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.cmotor" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Precio Lista</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.fpreciolista" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Precio Sistema</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.fprecioventap" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Descuento</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.fdescuentolista" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Precio Cliente</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.fpreciofinal" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Bono</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.fbono" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Sobre Precio</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.fsobreprecio" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Bono Especial</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.fbonoespecial" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Descuento</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.fdescuento" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">Fecha Pedido</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <label v-text="formDocRef.dfechapedido" class="form-control-label-readonly" style="text-align:right;"></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <h3 class="h4">FORMA DE PAGO</h3>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <form class="form-horizontal">
                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">* Forma de Pago</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <el-select v-model="formDocRef.nidformapago" filterable clearable placeholder="SELECCIONE" @change="changeFormaPago()" >
                                                                                                            <el-option
                                                                                                            v-for="item in arrayFormaPago"
                                                                                                            :key="item.nIdPar"
                                                                                                            :label="item.cParNombre"
                                                                                                            :value="item.nIdPar">
                                                                                                            </el-option>
                                                                                                        </el-select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-6" v-if="this.cvalidabanco=='SI'">
                                                                                                <div class="row">
                                                                                                    <label class="col-sm-4 form-control-label">* Banco</label>
                                                                                                    <div class="col-sm-8">
                                                                                                        <el-select v-model="formDocRef.nidbanco" filterable clearable placeholder="SELECCIONE" >
                                                                                                            <el-option
                                                                                                            v-for="item in arrayBanco"
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
                                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTabDocAsociados()">
                                                                                                    <i class="fa fa-arrow-right"></i> Siguiente
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane fade" id="TabDocAsociados">
                                                                <section class="forms">
                                                                    <div class="container-fluid">
                                                                        <div class="card">
                                                                            <form class="form-horizontal">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped table-sm" style="border-collapse: separate;">
                                                                                        <thead>
                                                                                            <tr>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="(documento, index) in arrayTablaDocumento" :key="documento.nIdPar">
                                                                                                <td :style="documento.nValida==1 ? 'color:red' : ''" v-text="documento.cCaracter + ' ' + documento.cParNombre"></td>
                                                                                                <td><input type="file" @change="getFile($event, index, documento.nIdPar)" accept=".pdf,.xlsx"/></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <br>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-9 offset-sm-5">
                                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarPedido()">
                                                                                            <i class="fa fa-save"></i> Generar Pedido
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </template>
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
                                <div v-for="e in mensajeError" :key="e" v-text="e">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detalle Pedido -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                                            v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='N' && vehiculo.cFlagActivaEventoCampania=='N'">
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
                                                            v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='S' && vehiculo.cFlagActivaEventoCampania=='N'">
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
                                                            v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='N' && vehiculo.cFlagActivaEventoCampania=='S'">
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

            <!-- Detalle Cotizacion -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">DETALLE COTIZACIÓN</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro Cotización</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleCotizacion.cnumerocotizacion" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleCotizacion.cnombreproveedor" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleCotizacion.cdocumentocliente" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Cliente</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleCotizacion.cnombrecliente" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Cod. Vehículo</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleCotizacion.nidversionvehiculo" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Vehículo</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleCotizacion.cvehiculo" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Fecha Cotización</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleCotizacion.dfechacotizacion" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Vendedor</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleCotizacion.cnombrevendedor" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Total Cotización Soles</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleCotizacion.ftotalcotizacionsoles" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Total Cotización Dolares</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleCotizacion.ftotalcotizaciondolares" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <!-- DETALLE VEHICULO -->
                                        <template v-if="arrayDetalleCotizacion.length">
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
                                                        <tr v-for="vehiculo in arrayDetalleCotizacion" :key="vehiculo.nIdPar" v-if="vehiculo.cFlagTipoItem=='V'">
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
                                        <template v-if="arrayDetalleCotizacion.length">
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
                                                        <tr v-for="vehiculo in arrayDetalleCotizacion" :key="vehiculo.nIdPar"
                                                            v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='N' && vehiculo.cFlagActivaEventoCampania=='N'">
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
                                        <template v-if="arrayDetalleCotizacion.length">
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
                                                        <tr v-for="vehiculo in arrayDetalleCotizacion" :key="vehiculo.nIdPar"
                                                            v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='S' && vehiculo.cFlagActivaEventoCampania=='N'">
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
                                        <template v-if="arrayDetalleCotizacion.length">
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
                                                        <tr v-for="vehiculo in arrayDetalleCotizacion" :key="vehiculo.nIdPar"
                                                            v-if="vehiculo.cFlagTipoItem=='E' && vehiculo.cFlagActivaObsequio=='N' && vehiculo.cFlagActivaEventoCampania=='S'">
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
                canio: '2018',
                cmes: 'MAYO',
                nidempresa: 0,
                nidsucursal: 0,
                // =====================================================
                // =========== VARIABLES MODAL PROVEEDOR ===============
                fillProveedor:{
                    cnombreproveedor: ''
                },
                arrayProveedor: [],
                // ======================================================
                // =========== VARIABLES TAB BUSCAR PEDIDO ==============
                fillPedido:{
                    dfechainicio: '',
                    dfechafin: '',
                    cnumeropedido: '',
                    cnumerovin: '',
                    nidestadopedido: ''
                },
                arrayEstadoPedido: [],
                // =============================================================
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
                // ================ VARIABLES TAB GENERAR PEDIDO ===============
                formPedido:{
                    dfechainicio: '',
                    dfechafin: '',
                    nidmarca: '',
                    nidmodelo: '',
                    cnumerocotizacion: '',
                    cnombrecontacto: ''
                },
                arrayMisPedido: [],
                arrayPedido: [],
                arrayMarca: [],
                arrayModelo: [],
                vistaFormularioPedido: 1,
                // ============== VARIABLES TAB COMPRA =================
                formCompra:{
                    nidcabeceracotizacion: 0,
                    cnumerovin: '',
                    cnombrecomercial: ''
                },
                arrayCompra: [],
                // ============== VARIABLES TAB DOCUMENTOS REFERENCIA =================
                formDocRef:{
                    cnrocotizacion: '',
                    cnrovin: '',
                    nordencompra: '',
                    ccolor: '',
                    cmotor: '',
                    cnombrecomercial: '',
                    naniofabricacion: '',
                    naniomodelo: '',
                    nidbanco: '',
                    nidformapago: '',
                    dfechapedido: '',
                    fpreciolista: 0,
                    fprecioventap: 0,
                    fbono: 0,
                    fbonoespecial: 0,
                    fsobreprecio: 0,
                    fdescuento: 0,
                    fdescuentolista: 0,
                    fpreciofinal: 0,
                    nidcompra: 0
                },
                arrayBanco: [],
                arrayFormaPago: [],
                cvalidabanco: '',
                // ============== VARIABLES TAB DOCUMENTOS ASOCIADOS =================
                arrayTablaDocumento: [],
                // =============================================================
                // MODAL DETALLE COTIZACION
                fillDetalleCotizacion:{
                    cnumerocotizacion: '',
                    cdocumentocliente: '',
                    cnombrecliente: '',
                    nidversionvehiculo: 0,
                    cvehiculo: '',
                    cnombreproveedor: '',
                    dfechacotizacion: '',
                    cnombrevendedor: '',
                    fpreciocierrefinalcliente: 0,
                    fflete: 0,
                    fpreciocierrelistaprecio: 0,
                    fpreciocierresistema: 0,
                    fsobreprecio: 0,
                    fdscto: 0,
                    ftotalcotizacionsoles: 0,
                    ftotalcotizaciondolares: 0
                },
                arrayDetalleCotizacion: [],
                // =============================================================
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
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
                accion: 0,
                modal:0,
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                attachment: [],
                arrayValidaAttachment: [],
                form: new FormData
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

                var to = from + (this.offset * 3);
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
            }
        },
        methods:{
            tabBuscarPedido(){
                this.formPedido.nidmarca = '';
                this.formPedido.nidmodelo = '';
                this.arrayPedido = [];
            },
            llenarEstadoPedido(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110063
                    }
                }).then(response => {
                    this.arrayEstadoPedido = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            listarPedidos(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/pedido/GetListPedidoByTipoEstado';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': sessionStorage.getItem("nIdSucursal"),
                        'dfechainicio': this.fillPedido.dfechainicio,
                        'dfechafin': this.fillPedido.dfechafin,
                        'cnumeropedido': this.fillPedido.cnumeropedido,
                        'cnumerovin': this.fillPedido.cnumerovin,
                        'nidmarca': this.formPedido.nidmarca,
                        'nidmodelo': this.formPedido.nidmodelo,
                        'nidestadopedido': this.fillPedido.nidestadopedido,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayMisPedido = response.data.arrayPedido.data;
                    this.pagination.current_page =  response.data.arrayPedido.current_page;
                    this.pagination.total = response.data.arrayPedido.total;
                    this.pagination.per_page    = response.data.arrayPedido.per_page;
                    this.pagination.last_page   = response.data.arrayPedido.last_page;
                    this.pagination.from        = response.data.arrayPedido.from;
                    this.pagination.to           = response.data.arrayPedido.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarPedidos(page);
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
            // ==========================================================
            // =============  TAB GENERAR PEDIDO ========================
            tabGenerarPedido(){
                this.llenarComboMarcas();
                this.llenarComboModelos();
                this.limpiarFormulario();
                this.vistaFormularioPedido = 1;
            },
            llenarComboMarcas(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110032
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboModelos(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';

                axios.get(url,{
                    params: {
                        'nidmarca' : this.formPedido.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.formPedido.nidmodelo = '';
                }).catch(error => {
                    console.log(error);
                });
            },
            //============= LISTAR COTIZACIONES APROBADAS PARA PEDIDO ==============
            listarCotizacionesIngresadas(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/pedido/GetLstCotizacionIngresadas';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': sessionStorage.getItem("nIdSucursal"),
                        'dfechainicio': this.formPedido.dfechainicio,
                        'dfechafin': this.formPedido.dfechafin,
                        'nidmarca': this.formPedido.nidmarca,
                        'nidmodelo': this.formPedido.nidmodelo,
                        'cnumerocotizacion': this.formPedido.cnumerocotizacion,
                        'page': page
                    }
                }).then(response => {
                    this.arrayPedido = response.data.arrayPedido.data;
                    this.pagination.current_page =  response.data.arrayPedido.current_page;
                    this.pagination.total = response.data.arrayPedido.total;
                    this.pagination.per_page    = response.data.arrayPedido.per_page;
                    this.pagination.last_page   = response.data.arrayPedido.last_page;
                    this.pagination.from        = response.data.arrayPedido.from;
                    this.pagination.to           = response.data.arrayPedido.to;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaCotizacion(page){
                this.pagination.current_page=page;
                this.listarCotizacionesIngresadas(page);
            },
            desactivar(nIdPedido){

                swal({
                        title: 'Estas seguro de eliminar esta Pedido?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Desactivar!',
                        cancelButtonText: 'No, cancelar!'
                        }).then((result) => {
                        var url = this.ruta + '/compra/desactivar';
                        axios.put(url, {
                            nIdPedido: nIdPedido
                        }).then(response => {
                            swal(
                            'Desactivado!',
                            'El registro fue eliminado.'
                            );
                            this.listarPedidos(1);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    })
            },
            verCotizacion(cotizacion){
                this.fillDetalleCotizacion.cnumerocotizacion = cotizacion.cNumeroCotizacion,
                this.fillDetalleCotizacion.cdocumentocliente = cotizacion.cPerDocumento,
                this.fillDetalleCotizacion.cnombrecliente = cotizacion.cContacto,
                this.fillDetalleCotizacion.nidversionvehiculo = cotizacion.nIdVersionVeh,
                this.fillDetalleCotizacion.cvehiculo = cotizacion.cNombreComercial + ' ' + cotizacion.nAnioFabricacion + '-' + cotizacion.nAnioModelo,
                this.fillDetalleCotizacion.cnombreproveedor = cotizacion.cNombreProveedor,
                this.fillDetalleCotizacion.cnombrevendedor = cotizacion.cNombreVendedor,
                this.fillDetalleCotizacion.dfechacotizacion = cotizacion.dFechaCotizacion,
                this.fillDetalleCotizacion.ftotalcotizacionsoles = cotizacion.fTotalCotizacionSoles,
                this.fillDetalleCotizacion.ftotalcotizaciondolares = cotizacion.fTotalCotizacionDolares,
                this.verDetalleCotizacion(cotizacion);
            },
            verDetalleCotizacion(cotizacion){
                this.mostrarProgressBar();
                var url = this.ruta + '/getcotizacion/GetLstDetalleCotizacion';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcabeceracotizacion': cotizacion.nIdCabeceraCotizacion
                    }
                }).then(response => {
                    this.arrayDetalleCotizacion = response.data.arrayDetalleCotizacion.data;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            //=============== APROBAR COTIZACION ========================
            generarPedido(cotizacion){
                this.formPedido.cnombrecontacto = cotizacion.cContacto;
                this.formCompra.nidcabeceracotizacion = cotizacion.nIdCabeceraCotizacion;
                this.formDocRef.cnrocotizacion = cotizacion.cNumeroCotizacion;
                this.vistaFormularioPedido = 0;
                this.listarCompras(1);
            },
            //=============== TAB ASIGNAR COMPRA ========================
            tabAsignarCompra(){
                $('#Tab1').addClass('nav-link active');
                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link disabled");
                $('#Tab3').removeClass('nav-link active');
                $('#Tab3').addClass('nav-link disabled');
                $('#TabAsignarCompra').addClass('in active show');
                $('#TabDocReferencias').removeClass('in active show');
                $('#TabDocAsociados').removeClass('in active show');
            },
            listarCompras(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/pedido/GetLstCompraByIdModelo';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidsucursal' : sessionStorage.getItem("nIdSucursal"),
                        'nidcabeceracotizacion' : this.formCompra.nidcabeceracotizacion,
                        'cnumerovin' : this.formCompra.cnumerovin,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayCompra = response.data.arrayCompra.data;
                    this.pagination.current_page =  response.data.arrayCompra.current_page;
                    this.pagination.total = response.data.arrayCompra.total;
                    this.pagination.per_page    = response.data.arrayCompra.per_page;
                    this.pagination.last_page   = response.data.arrayCompra.last_page;
                    this.pagination.from        = response.data.arrayCompra.from;
                    this.pagination.to           = response.data.arrayCompra.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaCompra(page){
                this.pagination.current_page=page;
                this.listarCompras(page);
            },
            //============= TAB DOCUMENTOS REFERENCIAS ==================
            activarTabDocReferencias(compra){
                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link");
                $('#Tab2').removeClass('nav-link disabled');
                $('#Tab2').addClass("nav-link active");
                $('#TabAsignarCompra').removeClass('in active show');
                $('#TabDocReferencias').addClass('in active show');
                this.formDocRef.nidcompra = compra.nIdCompra;
                this.formDocRef.cnrovin = compra.cNumeroVin;
                this.formDocRef.nordencompra = compra.nOrdenCompra;
                this.formDocRef.cnombrecomercial = compra.cNombreComercial;
                this.formDocRef.naniofabricacion = compra.nAnioFabricacion;
                this.formDocRef.naniomodelo = compra.nAnioVersion;
                this.formDocRef.ccolor = compra.cNombreColor;
                this.formDocRef.cmotor = compra.cNombreMotor;
                this.obtenerFechaRegistroPedido();
                this.listarDatosListaPrecioDetalle(parseInt(this.formCompra.nidcabeceracotizacion));
                this.llenarComboBanco();
                this.llenarFormaPago();
            },
            obtenerFechaRegistroPedido(){
                this.formDocRef.dfechapedido = moment().format('DD/MM/YYYY');
            },
            listarDatosListaPrecioDetalle(nidcabeceracotizacion){
                this.mostrarProgressBar();

                var url = this.ruta + '/pedido/GetListaPrecioDetalleByIdCotizacion';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidsucursal' : sessionStorage.getItem("nIdSucursal"),
                        'nidcabeceracotizacion' : this.formCompra.nidcabeceracotizacion
                    }
                }).then(response => {
                    this.formDocRef.fpreciolista = response.data[0].fPrecioLista;
                    this.formDocRef.fprecioventap = response.data[0].fPrecioVentaP;
                    this.formDocRef.fdescuentolista = response.data[0].fDescuento;
                    this.formDocRef.fbono = response.data[0].fBono;
                    this.formDocRef.fbonoespecial = response.data[0].fBonoEspecial;
                    this.formDocRef.fpreciofinal = response.data[0].fSubTotalDolares;
                    this.formDocRef.fsobreprecio = response.data[0].fSobrePrecio;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboBanco(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110042
                    }
                }).then(response => {
                    this.arrayBanco = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarFormaPago(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110062
                    }
                }).then(response => {
                    this.arrayFormaPago = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            changeFormaPago(){
                var url = this.ruta + '/tipoparametro/GetTipoByIdParametro';
                axios.get(url, {
                    params: {
                        'nidpar' : this.formDocRef.nidformapago,
                        'ctipoparametro' : 'D',
                        'nidtipopar': 0
                    }
                }).then(response => {
                    this.cvalidabanco = response.data[0].cDatoParDescripcion;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            //============= TAB DOCUMENTOS ASOCIADOS ===================
            activarTabDocAsociados(){
                if(this.validaMostrarTabAsociados()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link");
                $('#Tab3').removeClass('nav-link disabled');
                $('#Tab3').addClass("nav-link active");
                $('#TabDocReferencias').removeClass('in active show');
                $('#TabDocAsociados').addClass('in active show');
                this.llenarTablaDocumentos();
            },
            validaMostrarTabAsociados(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.formDocRef.nidformapago ||this.formDocRef.nidformapago == 0){
                    this.mensajeError.push('Debes Seleccionar Forma de Pago');
                };
                if(this.cvalidabanco == 'SI' && (!this.formDocRef.nidbanco || this.formDocRef.nidbanco==0)){
                    this.mensajeError.push('Debes Seleccionar Banco');
                }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            llenarTablaDocumentos(){
                var url = this.ruta + '/pedido/GetDocumentoByFormaPago';

                axios.get(url, {
                    params: {
                        'nidformapago': this.formDocRef.nidformapago,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayTablaDocumento = response.data.arrayDocumento;
                }).catch(error => {
                    console.log(error);
                });
            },
            getFile(e, index, nIdPar){
                let selectFile = e.target.files;
                this.arrayValidaAttachment.length = this.arrayTablaDocumento.length;
                this.arrayValidaAttachment[index] = selectFile;


                for(let i= 0; i < selectFile.length; i++){
                    this.attachment.push({
                        archivo: selectFile[i],
                        nameFile: selectFile[i].name,
                        valorIndex: index,
                        nIdTabla: nIdPar
                    });
                }
            },
            registrarPedido(){
                if(this.validaRegistraraPedido()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/pedido/SetCabeceraPedido';
                axios.post(url, {
                    'nIdEmpresa': 1300011,
                    'nIdSucursal': sessionStorage.getItem("nIdSucursal"),
                    'nIdCabeceraCotizacion': this.formCompra.nidcabeceracotizacion,
                    'nIdCompra': this.formDocRef.nidcompra,
                    'cNumeroPedido': 'PEDIDO-001',
                    'dFechaPedido': moment().format('YYYY-MM-DD'),
                    'nIdFormaPago': this.formDocRef.nidformapago,
                    'cGlosa': 'REGISTRO DE PEDIDO'
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        if(this.attachment.length){
                            this.subirArchivos(response.data[0].nIdCabeceraPedido);
                        }
                        else{
                            swal('Pedido registrado exitosamente');
                            this.vistaFormularioPedido = 1;
                            this.limpiarFormulario();
                        }
                    }
                    else{
                        swal('Compra' + this.formDocRef.nidcompra + 'No Disponible');
                    }
                }).catch(error => {
                    this.errors = error
                });
            },
            validaRegistraraPedido(){
                let me = this;
                me.error = 0;
                me.mensajeError =[];

                me.arrayTablaDocumento.map(function(value, key) {
                    if(value.nValida == 1 && !me.arrayValidaAttachment[key])
                    {
                        me.mensajeError.push('* ' + value.cParNombre + ' - Archivo Obligatorio');
                    }
                });

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            subirArchivos(nIdCabeceraPedido){
                let me = this;

                me.mostrarProgressBar();

                me.attachment.map(function(value, i) {
                    if(me.attachment[i]){
                        me.form.append('file[]', value.archivo);
                    }
                });

                me.arrayTablaDocumento.map(function(info, key) {
                    me.attachment.map(function(value, i) {
                        if(me.attachment[i] && info.nIdPar == value.nIdTabla){
                            me.form.append('data['+i+']["nIdPar"]', info.nIdPar);
                            me.form.append('data['+i+']["cParNombre"]', info.cParNombre);
                            me.form.append('data['+i+']["cParArchivoNombre"]', value.nameFile);
                            me.form.append('data['+i+']["nIdCabeceraPedido"]', nIdCabeceraPedido);
                        }
                    });
                });

                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };

                var url = me.ruta + '/pedido/subirArchivo';

                axios.post(url, me.form, config).then(response=>{
                    swal('Pedido registrado exitosamente');
                    me.vistaFormularioPedido = 1;
                    me.limpiarFormulario();
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            // =============================================
            // =============  MODAL ========================
            cerrarModal(){
                this.modal = 0,
                this.error = 0,
                this.mensajeError = ''
            },
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'proveedor':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.listarProveedores(1);
                                break;
                            }
                        }
                    }
                    break;
                    case "pedido":
                    {
                        switch(accion){
                            case 'detalle':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.verPedido(data);
                                break;
                            }
                        }
                    }
                    break;
                    case 'cotizacion':
                    {
                        switch(accion){
                            case 'detalle':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.verCotizacion(data);
                                break;
                            }
                        }
                    }
                    break;
                }
            },
            // ===========================================================
            limpiarFormulario(){
                this.arrayPedido = [];
                this.attachment = [];
                this.arrayValidaAttachment = [];
                this.form = new FormData;
            },
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            }
        },
        mounted(){
            this.llenarComboMarcas();
            this.llenarComboModelos();
            this.llenarEstadoPedido();
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
    }
</style>
