<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom"> AUTORIZACIÓN</h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab01" href="#TabMisSolicitudes" role="tab" @click.prevent="tabMisSolicitudes" data-toggle="tab">
                                            <i class="fa fa-search"></i> MIS SOLICITUDES
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab02" href="#TabNuevaSolicitud" @click.prevent="tabNuevaSolicitud" role="tab" data-toggle="tab">
                                            <i class="fa fa-list-alt"></i> NUEVA SOLICITUD
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabMisSolicitudes">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">MIS SOLICITUDES</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-md-8 offset-md-1">
                                                                        <div class="row">
                                                                            <label class="col-md-4 form-control-label">
                                                                                <el-radio-group v-model="fillBusquedaSolicitud.nidtipobusqueda" @change="cambiarVehiculoByCriterio">
                                                                                    <el-radio v-for="tipobsq in arrayTipoBusquedaVehiculo" :key="tipobsq.id" :label="tipobsq.value"> {{ tipobsq.text }} </el-radio>
                                                                                </el-radio-group>
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="fillBusquedaSolicitud.cnrovehiculo" disabled="disabled" placeholder="Busque en base a un criterio" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Por Vin o Placa </div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('vehiculo','buscar', 1)">
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
                                                                            <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillBusquedaSolicitud.dfechainicio"
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
                                                                                    v-model="fillBusquedaSolicitud.dfechafin"
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
                                                                            <label class="col-sm-4 form-control-label">Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="fillBusquedaSolicitud.cnombrecontacto" disabled="disabled" placeholder="Seleccione un Contacto" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Contacto </div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('contacto','buscar', 1)">
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
                                                                            <label class="col-sm-4 form-control-label">*Estado</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillBusquedaSolicitud.nidestado"
                                                                                        filterable
                                                                                        clearable
                                                                                        loading-text
                                                                                        placeholder="SELECCIONE">
                                                                                    <el-option
                                                                                        v-for="estado in arrayEstado"
                                                                                        :key="estado.nIdPar"
                                                                                        :label="estado.cParNombre"
                                                                                        :value="estado.nIdPar">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="buscarMisSolicitudes(1)">
                                                                            <i class="fa fa-search"></i> Buscar
                                                                        </button>
                                                                        <button type="button" class="btn btn-default btn-corner btn-sm" @click.prevent="limpiarMisSolicitudes()">
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
                                                            <form class="form-horizontal">
                                                                <div class="col-lg-12">
                                                                    <template v-if="arrayMisSolicitudes.length">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Fecha</th>
                                                                                        <th>Tipo</th>
                                                                                        <th>N° Solicitud</th>
                                                                                        <th>Contacto</th>
                                                                                        <th>VIN/Placa</th>
                                                                                        <th>Estado</th>
                                                                                        <th>Responsable</th>
                                                                                        <th>Acciones</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="carta in arrayMisSolicitudes" :key="carta.nIdSolicitudAutorizacion">
                                                                                        <td v-text="carta.cFechaSolicitud"></td>
                                                                                        <td v-text="carta.cTipoSolicitud"></td>
                                                                                        <td v-text="carta.cNroSolicitud"></td>
                                                                                        <td v-text="carta.cContacto"></td>
                                                                                        <td v-text="carta.cNroVehiculo"></td>
                                                                                        <td v-text="carta.cEstado"></td>
                                                                                        <template v-if="carta.cEstadoEvolucion == ''">
                                                                                            <td>------</td>
                                                                                        </template>
                                                                                        <template v-else>
                                                                                            <td v-text="carta.cEstadoEvolucion"></td>
                                                                                        </template>
                                                                                        <td>
                                                                                            <a :href="carta.cRutaDocumento"
                                                                                                        v-if="carta.cFlagEstadoAutorizacionControl != 'P '"
                                                                                                            target="_blank">
                                                                                                <i class='fa-md fa fa-file'></i>
                                                                                            </a>
                                                                                        </td>
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
                                                                                                <a @click.prevent="cambiarPaginaMiSolicitudes(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                            </li>
                                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                            :class="[page==isActived?'active':'']">
                                                                                                <a class="page-link"
                                                                                                href="#" @click.prevent="cambiarPaginaMiSolicitudes(page)"
                                                                                                v-text="page"></a>
                                                                                            </li>
                                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                <a @click.prevent="cambiarPaginaMiSolicitudes(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade " id="TabNuevaSolicitud">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="tab0201" href="#TabDatosSolictud" @click.prevent="tabDatosSolicitud" role="tab" data-toggle="tab">
                                                                <i class="fa fa-car"></i> DATOS SOLICITUD
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="tab0202" href="#TabDatosVehiculo" role="tab" data-toggle="tab">
                                                                <i class="fa fa fa-user"></i> DATOS VEHÍCULO
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane fade in active show" id="TabDatosSolictud">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <form class="form-horizontal">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Fecha</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-date-picker
                                                                                                v-model="fillNuevaSolicitud.dfechasolicitud"
                                                                                                value-format="yyyy-MM-dd"
                                                                                                format="dd/MM/yyyy"
                                                                                                type="date"
                                                                                                placeholder="dd/mm/aaaa">
                                                                                            </el-date-picker>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Tipo Solicitud</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="fillNuevaSolicitud.nidtiposolicitud"
                                                                                                        @change="tipoBusquedaVehiculoPorTipoSolicitud"
                                                                                                        filterable
                                                                                                        clearable
                                                                                                        placeholder="SELECCIONE">
                                                                                                <el-option
                                                                                                v-for="item in arrayTipoSolicitudes"
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
                                                                                        <label class="col-sm-4 form-control-label">* Enviar a</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input
                                                                                                placeholder="Enviar a "
                                                                                                v-model="fillNuevaSolicitud.cnombrejefeinmediato"
                                                                                                :disabled="true"
                                                                                                clearable>
                                                                                            </el-input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-8 form-control-label">* La Autorización Requiere Contacto ?</label>
                                                                                        <div class="col-sm-4">
                                                                                            <el-checkbox v-model="checked" @change="updateEstadoChecked" :label="checked ? 'No' : 'Si'"></el-checkbox>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                                        <div class="col-sm-8" :class="[checked ? 'disabled' : '']">
                                                                                            <el-row>
                                                                                                <div class="input-group" :class="[checked ? 'disabled' : '']">
                                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                        <div slot="content">Buscar Contacto</div>
                                                                                                        <el-input placeholder="Seleccione un Contacto" v-model="fillNuevaSolicitud.cnombrecontacto" :disabled="true" class="input-with-select" :clearable="true">
                                                                                                            <el-button slot="append" icon="el-icon-search"  @click="abrirModal('contacto','buscar', 2)"></el-button>
                                                                                                        </el-input>
                                                                                                    </el-tooltip>
                                                                                                </div>
                                                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                    <div slot="content">Nuevo Contacto </div>
                                                                                                    <el-button type="primary" icon="el-icon-circle-plus"  @click="abrirModal('contacto','nuevo', 110026)" circle></el-button>
                                                                                                </el-tooltip>
                                                                                            </el-row>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row" v-if="checked">
                                                                                <div class="col-md-9 offset-md-5">
                                                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="activarTab0202('')">
                                                                                        <i class="fa fa-arrow-right"></i> Siguiente
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
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
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr v-for="r in arrayReferenciavehiculo" :key="r.nIdReferenciaVehiculoContacto">
                                                                                            <td>
                                                                                                <el-tooltip class="item" effect="dark" placement="left-start">
                                                                                                    <div slot="content">Ir a Datos Vehículo</div>
                                                                                                    <i @click="activarTab0202(r.nIdAsignacionContactoVendedor)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                                                </el-tooltip>
                                                                                            </td>
                                                                                            <td v-text="r.cProveedorNombre"></td>
                                                                                            <td v-text="r.cLineaNombre"></td>
                                                                                            <td v-text="r.cMarcaNombre"></td>
                                                                                            <td v-text="r.cModeloNombre"></td>
                                                                                            <td v-text="r.nAnioFabricacion"></td>
                                                                                            <td v-text="r.nAnioModelo"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </template>
                                                                        <template v-else>
                                                                            <el-alert
                                                                                title="No se encuentran referencias"
                                                                                type="warning">
                                                                            </el-alert>
                                                                        </template>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade in active show" id="TabDatosVehiculo">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <form class="form-horizontal">
                                                                            <div class="form-group row">
                                                                                <div class="col-md-8 offset-md-1">
                                                                                    <div class="row">
                                                                                        <label class="col-md-4 form-control-label">
                                                                                            <el-radio-group v-model="fillNuevaSolicitud.nidtipobusqueda" @change="cambiarVehiculoByCriterio">
                                                                                                <el-radio v-for="tipobsq in arrayTipoBusquedaVehiculoTDV" :key="tipobsq.nIdTipoPar" :label="tipobsq.nDatoParNumerico">{{ tipobsq.cDatoParDescripcion }}</el-radio>
                                                                                            </el-radio-group>
                                                                                        </label>
                                                                                        <div class="col-md-8">
                                                                                            <div class="input-group">
                                                                                                <input type="text" v-model="fillNuevaSolicitud.cnrovehiculo" disabled="disabled" placeholder="Busque en base a un criterio" class="form-control form-control-sm">
                                                                                                <div class="input-group-prepend">
                                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                        <div slot="content">Buscar Por Vin o Placa </div>
                                                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('vehiculo','buscar', 2)">
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
                                                                                        <label class="col-sm-4 form-control-label">* Lugar de Partida</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input
                                                                                                placeholder="Eje: Panamericana Nte. 4200, José Leonardo Ortiz"
                                                                                                v-model="fillNuevaSolicitud.clugarpartida"
                                                                                                clearable>
                                                                                            </el-input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Lugar de Llegada</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input
                                                                                                placeholder="Eje: M. Grau, Chiclayo "
                                                                                                v-model="fillNuevaSolicitud.clugarllegada"
                                                                                                clearable>
                                                                                            </el-input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">*Fecha Movimiento</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-date-picker
                                                                                                v-model="fillNuevaSolicitud.dfechamovimiento"
                                                                                                value-format="yyyy-MM-dd"
                                                                                                format="dd/MM/yyyy"
                                                                                                type="date"
                                                                                                placeholder="dd/mm/aaaa">
                                                                                            </el-date-picker>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Hora Movimiento</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-time-picker
                                                                                                v-model="fillNuevaSolicitud.choraMovimiento"
                                                                                                value-format="HH:mm"
                                                                                                :picker-options="{
                                                                                                    format: 'AM/PM'
                                                                                                }"
                                                                                                placeholder="Hora de Movimiento">
                                                                                            </el-time-picker>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-2 form-control-label">* Observación</label>
                                                                                        <div class="col-sm-10">
                                                                                            <el-input
                                                                                                type="textarea"
                                                                                                autosize
                                                                                                placeholder="Detalle la observación"
                                                                                                v-model="fillNuevaSolicitud.cobservacion">
                                                                                            </el-input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <label class="col-md-4 form-control-label">*¿Quien va a mover el vehículo?</label>
                                                                                        <div class="col-md-8">
                                                                                            <el-select v-model="fillNuevaSolicitud.nidmovervehiculo"
                                                                                                    filterable
                                                                                                    clearable
                                                                                                    loading-text
                                                                                                    placeholder="SELECCIONE">
                                                                                                <el-option
                                                                                                    v-for="movervehiculo in arrayMoverVehiculo"
                                                                                                    :key="movervehiculo.nIdPar"
                                                                                                    :label="movervehiculo.cParNombre"
                                                                                                    :value="movervehiculo.nIdPar">
                                                                                                </el-option>
                                                                                            </el-select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-9 offset-md-5">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="registrarAutorizacion">
                                                                                        <i class="fa fa-save"></i> Registrar
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

            <!-- Modal Buscar Vehiculos -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">BUSQUEDA VEHICULO POR {{ (fillBusquedaSolicitud.nidtipobusqueda == 1) ? 'VIN' : 'PLACA' }} </h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Vin o Placa</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="modalVehiculo.cnrovehiculo" @keyup.enter="listarVehiculo(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" title="Buscar Vehiculos" class="btn btn-info btn-corner btn-sm" @click="listarVehiculo(1);">
                                                                        <i class="fa-lg fa fa-search"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayVehiculosByCriterio.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <template v-if="flagBuscarVehiculoByCriterio == 1">
                                                        <template v-if="fillBusquedaSolicitud.nidtipobusqueda == 1">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>VIN</th>
                                                                    <th>Nombre Comercial</th>
                                                                    <th>Año Fab.</th>
                                                                    <th>Año Modelo</th>
                                                                    <th>Periodo</th>
                                                                    <th>Linea</th>
                                                                    <th>Forma de Pago</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="vehiculo in arrayVehiculosByCriterio" :key="vehiculo.cNumeroVin">
                                                                    <td>
                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                            <div slot="content">Seleccionar {{ vehiculo.cNumeroVin }}</div>
                                                                            <i @click="asignarVehiculo(vehiculo)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                        </el-tooltip>
                                                                    </td>
                                                                    <td v-text="vehiculo.cNumeroVin"></td>
                                                                    <td v-text="vehiculo.cNombreComercial"></td>
                                                                    <td v-text="vehiculo.nAnioFabricacion"></td>
                                                                    <td v-text="vehiculo.nAnioVersion"></td>
                                                                    <td>{{ vehiculo.cMes }} / {{ vehiculo.cAnio }}</td>
                                                                    <td v-text="vehiculo.cNombreLinea"></td>
                                                                    <td v-text="vehiculo.cFormaPago"></td>
                                                                </tr>
                                                            </tbody>
                                                        </template>
                                                        <template v-else>
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>Placa</th>
                                                                    <th>Nombre Comercial</th>
                                                                    <th>Año Fab.</th>
                                                                    <th>Año Modelo</th>
                                                                    <th>Periodo</th>
                                                                    <th>Linea</th>
                                                                    <th>Forma de Pago</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="vehiculo in arrayVehiculosByCriterio" :key="vehiculo.cPlaca">
                                                                    <td>
                                                                        <a href="#" @click="asignarVehiculo(vehiculo)" data-toggle="tooltip">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="vehiculo.cPlaca"></td>
                                                                    <td v-text="vehiculo.cNombreComercial"></td>
                                                                    <td v-text="vehiculo.nAnioFabricacion"></td>
                                                                    <td v-text="vehiculo.nAnioVersion"></td>
                                                                    <td>{{ vehiculo.cMes }} / {{ vehiculo.cAnio }}</td>
                                                                    <td v-text="vehiculo.cNombreLinea"></td>
                                                                    <td v-text="vehiculo.cFormaPago"></td>
                                                                </tr>
                                                            </tbody>
                                                        </template>
                                                    </template>
                                                    <template v-else>
                                                        <template v-if="fillNuevaSolicitud.nidtipobusqueda == 1">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>VIN</th>
                                                                    <th>Nombre Comercial</th>
                                                                        <th>Año Fab.</th>
                                                                    <th>Año Modelo</th>
                                                                    <th>Periodo</th>
                                                                    <th>Linea</th>
                                                                    <th>Forma de Pago</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="vehiculo in arrayVehiculosByCriterio" :key="vehiculo.cNumeroVin">
                                                                    <td>
                                                                        <a href="#" @click="asignarVehiculo(vehiculo)" data-toggle="tooltip">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="vehiculo.cNumeroVin"></td>
                                                                    <td v-text="vehiculo.cNombreComercial"></td>
                                                                    <td v-text="vehiculo.nAnioFabricacion"></td>
                                                                    <td v-text="vehiculo.nAnioVersion"></td>
                                                                    <td>{{ vehiculo.cMes }} / {{ vehiculo.cAnio }}</td>
                                                                    <td v-text="vehiculo.cNombreLinea"></td>
                                                                    <td v-text="vehiculo.cFormaPago"></td>
                                                                </tr>
                                                            </tbody>
                                                        </template>
                                                        <template v-else>
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>Placa</th>
                                                                    <th>Nombre Comercial</th>
                                                                    <th>Año Fab.</th>
                                                                    <th>Año Modelo</th>
                                                                    <th>Periodo</th>
                                                                    <th>Linea</th>
                                                                    <th>Forma de Pago</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="vehiculo in arrayVehiculosByCriterio" :key="vehiculo.cPlaca">
                                                                    <td>
                                                                        <a href="#" @click="asignarVehiculo(vehiculo)" data-toggle="tooltip">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="vehiculo.cPlaca"></td>
                                                                    <td v-text="vehiculo.cNombreComercial"></td>
                                                                    <td v-text="vehiculo.nAnioFabricacion"></td>
                                                                    <td v-text="vehiculo.nAnioVersion"></td>
                                                                    <td>{{ vehiculo.cMes }} / {{ vehiculo.cAnio }}</td>
                                                                    <td v-text="vehiculo.cNombreLinea"></td>
                                                                    <td v-text="vehiculo.cFormaPago"></td>
                                                                </tr>
                                                            </tbody>
                                                        </template>
                                                    </template>
                                                </table>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <nav>
                                                            <ul class="pagination">
                                                                <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaVehiculosByCriterio(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaVehiculosByCriterio(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaVehiculosByCriterio(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModalSolicitud()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Buscar Contactos -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">BUSQUEDA CONTACTOS</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                        <div class="col-sm-8">
                                                            <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.id">
                                                                <input type="radio" class="radio-template" v-model="modalMisContactos.ntipopersona" :value="tipo.value" v-on:change="cambiarTipoPersonaMisContactos()">
                                                                <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="modalMisContactos.cnrodocumento" @keyup.enter="listarContactos(1)" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nombres</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="modalMisContactos.cfiltrodescripcion" @keyup.enter="listarContactos(1)" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarContactos(1);">
                                                        <i class="fa fa-search"></i> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayContacto.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <template v-if="modalMisContactos.ntipopersona == 1">
                                                        <thead>
                                                            <tr>
                                                                <th>Acciones</th>
                                                                <th>Contacto</th>
                                                                <th>Nro Documento</th>
                                                                <th>Telefono</th>
                                                                <th>Dirección</th>
                                                                <th>Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="c in arrayContacto" :key="c.nIdAsignacionContactoVendedor">
                                                                <td>
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Seleccionar {{ c.cContacto }}</div>
                                                                        <i @click.prevent="abrirModal('contacto', 'asignar', c)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                    </el-tooltip>
                                                                </td>
                                                                <td v-text="c.cContacto"></td>
                                                                <td v-text="c.cNumeroDocumento"></td>
                                                                <td v-text="c.nTelefonoMovil"></td>
                                                                <td v-text="c.cDireccion"></td>
                                                                <td v-text="c.cEmail"></td>
                                                            </tr>
                                                        </tbody>
                                                    </template>
                                                    <template v-else>
                                                        <thead>
                                                            <tr>
                                                                <th>Acciones</th>
                                                                <th>Razon Social</th>
                                                                <th>Nro Documento</th>
                                                                <th>Telefono</th>
                                                                <th>Email</th>
                                                                <th>Persona Contacto</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="c in arrayContacto" :key="c.nIdAsignacionContactoVendedor">
                                                                <td>
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Seleccionar {{ c.cRazonSocial }}</div>
                                                                        <i @click.prevent="abrirModal('contacto', 'asignar', c)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                    </el-tooltip>
                                                                </td>
                                                                <td v-text="c.cRazonSocial"></td>
                                                                <td v-text="c.cNumeroDocumento"></td>
                                                                <td v-text="c.nTelefonoMovil"></td>
                                                                <td v-text="c.cEmail"></td>
                                                                <td v-text="c.cContacto"></td>
                                                            </tr>
                                                        </tbody>
                                                    </template>
                                                </table>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <nav>
                                                            <ul class="pagination">
                                                                <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaMisContactos(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaMisContactos(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaMisContactos(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModalSolicitud()">Cerrar</button>
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
                // =============================================================
                // VARIABLES MIS SOLICITUDES
                // =============================================================
                fillBusquedaSolicitud: {
                    nidtipobusqueda: '1',
                    nidvehiculo: '',
                    cnrovehiculo: '',
                    dfechainicio: '',
                    dfechafin: '',
                    nidasigcontacto: '',
                    nidcontacto: '',
                    cnombrecontacto: '',
                    nidestado: ''
                },
                arrayTipoBusquedaVehiculo: [
                    { value: '1', text: 'VIN'},
                    { value: '2', text: 'PLACA'}
                ],
                arrayTipoBusquedaVehiculoTDV: [],
                arrayEstado: [],
                arrayMisSolicitudes : [],
                // ===============================
                // VARIABLES MODAL CONTACTO
                // ===============================
                modalVehiculo: {
                    cnrovehiculo: '',
                },
                arrayVehiculosByCriterio: [],
                // ===============================
                // VARIABLES MODAL CONTACTO
                // ===============================
                modalMisContactos:{
                    ntipopersona: 1,
                    cnrodocumento: '',
                    cfiltrodescripcion: '',
                },
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
                arrayContacto: [],
                // =============================================================
                // VARIABLES NUEVA SOLICITUD
                // =============================================================
                // ===============================
                // VARIABLES DATOS SOLICITUD
                // ===============================
                fillNuevaSolicitud: {
                    //datos solicitud
                    dfechasolicitud: '',
                    nidtiposolicitud: '',
                    nidasigcontacto: '',
                    nidcontacto: '',
                    cnombrecontacto: '',
                    nidjefeinmediato: 0,
                    cnombrejefeinmediato: '',
                    //datos vehiculo
                    nidtipobusqueda: '1',
                    nidvehiculo: 0,
                    cnrovehiculo: '',
                    clugarpartida: '',
                    clugarllegada: '',
                    dfechamovimiento: '',
                    choraMovimiento: '',
                    cobservacion: '',
                    nidmovervehiculo: ''
                },
                checked: true,
                arrayTipoSolicitudes: [],
                arrayReferenciavehiculo: [],
                // ===============================
                // VARIABLES DATOS VEHICULO
                // ===============================
                arrayMoverVehiculo: [],
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
                flagBuscarContacto: 0,
                flagBuscarVehiculoByCriterio: 0,
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
        mounted() {
            this.tabMisSolicitudes();
            this.informacionUsuario();
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
            informacionUsuario(){
                var url = this.ruta + '/parametro/GetParametroById';
                axios.get(url, {
                    params: {
                        'nidpar' : this.usuario.id,
                        'nidgrupopar': 110026
                    }
                }).then(response => {
                    this.informacionJefeInmediato(response.data[0]);
                }).catch(error => {
                    console.log(error);
                });
            },
            informacionJefeInmediato(data){
                var url = this.ruta + '/parametro/GetParametroById';
                axios.get(url, {
                    params: {
                        'nidpar' : data.nIdParParent,
                        'nidgrupopar': 110025
                    }
                }).then(response => {
                    this.fillNuevaSolicitud.nidjefeinmediato = response.data[0].nIdPar;
                    this.fillNuevaSolicitud.cnombrejefeinmediato = response.data[0].cParNombre;
                }).catch(error => {
                    console.log(error);
                });
            },
            // =================================================================
            // METODOS TAB MIS SOLICTIDUES
            // =================================================================
            tabMisSolicitudes(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link active');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link');

                $('#TabMisSolicitudes').addClass('in active show');
                $('#TabNuevaSolicitud').removeClass('in active show');
                this.limpiarMisSolicitudes();
                this.llenarEstados();
                this.buscarMisSolicitudes(1);
            },
            llenarEstados(){
                var url = this.ruta + '/getComision/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110079,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayEstado = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            buscarMisSolicitudes(page){
                var url = this.ruta + '/autorizacion/GetLstMisSolicitudes';
                axios.get(url, {
                    params: {
                        'nIdTipoBusquedaVehiculo': this.fillBusquedaSolicitud.nidtipobusqueda,
                        'cNroVehiculo' : this.fillBusquedaSolicitud.cnrovehiculo,
                        'dFechaInicio' : this.fillBusquedaSolicitud.dfechainicio,
                        'dFechaFin' : this.fillBusquedaSolicitud.dfechafin,
                        'nIdAsigContacto' : this.fillBusquedaSolicitud.nidasigcontacto,
                        'nIdEstado' : this.fillBusquedaSolicitud.nidestado,
                        'tipoRol': 1,
                        'nIdTipoBusquedaAutorizacion': 1,
                        'cFlagEstadoAutorizacion' : '',
                        'nIdSolicitudAutorizacion' : 0,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayMisSolicitudes;
                    this.arrayMisSolicitudes     = info.data;
                    this.pagination.current_page =  info.current_page;
                    this.pagination.total        = info.total;
                    this.pagination.per_page     = info.per_page;
                    this.pagination.last_page    = info.last_page;
                    this.pagination.from         = info.from;
                    this.pagination.to           = info.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaMiSolicitudes(page){
                this.pagination.current_page=page;
                this.buscarMisSolicitudes(page);
            },
            limpiarMisSolicitudes(){
                this.fillBusquedaSolicitud.nidtipobusqueda = '1';
                this.fillBusquedaSolicitud.nidvehiculo = '';
                this.fillBusquedaSolicitud.cnrovehiculo = '';
                this.fillBusquedaSolicitud.dfechainicio = '';
                this.fillBusquedaSolicitud.dfechafin = '';
                this.fillBusquedaSolicitud.nidasigcontacto = '';
                this.fillBusquedaSolicitud.cnombrecontacto = '';
                this.fillBusquedaSolicitud.nidestado = '';
            },
            // ======================
            // MODAL BUSCAR VEHICULO
            // ======================
            cambiarVehiculoByCriterio(){
                if (this.flagBuscarVehiculoByCriterio == 1) {
                    this.fillBusquedaSolicitud.nidvehiculo = '';
                    this.fillBusquedaSolicitud.cnrovehiculo = '';
                } else {
                    this.fillNuevaSolicitud.nidvehiculo = '';
                    this.fillNuevaSolicitud.cnrovehiculo = '';
                }
            },
            cambiarPaginaVehiculosByCriterio(page){
                this.paginationModal.current_page=page;
                this.listarVehiculo(page);
            },
            listarVehiculo(page){
                var url = this.ruta + '/autorizacion/GetLstVehiculosByCriterio';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cnrovehiculo' : this.modalVehiculo.cnrovehiculo.toString(),
                        'criterio': (this.flagBuscarVehiculoByCriterio == 1) ? this.fillBusquedaSolicitud.nidtipobusqueda : this.fillNuevaSolicitud.nidtipobusqueda,
                        'page' : page,
                    }
                }).then(response => {
                    let info = response.data.arrayVehiculosByCriterio;
                    this.arrayVehiculosByCriterio     = info.data;
                    this.paginationModal.current_page =  info.current_page;
                    this.paginationModal.total        = info.total;
                    this.paginationModal.per_page     = info.per_page;
                    this.paginationModal.last_page    = info.last_page;
                    this.paginationModal.from         = info.from;
                    this.paginationModal.to           = info.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            asignarVehiculo(vehiculo){
                //Si es 1 entonces es abierto desde el TAB MisSolcitidues
                if (this.flagBuscarVehiculoByCriterio == 1) {
                    //Si el tipo de busqueda es 1 entonces por VIN
                    if(this.fillBusquedaSolicitud.nidtipobusqueda == 1){
                        this.fillBusquedaSolicitud.nidvehiculo = vehiculo.nIdCompra;
                        this.fillBusquedaSolicitud.cnrovehiculo = vehiculo.cNumeroVin;
                    } else {//Sino es por Placa
                        this.fillBusquedaSolicitud.nidvehiculo = vehiculo.nIdVehiculoPlaca;
                        this.fillBusquedaSolicitud.cnrovehiculo = vehiculo.cPlaca;
                    }
                } else {//Si es 2 entonces es abierto desde el TAB Nueva Solicitud
                    //Si el tipo de busqueda es 1 entonces por VIN
                    if(this.fillNuevaSolicitud.nidtipobusqueda == 1){
                        this.fillNuevaSolicitud.nidvehiculo = vehiculo.nIdCompra;
                        this.fillNuevaSolicitud.cnrovehiculo = vehiculo.cNumeroVin;
                    } else {//Sino es por Placa
                        this.fillNuevaSolicitud.nidvehiculo = vehiculo.nIdVehiculoPlaca;
                        this.fillNuevaSolicitud.cnrovehiculo = vehiculo.cPlaca;
                    }
                }

                this.modalVehiculo.cnrovehiculo = '';
                this.cerrarModalSolicitud();
            },
            // ======================
            // MODAL BUSCAR CONTACTOS
            // ======================
            cambiarTipoPersonaMisContactos(){
                this.arrayContacto = [];
                this.cambiarPaginaMisContactos(1);
            },
            cambiarPaginaMisContactos(page){
                this.paginationModal.current_page=page;
                this.listarContactos(page);
            },
            listarContactos(page){
                var url = this.ruta + '/autorizacion/GetLstContactosByUsuario';
                axios.get(url, {
                    params: {
                        'nidempresa' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcronograma' : 220016,
                        'ntipopersona' : this.modalMisContactos.ntipopersona,
                        'cnrodocumento' : String(this.modalMisContactos.cnrodocumento.toString()),
                        'cfiltrodescripcion' : this.modalMisContactos.cfiltrodescripcion.toString(),
                        'tipoRol': 1,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayContactosByUsuario;
                    this.arrayContacto                = info.data;
                    this.paginationModal.current_page =  info.current_page;
                    this.paginationModal.total        = info.total;
                    this.paginationModal.per_page     = info.per_page;
                    this.paginationModal.last_page    = info.last_page;
                    this.paginationModal.from         = info.from;
                    this.paginationModal.to           = info.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            limpiarAlAsignarContacto(){
                //Limpiar Asignación contacto cada vez que se asigne
                this.arrayReferenciavehiculo = [];
                this.fillNuevaSolicitud.nidasigcontacto = '';
                this.fillNuevaSolicitud.nidcontacto = '';
                this.fillNuevaSolicitud.cnombrecontacto = '';
            },
            llenarReferenciasVehiculo(){
                var url = this.ruta + '/gescotizacion/GetRefVehiculoByContacto';
                axios.get(url, {
                    params: {
                        'nidempresa' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcontacto' : this.fillNuevaSolicitud.nidcontacto
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
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            // =================================================================
            // METODOS TAB NUEVA SOLICITUD
            // =================================================================
            tabNuevaSolicitud(){
                this.limpiarNuevaSolicitud();
                this.tabDatosSolicitud();
                this.checked = true;
                this.updateEstadoChecked();
            },
            limpiarNuevaSolicitud(){
                //datos solicitud
                this.fillNuevaSolicitud.dfechasolicitud = '';
                this.fillNuevaSolicitud.nidtiposolicitud = '';
                this.fillNuevaSolicitud.nidasigcontacto = '';
                this.fillNuevaSolicitud.nidcontacto = '';
                this.fillNuevaSolicitud.cnombrecontacto = '';
                this.fillNuevaSolicitud.nidtipobusqueda = '1';
                this.fillNuevaSolicitud.nidvehiculo = '';
                this.fillNuevaSolicitud.cnrovehiculo = '';
                this.fillNuevaSolicitud.clugarpartida = '';
                this.fillNuevaSolicitud.clugarllegada = '';
                this.fillNuevaSolicitud.dfechamovimiento = '';
                this.fillNuevaSolicitud.choraMovimiento = '';
                this.fillNuevaSolicitud.cobservacion = '';
                this.fillNuevaSolicitud.nidmovervehiculo = '';
            },
            // ============================
            // SUBTAB DATOS SOLICTIUD
            // ============================
            tabDatosSolicitud(){
                $('#tab0201').removeClass('nav-link active');
                $('#tab0201').addClass('nav-link active');
                $('#tab0202').removeClass('nav-link active');
                $('#tab0202').addClass('nav-link disabled');

                $('#TabDatosSolictud').addClass('in active show');
                $('#TabDatosVehiculo').removeClass('in active show');
                this.llenarComboTipoSolicitud();
            },
            llenarComboTipoSolicitud(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110077
                    }
                }).then(response => {
                    this.arrayTipoSolicitudes = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            tipoBusquedaVehiculoPorTipoSolicitud(){
                var url = this.ruta + '/tipoparametro/GetTipoByIdParametro';
                axios.get(url, {
                    params: {
                        'nidpar' : this.fillNuevaSolicitud.nidtiposolicitud,
                        'ctipoparametro' : 'D',
                        'nidtipopar': 0
                    }
                }).then(response => {
                    this.arrayTipoBusquedaVehiculoTDV = response.data;
                    this.fillNuevaSolicitud.nidtipobusqueda = this.arrayTipoBusquedaVehiculoTDV[0].nDatoParNumerico;//SETEAR AL ITEM CARGADO
                }).catch(error => {
                    console.log(error);
                });
            },
            updateEstadoChecked(){
                if(this.checked){
                    this.fillNuevaSolicitud.nidasigcontacto = '';
                    this.fillNuevaSolicitud.nidcontacto = '';
                    this.fillNuevaSolicitud.cnombrecontacto = '';
                    this.arrayReferenciavehiculo = [];
                }
            },
            activarTab0202(nIdAsignacionContactoVendedor = ''){
                this.fillNuevaSolicitud.nidasigcontacto = (nIdAsignacionContactoVendedor == '') ? '' : nIdAsignacionContactoVendedor;

                if(this.validarTab0201()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                $('#tab0201').removeClass('nav-link active');
                $('#tab0201').addClass('nav-link');
                $('#tab0202').removeClass('nav-link disabled');
                $('#tab0202').addClass('nav-link active');

                $('#TabDatosSolictud').removeClass('in active show');
                $('#TabDatosVehiculo').addClass('in active show');
                this.tabDatosVehiculo();
            },
            validarTab0201(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillNuevaSolicitud.dfechasolicitud){
                    this.mensajeError.push('La fecha de solicitud es obligatoria');
                }
                let fecha_actual     = moment();
                let fecha_solicitud  = moment(this.fillNuevaSolicitud.dfechasolicitud);
                if(fecha_actual.diff(fecha_solicitud, 'days') > 0){
                    this.mensajeError.push('La Fecha de la Solicitud debe ser mayor a la fecha de Actual');
                }
                if(!this.fillNuevaSolicitud.nidtiposolicitud || this.fillNuevaSolicitud.nidtiposolicitud == 0){
                    this.mensajeError.push('Debe seleccionar un tipo de solicitud');
                }
                if(this.fillNuevaSolicitud.nidjefeinmediato == 0 && !this.fillNuevaSolicitud.cnombrejefeinmediato){
                    this.mensajeError.push('Debe tener asignado un Jefe de Ventas');
                }
                if(!this.checked) {
                    if(!this.fillNuevaSolicitud.nidasigcontacto && !this.fillNuevaSolicitud.nidcontacto && !this.fillNuevaSolicitud.cnombrecontacto){
                        this.mensajeError.push('Debe asignar un Contacto');
                    }
                }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ============================
            // SUBTAB DATOS VEHÍCULO
            // ============================
            tabDatosVehiculo(){
                this.llenarMoverVehiculo();
            },
            llenarMoverVehiculo(){
                var url = this.ruta + '/getComision/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110078,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayMoverVehiculo = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            registrarAutorizacion(){
                if(this.validarRegistrarAutorizacion()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/autorizacion/SetRegistrarSolicitudAutorizacion';
                axios.post(url, {
                    'nIdAsigContacto'       :   this.fillNuevaSolicitud.nidasigcontacto,
                    'nIdVehiculoPlaca'      :   (this.fillNuevaSolicitud.nidtipobusqueda == 1) ? '' : this.fillNuevaSolicitud.nidvehiculo,
                    'nIdCompra'             :   (this.fillNuevaSolicitud.nidtipobusqueda == 1) ? this.fillNuevaSolicitud.nidvehiculo : '',
                    'nIdEmpresa'            :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal'           :   parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nIdTipoSolicitud'      :   this.fillNuevaSolicitud.nidtiposolicitud,
                    'dFechaSolicitud'       :   this.fillNuevaSolicitud.dfechasolicitud,
                    'cFlagContacto'         :   (this.fillNuevaSolicitud.nidasigcontacto) ? 'S' : 'N',
                    'cFlagVinPlaca'         :   (this.fillNuevaSolicitud.nidtipobusqueda == 1) ? 'V' : 'P',
                    'dFechaMovVehiculo'     :   this.fillNuevaSolicitud.dfechamovimiento,
                    'cHoraMovVehiculo'      :   this.fillNuevaSolicitud.choraMovimiento,
                    'cObservacion'          :   this.fillNuevaSolicitud.cobservacion,
                    'cLugarPartida'         :   this.fillNuevaSolicitud.clugarpartida,
                    'cLugarLlegada'         :   this.fillNuevaSolicitud.clugarllegada,
                    'nIdMoverVehiculo'      :   this.fillNuevaSolicitud.nidmovervehiculo,
                    'nIdEstadoSolAutori'    :   1300237,
                    'cFlagEstadoSolAutori'  :   'P'
                }).then(response => {
                    swal('Solicitud de Autorización registrada exitosamente');
                    this.limpiarMisSolicitudes();
                    this.limpiarNuevaSolicitud();
                    this.tabVolverMisSolicitudes();
                }).catch(error => {
                    this.errors = error
                });
            },
            tabVolverMisSolicitudes(){
                $('#tab0201').removeClass('nav-link active');
                $('#tab0201').addClass('nav-link');
                $('#tab0202').removeClass('nav-link active');
                $('#tab0202').addClass('nav-link disabled');

                $('#TabDatosSolictud').removeClass('in active show');
                $('#TabDatosVehiculo').removeClass('in active show');
                this.tabMisSolicitudes();
            },
            validarRegistrarAutorizacion(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillNuevaSolicitud.nidvehiculo && !this.fillNuevaSolicitud.cnrovehiculo){
                    this.mensajeError.push('Debe seleccionar un vehículo, es un campo obligatorio');
                }
                if(!this.fillNuevaSolicitud.clugarpartida){
                    this.mensajeError.push('Debe Ingresar un Lugar de Partida, es un campo obligatorio');
                }
                if(!this.fillNuevaSolicitud.clugarllegada){
                    this.mensajeError.push('Debe Ingresar un Lugar de Llegada, es un campo obligatorio');
                }
                if(!this.fillNuevaSolicitud.dfechamovimiento){
                    this.mensajeError.push('La fecha de movimiento es un campo obligatorio');
                }
                let fecha_actual     = moment();
                let fecha_movimiento = moment(this.fillNuevaSolicitud.dfechamovimiento);
                if(fecha_actual.diff(fecha_movimiento, 'days') > 0){
                    this.mensajeError.push('La Fecha de Movimiento debe ser despues de la fecha de Actual');
                }
                if(!this.fillNuevaSolicitud.choraMovimiento){
                    this.mensajeError.push('La Hora del movimiento es un campo obligatorio');
                }
                if(!this.fillNuevaSolicitud.nidmovervehiculo){
                    this.mensajeError.push('Debe seleccionar quien moverá el vehículo, es un campo obligatorio');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "vehiculo":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                console.log(data);
                                this.flagBuscarVehiculoByCriterio = data;
                                this.listarVehiculo(1);
                                this.accionmodal=2;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case "contacto":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.flagBuscarContacto = data;
                                this.modalMisContactos.ntipopersona = 1;
                                this.listarContactos(1);
                                this.accionmodal=3;
                                this.modal = 1;
                                break;
                            }
                            break;
                            case 'asignar':
                            {
                                if(this.modalMisContactos.ntipopersona == 1){
                                    if (this.flagBuscarContacto == 1) {
                                        this.fillBusquedaSolicitud.nidasigcontacto = data['nIdAsignacionContactoVendedor'];
                                        this.fillBusquedaSolicitud.nidcontacto = data['nIdContacto'];
                                        this.fillBusquedaSolicitud.cnombrecontacto = data['cContacto'];
                                    } else {
                                        //Limpiar Asignación contacto cada vez que se asigne
                                        this.limpiarAlAsignarContacto();
                                        this.fillNuevaSolicitud.nidcontacto = data['nIdContacto'];
                                        this.fillNuevaSolicitud.cnombrecontacto = data['cContacto'];
                                        this.llenarReferenciasVehiculo();
                                    }
                                } else {
                                    if (this.flagBuscarContacto == 1) {
                                        this.fillBusquedaSolicitud.nidasigcontacto = data['nIdAsignacionContactoVendedor'];
                                        this.fillBusquedaSolicitud.nidcontacto = data['nIdContacto'];
                                        this.fillBusquedaSolicitud.cnombrecontacto = data['cRazonSocial'];
                                    } else {
                                        //Limpiar Asignación contacto cada vez que se asigne
                                        this.limpiarAlAsignarContacto();
                                        this.fillNuevaSolicitud.nidcontacto = data['nIdContacto'];
                                        this.fillNuevaSolicitud.cnombrecontacto = data['cRazonSocial'];
                                        this.llenarReferenciasVehiculo();
                                    }
                                }
                                this.modalMisContactos.ntipopersona = 1;
                                this.modalMisContactos.cnrodocumento = '';
                                this.modalMisContactos.cfiltrodescripcion = '';
                                this.cerrarModalSolicitud();
                                break;
                            }
                            break;
                            case 'nuevo':
                            {
                                let me = this;

                                switch (data) {
                                    case 110026:
                                        me.$emit('vista', 1300281);//VENDEDORES
                                        break;
                                    case 110025:
                                        me.$emit('vista', 1300280);//JEFE DE VENTAS
                                        break;
                                    case 110083:
                                        me.$emit('vista', 1300300);//ADMINISTRADOR DE VENDEDORES
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }
                    }
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
                this.limpiarPaginacion();
                this.limpiarPaginacionModal();
            },
            cerrarModalSolicitud(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
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
    /* Estilos Modal */
    .menosPadding{
        padding: .31rem;
    }
    .subCabecera{
        justify-content: center;
        padding: 1rem;
        background: white;
    }
    .subCabecera>h3{
        color: black;
        font-size: 1rem;
        font-weight: bolder;
    }
    .flexRigth{
        display: flex;
        justify-content: center;
        align-items: flex-end;
        align-content: flex-end;
    }
    .flexLeft{
        width: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        align-content: flex-start;
    }
    .flexLeft>h4{
        font-weight: bolder;
    }
    .el-row{
        display: flex;
        justify-content: space-between;
        align-content: space-around;
    }
    .disabled{
        opacity: 0.65;
        cursor: not-allowed;
        pointer-events:none;
    }
</style>



