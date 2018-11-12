<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom"> APROBACIÓN DE LA COTIZACIÓN</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="h4">BUSCAR COTIZACIONES PENDIENTES DE CONFORMIDAD</h3>
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
                                                                <label class="col-sm-4 form-control-label">Fecha Inicio</label>
                                                                <div class="col-sm-8">
                                                                    <el-date-picker
                                                                        v-model="fillCotizacionesPendiente.dfechainicio"
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
                                                                <label class="col-sm-4 form-control-label">Fecha Fin</label>
                                                                <div class="col-sm-8">
                                                                    <el-date-picker
                                                                        v-model="fillCotizacionesPendiente.dfechafin"
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
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <label class="col-md-4 form-control-label">Marca</label>
                                                                <div class="col-md-8">
                                                                    <el-select v-model="fillCotizacionesPendiente.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
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
                                                                    <el-select v-model="fillCotizacionesPendiente.nidmodelo" filterable clearable placeholder="SELECCIONE">
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
                                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarCotizacionesPendientes(1)">
                                                                <i class="fa fa-search"></i> Buscar
                                                            </button>
                                                            <button type="button" class="btn btn-default btn-corner btn-sm" @click.prevent="limpiarBusqCotizacionesPendientes">
                                                                <i class="fa fa-recycle"></i> Limpiar
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
                                                <template v-if="arrayCotizacionesPendientes.length">
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
                                                                <tr v-for="cotizacionpendiente in arrayCotizacionesPendientes" :key="cotizacionpendiente.nIdCabeceraCotizacion">
                                                                    <td>
                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                            <div slot="content">Ver Detalle Cotizacion {{ cotizacionpendiente.nIdCabeceraCotizacion }}</div>
                                                                            <i @click="abrirModal('cotizacion', 'detalle', cotizacionpendiente)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                                        </el-tooltip>&nbsp;&nbsp;
                                                                        <!-- Opcion del Jefe de Ventas -->
                                                                        <template v-if="cotizacionpendiente.cTipoRol == 110025">
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Conformidad de Cotización {{ cotizacionpendiente.cNumeroCotizacion }}</div>
                                                                                <i @click="conformeNoConformeCotizacion(2, cotizacionpendiente.nIdCabeceraCotizacion, cotizacionpendiente.cNumeroCotizacion)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                        </template>
                                                                        <!-- Opcion del ADV -->
                                                                        <template v-if="cotizacionpendiente.cTipoRol == 110083">
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Distribuir Cotización {{ cotizacionpendiente.cNumeroCotizacion }}</div>
                                                                                <i @click="abrirModal('distribucion', 'abrir', cotizacionpendiente.nIdCabeceraCotizacion)" :style="'color:#796AEE'" class="fa-md fa fa-usd"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                        </template>
                                                                        <!-- Opción de Jefe de Ventas y ADV -->
                                                                        <template v-if="cotizacionpendiente.cTipoRol == 110025 || cotizacionpendiente.cTipoRol == 110083">
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Rechazar Cotización {{ cotizacionpendiente.cNumeroCotizacion }}</div>
                                                                                <i @click="conformeNoConformeCotizacion(3, cotizacionpendiente.nIdCabeceraCotizacion, cotizacionpendiente.cNumeroCotizacion)" :style="'color:red'" class="fa-md fa fa-trash"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                        </template>

                                                                        <!-- Opción de Gerencia -->
                                                                        <template v-if="cotizacionpendiente.cTipoRol == 110096">
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Aprobar Cotización {{ cotizacionpendiente.cNumeroCotizacion }}</div>
                                                                                <i @click="aprobarNoaprobarCotizacion(1, cotizacionpendiente.nIdCabeceraCotizacion, cotizacionpendiente.cNumeroCotizacion)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Rechazar Cotización {{ cotizacionpendiente.cNumeroCotizacion }}</div>
                                                                                <i @click="aprobarNoaprobarCotizacion(2, cotizacionpendiente.nIdCabeceraCotizacion, cotizacionpendiente.cNumeroCotizacion)" :style="'color:red'" class="fa-md fa fa-trash"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                        </template>
                                                                    </td>
                                                                    <td v-text="cotizacionpendiente.cNumeroCotizacion"></td>
                                                                    <td v-text="cotizacionpendiente.cContacto"></td>
                                                                    <td v-text="cotizacionpendiente.cNombreComercial + ' ' + cotizacionpendiente.nAnioFabricacion + '-' + cotizacionpendiente.nAnioModelo"></td>
                                                                    <td v-text="cotizacionpendiente.cDireccion"></td>
                                                                    <td v-text="cotizacionpendiente.nTelefonoMovil"></td>
                                                                    <td v-text="cotizacionpendiente.cEmail"></td>
                                                                    <td v-text="cotizacionpendiente.dFechaCotizacion"></td>
                                                                    <td v-text="cotizacionpendiente.dFechaVencimientoCotizacion"></td>
                                                                    <td v-text="cotizacionpendiente.cEstadoAprobacion"></td>
                                                                    <td v-text="cotizacionpendiente.cEstadoCotizacion"></td>
                                                                    <td v-text="cotizacionpendiente.cNombreVendedor"></td>
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

            <!-- MODAL DISTRIBUCIÓN DE ELEMENTOS DE VENTA POR REGALAR Y DESCUENTO -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">DISTRIBUCIÓN</h3>
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
                                            <template v-if="listDistribucionDescuento.length">
                                                <vs-divider border-style="solid" color="dark">
                                                    Distribución del Descuento Superado
                                                </vs-divider>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Código</th>
                                                                <th>Proveedor</th>
                                                                <th>Nombre Comercial</th>
                                                                <th>Precio de Venta Soles</th>
                                                                <th>Precio de Venta Dolares</th>
                                                                <th>Descuento</th>
                                                                <th>Supera Dscto</th>
                                                                <th>Proveedor</th>
                                                                <th>% Distribución</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="descuento in listDistribucionDescuento" :key="descuento.nIdDetalleCotizacion">
                                                                <td v-text="descuento.nIdCabeceraCotizacion"></td>
                                                                <td v-text="descuento.cProveedorNombre"></td>
                                                                <td v-text="descuento.cNombreComercial"></td>
                                                                <td v-text="descuento.fSubTotalSoles"></td>
                                                                <td v-text="descuento.fSubTotalDolares"></td>
                                                                <td v-text="descuento.fDescuento"></td>
                                                                <td v-text="descuento.fSuperaDescuento"></td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <el-select v-model="descuento.nIdProveedor"
                                                                                filterable clearable
                                                                                placeholder="SELECCIONE PROVEEDOR" >
                                                                            <el-option
                                                                                v-for="item in arrayProveedor"
                                                                                :key="item.nIdPar"
                                                                                :label="item.cParNombre"
                                                                                :value="item.nIdPar">
                                                                            </el-option>
                                                                        </el-select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="number" v-model="descuento.fDistribucion" @keyup="validarDistribucionDscto" min="0" max="100" maxlength="3" class="form-control form-control-sm">
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
                                            <template v-if="listDistribucionEVPorRegalar.length">
                                                <vs-divider border-style="solid" color="dark">
                                                    Distribución de Elementos de Venta por Regalar
                                                </vs-divider>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Código</th>
                                                                <th>Proveedor</th>
                                                                <th>Tipo Elemento</th>
                                                                <th>Nombre Elemento</th>
                                                                <th>Moneda</th>
                                                                <th>Precio de Venta</th>
                                                                <th>Cantidad</th>
                                                                <th>SubTotalSoles</th>
                                                                <th>SubTotalDolares</th>
                                                                <th>Proveedor</th>
                                                                <th>% Distribución</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="elemento in listDistribucionEVPorRegalar" :key="elemento.nIdElementoVenta">
                                                                <td v-text="elemento.nIdElementoVenta"></td>
                                                                <td v-text="elemento.cProveedorNombre"></td>
                                                                <td v-text="elemento.cTipoElemenNombre"></td>
                                                                <td v-text="elemento.cElemenNombre"></td>
                                                                <td v-text="elemento.cNombreMoneda"></td>
                                                                <td v-text="elemento.fElemenValorVenta"></td>
                                                                <td v-text="elemento.nCantidad"></td>
                                                                <td v-text="elemento.fSubTotalSoles"></td>
                                                                <td v-text="elemento.fSubTotalDolares"></td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <el-select v-model="elemento.nIdProveedor"
                                                                                filterable clearable
                                                                                placeholder="SELECCIONE" >
                                                                            <el-option
                                                                                v-for="item in arrayProveedor"
                                                                                :key="item.nIdPar"
                                                                                :label="item.cParNombre"
                                                                                :value="item.nIdPar">
                                                                            </el-option>
                                                                        </el-select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="number" v-model="elemento.fDistribucion" @keyup="validarDistribucionEV" min="0" max="100" maxlength="3" class="form-control form-control-sm">
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
                                                <div class="col-sm-9 offset-sm-4">
                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="registrarDistribucion">
                                                        <i class="fa fa-save"></i> DISTRIBUIR
                                                    </button>
                                                    <button type="button" class="btn btn-secundary btn-corner btn-sm" @click.prevent="limpiarDistribucion">
                                                        <i class="fa fa-recycle"></i> LIMPIAR
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal">Cerrar</button>
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
        props:['ruta', 'usuario'],
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
                fillCotizacionesPendiente:{
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: 0,
                    dfechainicio: '',
                    dfechafin: ''
                },
                arrayCotizacionesPendientes: [],
                arrayMisCotizacionesPendientes: [],
                //Modal Distribucion
                arrayDistribucionDescuento: [],
                listDistribucionDescuento: [],
                arrayDistribucionEVPorRegalar: [],
                listDistribucionEVPorRegalar: [],
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
                nIdGrupoUsuario: '',
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
        mounted(){
            this.informacionUsuario();
            this.llenarComboMarca();
            this.llenarComboModelo();
        },
        methods: {
            //===========================================================
            // MODAL COTIZACION DETALLE
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
            //===========================================================
            informacionUsuario(){
                var url = this.ruta + '/parametro/GetParametroById';
                axios.get(url, {
                    params: {
                        'nidpar' : this.usuario.id,
                        'nidgrupopar': 110083
                    }
                }).then(response => {
                    this.nIdGrupoUsuario = response.data[0].nIdGrupoPar;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboMarca(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110032
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                    this.fillCotizacionesPendiente.nidmarca = '';
                    this.arrayModelo = [];
                    this.llenarComboModelo();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';
                axios.get(url, {
                    params: {
                        'nidmarca': this.fillCotizacionesPendiente.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillCotizacionesPendiente.nidmodelo = '';
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            // buscar cotizaciones
            buscarCotizacionesPendientes(page){
                if(this.validarbuscarCotizacionesPendientes()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/getcotizacion/GetLstCotizacionPendientes';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidmarca' : this.fillCotizacionesPendiente.nidmarca,
                        'nidmodelo' : this.fillCotizacionesPendiente.nidmodelo,
                        'dfechainicio': this.fillCotizacionesPendiente.dfechainicio,
                        'dfechafin': this.fillCotizacionesPendiente.dfechafin,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayCotizacionesPendientes = response.data.arrayCotizacionesPendientes.data;
                    this.pagination.current_page   =  response.data.arrayCotizacionesPendientes.current_page;
                    this.pagination.total          = response.data.arrayCotizacionesPendientes.total;
                    this.pagination.per_page       = response.data.arrayCotizacionesPendientes.per_page;
                    this.pagination.last_page      = response.data.arrayCotizacionesPendientes.last_page;
                    this.pagination.from           = response.data.arrayCotizacionesPendientes.from;
                    this.pagination.to             = response.data.arrayCotizacionesPendientes.to;
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarbuscarCotizacionesPendientes(){
                this.error = 0;
                this.mensajeError =[];

                /*if(!this.fillCotizacionesPendiente.dfechainicio){
                    this.mensajeError.push('Debe ingresar una fecha de inicio');
                }

                if(!this.fillCotizacionesPendiente.dfechafin){
                    this.mensajeError.push('Debe ingresar una fecha de fin');
                }*/

                let fecha_ini = moment(this.fillCotizacionesPendiente.dfechainicio);
                let fecha_fin = moment(this.fillCotizacionesPendiente.dfechafin);

                if(fecha_fin.diff(fecha_ini, 'days') < 0){
                    this.mensajeError.push('La Fecha de Fin no puede ser menor a la fecha de inicio');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarPaginaCotizacion(page){
                this.paginationModal.current_page=page;
                this.buscarCotizacionesPendientes(page);
            },
            conformeNoConformeCotizacion(op, nIdCabeceraCotizacion, cNumeroCotizacion){
                swal({
                    title: '¿Esta seguro de' + ((op == 2) ? ' dar Conformidad a' : ' Rechazar ') + ' la cotización N°' + cNumeroCotizacion + '?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si,' + ((op == 2) ? 'Conforme' : ' Rechazar '),
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        this.mostrarProgressBar();

                        var url = this.ruta + '/setcotizacion/SetCambiarEstadoCotizacion';
                        axios.put(url, {
                            nIdCabeceraCotizacion : nIdCabeceraCotizacion,
                            opcion : op
                        }).then(response => {
                            me.buscarCotizacionesPendientes(1);
                            swal(
                                ((op == 2) ? 'Conforme' : ' Rechazar'),
                                'La Cotización ' + cNumeroCotizacion +' ha sido otorgada la ' + ((op == 2) ? '' : ' No ') + ' Conformidad con éxito.',
                                'success'
                            )
                        }).catch(error => {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {}
                })
            },
            limpiarBusqCotizacionesPendientes(){
                this.fillCotizacionesPendiente.nidlinea = '';
                this.fillCotizacionesPendiente.nidmarca = '';
                this.fillCotizacionesPendiente.nidmodelo = '';
                this.fillCotizacionesPendiente.dfechainicio = '';
                this.fillCotizacionesPendiente.dfechafin = '';
                this.$forceUpdate();
            },
            /**
             * MODAL DISTRIBUCIÓN ELEMENTO VENTAS Y SUPERA DSCTO
             */
            listarDistribucionDescuento(nIdCabeceraCotizacion){
                var url = this.ruta + '/getcotizacion/GetDistribucionBySuperaDscto';
                axios.get(url, {
                    params: {
                        'nIdCabeceraCotizacion' : nIdCabeceraCotizacion
                    }
                }).then(response => {
                    this.arrayDistribucionDescuento = response.data;
                    this.cargarDistribucionSuperaDscto();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cargarDistribucionSuperaDscto(){
                let me = this;
                me.listDistribucionDescuento = [];

                if(me.arrayDistribucionDescuento.length > 0){
                    me.arrayDistribucionDescuento.map(function(ec){
                        me.listDistribucionDescuento.push({
                            nIdCabeceraCotizacion   :   ec.nIdCabeceraCotizacion,
                            nIdDetalleCotizacion    :   ec.nIdDetalleCotizacion,
                            cProveedorNombre        :   ec.cProveedorNombre,
                            nIdCabeceraCotizacion   :   ec.nIdCabeceraCotizacion,
                            nIdDetalleCotizacion    :   ec.nIdDetalleCotizacion,
                            cFlagSuperaDescuento    :   ec.cFlagSuperaDescuento,
                            cNombreComercial        :   ec.cNombreComercial,
                            fSubTotalSoles          :   ec.fSubTotalSoles,
                            fSubTotalDolares        :   ec.fSubTotalDolares,
                            fDescuento              :   ec.fDescuento,
                            fSuperaDescuento        :   ec.fSuperaDescuento,
                            nIdProveedor            :   '',
                            fDistribucion           :   0
                        });
                    });
                }
            },
            listarDistribucionEVPorRegalar(nIdCabeceraCotizacion){
                var url = this.ruta + '/getcotizacion/GetDistribucionByElementoVenta';
                axios.get(url, {
                    params: {
                        'nIdCabeceraCotizacion' : nIdCabeceraCotizacion
                    }
                }).then(response => {
                    this.arrayDistribucionEVPorRegalar = response.data;
                    this.cargarDistribucionEVPorRegalar();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cargarDistribucionEVPorRegalar(){
                let me = this;
                me.listDistribucionEVPorRegalar = [];

                if(me.arrayDistribucionEVPorRegalar.length > 0){
                    me.arrayDistribucionEVPorRegalar.map(function(ec){
                        me.listDistribucionEVPorRegalar.push({
                            nIdCabeceraCotizacion   :   ec.nIdCabeceraCotizacion,
                            nIdDetalleCotizacion    :   ec.nIdDetalleCotizacion,
                            nIdElementoVenta    :   ec.nIdElementoVenta,
                            cProveedorNombre    :   ec.cProveedorNombre,
                            cTipoElemenNombre   :   ec.cTipoElemenNombre,
                            cElemenNombre       :   ec.cElemenNombre,
                            fElemenValorVenta   :   ec.fElemenValorVenta,
                            nCantidad           :   ec.nCantidad,
                            fSubTotalSoles      :   ec.fSubTotalSoles,
                            fSubTotalDolares    :   ec.fSubTotalDolares,
                            nIdProveedor        :   '',
                            fDistribucion       :   0
                        });
                    });
                }
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : '',
                        'opcion' : 1,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarDistribucionDscto(){
                let me = this;
                this.listDistribucionDescuento.map(function (x, y) {
                    console.log(x.fDistribucion, y);
                    if(parseInt(x.fDistribucion) < 0 || parseInt(x.fDistribucion) > 100){
                        me.$message.error(`No puede superar los margenes del 0 - 100`);
                        me.listDistribucionDescuento[y].fDistribucion = 0;//Seteado a 0.
                        me.$forceUpdate();
                    }
                    if(x.fDistribucion == ''){
                        me.listDistribucionDescuento[y].fDistribucion = 0;//Seteado a 0.
                        me.$forceUpdate();
                    }
                    me.$forceUpdate();
                });
            },
            validarDistribucionEV(){
                let me = this;
                this.listDistribucionEVPorRegalar.map(function (x, y) {
                    // console.log(x.fDistribucion, y);
                    if(parseInt(x.fDistribucion) < 0 || parseInt(x.fDistribucion) > 100){
                        me.$message.error(`No puede superar los margenes del 0 - 100`);
                        me.listDistribucionEVPorRegalar[y].fDistribucion = 0;//Seteado a 0.
                        me.$forceUpdate();
                    }
                    if(x.fDistribucion == ''){
                        me.listDistribucionEVPorRegalar[y].fDistribucion = 0;//Seteado a 0.
                        me.$forceUpdate();
                    }
                    me.$forceUpdate();
                });
            },
            registrarDistribucion(){
                if(this.validarRegistrarDistribucion()){
                    return;
                }

                var url = this.ruta + '/setcotizacion/SetDistribucionCotizacion';
                axios.post(url, {
                    listDistribucionDescuento: this.listDistribucionDescuento,
                    listDistribucionEVPorRegalar: this.listDistribucionEVPorRegalar
                }).then(response => {
                    if (this.nIdGrupoUsuario == '110083') {
                        //GENERAR LA CONFORMIDAD HACIA EL GERENTE
                        this.cambiarEstadoCotizacion(response.data, 4);
                    } else {
                        //GENERAR LA CONFORMIDAD HACIA EL GERENTE
                        this.cambiarEstadoCotizacion(response.data, 4);
                    }
                    swal('Cotización distribuida y pendiente de aprobación por Gerencia');
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarEstadoCotizacion(nIdCabeceraCotizacion, op){
                // console.log(nIdCabeceraCotizacion, op);
                var url = this.ruta + '/setcotizacion/SetCambiarEstadoCotizacion';
                axios.put(url, {
                    nIdCabeceraCotizacion: nIdCabeceraCotizacion,
                    opcion: op,
                }).then(response => {
                    //this.limpiarDistribucion();
                    this.cerrarModal();
                    this.limpiarModalDistribucion();
                    this.buscarCotizacionesPendientes(1);
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarRegistrarDistribucion(){
                this.error = 0;
                this.mensajeError =[];
                let me = this;

                //VALIDAR SECCIÓN DE DISTRIBUCIÓN DE SUPERA DESCUENTO
                let flagIdProveedorDscto = 0;
                this.listDistribucionDescuento.map(function (x) {
                    if(x.nIdProveedor == ''){
                        flagIdProveedorDscto = true;
                    }
                });
                if (flagIdProveedorDscto == true) {
                    this.mensajeError.push('Debe seleccionar un proveedor en la sección Supera Descuento');
                }

                let flagDistribucionDscto = 0;
                this.listDistribucionDescuento.map(function (x) {
                    if(parseInt(x.fDistribucion) < 0 || parseInt(x.fDistribucion) > 100){
                        flagDistribucionDscto = true;
                        x.fDistribucion = 0;//Seteado a 0
                    }
                    me.$forceUpdate();
                });
                if (flagDistribucionDscto == true) {
                    this.mensajeError.push('No puede superar los margenes del 0 - 100 en la sección Supera Descuento');
                }


                //VALIDAR SECCIÓN DE DISTRIBUCIÓN DE EV POR REGALAR
                let flagIdProveedorEV = 0;
                this.listDistribucionEVPorRegalar.map(function (x) {
                    if(x.nIdProveedor == ''){
                        flagIdProveedorEV = true;
                    }
                });
                if (flagIdProveedorEV == true) {
                    this.mensajeError.push('Debe seleccionar un proveedor en la Sección Ev Por Regalar');
                }

                let flagDistribucionEV = 0;
                this.listDistribucionEVPorRegalar.map(function (x) {
                    if(parseInt(x.fDistribucion) < 0 || parseInt(x.fDistribucion) > 100){
                        flagDistribucionEV = true;
                        x.fDistribucion = 0;//Seteado a 0
                    }
                    me.$forceUpdate();
                });
                if (flagDistribucionEV == true) {
                    this.mensajeError.push('No puede superar los margenes del 0 - 100 en la Sección Ev Por Regalar');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarModalDistribucion(){
                this.arrayDistribucionDescuento = [];
                this.arrayDistribucionEVPorRegalar = [];
                this.listDistribucionDescuento = [];
                this.listDistribucionEVPorRegalar = [];
            },
            limpiarDistribucion(){
                this.listDistribucionDescuento.map(function (x) {
                    x.nIdProveedor = '';
                    x.fDistribucion = 0;
                });
                this.listDistribucionEVPorRegalar.map(function (x) {
                    x.nIdProveedor = '';
                    x.fDistribucion = 0;
                });
            },
            /**
             * Aprobación Gerencia
             */
            aprobarNoaprobarCotizacion(op, nIdCabeceraCotizacion, cNumeroCotizacion){
                swal({
                    title: '¿Esta seguro de ' + ((op == 1) ? 'Aprobar' : ' Rechazar ') + ' la cotización N°' + cNumeroCotizacion + '?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, ' + ((op == 1) ? 'Aprobar' : ' Rechazar '),
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        this.mostrarProgressBar();

                        var url = this.ruta + '/setcotizacion/SetCambiarEstadoCotizacion';
                        axios.put(url, {
                            nIdCabeceraCotizacion : nIdCabeceraCotizacion,
                            opcion : op
                        }).then(response => {
                            me.buscarCotizacionesPendientes(1);
                            swal(
                                ((op == 1) ? 'Aprobar' : ' Rechazar '),
                                'La Cotización ' + cNumeroCotizacion +' ha sido ' + ((op == 1) ? 'Aprobada' : ' Rechazada ') + ' con éxito.',
                                'success'
                            )
                        }).catch(error => {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {}
                })
            },
            // =================================================================
            // MODAL
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "distribucion":
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.listarProveedores(1);
                                this.listarDistribucionDescuento(data);
                                this.listarDistribucionEVPorRegalar(data);
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
