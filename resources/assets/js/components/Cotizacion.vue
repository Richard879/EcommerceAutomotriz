<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">COTIZACIÓN</h2>
                </div>
            </header>

            <section>
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab01" href="#TabMisCotizaciones" @click="tabMisCotizaciones" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> MIS COTIZACIONES
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab02" href="#TabCotizacion" @click="tabCotizacion" role="tab" data-toggle="tab">
                                            <i class="fa fa-list"></i> COTIZACIÓN
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab03" href="#TabAsignarContacto" @click="tabAsignarContacto" v-if="fValorTipocambioComercial > 0" role="tab" data-toggle="tab">
                                            <i class="fa fa-user"></i> ASIGNAR CONTACTO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="tab04" href="#TabDetalleCotizacion" @click="tabDetalleCotización" v-if="fValorTipocambioComercial > 0" role="tab" data-toggle="tab">
                                            <i class="fa fa-list-ol"></i> DETALLE COTIZACIÓN
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabMisCotizaciones">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">MIS COTIZACIONES</h3>
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
                                                                                    v-model="fillMisCotizaciones.dfechainicio"
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
                                                                                    v-model="fillMisCotizaciones.dfechafin"
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
                                                                                <el-select v-model="fillMisCotizaciones.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarSoloComboModelo()">
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
                                                                                <el-select v-model="fillMisCotizaciones.nidmodelo" filterable clearable placeholder="SELECCIONE">
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
                                                                                <input type="text" v-model="fillMisCotizaciones.cnumerocotizacion" @keyup.enter="listarMisCotizaciones(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Estado Cotizacion</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillMisCotizaciones.nidestadocotizacion" filterable clearable placeholder="SELECCIONE">
                                                                                    <el-option
                                                                                    v-for="item in arrayEstadoCotizacion"
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
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarMisCotizaciones(1)">
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
                                                            <template v-if="arrayCotizaciones.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Nro Cotizacion</th>
                                                                                <th>Vehiculo</th>
                                                                                <th>Contacto</th>
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
                                                                            <tr v-for="cotizacion in arrayCotizaciones" :key="cotizacion.nIdCabeceraCotizacion">
                                                                                <td>
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Ver Detalle Cotizacion {{ cotizacion.nIdCabeceraCotizacion }}</div>
                                                                                        <i @click="abrirModal('cotizacion', 'detalle', cotizacion)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                                                    </el-tooltip>&nbsp;
                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                        <div slot="content">Reporte Cotizacion {{ cotizacion.nIdCabeceraCotizacion }}</div>
                                                                                        <i @click="generarCotizacionPDF(cotizacion.nIdCabeceraCotizacion)" :style="'color:red'" class="fa fa-file-pdf-o"></i>
                                                                                    </el-tooltip>&nbsp;
                                                                                </td>
                                                                                <td v-text="cotizacion.cNumeroCotizacion"></td>
                                                                                <td v-text="cotizacion.cNombreComercial + ' ' + cotizacion.nAnioFabricacion + '-' + cotizacion.nAnioModelo"></td>
                                                                                <td v-text="cotizacion.cContacto"></td>
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
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="TabCotizacion">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">CONFIGURACIÓN BÁSICA</h3>
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
                                                                            <label class="col-sm-4 form-control-label">* Tipo Cambio Compra</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillConfigBasica.tipoCambioCompra" class="form-control form-control-sm" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Tipo Cambio Comercial </label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillConfigBasica.tipoCambioVenta" class="form-control form-control-sm" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillConfigBasica.fechaInicio" class="form-control form-control-sm" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillConfigBasica.fechaFin" class="form-control form-control-sm" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--<div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Ref. Cotización</label>
                                                                            <div class="col-sm-8">
                                                                                <label v-text="fillConfigBasica.refCotizacion" class="form-control-label-readonly"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                                                <div class="form-group row" v-if="fValorTipocambioComercial > 0">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="tabAsignarContacto();">
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
                                    <div role="tabpanel" class="tab-pane fade" id="TabAsignarContacto"  v-if="fValorTipocambioComercial > 0">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">ASIGNACIÓN DE CONTACTO</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">Contacto</label>
                                                                                <div class="col-sm-8">
                                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="abrirModal('contacto','buscar')">
                                                                                        <i class="fa fa-search"></i> Buscar
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="fillAsignarContacto.ccontacto" class="form-control form-control-sm" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="fillAsignarContacto.cnrodocumento" class="form-control form-control-sm" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Dirección</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="fillAsignarContacto.cdireccion" class="form-control form-control-sm" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="row">
                                                                                <label class="col-sm-4 form-control-label">* Tipo Medio</label>
                                                                                <div class="col-sm-8">
                                                                                    <el-select v-model="fillAsignarContacto.nidreferencia" filterable clearable placeholder="SELECCIONE" >
                                                                                        <el-option
                                                                                        v-for="item in arrayTipoMedio"
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
                                                                                <label class="col-sm-4 form-control-label">* Email</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="fillAsignarContacto.cemail" class="form-control form-control-sm" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr/>
                                                                <div class="col-lg-12">
                                                                    <template v-if="arrayReferenciavehiculo.length">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Acción</th>
                                                                                        <th>Proovedor</th>
                                                                                        <th>Linea</th>
                                                                                        <th>Marca</th>
                                                                                        <th>Modelo</th>
                                                                                        <th>Año Fab</th>
                                                                                        <th>Año Modelo</th>
                                                                                        <th>Fecha Inicio</th>
                                                                                        <th>Fecha Fin</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="r in arrayReferenciavehiculo" :key="r.nIdReferenciaVehiculoContacto">
                                                                                        <td>
                                                                                            <template v-if="r.nNroCotizacionesActivas == 0">
                                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                    <div slot="content">Generar Cotizacion {{ r.cMarcaNombre + ' ' + r.cModeloNombre }}</div>
                                                                                                    <i @click="asingarReferenciaVehiculo(r.nIdAsignacionContactoVendedor, r.nIdProveedor, r.cProveedorNombre,
                                                                                                                                            r.nIdLinea, r.nIdMarca, r.nIdModelo)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                                </el-tooltip>
                                                                                            </template>
                                                                                            <template v-else>
                                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                    <div slot="content">Tiene Cotizaciones Activas {{ r.cMarcaNombre + ' ' + r.cModeloNombre }}</div>
                                                                                                    <i :style="'color:yellow'" class="fa-md fa fa-warning"></i>
                                                                                                </el-tooltip>
                                                                                            </template>
                                                                                        </td>
                                                                                        <td v-text="r.cProveedorNombre"></td>
                                                                                        <td v-text="r.cLineaNombre"></td>
                                                                                        <td v-text="r.cMarcaNombre"></td>
                                                                                        <td v-text="r.cModeloNombre"></td>
                                                                                        <td v-text="r.nAnioFabricacion"></td>
                                                                                        <td v-text="r.nAnioModelo"></td>
                                                                                        <td v-text="r.dFechaInicioAsignacionContacto"></td>
                                                                                        <td v-text="r.dFechaFinAsignacionContacto"></td>
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
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="TabDetalleCotizacion"  v-if="fValorTipocambioComercial > 0">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <!--<label class="col-sm-4 form-control-label">Cliente</label>-->
                                                                <div class="col-sm-8">
                                                                    <h2 class="no-margin-bottom" v-text="fillAsignarContacto.ccontacto"></h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">* SubLinea</label>
                                                                <div class="col-sm-8">
                                                                    <el-select v-model="fillAsignarContacto.nidsublinea" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
                                                                        <el-option
                                                                            v-for="sublinea in arraySubLinea"
                                                                            :key="sublinea.nIdSubLinea"
                                                                            :label="sublinea.cSubLineaNombre"
                                                                            :value="sublinea.nIdSubLinea">
                                                                        </el-option>
                                                                    </el-select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="tab0401" href="#TabDCVehiculo" @click="tabDCVehiculo" role="tab" data-toggle="tab">
                                                                <i class="fa fa-car"></i> VEHÍCULO
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="tab0402" href="#TabDCElementoVentaPorRegalar" role="tab" data-toggle="tab">
                                                                <i class="fa fa-gift"></i> OBSEQUIOS
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="tab0403" href="#TabDCElementoVenta" role="tab" data-toggle="tab">
                                                                <i class="fa fa-list-ol"></i> ELEMENTO VENTA
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="tab0404" href="#TabDCVerificarCampana" role="tab" data-toggle="tab">
                                                                <i class="fa fa-check-square"></i> CAMPAÑAS
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="tab0405" href="#TabDCConfirmarCotizacion" role="tab" data-toggle="tab">
                                                                <i class="fa fa-check"></i> CONFIRMAR COTIZACIÓN
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane fade in active show" id="TabDCVehiculo">
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
                                                                                                <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <div class="input-group">
                                                                                                        <input type="hidden" v-model="fillProveedor.nidproveedor">
                                                                                                        <input type="text" v-model="fillProveedor.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                                <div slot="content">Buscar Proveedor </div>
                                                                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                                                                    <i class="fa-lg fa fa-search"></i>
                                                                                                                </button>
                                                                                                            </el-tooltip>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">* Vehículo</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <div class="input-group-prepend">
                                                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="abrirModal('vehiculo','buscar')">
                                                                                                            <i class="fa fa-search"></i> Buscar
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr/>
                                                                                    <template v-if="arrayVehiculo.length">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-striped table-sm">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Acción</th>
                                                                                                        <th>Vehículo</th>
                                                                                                        <th>Cantidad</th>
                                                                                                        <th>Precio Base</th>
                                                                                                        <th>Sobre Precio</th>
                                                                                                        <th>Dscto</th>
                                                                                                        <th>Precio Cierre + Flete</th>
                                                                                                        <th>Limite de PVP</th>
                                                                                                        <th>Precio Cierre a Cliente</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr v-for="(vehiculo, index) in arrayVehiculo" :key="vehiculo.nIdContacto">
                                                                                                        <td>
                                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                                <div slot="content">Eliminar Vehiculo  {{ vehiculo.NombreComercial }}</div>
                                                                                                                <i @click="removerVehiculoLista(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                            </el-tooltip>
                                                                                                        </td>
                                                                                                        <td v-text="vehiculo.NombreComercial + ' ' + vehiculo.AnioFabricacion + '-' + vehiculo.AnioModelo"></td>
                                                                                                        <td v-html="vehiculo.cantidad"></td>
                                                                                                        <td v-text="vehiculo.PrecioBase"></td>
                                                                                                        <td>
                                                                                                            <input type="number"
                                                                                                                   class="form-control form-control-sm"
                                                                                                                   v-model="vehiculo.sobrePrecio"
                                                                                                                   @keyup="changeSobrePrecio(vehiculo.sobrePrecio)"
                                                                                                                   min="0"/>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input type="number"
                                                                                                                   class="form-control form-control-sm"
                                                                                                                   v-model="vehiculo.descuento"
                                                                                                                   @keyup="changeDscto(vehiculo.descuento)"
                                                                                                                   min="0"/>
                                                                                                        </td>
                                                                                                        <td v-text="vehiculo.PrecioCierre"></td>
                                                                                                        <td v-text="vehiculo.PrecioVenta"></td>
                                                                                                        <td> {{ vehiculo.subtotal = (parseFloat(vehiculo.PrecioBase) - parseFloat(vehiculo.descuento) + parseFloat(vehiculo.sobrePrecio)) }} </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-6">
                                                                                                    <div class="form-group row">
                                                                                                        <div class="col-sm-12" :class="[(fdscto01 >= 0) ? '' : 'datos']">
                                                                                                            <label class="col-sm-4 form-control-label">Dscto #01: </label>
                                                                                                            <label class="form-control-label"><strong> {{ fdscto01 = calcularDscto01[0] }} </strong></label>
                                                                                                        </div>
                                                                                                        <div class="col-sm-12" :class="[(fdscto02 > 0) ? '' : 'datos']">
                                                                                                            <label class="col-sm-4 form-control-label">Dscto #02: </label>
                                                                                                            <label class="form-control-label"><strong>{{ fdscto02 = Math.abs(calcularDscto02[0]) }} </strong></label>
                                                                                                        </div>
                                                                                                        <div class="col-sm-12" :class="[(fdscto03 > 0) ? '' : 'datos']">
                                                                                                            <label class="col-sm-4 form-control-label">Dscto #03: </label>
                                                                                                            <label class="form-control-label"><strong>{{ fdscto03 = Math.abs(calcularDscto03[0]) }} </strong></label>
                                                                                                        </div>
                                                                                                        <div class="col-sm-12">
                                                                                                            <label class="col-sm-4 form-control-label">Dx: </label>
                                                                                                            <label class="form-control-label"><strong>{{ fDx = calcularDx[0] }} </strong></label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-6 direction-money">
                                                                                                    <div class="form-group row">
                                                                                                        <label class="form-control-label">TOTAL USD &nbsp; &nbsp;</label>
                                                                                                        <label class="form-control-label">
                                                                                                            <strong>{{ montoTotalVehiculoDolar = totalVehiculo }}</strong>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div class="form-group row">
                                                                                                        <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                                        <label class="form-control-label">
                                                                                                            <strong>{{ montoTotalVehiculoSoles = totalVehiculoSoles }}</strong>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-12" :class="[((fdscto02 > 0) || (fdscto03 > 0)) ? '' : 'datos']">
                                                                                                    <div class="form-group row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="row">
                                                                                                                <label class="col-md-2 form-control-label">OBSERVACIÓN</label>
                                                                                                                <div class="col-md-10">
                                                                                                                    <el-input
                                                                                                                        type="textarea"
                                                                                                                        autosize
                                                                                                                        placeholder="Registre Observación del Descuento"
                                                                                                                        v-model="observacionDscto">
                                                                                                                    </el-input>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row" :class="[(arrayVehiculo[0].sobrePrecio != '' ||
                                                                                                                                arrayVehiculo[0].sobrePrecio <= flagLimiteSobrePrecio ||
                                                                                                                                arrayVehiculo[0].descuento != '') ? '' : 'datos']" >
                                                                                            <div class="col-sm-9 offset-sm-4">
                                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="siguienteTabDCElementoVentaPorRegalar">
                                                                                                    <i class="fa fa-arrow-right"></i> Siguiente
                                                                                                </button>
                                                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click.prevent="siguienteTabDCElementoVenta">
                                                                                                    <i class="fa fa-arrow-right"></i> Ir a Elemento Venta
                                                                                                </button>
                                                                                                <!--<button type="button" class="btn btn-warning btn-corner btn-sm" @click.prevent="siguienteTabDConfirmarcotizacion">
                                                                                                    <i class="fa fa-arrow-right"></i> Ir a Confirmar Cotización
                                                                                                </button>-->
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
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade" id="TabDCElementoVentaPorRegalar">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">OBSEQUIOS</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form class="form-horizontal">
                                                                                    <template v-if="arrayObsequio.length">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-striped table-sm">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Código</th>
                                                                                                        <th>Nombre</th>
                                                                                                        <th>Acción</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr v-for="(obsequio, index) in arrayObsequio" :key="index">
                                                                                                        <td v-text="index+1"></td>
                                                                                                        <td v-text="obsequio.cNombreObsequio"></td>
                                                                                                        <td>
                                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                                <div slot="content">Ver Detalle {{ obsequio.cNombreObsequio }}</div>
                                                                                                                <i @click="abrirModal('obsequio', 'detalle', obsequio)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
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
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9 offset-sm-4">
                                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="siguienteTabDCElementoVenta">
                                                                                                <i class="fa fa-arrow-right"></i> Siguiente
                                                                                            </button>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click.prevent="siguienteTabDCVerificarCampania">
                                                                                                <i class="fa fa-arrow-right"></i> Ir a Campaña
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <div class="row flex-rigth-margin">
                                                                                            <div class="form-group row">
                                                                                                <label class="form-control-label">TOTAL USD: &nbsp; &nbsp;</label>
                                                                                                <label class="form-control-label"><strong>{{ montoTotalElementoVentaPorRegalar = totalElementoVentaPorRegalar }}</strong></label>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                                <label class="form-control-label"><strong>{{ montoTotalElementoVentaPorRegalarSoles = totalElementoVentaPorRegalarSoles }}</strong></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade" id="TabDCElementoVenta">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">ASIGNAR ELEMENTO VENTA</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form class="form-horizontal">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">ELEMENTO VENTA</label>
                                                                                                <div class="col-sm-8">
                                                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="abrirModal('elementoventa','buscar')">
                                                                                                        <i class="fa fa-search"></i> Buscar
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr/>
                                                                                    <template v-if="arrayElementoVenta.length">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-striped table-sm">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Acción</th>
                                                                                                        <th>Elemento Venta</th>
                                                                                                        <th>Moneda</th>
                                                                                                        <th>Cantidad</th>
                                                                                                        <th>Precio</th>
                                                                                                        <th>SubTotal</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr v-for="(elementoventa, index) in arrayElementoVenta" :key="elementoventa.nIdContacto">
                                                                                                        <td>
                                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                                <div slot="content">Eliminar {{ elementoventa.cElemenNombre }}</div>
                                                                                                                <i @click="removerElementoVentaLista(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                            </el-tooltip>
                                                                                                        </td>
                                                                                                        <td v-text="elementoventa.cElemenNombre"></td>
                                                                                                        <td v-text="elementoventa.cMonedaNombre"></td>
                                                                                                        <td><input type="number" min="1" class="form-control form-control-sm" v-model="elementoventa.cantidad"/></td>
                                                                                                        <td v-text="elementoventa.fElemenValorVenta"></td>
                                                                                                        <td> {{ elementoventa.subtotal = elementoventa.cantidad*elementoventa.fElemenValorVenta }} </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="row flex-rigth-margin">
                                                                                                <div class="form-group row">
                                                                                                    <label class="form-control-label">TOTAL USD: &nbsp; &nbsp;</label>
                                                                                                    <label class="form-control-label"><strong>{{ montoTotalElementoVenta = totalElementoVenta }}</strong></label>
                                                                                                </div>
                                                                                                <div class="form-group row">
                                                                                                    <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                                    <label class="form-control-label"><strong>{{ montoTotalElementoVentaSoles = totalElementoVentaSoles }}</strong></label>
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
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9 offset-sm-4">
                                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="siguienteTabDCVerificarCampania">
                                                                                                <i class="fa fa-arrow-right"></i> Siguiente
                                                                                            </button>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click.prevent="siguienteTabDCVerificarCampania">
                                                                                                <i class="fa fa-arrow-right"></i> Ir a Verificar Campaña
                                                                                            </button>
                                                                                            <!--<button type="button" class="btn btn-warning btn-corner btn-sm" @click.prevent="siguienteTabDConfirmarcotizacion">
                                                                                                <i class="fa fa-arrow-right"></i> Ir a Confirmar Cotización
                                                                                            </button>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade" id="TabDCVerificarCampana">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">CAMPAÑAS ACTIVAS</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form class="form-horizontal">
                                                                                    <template v-if="arrayEventoCampania.length">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-striped table-sm">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Código</th>
                                                                                                        <th>Nombre</th>
                                                                                                        <th>Tipo</th>
                                                                                                        <th>Acción</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr v-for="(evento, index) in arrayEventoCampania" :key="index">
                                                                                                        <td v-text="index+1"></td>
                                                                                                        <td v-text="evento.cNombreEventoCampania"></td>
                                                                                                        <td v-text="evento.TipoEvento"></td>
                                                                                                        <td>
                                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                                <div slot="content">Ver Detalle {{ evento.cNombreEventoCampania }}</div>
                                                                                                                <i @click="abrirModal('campaña', 'detalle', evento)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
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
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-9 offset-sm-5">
                                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="siguienteTabDConfirmarcotizacion">
                                                                                                <i class="fa fa-arrow-right"></i> Siguiente
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <div class="row flex-rigth-margin">
                                                                                            <div class="form-group row">
                                                                                                <label class="form-control-label">TOTAL USD &nbsp; &nbsp;</label>
                                                                                                <label class="form-control-label"><strong>{{montoTotalConfiCotiEventoEleVenta=totalEventoEleVentaModal}}</strong></label>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                                <label class="form-control-label"><strong>{{montoTotalConfiCotiEventoEleVentaSoles=totalEventoEleVentaModalSoles}}</strong></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade" id="TabDCConfirmarCotizacion">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <form class="form-horizontal">
                                                                            <!-- DETALLE VEHICULO -->
                                                                            <template v-if="arrayConfiCotiVehiculo.length">
                                                                                <vs-divider border-style="solid" color="dark">
                                                                                    Vehículo
                                                                                </vs-divider>
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th colspan="3">Vehículo</th>
                                                                                                <th>Cantidad</th>
                                                                                                <th>Dscto</th>
                                                                                                <th>Precio Final</th>
                                                                                                <th>SubTotal</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="cotivehiculo in arrayConfiCotiVehiculo" :key="cotivehiculo.nIdContacto">
                                                                                                <td colspan="3"> {{ cotivehiculo.detalle }} </td>
                                                                                                <td v-text="cotivehiculo.cantidad"></td>
                                                                                                <td v-text="cotivehiculo.dscto"></td>
                                                                                                <td v-text="cotivehiculo.preciofinal"></td>
                                                                                                <td v-text="cotivehiculo.subtotal"></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="row flex-rigth-margin">
                                                                                        <div class="form-group row">
                                                                                            <label class="form-control-label">TOTAL USD &nbsp; &nbsp;</label>
                                                                                            <label class="form-control-label"><strong> {{ montoTotalConfiCotiVehiculo = totalConfiCotiVehiculo }}</strong></label>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                            <label class="form-control-label"><strong> {{ montoTotalConfiCotiVehiculoSoles = totalConfiCotiVehiculoSoles }}</strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <vs-divider border-style="solid" color="dark"/>
                                                                            </template>
                                                                            <template v-else>
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="10">No existen vehículos cotizados!</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </template>
                                                                            <!-- DETALLE ELEMENTOS DE VENTA VENDIDOS -->
                                                                            <template v-if="arrayConfiCotiEleVenta.length">
                                                                                <vs-divider border-style="solid" color="dark">
                                                                                    Elementos de Venta Vendidos
                                                                                </vs-divider>
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th colspan="3">Elemento Venta</th>
                                                                                                <th>Cantidad</th>
                                                                                                <th>Moneda</th>
                                                                                                <th>Precio Final</th>
                                                                                                <th>SubTotal</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="cotieleventa in arrayConfiCotiEleVenta" :key="cotieleventa.nIdContacto">
                                                                                                <td colspan="3"> {{ cotieleventa.detalle }} </td>
                                                                                                <td v-text="cotieleventa.cantidad"></td>
                                                                                                <td v-text="cotieleventa.monedanombre"></td>
                                                                                                <td v-text="cotieleventa.preciofinal"></td>
                                                                                                <td v-text="cotieleventa.subtotal"></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="row flex-rigth-margin">
                                                                                        <div class="form-group row">
                                                                                            <label class="form-control-label">TOTAL USD &nbsp; &nbsp;</label>
                                                                                            <label class="form-control-label"><strong>{{ montoTotalConfiCotiEleVenta = totalElementoVenta }}</strong></label>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                            <label class="form-control-label"><strong>{{ montoTotalConfiCotiEleVentaSoles = totalElementoVentaSoles }}</strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <vs-divider border-style="solid" color="dark"/>
                                                                            </template>
                                                                            <template v-else>
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="10">No existen elementos de ventas cotizados!</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </template>
                                                                            <!-- DETALLE ELEMENTOS DE VENTA REGALOS -->
                                                                            <template v-if="arrayConfiCotiObsequios.length">
                                                                                <vs-divider border-style="solid" color="dark">
                                                                                    Obsequios
                                                                                </vs-divider>
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th colspan="3">Obsequio</th>
                                                                                                <th>Elemento Venta</th>
                                                                                                <th>Cantidad</th>
                                                                                                <th>Moneda</th>
                                                                                                <th>Precio Final</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="cotieleventa in arrayConfiCotiObsequios" :key="cotieleventa.nIdContacto">
                                                                                                <td colspan="3" v-text=" cotieleventa.nombreOBS"></td>
                                                                                                <td v-text=" cotieleventa.nombreEV"></td>
                                                                                                <td v-text="cotieleventa.cantidad"></td>
                                                                                                <td v-text="cotieleventa.monedanombre"></td>
                                                                                                <td v-text="cotieleventa.preciofinal"></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="row flex-rigth-margin">
                                                                                        <div class="form-group row">
                                                                                            <label class="form-control-label">TOTAL USD &nbsp; &nbsp;</label>
                                                                                            <label class="form-control-label"><strong>{{ montoTotalConfiCotiObsequios = totalElementoVentaPorRegalar }}</strong></label>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                            <label class="form-control-label"><strong>{{ montoTotalConfiCotiObsequiosSoles = totalElementoVentaPorRegalarSoles }}</strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <vs-divider border-style="solid" color="dark"/>
                                                                            </template>
                                                                            <template v-else>
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="10">No existen regalos!</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </template>
                                                                            <!-- DETALLE ELEMENTOS DE VENTA CAMAPAÑAS -->
                                                                            <template v-if="arrayConfiCotiEventoEleVenta.length">
                                                                                <vs-divider border-style="solid" color="dark">
                                                                                    Campañas
                                                                                </vs-divider>
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th colspan="3">Campaña</th>
                                                                                                <th>Elemento Venta</th>
                                                                                                <th>Cantidad</th>
                                                                                                <th>Moneda</th>
                                                                                                <th>Precio Final</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="(cotieleventa, index) in arrayConfiCotiEventoEleVenta" :key="index">
                                                                                                <td colspan="3" v-text=" cotieleventa.nombreEC"></td>
                                                                                                <td v-text=" cotieleventa.nombreEV"></td>
                                                                                                <td v-text="cotieleventa.cantidad"></td>
                                                                                                <td v-text="cotieleventa.monedanombre"></td>
                                                                                                <td v-text="cotieleventa.preciofinal"></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="row flex-rigth-margin">
                                                                                        <div class="form-group row">
                                                                                            <label class="form-control-label">TOTAL USD &nbsp; &nbsp;</label>
                                                                                            <label class="form-control-label"><strong>{{montoTotalConfiCotiEventoEleVenta=totalEventoEleVentaModal}}</strong></label>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="form-control-label">TOTAL S/. &nbsp; &nbsp;</label>
                                                                                            <label class="form-control-label"><strong>{{montoTotalConfiCotiEventoEleVentaSoles=totalEventoEleVentaModalSoles}}</strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <vs-divider border-style="solid" color="dark"/>
                                                                            </template>
                                                                            <template v-else>
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="10">No existen campañas!</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </template>
                                                                            <hr/>
                                                                            <div class="col-lg-12">
                                                                                <div class="row flex-rigth-margin">
                                                                                    <div class="form-group row">
                                                                                        <strong>
                                                                                            TOTAL USD &nbsp; &nbsp; <label> {{ montoTotalCotizacion = totalConfiCoti }} </label>
                                                                                        </strong>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <strong>
                                                                                            TOTAL S/. &nbsp; &nbsp; <label> {{ montoTotalCotizacionSoles = totalConfiCotiSoles }} </label>
                                                                                        </strong>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-9 offset-sm-4">
                                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="registrarCotizacion">
                                                                                            <i class="fa fa-save"></i> REGISTRAR
                                                                                        </button>
                                                                                        <button type="button" class="btn btn-secundary btn-corner btn-sm" @click.prevent="cancelarCotizacion">
                                                                                            <i class="fa fa-close"></i> CANCELAR
                                                                                        </button>
                                                                                    </div>
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

            <!-- Modal Buscar Contactos -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">BUSQUEDA DE CONTACTOS</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                        <div class="col-sm-8">
                                                            <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.value">
                                                                <input type="radio" class="radio-template" v-model="fillBusqContacto.ntipopersona" :value="tipo.value" @change="cambiarTipoPersona()">
                                                                <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label" v-text="fillBusqContacto.lblcontactonombre"></label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillBusqContacto.ccontactonombre" @keyup.enter="buscarContactosPorVendedor(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar por {{ fillBusqContacto.lblcontactonombre }} </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscarContactosPorVendedor(1)">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label" v-text="fillBusqContacto.lblcontactodocumento"></label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillBusqContacto.ccontactodocumento" @keyup.enter="buscarContactosPorVendedor(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar por {{ fillBusqContacto.lblcontactodocumento }} </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscarContactosPorVendedor(1)">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarContactosPorVendedor(1);">
                                                        <i class="fa fa-search"></i> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayContactosPorVendedor.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <template v-if="arrayContactosPorVendedor[0].cPerApellidos">
                                                                <th>Apellidos y Nombres</th>
                                                                <th>DNI</th>
                                                            </template>
                                                            <template v-else>
                                                                <th>Razón Social</th>
                                                                <th>RUC</th>
                                                            </template>
                                                            <th>Email</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="contactos in arrayContactosPorVendedor" :key="contactos.nIdContacto">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar Contacto</div>
                                                                    <i @click.prevent="abrirModal('contacto', 'asignar', contactos)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <template v-if="contactos.cPerApellidos">
                                                                <td v-text="contactos.cContacto"></td>
                                                                <td v-text="contactos.cNumeroDocumento"></td>
                                                            </template>
                                                            <template v-else>
                                                                <td v-text="contactos.cRazonSocial"></td>
                                                                <td v-text="contactos.cNumeroDocumento"></td>
                                                            </template>
                                                            <td v-text="contactos.cEmail"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <nav>
                                                            <ul class="pagination">
                                                                <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaContactosPorVendedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaContactosPorVendedor(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaContactosPorVendedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="datatable-info">Mostrando {{ paginationModal.from }} a {{ paginationModal.to }} de {{ paginationModal.total }} registros</div>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Buscar Proveedores -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA DE PROVEEDORES</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombre</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillProveedor.cproveedornombre" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Proveedor </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayProveedor.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Nombre Proveedor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="proveedor in arrayProveedor" :key="proveedor.nIdPar">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ proveedor.cParNombre }}</div>
                                                                    <i @click="asignarProveedor(proveedor.nIdPar, proveedor.cParNombre)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="proveedor.cParNombre"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <nav>
                                                            <ul class="pagination">
                                                                <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaProveedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaProveedor(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaProveedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="datatable-info">Mostrando {{ paginationModal.from }} a {{ paginationModal.to }} de {{ paginationModal.total }} registros</div>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Buscar Vehiculos -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">BUSQUEDA DE VEHÍCULOS</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="text-center">
                                                            <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label class="col-md-4 form-control-label">TIPO DE LISTA</label>
                                                        <div class="col-md-8">
                                                            <el-select v-model="fillBusqVehiculo.nidtipolista" filterable clearable placeholder="SELECCIONE" @change="mostrarDetalleLista">
                                                                <el-option
                                                                v-for="item in arrayTipoLista"
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
                                                        <label class="col-md-4 form-control-label">DETALLE LISTA</label>
                                                        <div class="col-md-8">
                                                            <span v-text="fillBusqVehiculo.cinfotipolista"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label class="col-md-4 form-control-label">Linea</label>
                                                        <div class="col-md-8">
                                                            <el-select v-model="fillBusqVehiculo.nidlinea" filterable disabled="disabled" clearable placeholder="SELECCIONE" v-on:change="llenarComboMarca()">
                                                                <el-option
                                                                v-for="item in arrayLinea"
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
                                                        <label class="col-md-4 form-control-label">Marca</label>
                                                        <div class="col-md-8">
                                                            <el-select v-model="fillBusqVehiculo.nidmarca" filterable disabled="disabled" clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
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
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label class="col-md-4 form-control-label">Modelo</label>
                                                        <div class="col-md-8">
                                                            <el-select v-model="fillBusqVehiculo.nidmodelo" filterable disabled="disabled" clearable placeholder="SELECCIONE" >
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
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label class="col-md-4 form-control-label">Nombre Comercial</label>
                                                        <div class="col-md-8">
                                                            <input type="text" v-model="fillBusqVehiculo.cnombrecomercial" @keyup.enter="buscarVehiculos(1)" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-9 offset-md-5">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarVehiculos(1)">
                                                        <i class="fa fa-search"></i> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayVehiculoModal.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Codigo</th>
                                                            <th>Nombre Comercial</th>
                                                            <th>Año Fabricación</th>
                                                            <th>Año Modelo</th>
                                                            <th>Precio Base</th>
                                                            <th>Descuento</th>
                                                            <th>Precio Cierre</th>
                                                            <th>Costo Dealer</th>
                                                            <th>Precio Venta</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="vehiculo in arrayVehiculoModal" :key="vehiculo.nIdContacto">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar Vehiculo {{ vehiculo.NombreComercial }}</div>
                                                                    <i @click.prevent="agregarVehículoLista(vehiculo)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="vehiculo.codListaPrecioVD"></td>
                                                            <td v-text="vehiculo.NombreComercial"></td>
                                                            <td v-text="vehiculo.AnioFab"></td>
                                                            <td v-text="vehiculo.AnioMod"></td>
                                                            <td v-text="vehiculo.PrecioBase"></td>
                                                            <td v-text="vehiculo.Descuento"></td>
                                                            <td v-text="vehiculo.PrecioCierre"></td>
                                                            <td v-text="vehiculo.CostoDealer"></td>
                                                            <td v-text="vehiculo.PrecioVenta"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <nav>
                                                            <ul class="pagination">
                                                                <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaVehiculosModal(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaVehiculosModal(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaVehiculosModal(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="datatable-info">Mostrando {{ paginationModal.from }} a {{ paginationModal.to }} de {{ paginationModal.total }} registros</div>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Buscar Elemento de Venta -->
            <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO ELEMENTO VENTA</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Tipo Elemento</label>
                                                        <div class="col-sm-8">
                                                            <el-select v-model="fillBusqTipoElemento.ntpoelemen" filterable clearable placeholder="SELECCIONE" >
                                                                <el-option
                                                                v-for="item in arrayTipoElemento"
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
                                                        <label class="col-sm-4 form-control-label">* Nombre Elemento</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillBusqTipoElemento.celementonombre" @keyup.enter="buscarElementoVenta(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Elemento Venta </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscarElementoVenta(1)">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-9 offset-md-5">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarElementoVenta(1)">
                                                        <i class="fa fa-search"></i> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayElementoVentaModal.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acciones</th>
                                                            <th>Código</th>
                                                            <th>Proveedor</th>
                                                            <th>Tipo Elemento</th>
                                                            <th>Nombre Elemento</th>
                                                            <th>Tipo Moneda</th>
                                                            <th>Precio de Venta</th>
                                                            <th>Precio de Venta Mínimo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="elemento in arrayElementoVentaModal" :key="elemento.nIdContacto">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Agregar {{ elemento.cElemenNombre }}</div>
                                                                    <i @click.prevent="agregarElementoVentaLista(elemento)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="elemento.nIdElemento"></td>
                                                            <td v-text="elemento.cProveedorNombre"></td>
                                                            <td v-text="elemento.cTipoElemenNombre"></td>
                                                            <td v-text="elemento.cElemenNombre"></td>
                                                            <td v-text="elemento.cMonedaNombre"></td>
                                                            <td v-text="elemento.fElemenValorVenta"></td>
                                                            <td v-text="elemento.fElemenValorMinimoVenta"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <nav>
                                                            <ul class="pagination">
                                                                <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaTipoElementoVenta(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaTipoElementoVenta(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaTipoElementoVenta(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="datatable-info">Mostrando {{ paginationModal.from }} a {{ paginationModal.to }} de {{ paginationModal.total }} registros</div>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Buscar Detalle Evento Campaña -->
            <div class="modal fade" v-if="accionmodal==6" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">DETALLE EVENTO/CAMPAÑA</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div>
                                                            <h3 v-text="fillEventoCampania.cNombreEventoCampania"></h3>
                                                            <h2 class="no-margin-bottom" v-text="fillEventoCampania.TipoEvento"></h2>
                                                            <input type="hidden" v-text="montoTotalEventoElementoVenta = totalEventoEleVentaModal">
                                                            <input type="hidden" v-text="montoTotalEventoElementoVentaSoles = totalEventoEleVentaModalSoles">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayEventoEleVentaModal.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acciones</th>
                                                            <th>Elemento Venta</th>
                                                            <th>Moneda</th>
                                                            <th>Valor</th>
                                                            <th>Cantidad a Regalar</th>
                                                            <th>En Stock</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(eleventa, index) in arrayEventoEleVentaModal" :key="eleventa.nIdContacto">
                                                            <template v-if="eleventa.nIdEventoCampania == fillEventoCampania.nIdEventoCampania">
                                                                <td>
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Eliminar {{ eleventa.cNombre }}</div>
                                                                        <i @click="removerElementoVentaCampania(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                    </el-tooltip>
                                                                </td>
                                                                <td v-text="eleventa.cNombre"></td>
                                                                <td v-text="eleventa.cMonedaNombre"></td>
                                                                <td v-text="eleventa.fValorVenta"></td>
                                                                <td v-text="eleventa.cantidad"></td>
                                                                <td v-text="eleventa.nStock"></td>
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

            <!-- Modal Buscar Elemento de Venta Por Regalar-->
            <div class="modal fade" v-if="accionmodal==7" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO ELEMENTO VENTA A REGALAR</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Tipo Elemento</label>
                                                        <div class="col-sm-8">
                                                            <el-select v-model="fillBusqTipoElementoPorRegalar.ntpoelemen" filterable clearable placeholder="SELECCIONE">
                                                                <el-option
                                                                    v-for="item in arrayTipoElemento"
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
                                                        <label class="col-sm-4 form-control-label">* Nombre Elemento</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillBusqTipoElementoPorRegalar.celementonombre" @keyup.enter="buscarElementoVentaPorRegalar(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Elemento Venta </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscarElementoVentaPorRegalar(1)">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-9 offset-md-5">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarElementoVentaPorRegalar(1)">
                                                        <i class="fa fa-search"></i> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayElementoVentaModalPorRegalar.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acciones</th>
                                                            <th>Código</th>
                                                            <th>Proveedor</th>
                                                            <th>Tipo Elemento</th>
                                                            <th>Nombre Elemento</th>
                                                            <th>Tipo Moneda</th>
                                                            <th>Precio de Venta</th>
                                                            <th>Precio de Venta Mínimo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="elemento in arrayElementoVentaModalPorRegalar" :key="elemento.nIdContacto">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Agregar {{ elemento.cElemenNombre }}</div>
                                                                    <i @click.prevent="agregarElementoVentaListaPorRegalar(elemento)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="elemento.nIdElemento"></td>
                                                            <td v-text="elemento.cProveedorNombre"></td>
                                                            <td v-text="elemento.cTipoElemenNombre"></td>
                                                            <td v-text="elemento.cElemenNombre"></td>
                                                            <td v-text="elemento.cMonedaNombre"></td>
                                                            <td v-text="elemento.fElemenValorVenta"></td>
                                                            <td v-text="elemento.fElemenValorMinimoVenta"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <nav>
                                                            <ul class="pagination">
                                                                <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaTipoElementoVentaPorRegalar(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaTipoElementoVentaPorRegalar(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaTipoElementoVentaPorRegalar(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="datatable-info">Mostrando {{ paginationModal.from }} a {{ paginationModal.to }} de {{ paginationModal.total }} registros</div>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detalle Cotizacion -->
            <div class="modal fade" v-if="accionmodal==8" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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

            <!-- Modal Buscar Detalle Obsequios-->
            <div class="modal fade" v-if="accionmodal==9" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">DETALLE OBSEQUIOS</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div>
                                                            <h3 v-text="fillObsequio.cNombreObsequio"></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayObsequioEleVentaModal.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acciones</th>
                                                            <th>Obsequio</th>
                                                            <th>Moneda</th>
                                                            <th>Valor</th>
                                                            <th>Cantidad a Regalar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(obsequio, index) in arrayObsequioEleVentaModal" :key="obsequio.nIdContacto">
                                                            <template v-if="obsequio.nIdObsequio == fillObsequio.nIdObsequio">
                                                                <td>
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Eliminar {{ obsequio.cNombre }}</div>
                                                                        <i @click="removerElementoVentaCampania(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                    </el-tooltip>
                                                                </td>
                                                                <td v-text="obsequio.cNombre"></td>
                                                                <td v-text="obsequio.cMonedaNombre"></td>
                                                                <td v-text="obsequio.fValorVenta"></td>
                                                                <td v-text="obsequio.cantidad"></td>
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
                // =============================================================
                // VARIABLES TAB MIS COTIZACIONES
                // =============================================================
                fillMisCotizaciones: {
                    fechaInicio: '',
                    fechaFin: '',
                    nidmarca: '',
                    nidmodelo: '',
                    nidestadocotizacion: '',
                    cnumerocotizacion: ''
                },
                arrayCotizaciones: [],
                arrayEstadoCotizacion: [],
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
                cFlagActivaElemento: 0,
                cFlagActivaObsequio: 0,
                cFlagActivaCampania: 0,
                // =============================================================
                // VARIABLES TAB COTIZACIÓN
                // =============================================================
                fillConfigBasica: {
                    tipoCambioVenta: 0.0,
                    tipoCambioCompra: 0.0,
                    fechaInicio: '',
                    fechaFin: '',
                    refCotizacion: 'NINGUNA'
                },
                // =============================================================
                // VARIABLES TAB ASIGNAR CONTACTO
                // =============================================================
                fillBusqContacto:{
                    ntipopersona: 1,
                    lblcontactonombre: 'Apellidos',
                    lblcontactodocumento: 'DNI',
                    ccontactonombre: '',
                    ccontactodocumento: ''
                },
                arrayContactosPorVendedor: [],
                fillAsignarContacto:{
                    nidasignarcontacto: 0,
                    nidcontacto: 0,
                    ccontacto: '',
                    cnrodocumento: '',
                    cdireccion: '',
                    cemail: '',
                    nidreferencia: '',
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: '',
                    nidsublinea: ''
                },
                arrayTipoMedio: [],
                arrayReferenciavehiculo: [],
                arraySubLinea: [],
                // =============================================================
                // VARIABLES TAB DETALLE COTIZACIÓN
                // =============================================================
                fillProveedor:{
                    nidproveedor: 0,
                    cproveedornombre: ''
                },
                arrayProveedor: [],
                // ================= MODAL BUSCAR VEHICULO =================
                arrayTipoLista: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                fillBusqVehiculo:{
                    cinfotipolista: '',
                    nidtipolista: '',
                    nidlinea: '',
                    nidmarca: '',
                    nidmodelo: '',
                    cnombrecomercial: ''
                },
                arrayVehiculoModal : [],
                // ================= SUB TAB VEHICULO =================
                arrayVehiculo: [],
                flagLimiteSobrePrecio: 0,
                fdscto01: 0,
                fdscto02: 0,
                fdscto03: 0,
                fDx: 0,
                observacionDscto: '',
                montoTotalVehiculoDolar: 0,
                fValorTipoCambioCompra: 0,
                fValorTipoCambioVenta: 0,
                fValorTipocambioComercial: 0,
                montoTotalVehiculoSoles: 0,
                // ================= SUBTAB Elemento Venta POR REGALAR=================
                /*fillBusqTipoElementoPorRegalar: {
                    ntpoelemen: '',
                    celementonombre: ''
                },
                arrayElementoVentaModalPorRegalar: [],
                arrayElementoVentaPorRegalar: [],
                montoTotalElementoVentaPorRegalar: 0,
                montoTotalElementoVentaPorRegalarSoles: 0,*/
                arrayObsequiosByModelo: [],
                arrayObsequio: [],
                fillObsequio: {
                    nIdObsequio: 0,
                    cNombreObsequio: ''
                },
                arrayObsequioEleVenta: [],
                arrayObsequioEleVentaModal: [],
                // ================= SUBTAB Elemento Venta =================
                fillBusqTipoElemento: {
                    ntpoelemen: '',
                    celementonombre: ''
                },
                arrayTipoElemento: [],
                arrayElementoVentaModal: [],
                arrayElementoVenta: [],
                montoTotalElementoVenta: 0,
                montoTotalElementoVentaSoles: 0,
                /// ================= SUBTAB EVENTO CAMPAÑA =================
                arrayCampaniasByModelo: [],
                /*arrayCampaniasByMarca: [],
                arrayCampaniasByLinea: [],*/
                arrayEventoCampania: [],
                fillEventoCampania: {
                    nIdEventoCampania: 0,
                    cNombreEventoCampania: '',
                    TipoEvento: ''
                },
                arrayEventoEleVenta: [],
                arrayEventoEleVentaModal: [],
                montoTotalEventoElementoVenta: 0,
                montoTotalEventoElementoVentaSoles: 0,
                //SUBTAB CONFIRMAR COTIZACIÓN
                //Vehiculo
                arrayConfiCotiVehiculo: [],
                montoTotalConfiCotiVehiculo: 0,
                montoTotalConfiCotiVehiculoSoles: 0,
                //Obsequios
                arrayConfiCotiObsequios: [],
                montoTotalConfiCotiObsequios: 0,
                montoTotalConfiCotiObsequiosSoles: 0,
                //Ele Venta
                arrayConfiCotiEleVenta: [],
                montoTotalConfiCotiEleVenta: 0,
                montoTotalConfiCotiEleVentaSoles: 0,
                //Ele Venta de Campaña
                arrayConfiCotiEventoEleVenta: [],
                montoTotalConfiCotiEventoEleVenta: 0,
                montoTotalConfiCotiEventoEleVentaSoles: 0,
                //Totales
                arrayMontosCotizacion: [],
                montoTotalCotizacion: 0,
                montoTotalCotizacionSoles: 0,
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
                //Radio Buttons Tipo Persona
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
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

            }
        },
        mounted() {
            this.tabMisCotizaciones();
            //this.configuracionInicial();
        },
        computed:{
            //Paginación
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
            //Calcula el Dscto 01
            calcularDscto01: function(){
                let me = this;
                if(me.arrayVehiculo){
                    return me.arrayVehiculo.map(function(x){
                        if((x.subtotal - x.PrecioVenta) >= 0) {
                        // if((x.PrecioBase - x.PrecioCierre - x.descuento) >= 0) {
                            me.observacionDscto = '';
                            // return x.PrecioBase - x.PrecioCierre - x.descuento;
                            return x.subtotal - x.PrecioVenta;
                        } else {
                            return 0;
                        }
                    });
                }
            },
            //Calcula el Dscto 01
            calcularDscto02: function(){
                let me = this;
                if(me.arrayVehiculo){
                    return me.arrayVehiculo.map(function(x){
                        if((x.subtotal - x.PrecioVenta) < 0) {
                        // if((x.PrecioBase - x.PrecioCierre - x.descuento) < 0) {
                            // return x.PrecioBase - x.PrecioCierre - x.descuento;
                            // console.log(me.fdscto03);
                            // console.log(Math.abs(x.subtotal - x.PrecioVenta));
                            let residuo = Math.abs(x.subtotal - x.PrecioVenta);
                            return residuo - me.fdscto03;
                        } else {
                            return 0;
                        }
                    });
                }
            },
            //Calcula el Dscto 01
            calcularDscto03: function(){
                let me = this;
                if(me.arrayVehiculo){
                    return me.arrayVehiculo.map(function(x){
                        if((x.subtotal - x.PrecioCierre) < 0) {
                        // if((x.PrecioBase - x.PrecioCierre - x.descuento) < 0) {
                            // return x.PrecioBase - x.PrecioCierre - x.descuento;
                            return x.subtotal - x.PrecioCierre;
                        } else {
                            return 0;
                        }
                    });
                }
            },
            //Calcula el Dx
            calcularDx: function(){
                let me = this;
                if(me.arrayVehiculo) {
                    return me.arrayVehiculo.map(function(x){
                        return x.PrecioBase - x.PrecioCierre;
                    });
                }
            },
            //Calcula SubTotales y Total del TAB Vehículo
            totalVehiculo: function(){
                let me = this;
                return me.arrayVehiculo.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.subtotal);
                }, 0);
            },
            totalVehiculoSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalVehiculoDolar * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },
            //Calcula SubTotales y Total del TAB Elemento Venta
            totalElementoVenta: function(){
                let me = this;
                let sumaElementoDolares;
                return me.arrayElementoVenta.reduce(function(valorAnterior, valorActual){
                    //Si moneda es soles
                    if(valorActual.nIdMoneda == 1300027){
                        sumaElementoDolares = valorAnterior + (parseFloat(valorActual.subtotal) / me.fValorTipocambioComercial);
                    }else{
                        sumaElementoDolares = valorAnterior + parseFloat(valorActual.subtotal);
                    }
                    return Number((sumaElementoDolares).toFixed(2));
                }, 0);
            },
            totalElementoVentaSoles: function(){
                let me = this;
                let sumaElementoSoles;
                return me.arrayElementoVenta.reduce(function(valorAnterior, valorActual){
                    //Si moneda es dolares
                    if(valorActual.nIdMoneda == 1300028){
                        sumaElementoSoles = valorAnterior + (parseFloat(valorActual.subtotal) * me.fValorTipocambioComercial);
                    }else{
                        sumaElementoSoles = valorAnterior + parseFloat(valorActual.subtotal);
                    }
                    return Number((sumaElementoSoles).toFixed(2));
                }, 0);
            },
            //Calcula SubTotales y Total del TAB Elemento Venta
            totalElementoVentaPorRegalar: function(){
                let me = this;
                let sumaElementoRegaloDolares;
                return me.arrayObsequioEleVentaModal.reduce(function(valorAnterior, valorActual){
                    //Si moneda es soles
                    if(valorActual.nIdMoneda == 1300027){
                        sumaElementoRegaloDolares = valorAnterior + (parseFloat(valorActual.fValorVenta) / me.fValorTipocambioComercial);
                    }else{
                        sumaElementoRegaloDolares = valorAnterior + parseFloat(valorActual.fValorVenta);
                    }
                    return Number((sumaElementoRegaloDolares).toFixed(2));
                }, 0);
            },
            totalElementoVentaPorRegalarSoles: function(){
                let me = this;
                let sumaElementoRegaloSoles;
                return me.arrayObsequioEleVentaModal.reduce(function(valorAnterior, valorActual){
                    //Si moneda es dolares
                    if(valorActual.nIdMoneda == 1300028){
                        sumaElementoRegaloSoles = valorAnterior + (parseFloat(valorActual.fValorVenta) * me.fValorTipocambioComercial);
                    }else{
                        sumaElementoRegaloSoles = valorAnterior + parseFloat(valorActual.fValorVenta);
                    }
                    return Number((sumaElementoRegaloSoles).toFixed(2));
                }, 0);
            },
            //Calcula SubTotales y Total del TAB Evento Campaña
            totalEventoEleVentaModal: function(){
                let me = this;
                let sumaElementoCampaniaDolares;
                return me.arrayEventoEleVentaModal.reduce(function(valorAnterior, valorActual){
                    //Si moneda es soles
                    if(valorActual.nIdMoneda == 1300027){
                        sumaElementoCampaniaDolares = valorAnterior + (parseFloat(valorActual.fValorVenta) / me.fValorTipocambioComercial);
                    }else{
                        sumaElementoCampaniaDolares = valorAnterior + parseFloat(valorActual.fValorVenta);
                    }
                    return Number((sumaElementoCampaniaDolares).toFixed(2));
                }, 0);
            },
            totalEventoEleVentaModalSoles: function(){
                let me = this;
                let sumaElementoCampaniaSoles;
                return me.arrayEventoEleVentaModal.reduce(function(valorAnterior, valorActual){
                    //Si moneda es dolares
                    if(valorActual.nIdMoneda == 1300028){
                        sumaElementoCampaniaSoles = valorAnterior + (parseFloat(valorActual.fValorVenta) * me.fValorTipocambioComercial);
                    }else{
                        sumaElementoCampaniaSoles = valorAnterior + parseFloat(valorActual.fValorVenta);
                    }
                    return Number((sumaElementoCampaniaSoles).toFixed(2));
                }, 0);
            },
            //Calcula SubTotales y Total del TAB Cotización - Vehiculo
            totalConfiCotiVehiculo: function(){
                let me = this;
                return me.arrayConfiCotiVehiculo.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.subtotal);
                }, 0);
            },
            totalConfiCotiVehiculoSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalConfiCotiVehiculo * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },
            //Calcula SubTotales y Total del TAB Cotización - Elemento Venta Por Regalar
            /*totalConfiCotiEleVentaPorRegalar: function(){
                let me = this;
                return me.arrayConfiCotiObsequios.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.subtotal);
                }, 0);
            },
            totalConfiCotiEleVentaPorRegalarSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalConfiCotiObsequios * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },*/
            //Calcula SubTotales y Total del TAB Cotización - Elemento Venta
            /*totalConfiCotiEleVenta: function(){
                let me = this;
                return me.arrayConfiCotiEleVenta.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.subtotal);
                }, 0);
            },
            totalConfiCotiEleVentaSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalConfiCotiEleVenta * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },*/
            //Calcula SubTotales y Total del TAB Cotización - Evento Camapaña (Elemento Venta)
            /*totalConfiCotiEventoEleVenta: function(){
                let me = this;
                return me.arrayConfiCotiEventoEleVenta.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.preciofinal);
                }, 0);
            },
            totalConfiCotiEventoEleVentaSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalConfiCotiEventoEleVenta * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            },*/
            //Calcula SubTotales y Total de toda la Cotización
            totalConfiCoti: function(){
                let me = this;
                return me.arrayMontosCotizacion.reduce(function(valorAnterior, valorActual){
                    return valorAnterior + parseFloat(valorActual.monto);
                }, 0);
            },
            totalConfiCotiSoles: function(){
                let me = this;
                let montoconvertido = me.montoTotalCotizacion * me.fValorTipocambioComercial;
                montoconvertido = Number((montoconvertido).toFixed(2));
                return montoconvertido;
            }
        },
        methods:{
            // =================================================================
            // TAB MIS COTIZACIÓNES
            // =================================================================
            tabMisCotizaciones(){
                this.llenarSoloComboMarca();
                this.llenarSoloComboModelo();
                this.llenarEstadoCotizacion();
                this.arrayCotizaciones = [];
            },
            llenarSoloComboMarca(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110032
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarSoloComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';

                axios.get(url,{
                    params: {
                        'nidmarca' : this.fillMisCotizaciones.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillMisCotizaciones.nidmodelo = '';
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarEstadoCotizacion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110058
                    }
                }).then(response => {
                    this.arrayEstadoCotizacion = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            listarMisCotizaciones(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/gescotizacion/GetListCotizacionesByIdVendedor';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'dfechainicio': this.fillMisCotizaciones.dfechainicio,
                        'dfechafin': this.fillMisCotizaciones.dfechafin,
                        'nidmarca': this.fillMisCotizaciones.nidmarca,
                        'nidmodelo': this.fillMisCotizaciones.nidmodelo,
                        'cnumerocotizacion': this.fillMisCotizaciones.cnumerocotizacion,
                        'nidestadocotizacion': this.fillMisCotizaciones.nidestadocotizacion,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayCotizaciones = response.data.arrayCotizaciones.data;
                    this.pagination.current_page =  response.data.arrayCotizaciones.current_page;
                    this.pagination.total = response.data.arrayCotizaciones.total;
                    this.pagination.per_page    = response.data.arrayCotizaciones.per_page;
                    this.pagination.last_page   = response.data.arrayCotizaciones.last_page;
                    this.pagination.from        = response.data.arrayCotizaciones.from;
                    this.pagination.to           = response.data.arrayCotizaciones.to;
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
            cambiarPaginaCotizacion(page){
                this.pagination.current_page=page;
                this.listarMisCotizaciones(page);
            },
            verCotizacion(cotizacion){
                this.fillDetalleCotizacion.cnumerocotizacion        = cotizacion.cNumeroCotizacion,
                this.fillDetalleCotizacion.cdocumentocliente        = cotizacion.cPerDocumento,
                this.fillDetalleCotizacion.cnombrecliente           = cotizacion.cContacto,
                this.fillDetalleCotizacion.nidversionvehiculo       = cotizacion.nIdVersionVeh,
                this.fillDetalleCotizacion.cvehiculo                = cotizacion.cNombreComercial + ' ' + cotizacion.nAnioFabricacion + '-' + cotizacion.nAnioModelo,
                this.fillDetalleCotizacion.cnombreproveedor         = cotizacion.cNombreProveedor,
                this.fillDetalleCotizacion.cnombrevendedor          = cotizacion.cNombreVendedor,
                this.fillDetalleCotizacion.dfechacotizacion         = cotizacion.dFechaCotizacion,
                this.fillDetalleCotizacion.ftotalcotizacionsoles    = cotizacion.fTotalCotizacionSoles,
                this.fillDetalleCotizacion.ftotalcotizaciondolares  = cotizacion.fTotalCotizacionDolares,
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
            // =================================================================
            // TAB COTIZACIÓN
            // =================================================================
            tabCotizacion(){
                //$('#tab02').removeClass('nav-link active');
                //$('#tab02').addClass('nav-link active');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link');
                $('#tab04').removeClass('nav-link active');
                $('#tab04').addClass('nav-link');

                $('#TabCotizacion').addClass("in active show");
                $('#TabAsignarContacto').removeClass('in active show');
                $('#TabDetalleCotizacion').removeClass('in active show');
                this.configuracionInicial();
            },
            configuracionInicial(){
                this.obtenerFechaInicioCotizacion();
                this.obtenerFechaFinCotizacion();
                this.getTipoCambio();
            },
            obtenerFechaInicioCotizacion(){
                this.fillConfigBasica.fechaInicio = moment().format('DD/MM/YYYY');
            },
            obtenerFechaFinCotizacion(){
                var url = this.ruta + '/tipoparametro/GetTipoByIdParametro';
                axios.get(url, {
                    params: {
                        'nidpar' : 1300170,
                        'ctipoparametro' : 'N',
                        'nidtipopar': 4
                    }
                }).then(response => {
                    var fecha = moment().add(parseInt(response.data[0].nDatoParNumerico), 'days').format('DD/MM/YYYY');
                    this.fillConfigBasica.fechaFin = fecha;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            getTipoCambio(){
                this.mostrarProgressBar();
                var url = this.ruta + '/gescotizacion/GetTipoCambio';
                axios.get(url).then(response => {
                    this.fValorTipoCambioCompra = response.data[0].fValorTipoCambioCompra;
                    this.fValorTipoCambioVenta = response.data[0].fValorTipoCambioVenta;
                    this.fValorTipocambioComercial = response.data[0].fValorTipoCambioComercial;

                    this.fillConfigBasica.tipoCambioVenta = response.data[0].fValorTipoCambioComercial;
                    this.fillConfigBasica.tipoCambioCompra = response.data[0].fValorTipoCambioCompra;
                }).then(function (response) {
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
            // =================================================================
            // TAB ASIGNAR CONTACTO
            // =================================================================
            tabAsignarContacto(){
                if(this.validaCotizacion()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass("nav-link");
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass("nav-link");
                $('#tab03').addClass('nav-link active');
                $('#tab04').removeClass('nav-link active');
                $('#tab04').addClass('nav-link disabled');
                $('#TabMisCotizaciones').removeClass('in active show');
                $('#TabCotizacion').removeClass('in active show');
                $('#TabAsignarContacto').addClass('in active show');
                $('#TabDetalleCotizacion').removeClass('in active show');

                this.llenarTipoMedio();
                this.llenarReferenciasVehiculo();
            },
            validaCotizacion(){
                this.error = 0;
                this.mensajeError =[];

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            buscarContactosPorVendedor(page){
                var url = this.ruta + '/gescontacto/GetListContactoByVendedor';
                axios.get(url, {
                    params: {
                        'nidempresa' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcronograma' : 220016,
                        'ntipopersona' : this.fillBusqContacto.ntipopersona,
                        'cnrodocumento' : String(this.fillBusqContacto.ccontactodocumento.toString()),
                        'cfiltrodescripcion' : this.fillBusqContacto.ccontactonombre.toString(),
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayContactosPorVendedor;
                    //Data
                    this.arrayContactosPorVendedor = info.data;
                    //Pagination
                    this.paginationModal.current_page   =   info.current_page;
                    this.paginationModal.total          =   info.total;
                    this.paginationModal.per_page       =   info.per_page;
                    this.paginationModal.last_page      =   info.last_page;
                    this.paginationModal.from           =   info.from;
                    this.paginationModal.to             =   info.to;
                    //Limpiar caja busqueda
                    this.limpiarfillBusqContacto();
                }).catch(error => {
                    this.errors = error.response.data
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPaginaContactosPorVendedor(page){
                this.pagination.current_page=page;
                this.buscarContactosPorVendedor(page);
            },
            cambiarTipoPersona(){
                if (this.fillBusqContacto.ntipopersona == 1) {
                    this.fillBusqContacto.lblcontactonombre = "Apellidos";
                    this.fillBusqContacto.lblcontactodocumento = "DNI";
                } else {
                    this.fillBusqContacto.lblcontactonombre = "Razón Social";
                    this.fillBusqContacto.lblcontactodocumento = "RUC";
                }
                this.limpiarfillBusqContacto();
            },
            limpiarfillBusqContacto(){
                this.fillBusqContacto.ccontactonombre = '';
                this.fillBusqContacto.ccontactodocumento = '';
            },
            llenarTipoMedio(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110057
                    }
                }).then(response => {
                    let info = response.data;
                    //Data
                    this.arrayTipoMedio = info;
                }).catch(error => {
                    this.errors = error.response.data
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarReferenciasVehiculo(){
                var url = this.ruta + '/gescotizacion/GetRefVehiculoByContacto';
                axios.get(url, {
                    params: {
                        'nidempresa' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcontacto' : parseInt(this.fillAsignarContacto.nidcontacto)
                    }
                }).then(response => {
                    let info = response.data.arraySegReferenciavehiculo;
                    //Data
                    this.arrayReferenciavehiculo = info.data;
                    //Pagination
                    this.pagination.current_page   =   info.current_page;
                    this.pagination.total          =   info.total;
                    this.pagination.per_page       =   info.per_page;
                    this.pagination.last_page      =   info.last_page;
                    this.pagination.from           =   info.from;
                    this.pagination.to             =   info.to;
                    //Limpiar caja busqueda
                    this.limpiarfillBusqContacto();
                }).catch(error => {
                    this.errors = error.response.data
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            asingarReferenciaVehiculo(nIdAsignacionContactoVendedor, nIdProveedor, cProveedorNombre, nIdLinea, nIdMarca, nIdModelo){
                this.tabDCVehiculo();
                this.fillAsignarContacto.nidasignarcontacto = nIdAsignacionContactoVendedor;
                this.fillProveedor.nidproveedor = nIdProveedor;
                this.fillProveedor.cproveedornombre = cProveedorNombre;
                this.fillAsignarContacto.nidlinea = nIdLinea;
                this.fillAsignarContacto.nidmarca = nIdMarca;
                this.fillAsignarContacto.nidmodelo = nIdModelo;
                this.tabDetalleCotización();
                this.llenarComboSubLinea();
            },
            tabDetalleCotización(){
                if(this.validaAsignarCotizacion()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link');
                $('#tab04').removeClass('nav-link disabled');
                $('#tab04').addClass('nav-link active');

                $('#TabCotizacion').removeClass('in active show');
                $('#TabAsignarContacto').removeClass('in active show');
                $('#TabDetalleCotizacion').addClass('in active show');
            },
            validaAsignarCotizacion(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillAsignarContacto.ccontacto){
                    this.mensajeError.push('Apellidos y Nombres no puede estar vacío');
                }
                if(!this.fillAsignarContacto.cnrodocumento){
                    this.mensajeError.push('Doc. Identidad no puede estar vacío');
                }
                if(!this.fillAsignarContacto.cdireccion){
                    this.mensajeError.push('La dirección no puede estar vacía');
                }
                if(!this.fillAsignarContacto.cemail){
                    this.mensajeError.push('El email no puede estar vacío');
                }
                if(this.fillAsignarContacto.nidreferencia == 0 || this.fillAsignarContacto.nidreferencia == ''){
                    this.mensajeError.push('Debes Seleccionar un Tipo Medio');
                }
                if(this.fillAsignarContacto.nidasignarcontacto == 0 ||
                    this.fillAsignarContacto.nidasignarcontacto == undefined){
                    this.mensajeError.push('Debes asignar una Referencia de Vehículo');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            llenarComboSubLinea(){
                var url = this.ruta + '/versionvehiculo/GetSubLineaByLinea';

                axios.get(url, {
                    params: {
                        'nidlinea': this.fillAsignarContacto.nidlinea,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arraySubLinea = response.data.arraySubLinea;
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
            // TAB DETALLE COTIZACION
            // =================================================================
            // ======================
            // SUBTAB VEHÍCULO
            // ======================
            tabDCVehiculo(){
                $('#tab0401').addClass('nav-link active');
                $('#tab0402').removeClass('nav-link active');
                $('#tab0402').addClass("nav-link disabled");
                $('#tab0403').removeClass('nav-link active');
                $('#tab0403').addClass('nav-link disabled');
                $('#tab0404').removeClass('nav-link active');
                $('#tab0404').addClass('nav-link disabled');
                $('#tab0405').removeClass('nav-link active');
                $('#tab0405').addClass('nav-link disabled');
                $('#TabDCVehiculo').addClass('in active show');
                $('#TabDCElementoVentaPorRegalar').removeClass('in active show');
                $('#TabDCElementoVenta').removeClass('in active show');
                $('#TabDCVerificarCampana').removeClass('in active show');
                $('#TabDCConfirmarCotizacion').removeClass('in active show');
            },
            llenarTipoLista(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110044
                    }
                }).then(response => {
                    let info = response.data;
                    //Data
                    this.arrayTipoLista = info;
                }).catch(error => {
                    this.errors = error.response.data
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : this.fillProveedor.cproveedornombre.toString(),
                        'opcion' : 0,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    this.paginationModal.current_page   =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total          = response.data.arrayProveedor.total;
                    this.paginationModal.per_page       = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page      = response.data.arrayProveedor.last_page;
                    this.paginationModal.from           = response.data.arrayProveedor.from;
                    this.paginationModal.to             = response.data.arrayProveedor.to;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.fillProveedor.nidproveedor = nProveedorId;
                this.fillProveedor.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.llenarComboLinea();
            },
            validarBotonBuscarVehiculo(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillProveedor.cproveedornombre){
                    this.mensajeError.push('Debe seleccionar un proveedor');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            mostrarDetalleLista(){
                var url = this.ruta + '/gescotizacion/GetTipoLista';
                axios.get(url, {
                    params: {
                        'nidproveedor': this.fillProveedor.nidproveedor,
                        'nidtipolista' : this.fillBusqVehiculo.nidtipolista
                    }
                }).then(response => {
                    var varnro = (response.data[0].NRO) == null ? '' : response.data[0].NRO + ' - ';
                    this.fillBusqVehiculo.cinfotipolista = varnro + response.data[0].MES + ' ' + response.data[0].ANIO;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboLinea(){
                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidproveedor' : this.fillProveedor.nidproveedor
                    }
                }).then(response => {
                    this.arrayLinea = response.data;
                    this.fillBusqVehiculo.nidlinea = this.fillAsignarContacto.nidlinea;
                    this.llenarComboMarca();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboMarca(){
                var url = this.ruta + '/versionvehiculo/GetMarcaByLinea';

                axios.get(url, {
                    params: {
                        'nidlinea': this.fillBusqVehiculo.nidlinea
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                    this.fillBusqVehiculo.nidmarca = this.fillAsignarContacto.nidmarca;
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
                        'nidmarca': this.fillBusqVehiculo.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillBusqVehiculo.nidmodelo = this.fillAsignarContacto.nidmodelo;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            buscarVehiculos(page){
                if(this.validarBuscarVehiculos()){
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/gescotizacion/GetListVehiculos';
                axios.get(url, {
                    params: {
                        'nidproveedor': this.fillProveedor.nidproveedor,
                        'nidtipolista': this.fillBusqVehiculo.nidtipolista,
                        'nidlinea' : this.fillBusqVehiculo.nidlinea,
                        'nidmarca' : this.fillBusqVehiculo.nidmarca,
                        'nidmodelo' : this.fillBusqVehiculo.nidmodelo,
                        'cnombrecomercial' : this.fillBusqVehiculo.cnombrecomercial,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayVehiculoModal = response.data.arrayListaVehiculos.data;
                    this.paginationModal.current_page   =  response.data.arrayListaVehiculos.current_page;
                    this.paginationModal.total          = response.data.arrayListaVehiculos.total;
                    this.paginationModal.per_page       = response.data.arrayListaVehiculos.per_page;
                    this.paginationModal.last_page      = response.data.arrayListaVehiculos.last_page;
                    this.paginationModal.from           = response.data.arrayListaVehiculos.from;
                    this.paginationModal.to             = response.data.arrayListaVehiculos.to;
                    //this.limpiarfillBusqVehiculo();
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
            validarBuscarVehiculos(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillBusqVehiculo.nidtipolista == 0){
                    this.mensajeError.push('Debe seleccionar un tipo de lista');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarPaginaVehiculosModal(page){
                this.paginationModal.current_page=page;
                this.buscarVehiculos(page);
            },
            limpiarfillBusqVehiculo(){
                this.fillBusqVehiculo.nidlinea = '';
                this.fillBusqVehiculo.nidmarca = '';
                this.fillBusqVehiculo.nidmodelo = '';
                this.fillBusqVehiculo.cnombrecomercial = '';
            },
            agregarVehículoLista(vehiculo){
                if(this.encontrarVehiculo(vehiculo.NombreComercial)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'El vehículo ya se encuentra agregado!',
                    })
                } else {
                    this.arrayVehiculo = [];

                    this.arrayVehiculo.push({
                        codListaPrecioVD : vehiculo.codListaPrecioVD,
                        NombreComercial  : vehiculo.NombreComercial,
                        AnioFabricacion  : vehiculo.nAnioFabricacion,
                        AnioModelo       : vehiculo.nAnioModelo,
                        PrecioBase       : vehiculo.PrecioBase,
                        PrecioCierre     : vehiculo.PrecioCierre,
                        PrecioVenta      : vehiculo.PrecioVenta,
                        cantidad         : 1,
                        sobrePrecio      : 0,
                        descuento        : 0,
                        subtotal         : 0,
                        nIdMoneda        : vehiculo.nIdMoneda,
                        nIdLinea         : vehiculo.nIdLinea,
                        nIdMarca         : vehiculo.nIdMarca,
                        nIdModelo        : vehiculo.nIdModelo
                    });

                    toastr.success('Se Agregó vehículo "'+ vehiculo.NombreComercial +'"');
                    this.cerrarModal();
                }
            },
            //Evalua el cambio del sobre Precio
            changeSobrePrecio(value){
                //Si existe descuento
                if (this.arrayVehiculo[0].descuento > 0) {
                    this.$message.error(`Primero borre el Descuento para generar el Sobre Precio`);
                    this.arrayVehiculo[0].sobrePrecio = 0;
                    this.$forceUpdate();
                } else {
                    if(value == ''){
                        this.arrayVehiculo[0].sobrePrecio = 0;
                    }
                    //Sino entonces calcular el 10% y evaluarlo con el sobre precio actual
                    this.flagLimiteSobrePrecio = this.arrayVehiculo[0].PrecioBase * 0.1;
                    if (value > this.flagLimiteSobrePrecio) {
                        this.$message.error(`El sobre precio (${value}) no puede superar el limite del 10% del Precio Base (${this.arrayVehiculo[0].PrecioBase})`);
                        this.arrayVehiculo[0].sobrePrecio = 0;
                        this.flagLimiteSobrePrecio = 0;
                        this.$forceUpdate();
                    } else {
                        if(value > (this.flagLimiteSobrePrecio/1.2) && value < this.flagLimiteSobrePrecio) {
                            this.$message.warning(`El sobre precio es (${value}), Se encuentra cerca del 10% del Precio Base (${this.flagLimiteSobrePrecio})`);
                        }
                    }
                    this.$forceUpdate();
                }
                this.$forceUpdate();
            },
            //Evalua el cambio de Dscto
            changeDscto(value){
                let me = this;
                if (this.arrayVehiculo[0].sobrePrecio > 0) {
                    this.$message.error(`Primero borre el Sobre Precio para generar el Descuento`);
                    this.arrayVehiculo[0].descuento = 0;
                    this.$forceUpdate();
                } else {
                    if(value == '' || value < 0){
                        this.arrayVehiculo[0].descuento = 0;
                    }
                    // //Si el SubTotal es menor que el Precio de Venta (PVP)
                    // if(parseFloat(this.arrayVehiculo[0].subtotal) < parseFloat(this.arrayVehiculo[0].PrecioVenta) ) {
                    //     // this.$message.error(`El descuento no puede superar el limite del PVP`);
                    //     // this.arrayVehiculo[0].descuento = 0;
                    //     // this.$forceUpdate();
                    //     this.$message.warning(`El descuento ${this.arrayVehiculo[0].subtotal} súperó el limite del PVP ${this.arrayVehiculo[0].PrecioVenta}`);
                    //     this.$forceUpdate();
                    // }

                    if((parseFloat(this.arrayVehiculo[0].subtotal) < parseFloat(this.arrayVehiculo[0].PrecioVenta)) && (parseFloat(this.arrayVehiculo[0].subtotal) > (parseFloat(this.arrayVehiculo[0].PrecioCierre)))) {
                        // this.$message.error(`El descuento no puede superar el limite del PVP`);
                        // this.arrayVehiculo[0].descuento = 0;
                        // this.$forceUpdate();
                        this.$message.warning(`El descuento ${this.arrayVehiculo[0].subtotal} súperó el limite del PVP ${this.arrayVehiculo[0].PrecioVenta}`);
                        this.$forceUpdate();
                    }

                    //Si el SubTotal es menor que el Precio de Cierre (Precio Real Vehiculo)
                    if(parseFloat(this.arrayVehiculo[0].subtotal) < parseFloat(this.arrayVehiculo[0].PrecioCierre) ) {
                        this.$message.warning(`El descuento ${this.arrayVehiculo[0].subtotal} súperó el limite del Precio de Cierre ${this.arrayVehiculo[0].PrecioCierre}`);
                        this.$forceUpdate();
                    }
                    this.$forceUpdate();
                }
                this.$forceUpdate();
            },
            encontrarVehiculo(vehiculo){
                var sw=0;
                this.arrayVehiculo.map(function (x) {
                    if(x.NombreComercial == vehiculo){
                        sw = true;
                    }
                });
                return sw;
            },
            removerVehiculoLista(index){
                this.$delete(this.arrayVehiculo, index);
                this.flagLimiteSobrePrecio = 0;
                this.fdscto01 = 0;
                this.fDx = 0;
                this.fdscto02 = 0;
                this.observacionDscto = '';
            },
            siguienteTabDCElementoVentaPorRegalar(){
                if(this.validarTabDCElementoVentaPorRegalar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab0401').removeClass('nav-link active');
                $('#tab0401').addClass('nav-link');
                $('#tab0402').removeClass('nav-link disabled');
                $('#tab0402').addClass('nav-link active');

                $('#TabDCVehiculo').removeClass('in active show');
                $('#TabDCElementoVentaPorRegalar').addClass('in active show');
                $('#TabDCElementoVenta').removeClass('in active show');
                $('#TabDCVerificarCampana').removeClass('in active show');
                $('#TabDCConfirmarCotizacion').removeClass('in active show');
                this.$nextTick(function () {
                    this.llenarObsequiosPorModelo();
                })
            },
            validarTabDCElementoVentaPorRegalar(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayVehiculo.length == 0){
                    this.mensajeError.push('Debe haber un vehiculo agregado');
                }

                if(parseInt(this.arrayVehiculo[0].sobrePrecio) === "" || parseInt(this.arrayVehiculo[0].sobrePrecio) < 0){
                    this.mensajeError.push('Sobre Precio debe tener un valor asignado (0 - 10% Precio Base)');
                    this.arrayVehiculo[0].sobrePrecio = 0;
                }
                if(parseInt(this.arrayVehiculo[0].descuento) === "" || parseInt(this.arrayVehiculo[0].descuento) < 0){
                    this.mensajeError.push('Dscto debe tener un valor asignado (0-limite permitido)');
                    this.arrayVehiculo[0].descuento = 0;
                }

                if(this.fdscto02 > 0){
                    if(!this.observacionDscto) {
                        this.mensajeError.push('Debe registrar una Observación de Dscto');
                    }
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ================================
            // SUBTAB ELEMENTO VENTA POR REGALAR
            // ================================
            llenarObsequiosPorModelo(){
                var url = this.ruta + '/gescotizacion/GetListObsequiosByVehiculo';
                axios.get(url, {
                    params: {
                        'nidproveedor'      : this.fillProveedor.nidproveedor,
                        'fecha'             : moment().format('YYYY-MM-DD'),
                        'nidcodigo'         : this.arrayVehiculo[0].nIdModelo,
                        'naniofabricacion'  : this.arrayVehiculo[0].AnioFabricacion,
                        'naniomodelo'       : this.arrayVehiculo[0].AnioModelo,
                        'tipo'              : 3
                    }
                }).then(response => {
                    this.arrayObsequiosByModelo  =  response.data;
                    this.$nextTick(function () {
                        this.llenarObsequio();
                    })
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarObsequio(){
                let me = this;
                let url = me.ruta + '/gescotizacion/GetListObsequioElementoVenta';

                this.arrayObsequio = []; //Setea array de campañas
                this.arrayObsequioEleVentaModal = [];//Setea array de elementos de venta del modal

                this.$nextTick(function () {
                    let me = this;
                    if(this.arrayObsequiosByModelo.length > 0){
                        this.arrayObsequiosByModelo.map(function(ec){
                            me.arrayObsequio.push({
                                nIdObsequio         : ec.nIdObsequio,
                                cNombreObsequio     : ec.cNombreObsequio,
                                dFechaInicio        : ec.dFechaInicio,
                                dFechaFin           : ec.dFechaFin,
                                fValorPresupuesto   : ec.fValorPresupuesto
                            });

                            axios.get(url, {
                                params: {
                                    'nidobsequio'  : ec.nIdObsequio
                                }
                            }).then(response => {
                                me.arrayObsequioEleVenta  =  response.data;
                                me.$nextTick(function () {
                                    me.llenarObsequioEleVenta();
                                })
                            }).catch(error => {
                                me.errors = error
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        location.reload('0');
                                    }
                                }
                            });
                        });
                    }
                })
            },
            llenarObsequioEleVenta(){
                this.$nextTick(function () {
                    let me = this;
                    if(this.arrayObsequioEleVenta.length > 0){
                        this.arrayObsequioEleVenta.map(function(eev){
                            me.arrayObsequioEleVentaModal.push({
                                nIdObsequio             : eev.nIdObsequio,
                                cNombreObsequio         : eev.cNombreObsequio,
                                nIdElementoVenta        : eev.nIdElementoVenta,
                                cNombre                 : eev.cNombre,
                                nIdMoneda               : eev.nIdMoneda,
                                cMonedaNombre           : eev.cMonedaNombre,
                                nIdObsequioElementoVenta  : eev.nIdObsequioElementoVenta,
                                fValorVenta             : eev.fValorVenta,
                                cantidad                : eev.nCantidad
                            });
                        });
                    }
                })
            },
            siguienteTabDCElementoVenta(){
                if(this.validarTabDCElementoVentaPorRegalar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab0401').removeClass('nav-link active');
                $('#tab0401').addClass('nav-link');
                $('#tab0402').removeClass('nav-link active');
                $('#tab0402').addClass('nav-link');
                $('#tab0403').removeClass('nav-link disabled');
                $('#tab0403').addClass('nav-link active');

                $('#TabDCVehiculo').removeClass('in active show');
                $('#TabDCElementoVentaPorRegalar').removeClass('in active show');
                $('#TabDCElementoVenta').addClass('in active show');
                $('#TabDCVerificarCampana').removeClass('in active show');
                $('#TabDCConfirmarCotizacion').removeClass('in active show');
            },
            // ======================
            // SUBTAB ELEMENTO VENTA
            // ======================
            cargarTipoElemento(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid': 110027
                    }
                }).then(response => {
                    this.arrayTipoElemento = response.data;
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            buscarElementoVenta(page){
                /*if(this.validarBuscarElementoVenta()){
                    return;
                }*/

                var url = this.ruta + '/gescotizacion/GetElementoByTipo';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidtipoelemen' : this.fillBusqTipoElemento.ntpoelemen,
                        'celementonombre': this.fillBusqTipoElemento.celementonombre,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayElementoVentaModal       =   response.data.arrayElementoVenta.data;
                    this.paginationModal.current_page  =   response.data.arrayElementoVenta.current_page;
                    this.paginationModal.total         =   response.data.arrayElementoVenta.total;
                    this.paginationModal.per_page      =   response.data.arrayElementoVenta.per_page;
                    this.paginationModal.last_page     =   response.data.arrayElementoVenta.last_page;
                    this.paginationModal.from          =   response.data.arrayElementoVenta.from;
                    this.paginationModal.to            =   response.data.arrayElementoVenta.to;
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarBuscarElementoVenta(){
                this.error = 0;
                this.mensajeError =[];

                /*if(this.fillBusqTipoElemento.ntpoelemen == 0 || this.fillBusqTipoElemento.ntpoelemen == ''){
                    this.mensajeError.push('Debe seleccionar un tipo de elemento de venta');
                }*/

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarPaginaTipoElementoVenta(page){
                this.pagination.current_page=page;
                this.buscarElementoVenta(page);
            },
            agregarElementoVentaLista(elemento){
                if(this.encontrarElementoVenta(elemento.cElemenNombre)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'El elemento de venta ya se encuentra agregado!',
                    })
                } else {
                    this.arrayElementoVenta.push({
                        cCodigoERP              : elemento.cCodigoERP,
                        cElemenNombre           : elemento.cElemenNombre,
                        cMonedaNombre           : elemento.cMonedaNombre,
                        cProveedorNombre        : elemento.cProveedorNombre,
                        cTipoElemenNombre       : elemento.cTipoElemenNombre,
                        fElemenValorMinimoVenta : elemento.fElemenValorMinimoVenta,
                        fElemenValorVenta       : elemento.fElemenValorVenta,
                        nIdElemento             : elemento.nIdElemento,
                        nIdMoneda               : elemento.nIdMoneda,
                        nIdProveedor            : elemento.nIdProveedor,
                        nIdTipoElemento         : elemento.nIdTipoElemento,
                        cantidad                : 1,
                        subtotal                : 0
                    });

                    /*toastr.options.progressBar = true;
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = "toast-top-full-width";*/
                    toastr.success('Se Agregó "'+ elemento.cElemenNombre +'" ');
                }
            },
            encontrarElementoVenta(elemento){
                var sw=0;
                this.arrayElementoVenta.map(function (x) {
                    if(x.cElemenNombre == elemento){
                        sw = true;
                    }
                });
                return sw;
            },
            removerElementoVentaLista(index){
                this.$delete(this.arrayElementoVenta, index);
            },
            siguienteTabDCVerificarCampania(){
                if(this.validarTabDCElementoVentaPorRegalar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab0402').removeClass('nav-link active');
                $('#tab0402').addClass('nav-link');
                $('#tab0403').removeClass('nav-link active');
                $('#tab0403').addClass('nav-link');
                $('#tab0404').removeClass('nav-link disabled');
                $('#tab0404').addClass('nav-link active');

                $('#TabDCVehiculo').removeClass('in active show');
                $('#TabDCElementoVentaPorRegalar').removeClass('in active show');
                $('#TabDCElementoVenta').removeClass('in active show');
                $('#TabDCVerificarCampana').addClass('in active show');
                $('#TabDCConfirmarCotizacion').removeClass('in active show');
                this.$nextTick(function () {
                    this.llenarCampaniasPorModeloVehiculo();
                })
            },
            // ======================
            // SUBTAB VERIFICAR CAMPAÑA
            // ======================
            llenarCampaniasPorModeloVehiculo(){
                var url = this.ruta + '/gescotizacion/GetListCampañasByVehiculo';
                axios.get(url, {
                    params: {
                        'nidproveedor'      : this.fillProveedor.nidproveedor,
                        'fecha'             : moment().format('YYYY-MM-DD'),
                        'nidcodigo'         : this.arrayVehiculo[0].nIdModelo,
                        'naniofabricacion'  : this.arrayVehiculo[0].AnioFabricacion,
                        'naniomodelo'       : this.arrayVehiculo[0].AnioModelo,
                        'tipo'              : 3
                    }
                }).then(response => {
                    this.arrayCampaniasByModelo  =  response.data;
                    this.$nextTick(function () {
                        //this.llenarCamapaniasPorMarcaVehiculo();
                        this.llenarEventoCampania();
                    })
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarEventoCampania(){
                let me = this;
                let url = me.ruta + '/gescotizacion/GetListEventoElementoVenta';

                this.arrayEventoCampania = []; //Setea array de campañas
                this.arrayEventoEleVentaModal = [];//Setea array de elementos de venta del modal

                this.$nextTick(function () {
                    let me = this;
                    if(this.arrayCampaniasByModelo.length > 0){
                        this.arrayCampaniasByModelo.map(function(ec){
                            me.arrayEventoCampania.push({
                                nIdEventoCampania       : ec.nIdEventoCampania,
                                cNombreEventoCampania   : ec.cNombreEventoCampania,
                                nIdTipoEvento           : ec.nIdTipoEvento,
                                TipoEvento              : ec.TipoEvento,
                                dFechaInicio            : ec.dFechaInicio,
                                dFechaFin               : ec.dFechaFin,
                                fValorPresupuesto       : ec.fValorPresupuesto
                            });

                            axios.get(url, {
                                params: {
                                    'fecha'  : moment().format('YYYY-MM-DD'),
                                    'nideventocampania'  : ec.nIdEventoCampania
                                }
                            }).then(response => {
                                me.arrayEventoEleVenta  =  response.data;
                                me.$nextTick(function () {
                                    me.llenarEventoEleVenta();
                                })
                            }).catch(error => {
                                me.errors = error
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        location.reload('0');
                                    }
                                }
                            });
                        });
                    }
                    /*if(this.arrayCampaniasByMarca.length > 0){
                        this.arrayCampaniasByMarca.map(function(ec){
                            me.arrayEventoCampania.push({
                                nIdEventoCampania       : ec.nIdEventoCampania,
                                cNombreEventoCampania   : ec.cNombreEventoCampania,
                                nIdTipoEvento           : ec.nIdTipoEvento,
                                TipoEvento              : ec.TipoEvento,
                                dFechaInicio            : ec.dFechaInicio,
                                dFechaFin               : ec.dFechaFin,
                                fValorPresupuesto       : ec.fValorPresupuesto
                            });

                            axios.get(url, {
                                params: {
                                    'fecha'  : moment().format('YYYY-MM-DD'),
                                    'nideventocampania'  : ec.nIdEventoCampania
                                }
                            }).then(response => {
                                me.arrayEventoEleVenta  =  response.data;
                                me.$nextTick(function () {
                                    me.llenarEventoEleVenta();
                                })
                            }).catch(error => {
                                this.errors = error
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        location.reload('0');
                                    }
                                }
                            });
                        });
                    }
                    if(this.arrayCampaniasByLinea.length > 0){
                        this.arrayCampaniasByLinea.map(function(ec){
                            me.arrayEventoCampania.push({
                                nIdEventoCampania       : ec.nIdEventoCampania,
                                cNombreEventoCampania   : ec.cNombreEventoCampania,
                                nIdTipoEvento           : ec.nIdTipoEvento,
                                TipoEvento              : ec.TipoEvento,
                                dFechaInicio            : ec.dFechaInicio,
                                dFechaFin               : ec.dFechaFin,
                                fValorPresupuesto       : ec.fValorPresupuesto
                            });

                            axios.get(url, {
                                params: {
                                    'fecha'  : moment().format('YYYY-MM-DD'),
                                    'nideventocampania'  : ec.nIdEventoCampania
                                }
                            }).then(response => {
                                me.arrayEventoEleVenta  =  response.data;
                                me.$nextTick(function () {
                                    me.llenarEventoEleVenta();
                                })
                            }).catch(error => {
                                me.errors = error
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        location.reload('0');
                                    }
                                }
                            });
                        });
                    }*/
                })
            },
            llenarEventoEleVenta(){
                this.$nextTick(function () {
                    let me = this;
                    if(this.arrayEventoEleVenta.length > 0){
                        this.arrayEventoEleVenta.map(function(eev){
                            me.arrayEventoEleVentaModal.push({
                                nIdEventoCampania       : eev.nIdEventoCampania,
                                cNombreEventoCampania   : eev.cNombreEventoCampania,
                                nIdElementoVenta        : eev.nIdElementoVenta,
                                cNombre                 : eev.cNombre,
                                nIdMoneda               : eev.nIdMoneda,
                                cMonedaNombre           : eev.cMonedaNombre,
                                nIdEventoElementoVenta  : eev.nIdEventoElementoVenta,
                                fValorVenta             : eev.fValorVenta,
                                cantidad                : eev.nCantidad,
                                nStock                  : eev.nStock
                            });
                        });
                    }
                })
            },
            removerElementoVentaCampania(index){
                this.$delete(this.arrayEventoEleVentaModal, index);
            },
            // ======================
            // SUBTAB CONFIRMAR COTIZACIÓN
            // ======================
            llenarDetalleConfirmacion(){
                let me = this;

                //Setear arrays vacío
                me.arrayConfiCotiVehiculo = [];//Seteo array detalle de vehiculos
                me.arrayConfiCotiObsequios = []//Seteo array de ele venta por regalar
                me.arrayConfiCotiEleVenta = [];//Seteo array detalle de ele venta
                me.arrayConfiCotiEventoEleVenta = [];//Seteo array detalle ele venta de campaña
                me.arrayMontosCotizacion = [];//Seteo array de totales calculados

                // ======================
                // DETALLE VEHÍCULO
                // ======================
                me.arrayVehiculo.map(function (v) {
                    me.arrayConfiCotiVehiculo.push({
                        codigo       : v.codListaPrecioVD,
                        detalle      : v.NombreComercial,
                        cantidad     : v.cantidad,
                        sobreprecio  : v.sobrePrecio,
                        dscto        : v.descuento,
                        preciofinal  : v.PrecioBase,
                        subtotal     : v.subtotal,
                        nidmoneda    : v.nIdMoneda,
                        flagTipoItem : 'V',
                        flagactivaregalo : 'N'
                    });
                });
                //ALMACENO EL MONTO TOTAL DEL VEHICULO EN EL ARRAY, PARA ACUMULARLO
                me.arrayMontosCotizacion.push({
                    monto: me.montoTotalVehiculoDolar
                });

                // ====================================
                // DETALLE ELEMENTO VENTA POR REGALAR
                // ====================================
                if(me.arrayObsequioEleVentaModal.length > 0){
                    me.arrayObsequioEleVentaModal.map(function(ev){
                        me.arrayConfiCotiObsequios.push({
                            codigoEV     : ev.nIdElementoVenta,
                            codigoOBS     : ev.nIdObsequio,
                            codigoOEV    : ev.nIdObsequioElementoVenta,
                            nombreEV     : ev.cNombre,
                            nombreOBS    : ev.cNombreObsequio,
                            cantidad     : ev.cantidad,
                            dscto        : 0,
                            preciofinal  : ev.fValorVenta,
                            flagTipoItem : 'E',
                            flagactivaregalo : 'S',
                            nidmoneda    : ev.nIdMoneda,
                            monedanombre : ev.cMonedaNombre
                        });
                    });
                }

                // ======================
                // DETALLE ELEMENTO VENTA
                // ======================
                if(me.arrayElementoVenta.length > 0){
                    me.arrayElementoVenta.map(function(ev){
                        me.arrayConfiCotiEleVenta.push({
                            codigo       : ev.nIdElemento,
                            detalle      : ev.cElemenNombre,
                            cantidad     : ev.cantidad,
                            dscto        : 0,
                            preciofinal  : ev.fElemenValorVenta,
                            subtotal     : ev.subtotal,
                            flagTipoItem : 'E',
                            flagactivaregalo : 'N',
                            nidmoneda    : ev.nIdMoneda,
                            monedanombre : ev.cMonedaNombre
                        });
                    });
                    //ALMACENO EL MONTO TOTAL DEL ELE VENTA EN EL ARRAY, PARA ACUMULARLO
                    me.arrayMontosCotizacion.push({
                        monto: me.montoTotalElementoVenta
                    });
                }

                // ======================
                // DETALLE CAMPAÑA ELEMENTO VENTA
                // ======================
                if(me.arrayEventoEleVentaModal.length > 0){
                    me.arrayEventoEleVentaModal.map(function(ev){
                        me.arrayConfiCotiEventoEleVenta.push({
                            codigoEV     : ev.nIdElementoVenta,
                            codigoEC     : ev.nIdEventoCampania,
                            codigoEEV    : ev.nIdEventoElementoVenta,
                            nombreEV     : ev.cNombre,
                            nombreEC     : ev.cNombreEventoCampania,
                            cantidad     : ev.cantidad,
                            dscto        : 0,
                            preciofinal  : ev.fValorVenta,
                            flagTipoItem : 'E',
                            flagactivaregalo : 'N',
                            nidmoneda    : ev.nIdMoneda,
                            monedanombre : ev.cMonedaNombre
                        });
                    });
                }
            },
            registrarCotizacion(){
                if(this.validarRegistrarCotizacion()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/gescotizacion/SetCabeceraCotizacion';
                axios.post(url, {
                    'nIdAsignacionContactoVendedor' :   parseInt(this.fillAsignarContacto.nidasignarcontacto),
                    'cNumeroCotizacion'             :   'COT-001',
                    'nIdEmpresa'                    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal'                   :   parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nIdContacto'                   :   this.fillAsignarContacto.nidcontacto,
                    'nIdReferencia'                 :   1300129,
                    'dFechaCotizacion'              :   moment().format('YYYY-MM-DD'),
                    'dFechaVencimientoCotizacion'   :   moment().add(7, 'days').format('YYYY-MM-DD'),
                    'fTipoCambioVenta'              :   this.fValorTipoCambioVenta,
                    'fTipoCambioCompra'             :   this.fValorTipoCambioCompra,
                    'fTipoCambioComercial'          :   this.fValorTipocambioComercial,
                    'fTotalCotizacionVehiculoDolar' :   this.montoTotalConfiCotiVehiculo,
                    'fTotalCotizacionVehiculoSol'   :   this.montoTotalConfiCotiVehiculoSoles,
                    'fTotalElementoVentaDolar'      :   this.montoTotalConfiCotiEleVenta,
                    'fTotalElementoVentaSol'        :   this.montoTotalConfiCotiEleVentaSoles,
                    'cGlosa'                        :   this.observacionDscto,
                    'nIdSubLinea'                   :   this.fillAsignarContacto.nidsublinea
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1){
                        this.registrarDetalleCotizacion(response.data[0].nIdCabeceraCotizacion);
                    }else{
                        swal('EXISTE COTIZACION ACTIVA A ESTA REFERENCIA');
                    }
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            registrarDetalleCotizacion(nIdCabeCoti){
                if(this.arrayVehiculo.length > 0){
                    var url = this.ruta + '/gescotizacion/SetDetalleCotizacion';
                    axios.post(url, {
                        nIdCabeCoti: nIdCabeCoti,
                        fTipoCambioComercial: this.fValorTipocambioComercial,
                        fdscto02: this.fdscto02,
                        fdscto03: this.fdscto03,
                        arrayvehiculos: this.arrayConfiCotiVehiculo,
                        arrayobsequios: this.arrayConfiCotiObsequios,
                        arrayelemventa: this.arrayConfiCotiEleVenta,
                        arrayeventoeleventa: this.arrayConfiCotiEventoEleVenta
                    }).then(response => {
                        // ADV cuando existen solo promociones y/o obsequios
                        // GERENCIA cuando existen solo dscto
                        if (response.data.contAprobacionGerencia > 0){
                            this.cambiarEstadoCotizacion(response.data.nIdCabeceraCotizacion, 2);
                            this.generarCotizacionPDF(nIdCabeCoti);
                            swal('Cotización generada exitosamente, pendiente de Aprobación');
                        } else {
                            if (response.data.contAprobacionADV > 0) {
                                this.cambiarEstadoCotizacion(response.data.nIdCabeceraCotizacion, 2);
                                this.generarCotizacionPDF(nIdCabeCoti)
                                swal('Cotización generada exitosamente, pendiente de Aprobación');
                            } else {
                                this.cambiarEstadoCotizacion(response.data.nIdCabeceraCotizacion, 1);
                                this.generarCotizacionPDF(nIdCabeCoti)
                                swal('Cotización generada y aprobada exitosamente');
                            }
                        }
                        /*
                            if (response.data.arrayDatosCotizacion[0].cFlagSuperaDescuento == 'N'){
                                //GENERAR LA APROBACION DE LA COTIZACIÓN DE MANERA AUTOMATICA
                                this.cambiarEstadoCotizacion(response.data.arrayDatosCotizacion[0].nIdCabeceraCotizacion, 1);
                                swal('Cotización generada y aprobada exitosamente');
                            } else {
                                this.cambiarEstadoCotizacion(response.data.arrayDatosCotizacion[0].nIdCabeceraCotizacion, 2);
                                swal('Cotización generada exitosamente, pendiente de Aprobación');
                            }
                        */
                    }).catch(error => {
                        console.log(error);
                        if (error.response) {
                            if (error.response.status == 401) {
                                location.reload('0');
                            }
                        }
                    });
                }
            },
            generarCotizacionPDF(nIdCabeCoti){
                var config = {
                    responseType: 'blob'
                };
                var url = this.ruta + '/getcotizacion/GetDetalleCotizacion';
                axios.post(url, {
                    'nIdEmpresa'            :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal'           :   parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nIdCabeceraCotizacion' :   nIdCabeCoti
                }, config).then(response => {
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
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarEstadoCotizacion(nIdCabeceraCotizacion, op){
                var url = this.ruta + '/setcotizacion/SetCambiarEstadoCotizacion';
                axios.put(url, {
                    nIdCabeceraCotizacion: nIdCabeceraCotizacion,
                    opcion: op,
                }).then(response => {
                    console.log(response);
                    this.limpiarProcesoCotizacion();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validarRegistrarCotizacion(){
                this.error = 0;
                this.mensajeError =[];

                if(this.arrayVehiculo.length == 0){
                    this.mensajeError.push('Debe haber un vehiculo agregado');
                }

                if(this.fdscto02 > 0){
                    if(!this.observacionDscto) {
                        this.mensajeError.push('Debe registrar una Observación de Dscto');
                    }
                }

                if(!this.fillAsignarContacto.nidcontacto){
                    this.mensajeError.push('Debe asignar un contacto');
                };
                if(!this.fillAsignarContacto.nidsublinea){
                    this.mensajeError.push('Debe seleccionar una SubLinea');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cancelarCotizacion(){
                this.limpiarProcesoCotizacion();
            },
            limpiarProcesoCotizacion(){
                //Tab Asignar Cotización
                this.fillAsignarContacto.ccontacto = '';
                this.fillAsignarContacto.cdireccion = '';
                this.fillAsignarContacto.cemail = '';
                this.fillAsignarContacto.cnrodocumento = '';
                this.fillAsignarContacto.nidasignarcontacto = '';
                this.fillAsignarContacto.nidcontacto = '';
                this.fillAsignarContacto.nidreferencia = '';
                this.arrayReferenciavehiculo = [];
                //Tab Detalle Cotización
                this.fillProveedor.cproveedornombre = '';
                this.fillProveedor.nidproveedor = '';
                this.fillBusqVehiculo.cinfotipolista = '';
                this.fillBusqVehiculo.cnombrecomercial = '';
                this.fillBusqVehiculo.nidlinea = '';
                this.fillBusqVehiculo.nidmarca = '';
                this.fillBusqVehiculo.nidmodelo = '';
                this.fillBusqVehiculo.nidtipolista = '';

                this.arrayVehiculo = [];
                this.arrayObsequio = [];
                this.arrayElementoVenta = [];
                this.arrayEventoEleVenta= [];
                this.arrayEventoEleVentaModal= [];

                this.arrayMontosCotizacion = [];
                this.arrayConfiCotiVehiculo = [];
                this.arrayConfiCotiObsequios = [];
                this.arrayConfiCotiEleVenta = [];
                this.arrayConfiCotiEventoEleVenta = [];

                this.montoTotalVehiculoDolar = 0;
                this.montoTotalVehiculoSoles = 0;
                this.montoTotalElementoVentaPorRegalar = 0;
                this.montoTotalElementoVentaPorRegalarSoles = 0;
                this.montoTotalElementoVenta = 0;
                this.montoTotalElementoVentaSoles = 0;
                this.montoTotalEventoElementoVenta= 0;
                this.montoTotalEventoElementoVentaSoles= 0;

                this.montoTotalConfiCotiVehiculo = 0;
                this.montoTotalConfiCotiVehiculoSoles = 0;
                this.montoTotalConfiCotiObsequios = 0;
                this.montoTotalConfiCotiObsequiosSoles = 0;
                this.montoTotalConfiCotiEleVenta = 0;
                this.montoTotalConfiCotiEleVentaSoles = 0;
                this.montoTotalCotizacion = 0;
                this.montoTotalCotizacionSoles = 0;
                this.montoTotalConfiCotiEventoEleVenta= 0;
                this.montoTotalConfiCotiEventoEleVentaSoles= 0;

                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link active');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link');
                $('#tab04').removeClass('nav-link active');
                $('#tab04').addClass('nav-link disabled');

                $('#TabCotizacion').addClass("in active show");
                $('#TabAsignarContacto').removeClass('in active show');
                $('#TabDetalleCotizacion').removeClass('in active show');

                $('#tab0401').removeClass('nav-link');
                $('#tab0401').addClass('nav-link active');
                $('#tab0402').removeClass('nav-link active');
                $('#tab0402').addClass('nav-link disabled');
                $('#tab0403').removeClass('nav-link active');
                $('#tab0403').addClass('nav-link disabled');
                $('#tab0404').removeClass('nav-link active');
                $('#tab0404').addClass('nav-link disabled');
                $('#tab0405').removeClass('nav-link active');
                $('#tab0405').addClass('nav-link disabled');

                $('#TabDCVehiculo').addClass('in active show');
                $('#TabDCElementoVentaPorRegalar').removeClass('in active show');
                $('#TabDCElementoVenta').removeClass('in active show');
                $('#TabDCVerificarCampana').removeClass('in active show');
                $('#TabDCConfirmarCotizacion').removeClass('in active show');
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "contacto":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.arrayContactosPorVendedor = [];
                                this.accionmodal=2;
                                this.modal = 1;
                                //this.buscarContactosPorVendedor(1);
                                break;
                            }
                            break;
                            case 'asignar':
                            {
                                (this.fillBusqContacto.ntipopersona) == 1 ?
                                        this.fillAsignarContacto.ccontacto = data['cContacto'] :
                                        this.fillAsignarContacto.ccontacto = data['cRazonSocial'];
                                this.fillAsignarContacto.nidcontacto = data['nIdContacto'];
                                // this.fillAsignarContacto.ccontacto = data['cContacto'];
                                this.fillAsignarContacto.cnrodocumento = data['cNumeroDocumento'];
                                this.fillAsignarContacto.cdireccion = data['cDireccion'];
                                this.fillAsignarContacto.cemail = data['cEmail'];
                                this.tabAsignarContacto();
                                this.cerrarModal();
                                break;
                            }
                        }
                    }
                    break;
                    case "proveedor":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarProveedores(1);
                                break;
                            }
                        }
                    }
                    break;
                    case 'vehiculo':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                if(this.validarBotonBuscarVehiculo()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }
                                this.accionmodal=4;
                                this.modal = 1;
                                this.llenarTipoLista();
                                this.llenarComboLinea();
                                break;
                            }
                        }
                    }
                    break;
                    case 'elementoventa':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=5;
                                this.modal = 1;
                                this.arrayElementoVentaModal = [];
                                this.cargarTipoElemento();
                            }
                        }
                    }
                    break;
                    case 'elementoventaPorRegalar':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=7;
                                this.modal = 1;
                                this.arrayElementoVentaModalPorRegalar = [];
                                this.cargarTipoElemento();
                            }
                        }
                    }
                    case 'campaña':
                    {
                        switch(accion){
                            case 'detalle':
                            {
                                this.fillEventoCampania.cNombreEventoCampania = data['cNombreEventoCampania'];
                                this.fillEventoCampania.TipoEvento = data['TipoEvento'];
                                this.fillEventoCampania.nIdEventoCampania = data['nIdEventoCampania'];
                                this.accionmodal=6;
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
                                this.accionmodal=8;
                                this.modal = 1;
                                this.verCotizacion(data);
                                break;
                            }
                        }
                    }
                    break;
                    case 'obsequio':
                    {
                        switch(accion){
                            case 'detalle':
                            {
                                this.fillObsequio.cNombreObsequio = data['cNombreObsequio'];
                                this.fillObsequio.nIdObsequio = data['nIdObsequio'];
                                this.accionmodal=9;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                }
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
            //Cerrar Modal
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                //this.limpiarPaginacion();
                //this.limpiarPaginacionModal();
                //SubTab - Modal Vehiculo
                this.arrayProveedor = [];
                this.arrayVehiculoModal = [];
                //SubTab - Modal Elemento Venta
                this.arrayElementoVentaModal = [];
            },
            siguienteTabDConfirmarcotizacion(){
                if(this.validarTabDCElementoVentaPorRegalar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab0401').removeClass('nav-link active');
                $('#tab0401').addClass('nav-link');
                $('#tab0402').removeClass('nav-link active');
                $('#tab0402').addClass('nav-link');
                $('#tab0403').removeClass('nav-link active');
                $('#tab0403').addClass('nav-link');
                $('#tab0404').removeClass('nav-link active');
                $('#tab0404').addClass('nav-link');
                $('#tab0405').removeClass('nav-link disabled');
                $('#tab0405').addClass('nav-link active');

                $('#TabDCVehiculo').removeClass('in active show');
                $('#TabDCElementoVentaPorRegalar').removeClass('in active show');
                $('#TabDCElementoVenta').removeClass('in active show');
                $('#TabDCVerificarCampana').removeClass('in active show');
                $('#TabDCConfirmarCotizacion').addClass('in active show');

                this.llenarDetalleConfirmacion();
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            }
        }
    }
</script>

<style>
    .datos{
        opacity: 0 !important;
        display: none;
    }
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
    .direction-money{
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        flex-direction: column;
    }
    .centrarbtn{
        display: flex;
        justify-content: center;
    }
    .flex-rigth-margin{
        display: flex;
        justify-content: space-around;
        align-content: space-around;
        flex-direction: column;
        align-items: flex-end;
        margin-right: 2rem;
    }
    .widthFull>.el-select>.el-input {
        width: 100%;
    }
</style>


