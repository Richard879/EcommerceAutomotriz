<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">MODULO APROBAR DESCUENTO PEDIDO</h2>
                    </vs-divider>
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
                                                <h3 class="h4">BUSCAR PEDIDO PENDIENTES DE CONFORMIDAD</h3>
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
                                                        <!--<div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                                <div class="col-sm-8">
                                                                    <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.value">
                                                                        <input type="radio" class="radio-template" v-model="fillCotizacionesPendiente.ntipopersona" :value="tipo.value">
                                                                        <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" v-model="fillCotizacionesPendiente.ccontacto" @keyup.enter="buscarCotizacionesPendientes(1)" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" v-model="fillCotizacionesPendiente.cnrodocumento" @keyup.enter="listarCarteraMesPorVendedor(1)" class="form-control form-control-sm">
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
                                                                    <th>Nro Pedido</th>
                                                                    <th>Nro Cotizacion</th>
                                                                    <th>Contacto</th>
                                                                    <th>Nro Documento</th>
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
                                                                <tr v-for="cotizacionpendiente in arrayCotizacionesPendientes" :key="cotizacionpendiente.nIdCabeceraPedido">
                                                                    <td>
                                                                        <!-- Opcion del Jefe de Ventas -->
                                                                        <template v-if="cotizacionpendiente.cTipoRol == 110025">
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Conformidad de Pedido {{ cotizacionpendiente.cNumeroCotizacion }}</div>
                                                                                <i  @click="conformeNoConformeCotizacion(2, cotizacionpendiente)"
                                                                                    :style="'color:#796AEE'"
                                                                                    class="fa-md fa fa-check-circle"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                        </template>
                                                                        <!-- Opcion del ADV -->
                                                                        <template v-if="cotizacionpendiente.cTipoRol == 110083">
                                                                            <!--<el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Ver Detalle Cotizacion {{ cotizacionpendiente.cNumeroCotizacion }}</div>
                                                                                <i  @click="abrirModal('cotizacion', 'detalle', cotizacionpendiente)"
                                                                                    :style="'color:#796AEE'"
                                                                                    class="fa-md fa fa-eye"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;-->
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Ver Detalle Pedido {{ cotizacionpendiente.cNumeroPedido }}</div>
                                                                                <i @click="abrirModal('pedido', 'detalle', cotizacionpendiente)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Distribuir Pedido {{ cotizacionpendiente.cNumeroPedido }}</div>
                                                                                <i  @click="abrirModal('distribucion', 'abrir', cotizacionpendiente)"
                                                                                    :style="'color:#796AEE'"
                                                                                    class="fa-md fa fa-usd"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                        </template>
                                                                        <!-- Opción de Jefe de Ventas y ADV -->
                                                                        <template v-if="cotizacionpendiente.cTipoRol == 110025 || cotizacionpendiente.cTipoRol == 110083">
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Rechazar Pedido {{ cotizacionpendiente.cNumeroPedido }}</div>
                                                                                <i  @click="conformeNoConformeCotizacion(3, cotizacionpendiente)"
                                                                                    :style="'color:red'"
                                                                                    class="fa-md fa fa-trash"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                        </template>

                                                                        <!-- Opción de Gerencia -->
                                                                        <template v-if="cotizacionpendiente.cTipoRol == 110096">
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Ver Detalle Distribución {{ cotizacionpendiente.cNumeroPedido }}</div>
                                                                                <i  @click="abrirModal('pedido', 'distribucion', cotizacionpendiente)"
                                                                                    :style="'color:#796AEE'"
                                                                                    class="fa-md fa fa-eye"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Aprobar Pedido {{ cotizacionpendiente.cNumeroPedido }}</div>
                                                                                <i  @click="aprobarNoaprobarCotizacion(1, cotizacionpendiente)"
                                                                                    :style="'color:#796AEE'"
                                                                                    class="fa-md fa fa-check-circle"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                <div slot="content">Rechazar Pedido {{ cotizacionpendiente.cNumeroPedido }}</div>
                                                                                <i  @click="aprobarNoaprobarCotizacion(2, cotizacionpendiente)"
                                                                                    :style="'color:red'"
                                                                                    class="fa-md fa fa-trash"></i>
                                                                            </el-tooltip>&nbsp;&nbsp;
                                                                        </template>
                                                                    </td>
                                                                    <td v-text="cotizacionpendiente.cNumeroPedido"></td>
                                                                    <td v-text="cotizacionpendiente.cNumeroCotizacion"></td>
                                                                    <td v-text="cotizacionpendiente.cContacto"></td>
                                                                    <td v-text="cotizacionpendiente.cPerDocumento"></td>
                                                                    <td v-text="cotizacionpendiente.cNombreComercial + ' ' + cotizacionpendiente.nAnioModelo"></td>
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
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro Cotización</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cnumerocotizacion" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cnombreproveedor" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cdocumentocliente" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Cliente</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cnombrecliente" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Vehículo</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cvehiculo" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro VIN</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cnumerovin" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Fecha Cotización</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.dfechacotizacion" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Vendedor</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cnombrevendedor" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Prec. Cierre Final Cliente s./</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.ftotalcotizacionvehiculosol" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Prec. Cierre Final Cliente US$</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.ftotalcotizacionvehiculodolar" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Flete</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.fflete" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* TyP</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.ftyp" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Prec. Cierre LP</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.fpreciocierrelp" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Prec. Cierre Sistema</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.fpreciocierresistema" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Sobre Precio</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.fsobreprecio" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Descuento</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.fdescuento" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br/>
                                            <template v-if="cflagVerificaDistribucionAprobacion">
                                                <template v-if="arrayDetalleDistribucion.length">
                                                    <vs-divider border-style="solid" color="dark">
                                                        Diferencia Costo Dealer
                                                    </vs-divider>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Prec. Cierre Venta US$</th>
                                                                    <th>Costo Dealer Compra US$</th>
                                                                    <th>Costo Dealer Venta US$</th>
                                                                    <th>Diferencia US$</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="dis in arrayDetalleDistribucion" :key="dis.nIdCabeceraCotizacion">
                                                                    <td v-text="dis.fTotalCotizacionVehiculoDolar"></td>
                                                                    <td v-text="dis.fCostoDealerCompra"></td>
                                                                    <td v-text="dis.fCostoDealerVenta"></td>
                                                                    <td v-text="dis.fPrecioDiferencia"></td>
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
                                            </template>
                                            <template v-if="cflagVerificaDistribucionAprobacion">
                                                <template v-if="listDistribucionDescuento.length">
                                                    <vs-divider border-style="solid" color="dark">
                                                        Distribución del Descuento
                                                    </vs-divider>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Código</th>
                                                                    <th>Proveedor</th>
                                                                    <th>Nombre Comercial</th>
                                                                    <th>Precio Venta s/.</th>
                                                                    <th>Precio Venta US$</th>
                                                                    <th>Descuento US$</th>
                                                                    <th>Proveedor</th>
                                                                    <th>US$ Proveedor</th>
                                                                    <th>US$ Saisac</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="descuento in listDistribucionDescuento" :key="descuento.nIdCabeceraPedido">
                                                                    <td v-text="descuento.nIdCabeceraPedido"></td>
                                                                    <td v-text="descuento.cProveedorNombre"></td>
                                                                    <td v-text="descuento.cNombreComercial"></td>
                                                                    <td v-text="descuento.fSubTotalSoles"></td>
                                                                    <td v-text="descuento.fSubTotalDolares"></td>
                                                                    <td v-text="descuento.fDescuento"></td>
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
                                                                    <td> <strong> {{ parseFloat(descuento.fMontoDesembolsar).toFixed(2) }} </strong> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9 offset-sm-5">
                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="registrarDistribucion">
                                                                <i class="fa fa-save"></i> DISTRIBUIR
                                                            </button>
                                                            <button type="button" class="btn btn-secundary btn-corner btn-sm" @click.prevent="limpiarDistribucion">
                                                                <i class="fa fa-recycle"></i> LIMPIAR
                                                            </button>
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
                                            </template>
                                            <template v-else>
                                                <template v-if="listDistribucionDescuento.length">
                                                    <vs-divider border-style="solid" color="dark">
                                                        Distribución del Descuento Inferior al PVP
                                                    </vs-divider>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Código</th>
                                                                    <th>Proveedor</th>
                                                                    <th>Nombre Comercial</th>
                                                                    <th>Precio Venta s/.</th>
                                                                    <th>Precio Venta US$</th>
                                                                    <th>Descuento US$</th>
                                                                    <th>Proveedor</th>
                                                                    <th>US$ Proveedor</th>
                                                                    <th>US$ Saisac</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="descuento in listDistribucionDescuento" :key="descuento.nIdCabeceraPedido">
                                                                    <td v-text="descuento.nIdCabeceraPedido"></td>
                                                                    <td v-text="descuento.cProveedorNombre"></td>
                                                                    <td v-text="descuento.cNombreComercial"></td>
                                                                    <td v-text="descuento.fSubTotalSoles"></td>
                                                                    <td v-text="descuento.fSubTotalDolares"></td>
                                                                    <td v-text="descuento.fDescuento"></td>
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
                                                                    <td> <strong> {{ parseFloat(descuento.fMontoDesembolsar).toFixed(2) }} </strong> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9 offset-sm-5">
                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="registrarDistribucion">
                                                                <i class="fa fa-save"></i> DISTRIBUIR
                                                            </button>
                                                            <button type="button" class="btn btn-secundary btn-corner btn-sm" @click.prevent="limpiarDistribucion">
                                                                <i class="fa fa-recycle"></i> LIMPIAR
                                                            </button>
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
                                                    <div class="form-group row">
                                                        <div class="col-sm-9 offset-sm-4">
                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="cambiarEstadoCotizacion(nIdCabeceraCotizacion, 1)">
                                                                <i class="fa fa-check"></i> APROBAR
                                                            </button>
                                                        </div>
                                                    </div>
                                                </template>
                                            </template>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="text-center">
                                                        <div v-for="(e, index) in mensajeError" :key="index" v-text="e"></div>
                                                    </div>
                                                </div>
                                                <br>
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
                                                        <tr v-for="vehiculo in arrayDetalleCotizacion" :key="vehiculo.nIdPar">
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
                                                        <tr v-for="vehiculo in arrayDetalleCotizacion" :key="vehiculo.nIdPar">
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
                                                        <tr v-for="vehiculo in arrayDetalleCotizacion" :key="vehiculo.nIdPar">
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
                                                        <tr v-for="vehiculo in arrayDetalleCotizacion" :key="vehiculo.nIdPar">
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

            <!-- Detalle Distribución -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">DETALLE DISTRIBUCIÓN</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro Cotización</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cnumerocotizacion" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cnombreproveedor" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cdocumentocliente" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Cliente</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cnombrecliente" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Vehículo</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cvehiculo" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro VIN</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cnumerovin" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Fecha Cotización</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.dfechacotizacion" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Vendedor</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.cnombrevendedor" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Prec. Cierre Final Cliente s./</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.ftotalcotizacionvehiculosol" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Prec. Cierre Final Cliente US$</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.ftotalcotizacionvehiculodolar" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Flete</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.fflete" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* TyP</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.ftyp" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Prec. Cierre LP</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.fpreciocierrelp" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Prec. Cierre Sistema</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.fpreciocierresistema" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Sobre Precio</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.fsobreprecio" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Descuento</label>
                                                        <div class="col-sm-8">
                                                            <input v-model="fillDetalleDistribucion.fdescuento" class="form-control form-control-sm" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <!-- DETALLE DISTRIBUCIÓN -->
                                        <template v-if="arrayListDistribucion.length">
                                            <vs-divider border-style="solid" color="dark">
                                                Detalle Distribución
                                            </vs-divider>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Nro Pedido</th>
                                                            <th>Proveedor</th>
                                                            <th>Monto US$</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="vehiculo in arrayListDistribucion" :key="vehiculo.nIdDistribucionCotizacion">
                                                            <td v-text="vehiculo.cNumeroPedido"></td>
                                                            <td v-text="vehiculo.cNombreProveedor"></td>
                                                            <td v-text="vehiculo.fMontoDesembolsar"></td>
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

            <!-- Detalle Pedido -->
            <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                                                    </el-tooltip>
                                                                </td>
                                                            </template>
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
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
                fillCotizacionesPendiente:{
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: 0,
                    dfechainicio: '',
                    dfechafin: '',
                    ntipopersona: 1,
                    ccontacto: '',
                    cnrodocumento: ''
                },
                arrayCotizacionesPendientes: [],
                arrayMisCotizacionesPendientes: [],
                //Modal Distribucion
                arrayDistribucionDescuento: [],
                listDistribucionDescuento: [],
                arrayDistribucionEVPorRegalar: [],
                // listDistribucionEVPorRegalar: [],
                cflagVerificaDistribucionAprobacion: true,
                nIdCabeceraCotizacion: '',
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
                    ftotalcotizacionsoles: 0,
                    ftotalcotizaciondolares: 0
                },
                arrayDetalleCotizacion: [],
                cFlagActivaElemento: 0,
                cFlagActivaObsequio: 0,
                cFlagActivaCampania: 0,
                //=========================== MODAL DETALLE PEDIDO ===================W
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
                // MODAL DISTRIBUCION
                fillDetalleDistribucion:{
                    cnumerocotizacion: '',
                    cdocumentocliente: '',
                    cnombrecliente: '',
                    nidversionvehiculo: 0,
                    cvehiculo: '',
                    cnombreproveedor: '',
                    dfechacotizacion: '',
                    cnombrevendedor: '',
                    ftotalcotizacionvehiculodolar: 0,
                    ftotalcotizacionvehiculosol: 0,
                    fflete: 0,
                    ftyp: 0,
                    fpreciocierrelp: 0,
                    fpreciocierresistema: 0,
                    fsobreprecio: 0,
                    fdescuento: 0,
                    cnumerovin: ''
                },
                arrayDetalleDistribucion: [],
                arrayListDistribucion: [],
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
                this.fillDetalleCotizacion.cnumerocotizacion    = cotizacion.cNumeroCotizacion,
                this.fillDetalleCotizacion.cdocumentocliente    = cotizacion.cPerDocumento,
                this.fillDetalleCotizacion.cnombrecliente       = cotizacion.cContacto,
                this.fillDetalleCotizacion.nidversionvehiculo   = cotizacion.nIdVersionVeh,
                this.fillDetalleCotizacion.cvehiculo            = cotizacion.cNombreComercial + ' ' + cotizacion.nAnioModelo,
                this.fillDetalleCotizacion.cnombreproveedor     = cotizacion.cNombreProveedor,
                this.fillDetalleCotizacion.cnombrevendedor      = cotizacion.cNombreVendedor,
                this.fillDetalleCotizacion.dfechacotizacion     = cotizacion.dFechaCotizacion,
                this.fillDetalleCotizacion.ftotalcotizacionsoles= cotizacion.fTotalCotizacionSoles,
                this.fillDetalleCotizacion.ftotalcotizaciondolares = cotizacion.fTotalCotizacionDolares,
                this.verDetalleCotizacion(cotizacion);
            },
            verDetalleCotizacion(cotizacion){
                this.mostrarProgressBar();
                var url = this.ruta + '/getcotizacion/GetLstDetalleCotizacion';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcabeceracotizacion': cotizacion.nIdCabeceraCotizacion
                    }
                }).then(response => {
                    this.arrayDetalleCotizacion = response.data.arrayDetalleCotizacion.data;
                    this.verificaDetalleCotizacion();
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
            verificaDetalleCotizacion(){
                let me = this;
                me.cFlagActivaElemento = 0;
                me.cFlagActivaObsequio = 0;
                me.cFlagActivaCampania = 0;

                me.arrayDetalleCotizacion.map(function(value, key) {
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
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
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
                        'nidmarca': this.fillCotizacionesPendiente.nidmarca,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayModelo = response.data.arrayModelo;
                    this.fillCotizacionesPendiente.nidmodelo = '';
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
            // buscar cotizaciones
            buscarCotizacionesPendientes(page){
                if(this.validarbuscarCotizacionesPendientes()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/pedido/GetLstPedidoConDescuento';
                axios.get(url, {
                    params: {
                        'nidempresa'    : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidmarca'      : this.fillCotizacionesPendiente.nidmarca,
                        'nidmodelo'     : this.fillCotizacionesPendiente.nidmodelo,
                        'dfechainicio'  : this.fillCotizacionesPendiente.dfechainicio,
                        'dfechafin'     : this.fillCotizacionesPendiente.dfechafin,
                        'ccontacto'     : this.fillCotizacionesPendiente.ccontacto,
                        'cnrodocumento' : this.fillCotizacionesPendiente.cnrodocumento,
                        'ntipopersona'  : this.fillCotizacionesPendiente.ntipopersona,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayCotizacionesPendientes = response.data.arrayCotizacionesConDescuento.data;
                    this.pagination.current_page   =  response.data.arrayCotizacionesConDescuento.current_page;
                    this.pagination.total          = response.data.arrayCotizacionesConDescuento.total;
                    this.pagination.per_page       = response.data.arrayCotizacionesConDescuento.per_page;
                    this.pagination.last_page      = response.data.arrayCotizacionesConDescuento.last_page;
                    this.pagination.from           = response.data.arrayCotizacionesConDescuento.from;
                    this.pagination.to             = response.data.arrayCotizacionesConDescuento.to;
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
            conformeNoConformeCotizacion(op, objPedido){
                swal({
                    title: '¿Esta seguro de' + ((op == 2) ? ' dar Conformidad a' : ' Rechazar ') + 'el pedido N°' + objPedido.cNumeroPedido + '?',
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
                            'nIdCabeceraCotizacion' : objPedido.nIdCabeceraCotizacion,
                            'opcion'                : op
                        }).then(response => {
                            me.buscarCotizacionesPendientes(1);
                            swal(
                                ((op == 2) ? 'Conforme' : ' Rechazar'),
                                'El Pedido ' + objPedido.cNumeroPedido +' ha sido otorgada la ' + ((op == 2) ? '' : ' No ') + ' Conformidad con éxito.',
                                'success'
                            )
                        }).catch(error => {
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
            limpiarBusqCotizacionesPendientes(){
                this.fillCotizacionesPendiente.nidlinea = '';
                this.fillCotizacionesPendiente.nidmarca = '';
                this.fillCotizacionesPendiente.nidmodelo = '';
                this.fillCotizacionesPendiente.dfechainicio = '';
                this.fillCotizacionesPendiente.dfechafin = '';
                this.$forceUpdate();
            },
            //===========================================================
            //=================== MODAL DISTRIBUCION ====================
            getDetalleCotizacionDistribucion(objPedido){
                //Verifica si es Gerencia o ADV para listar los Dscto Correspondientes
                let op = 1;
                let me = this;
                (this.cflagVerificaDistribucionAprobacion) ? (op = 1) : (op = 0);
                this.$forceUpdate();

                var url = me.ruta + '/gescotizacion/GetDetalleCotizacionDistribucion';
                axios.get(url, {
                    params: {
                        'nidempresa'            : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'           : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcabeceracotizacion' : objPedido.nIdCabeceraCotizacion,
                        'cflagVerificaDistribucion': op
                    }
                }).then(response => {
                    this.arrayDetalleDistribucion                       = response.data.arrayDetalleCotizacion,
                    this.fillDetalleDistribucion.cnumerocotizacion      = response.data.arrayDetalleCotizacion[0].cNumeroCotizacion,
                    this.fillDetalleDistribucion.cdocumentocliente      = response.data.arrayDetalleCotizacion[0].cPerDocumento,
                    this.fillDetalleDistribucion.cnombrecliente         = response.data.arrayDetalleCotizacion[0].cContacto,
                    this.fillDetalleDistribucion.nidversionvehiculo     = response.data.arrayDetalleCotizacion[0].nIdVersionVeh,
                    this.fillDetalleDistribucion.cvehiculo              = response.data.arrayDetalleCotizacion[0].cNombreComercial + ' ' + response.data.arrayDetalleCotizacion[0].nAnioModelo,
                    this.fillDetalleDistribucion.cnombreproveedor       = response.data.arrayDetalleCotizacion[0].cNombreProveedor,
                    this.fillDetalleDistribucion.cnombrevendedor        = response.data.arrayDetalleCotizacion[0].cNombreVendedor,
                    this.fillDetalleDistribucion.dfechacotizacion       = response.data.arrayDetalleCotizacion[0].dFechaCotizacion,
                    this.fillDetalleDistribucion.ftotalcotizacionvehiculosol    = response.data.arrayDetalleCotizacion[0].fTotalCotizacionVehiculoSol,
                    this.fillDetalleDistribucion.ftotalcotizacionvehiculodolar  = response.data.arrayDetalleCotizacion[0].fTotalCotizacionVehiculoDolar,
                    this.fillDetalleDistribucion.fflete                 = response.data.arrayDetalleCotizacion[0].fFlete,
                    this.fillDetalleDistribucion.ftyp                   = response.data.arrayDetalleCotizacion[0].fTYP,
                    this.fillDetalleDistribucion.fpreciocierrelp        = response.data.arrayDetalleCotizacion[0].fPrecioCierreLista,
                    this.fillDetalleDistribucion.fpreciocierresistema   = response.data.arrayDetalleCotizacion[0].fPrecioCierreSistema,
                    this.fillDetalleDistribucion.fsobreprecio           = response.data.arrayDetalleCotizacion[0].fSobrePrecio,
                    this.fillDetalleDistribucion.fdescuento             = response.data.arrayDetalleCotizacion[0].fDescuento,
                    this.fillDetalleDistribucion.cnumerovin             = response.data.arrayDetalleCotizacion[0].cNumeroVin
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
            verificarDatosCotizacion(objPedido){
                var url = this.ruta + '/getcotizacion/GetDatosCotizacion';
                axios.get(url, {
                    params: {
                        'nIdCabeceraCotizacion' : objPedido.nIdCabeceraCotizacion
                    }
                }).then(response => {
                    //Si existen registros que van a generencia
                    if (response.data.contGerencia > 0){
                        //Mostrar formulario para dar conformidad y pase a Gerencia
                        this.cflagVerificaDistribucionAprobacion = true;
                    } else {
                        //Mostrar formulario para aprobar cotización
                        this.cflagVerificaDistribucionAprobacion = false;
                        this.nIdCabeceraCotizacion = objPedido.nIdCabeceraCotizacion;
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
            listarDistribucionDescuento(objPedido){
                //Verifica si es Gerencia o ADV para listar los Dscto Correspondientes
                let op = 1;
                let me = this;
                (this.cflagVerificaDistribucionAprobacion) ? (op = 1) : (op = 0);
                this.$forceUpdate();

                var url = me.ruta + '/getcotizacion/GetDistribucionBySuperaDscto';
                axios.get(url, {
                    params: {
                        'nIdCabeceraPedido'         : objPedido.nIdCabeceraPedido,
                        'nIdCabeceraCotizacion'     : objPedido.nIdCabeceraCotizacion,
                        'cflagVerificaDistribucion' : op
                    }
                }).then(response => {
                    me.arrayDistribucionDescuento = response.data;
                    me.cargarDistribucionSuperaDscto();
                    me.loading.close();
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
            cargarDistribucionSuperaDscto(){
                let me = this;
                me.listDistribucionDescuento = [];

                this.cflagVerificaDistribucionAprobacion
                if(me.arrayDistribucionDescuento.length > 0){
                    me.arrayDistribucionDescuento.map(function(ec){
                        me.listDistribucionDescuento.push({
                            'nIdCabeceraPedido'       :   ec.nIdCabeceraPedido,
                            'nIdCabeceraCotizacion'   :   ec.nIdCabeceraCotizacion,
                            'nIdDetalleCotizacion'    :   ec.nIdDetalleCotizacion,
                            'cProveedorNombre'        :   ec.cProveedorNombre,
                            'cNombreComercial'        :   ec.cNombreComercial,
                            'fSubTotalSoles'          :   ec.fSubTotalSoles,
                            'fSubTotalDolares'        :   ec.fSubTotalDolares,
                            'fDescuento'              :   ec.fDescuento,
                            'fMontoDesembolsar'       :   0,
                            'nIdProveedor'            :   '',
                            'fDistribucion'           :   0
                        });
                    });
                }
            },
            /*listarDistribucionEVPorRegalar(nIdCabeceraCotizacion){
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
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
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
            },*/
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
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
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            validarDistribucionDscto(){
                let me = this;
                this.listDistribucionDescuento.map(function (x, y) {
                    // console.log(x.fDistribucion, y);
                    /*if(parseInt(x.fDistribucion) < 0 || parseInt(x.fDistribucion) > 100){
                        me.$message.error(`No puede superar los margenes del 0 - 100`);
                        me.listDistribucionDescuento[y].fDistribucion = 0;//Seteado a 0.
                        me.$forceUpdate();
                    }*/
                    if(x.fDistribucion == ''){
                        me.listDistribucionDescuento[y].fDistribucion = 0;//Seteado a 0.
                        me.$forceUpdate();
                    }
                    //x.fMontoDesembolsar = (Number((parseFloat(x.fDescuento)).toFixed(2)) * (Number((parseFloat(x.fDistribucion)).toFixed(2)) / 100))
                    x.fMontoDesembolsar = (Number((parseFloat(x.fDescuento)).toFixed(2)) - (Number((parseFloat(x.fDistribucion)).toFixed(2))))
                    me.$forceUpdate();
                });
            },
            /*
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
            },*/
            registrarDistribucion(){
                if(this.validarRegistrarDistribucion()){
                    return;
                }

                var url = this.ruta + '/setcotizacion/SetDistribucionCotizacion';
                axios.post(url, {
                    'nIdEmpresa'                : parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'listDistribucionDescuento' : this.listDistribucionDescuento
                    // listDistribucionEVPorRegalar: this.listDistribucionEVPorRegalar
                }).then(response => {
                    if (this.cflagVerificaDistribucionAprobacion) {
                        // GENERAR LA CONFORMIDAD HACIA EL GERENTE
                        this.cambiarEstadoCotizacion(response.data, 4);
                        swal('Pedido distribuido y pendiente de aprobación por Gerencia');
                    } else {
                        // GENERAR LA APROVACIÓN DEL ADV
                        this.cambiarEstadoCotizacion(response.data, 1);
                        swal('Cotización Aprobada para Pedido');
                    };
                    this.$forceUpdate();
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
                    this.cflagVerificaDistribucionAprobacion = true;
                    this.nIdCabeceraCotizacion = '';
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
            validarRegistrarDistribucion(){
                let me = this;
                me.error = 0;
                me.mensajeError =[];

                //VALIDAR SECCIÓN DE DISTRIBUCIÓN DE SUPERA DESCUENTO
                if(me.listDistribucionDescuento.length > 0) {
                    me.listDistribucionDescuento.map(function (x) {
                        if(x.nIdProveedor == ''){
                            me.mensajeError.push('Debe seleccionar un proveedor en la sección Supera Descuento');
                        }
                        /*if(parseFloat(x.fDistribucion) < 0 || parseFloat(x.fDistribucion) > 100){
                            me.mensajeError.push('No puede superar los margenes del 0 - 100 en la sección Supera Descuento');
                            x.fDistribucion = 0;//Seteado a 0
                        }*/
                        me.$forceUpdate();
                    });
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            limpiarModalDistribucion(){
                this.arrayDistribucionDescuento = [];
                // this.arrayDistribucionEVPorRegalar = [];
                this.listDistribucionDescuento = [];
                // this.listDistribucionEVPorRegalar = [];
            },
            limpiarDistribucion(){
                this.listDistribucionDescuento.map(function (x) {
                    x.nIdProveedor = '';
                    x.fDistribucion = 0;
                });
                // this.listDistribucionEVPorRegalar.map(function (x) {
                //     x.nIdProveedor = '';
                //     x.fDistribucion = 0;
                // });
            },
            /**
             * Aprobación Gerencia
             */
            aprobarNoaprobarCotizacion(op, objPedido){
                swal({
                    title: '¿Esta seguro de ' + ((op == 1) ? 'Aprobar' : ' Rechazar ') + 'el pedido N°' + objPedido.cNumeroPedido + '?',
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
                            nIdCabeceraCotizacion : objPedido.nIdCabeceraCotizacion,
                            opcion : op
                        }).then(response => {
                            me.buscarCotizacionesPendientes(1);
                            swal(
                                ((op == 1) ? 'Aprobar' : ' Rechazar '),
                                'El pedido ' + objPedido.cNumeroPedido +' ha sido ' + ((op == 1) ? 'Aprobada' : ' Rechazada ') + ' con éxito.',
                                'success'
                            )
                        }).catch(error => {
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
            verDistribucion(objPedido){
                let me = this;
                var url = me.ruta + '/pedido/GetListDistribucionPedido';
                axios.get(url, {
                    params: {
                        'nidempresa'                : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'               : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcabecerapedido'         : objPedido.nIdCabeceraPedido,
                        'nidcabeceracotizacion'     : objPedido.nIdCabeceraCotizacion
                    }
                }).then(response => {
                    this.arrayListDistribucion   = response.data.arrayListDistribucion
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
            // VER DETALLE PEDIDO
            // =================================================================
            verPedido(pedido){
                this.fillDetallePedido.nidcabecerapedido    = pedido.nIdCabeceraPedido,
                this.fillDetallePedido.cnumeropedido        = pedido.cNumeroPedido,
                this.fillDetallePedido.cnumerocotizacion    = pedido.cNumeroCotizacion,
                this.fillDetallePedido.cdocumentocliente    = pedido.cPerDocumento,
                this.fillDetallePedido.cnombrecliente       = pedido.cContacto,
                this.fillDetallePedido.nidversionvehiculo   = pedido.nIdVersionVeh,
                this.fillDetallePedido.cvehiculo            = pedido.cNombreComercial + ' ' + pedido.nAnioModelo,
                this.fillDetallePedido.cnumerovin           = pedido.cNumeroVin,
                this.fillDetallePedido.cnombrevendedor      = pedido.cNombreVendedor,
                this.fillDetallePedido.dfechapedido         = pedido.dFechaPedido,
                this.fillDetallePedido.ftotalpedidosoles    = pedido.fTotalPedidoSoles,
                this.fillDetallePedido.ftotalpedidodolares  = pedido.fTotalPedidoDolares,
                this.verDetallePedido(pedido);
                this.verDocumentosPedido(pedido);
            },
            verDetallePedido(pedido){
                this.mostrarProgressBar();
                var url = this.ruta + '/pedido/GetLstDetallePedido';
                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcabecerapedido' : pedido.nIdCabeceraPedido
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
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcabecerapedido' : pedido.nIdCabeceraPedido,
                        'opcion'            : 1
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
                                let me = this;
                                me.verificarDatosCotizacion(data);
                                me.listarProveedores(1);
                                me.loadingProgressBar("VERIFICANDO DESCUENTOS...");
                                setTimeout(function() {
                                    me.getDetalleCotizacionDistribucion(data);
                                    me.listarDistribucionDescuento(data);
                                }, 1200);

                                // this.listarDistribucionEVPorRegalar(data);
                                this.accionmodal=2;
                                this.modal = 1;
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
                    case 'pedido':
                    {
                        switch(accion){
                            case 'distribucion':
                            {
                                this.accionmodal=4;
                                this.modal = 1;
                                this.getDetalleCotizacionDistribucion(data);
                                this.verDistribucion(data);
                                break;
                            }break;
                            case 'detalle':
                            {
                                this.accionmodal=5;
                                this.modal = 1;
                                this.verPedido(data);
                                break;
                            }break;
                        }
                    }
                }
            },
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.listDistribucionDescuento = [];
                this.arrayDetalleDistribucion = [];
                this.fillDetalleDistribucion.cnumerocotizacion      = '',
                this.fillDetalleDistribucion.cdocumentocliente      = '',
                this.fillDetalleDistribucion.cnombrecliente         = '',
                this.fillDetalleDistribucion.nidversionvehiculo     = '',
                this.fillDetalleDistribucion.cvehiculo              = '',
                this.fillDetalleDistribucion.cnombreproveedor       = '',
                this.fillDetalleDistribucion.cnombrevendedor        = '',
                this.fillDetalleDistribucion.dfechacotizacion       = '',
                this.fillDetalleDistribucion.ftotalcotizacionvehiculosol    = '',
                this.fillDetalleDistribucion.ftotalcotizacionvehiculodolar  = '',
                this.fillDetalleDistribucion.fflete                 = '',
                this.fillDetalleDistribucion.ftyp                   = '',
                this.fillDetalleDistribucion.fpreciocierrelp        = '',
                this.fillDetalleDistribucion.fpreciocierresistema   = '',
                this.fillDetalleDistribucion.fsobreprecio           = '',
                this.fillDetalleDistribucion.fdescuento             = '',
                this.fillDetalleDistribucion.cnumerovin             = '';
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
