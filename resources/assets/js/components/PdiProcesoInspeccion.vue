<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">PROCESO DE INSPECCIÓN</h2>
                </div>
            </header>

            <template v-if="vistaFormulario">
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">BUSCAR</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <label class="col-md-4 form-control-label">
                                                        <el-radio-group v-model="fillPdi.ncriterio" @change="cambiarBusquedaPorCriterio">
                                                            <el-radio v-for="tipobsq in arrayTipoBusquedaVehiculo" :key="tipobsq.id" :label="tipobsq.value"> {{ tipobsq.text }} </el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input type="text" v-model="fillPdi.cdescripcioncriterio" class="form-control form-control-sm">
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
                                                            v-model="fillPdi.dfechainicio"
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
                                                            v-model="fillPdi.dfechafin"
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
                                            <!--<div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Tipo Solicitud</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillCompra.nidmarca" filterable clearable placeholder="SELECCIONE" v-on:change="llenarComboModelo()">
                                                            <el-option
                                                            v-for="item in arrayMarca"
                                                            :key="item.nIdPar"
                                                            :label="item.cParNombre"
                                                            :value="item.nIdPar">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>-->
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Estado PDI</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillPdi.nidestadopdi" filterable clearable placeholder="SELECCIONE">
                                                            <el-option
                                                                v-for="item in arrayEstatoPdi"
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
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarPdi(1)"><i class="fa fa-search"></i> Buscar</button>
                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="abrirFormulario('pdi','registrar')"><i class="fa fa-file-o"></i> Nuevo</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">LISTADO PDI</h3>
                                </div>
                                <div class="card-body">
                                    <template v-if="arrayPdi.length">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Fecha</th>
                                                        <th>Hora</th>
                                                        <th>Tipo Solicitud</th>
                                                        <th>Tipo Movimiento</th>
                                                        <th>Vin/Placa</th>
                                                        <th>Tipo Inspección</th>
                                                        <th>Aprobación Pdi</th>
                                                        <th>Estado Pdi</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="pdi in arrayPdi" :key="pdi.nIdCabeceraInspeccion">
                                                        <td v-text="pdi.nIdCabeceraInspeccion"></td>
                                                        <td v-text="pdi.dFechaInspeccion"></td>
                                                        <td v-text="pdi.cHoraInspeccion"></td>
                                                        <td v-text="pdi.cNombreSolicitud"></td>
                                                        <td v-text="pdi.cFlagTipoMovimiento"></td>
                                                        <td v-text="pdi.cVinPlaca"></td>
                                                        <td v-text="pdi.cNombreTipoInspeccion"></td>
                                                        <td v-text="pdi.cEvaluacion"></td>
                                                        <td v-text="pdi.cEstadoPdi"></td>
                                                        <td>
                                                            <template v-if="pdi.nIdEstadoPdi==1300339">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ pdi.cNombreSolicitud }}</div>
                                                                    <i @click="abrirFormulario('pdi','actualizar', pdi)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>&nbsp;
                                                            </template>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Reporte PDI {{ pdi.nIdCabeceraInspeccion }}</div>
                                                                <i @click="generarPDF(pdi.nIdCabeceraInspeccion)" :style="'color:red'" class="fa-md fa fa-file-pdf-o"></i>
                                                            </el-tooltip>&nbsp;
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
            </template>

            <template v-else>
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4" v-text="tituloFormulario"></h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <label v-if="accion==1" class="col-sm-3 form-control-label">*&nbsp;
                                                        <label class="checkbox-inline" v-for="tipo in arrayFlagVinPlaca" :key="tipo.value">
                                                            <input type="radio" class="radio-template" v-model="formPdi.nidflagvinplaca" :value="tipo.value" @change="changeFlagVinPlaca">
                                                            <label class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </label>
                                                    </label>
                                                    <label v-if="accion==2" class="col-sm-3 form-control-label" v-text="formPdi.cFlagVinPlaca=='P' ? 'Nro Placa' : 'Nro Vin'"></label>
                                                    <div class="col-sm-5">
                                                        <div class="input-group">
                                                            <input type="text" v-model="formPdi.cvinplacanombre" disabled="disabled" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Buscar Por Vin o Placa </div>
                                                                    <button v-if="accion==1" type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('pdi','vinplaca')">
                                                                        <i class="fa-lg fa fa-search"></i>
                                                                    </button>
                                                                </el-tooltip>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <template v-if="formPdi.cvinplacanombre">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-3 form-control-label">* Tipo Inspección</label>
                                                        <div class="col-sm-5">
                                                            <el-select  v-model="formPdi.nidtipoinspeccion"
                                                                        filterable
                                                                        clearable
                                                                        placeholder="SELECCIONE TIPO DE INSPECCIÓN"
                                                                        @change="changeTipoInspeccion"
                                                                        :class="[this.accion==1 ? '' : 'disabled']" >
                                                                <el-option
                                                                    v-for="item in arrayTipoInspeccion"
                                                                    :key="item.nIdTipoInspeccion"
                                                                    :label="item.cNombreTipoInspeccion"
                                                                    :value="item.nIdTipoInspeccion">
                                                                </el-option>
                                                            </el-select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Ver Plantilla </div>
                                                                <button v-if="this.nflagseccioninspeccion==1" type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('pdi','plantilla')">
                                                                    <i class="fa fa-eye"></i>&nbsp;Plantilla
                                                                </button>
                                                            </el-tooltip>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Ver Accesorio </div>
                                                                <button v-if="this.nflagaccesorio==1" type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('pdi','accesorio')">
                                                                    <i class="fa fa-eye"></i>&nbsp;Accesorio
                                                                </button>
                                                            </el-tooltip>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-3 form-control-label">* Punto Inspección</label>
                                                        <div class="col-sm-5">
                                                            <div class="input-group">
                                                                <input type="text" v-model="formPdi.cnombrepuntoinspeccion" disabled="disabled" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Punto Inspección </div>
                                                                        <button v-if="this.accion==1" type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('pdi','puntoinspeccion')">
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
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-3 form-control-label">Solicitud Autorización</label>
                                                        <div class="col-sm-5">
                                                            <div class="input-group">
                                                                <input type="text" v-model="formPdi.cnombresolicitud" disabled="disabled" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Solicitud Autorización</div>
                                                                        <button v-if="this.accion==1" type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('pdi','solicitud')">
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
                                                        <label class="col-sm-4 form-control-label">* Tipo Movimiento</label>
                                                        <div class="col-sm-8">
                                                            <label class="checkbox-inline" v-for="tipo in arrayFlagTipoMovimiento" :key="tipo.value">
                                                                <input type="radio" class="radio-template" v-model="formPdi.nidflagmovimiento" :value="tipo.value">
                                                                <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Fecha Inspección</label>
                                                        <div class="col-sm-8">
                                                            <el-date-picker
                                                                v-model="formPdi.dfechainspeccion"
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
                                                        <label class="col-sm-4 form-control-label">* Hora Inspección</label>
                                                        <div class="col-sm-8">
                                                            <el-time-picker
                                                                v-model="formPdi.chorainspeccion"
                                                                value-format="HH:mm"
                                                                :picker-options="{
                                                                format: 'AM/PM'
                                                                }"
                                                                placeholder="Hora Inspección">
                                                            </el-time-picker>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <template v-if="this.nflagalmacen ==1">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Almacén</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="formAlmacen.cwhsname" class="form-control form-control-sm" readonly>
                                                                    <div class="input-group-prepend">
                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                            <div slot="content">Buscar Almacén </div>
                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('almacen','buscar')">
                                                                                <i class="fa-lg fa fa-search"></i>
                                                                            </button>
                                                                        </el-tooltip>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Adjuntar</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" id="file-upload" @change="getFile" accept=".xls,.xlsx" class="form-control form-control-sm"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label"><span v-text="formPdi.nidconformidad ? 'Conforme' : 'NO Conforme'"></span></label>
                                                        <div class="col-sm-8">
                                                            <el-switch v-model="formPdi.nidconformidad">
                                                            </el-switch>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-2 form-control-label">Observación</label>
                                                        <div class="col-sm-10">
                                                            <el-input
                                                                type="textarea"
                                                                autosize
                                                                placeholder=""
                                                                v-model="formPdi.cobservacion">
                                                            </el-input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" v-if="accion==1" class="btn btn-success btn-corner btn-sm" @click="registrar()">
                                                    <i class="fa fa-save"></i> Registrar
                                                </button>
                                                <button type="button" v-if="accion==2" class="btn btn-secondary btn-corner btn-sm" @click="actualizar()">
                                                    <i class="fa fa-save"></i> Actualizar
                                                </button>
                                                <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cambiarVistaFormulario()">
                                                    <i class="fa fa-close"></i> Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </template>

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

            <!-- MODAL SOLICITUD AUTORIZACION -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA SOLICITUDES</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <!--<div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombre</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillItem.citemnombre" @keyup.enter="listarItems(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" title="Buscar Items" class="btn btn-info btn-corner btn-sm" @click="listarItems(1)">
                                                                        <i class="fa-lg fa fa-search"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br/>-->
                                        </form>
                                        <template v-if="arraySolicitud.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Nro Solicitud</th>
                                                            <th>Tipo Solicitud</th>
                                                            <th>Estado Solicitud</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="sa in arraySolicitud" :key="sa.nIdSolicitudAutorizacion">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ sa.cTipoSolicitud }}</div>
                                                                    <i @click="asignarSolicitud(sa.nIdSolicitudAutorizacion, sa.cNumeroSolicitud, sa.cTipoSolicitud)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="sa.cNumeroSolicitud"></td>
                                                            <td v-text="sa.cTipoSolicitud"></td>
                                                            <td v-text="sa.cEstadoSolicitud"></td>
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
                                                                    <a @click.prevent="cambiarPaginaSolicitud(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaSolicitud(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaSolicitud(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

            <!-- MODAL PUNTO INSPECCIÓN -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA PUNTO DE INSPECCIÓN</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <!--<div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombre</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillItem.citemnombre" @keyup.enter="listarItems(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" title="Buscar Items" class="btn btn-info btn-corner btn-sm" @click="listarItems(1)">
                                                                        <i class="fa-lg fa fa-search"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>-->
                                        </form>
                                        <template v-if="arrayPuntoInspeccion.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Código</th>
                                                            <th>Nombre</th>
                                                            <th>Tipo Movimiento</th>
                                                            <th>Ingreso Sucursal</th>
                                                            <th>Salida Sucursal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="punto in arrayPuntoInspeccion" :key="punto.nIdSolicitudAutorizacion">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ punto.cNombrePuntoInspeccion }}</div>
                                                                    <i @click="asignarPuntoInspeccion(punto.nIdPuntoInspeccion, punto.cNombrePuntoInspeccion)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="punto.nIdPuntoInspeccion"></td>
                                                            <td v-text="punto.cNombrePuntoInspeccion"></td>
                                                            <td v-text="punto.cFlagTipoMovimiento"></td>
                                                            <td v-text="punto.cFlagIngresoSucursal"></td>
                                                            <td v-text="punto.cFlagSalidaSucursal"></td>
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
                                                                    <a @click.prevent="cambiarPaginaPuntoInspeccion(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaPuntoInspeccion(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaPuntoInspeccion(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

            <!-- MODAL VIN -->
            <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO COMPRA</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Fecha Inicio</label>
                                                        <div class="col-sm-8">
                                                            <el-date-picker
                                                                v-model="fillCompra.dfechainicio"
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
                                                                v-model="fillCompra.dfechafin"
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
                                                        <label class="col-sm-4 form-control-label">Nº Orden Compra</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="fillCompra.nordencompra" @keyup.enter="listarPorVin()" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nro Vin</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="fillCompra.cnumerovin" @keyup.enter="listarPorVin()" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Marca</label>
                                                        <div class="col-sm-8">
                                                            <el-select  v-model="fillCompra.nidmarca"
                                                                        filterable
                                                                        clearable
                                                                        placeholder="SELECCIONE MARCA"
                                                                        @change="llenarComboModelo">
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
                                                            <el-select  v-model="fillCompra.nidmodelo"
                                                                        filterable
                                                                        clearable
                                                                        placeholder="SELECCIONE MODELO">
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
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarPorVin(1)">
                                                        <i class="fa fa-search"></i> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayCompra.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Código</th>
                                                            <th>Periodo</th>
                                                            <th>OC</th>
                                                            <th>Línea</th>
                                                            <th>Almacén<nav></nav></th>
                                                            <th>Nro Vin</th>
                                                            <th>Nombre Comercial</th>
                                                            <th>Año Fab</th>
                                                            <th>Año Mod</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="compra in arrayCompra" :key="compra.nIdCompra">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ compra.cNumeroVin }}</div>
                                                                    <i @click="asignarVin(compra)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="compra.nIdCompra"></td>
                                                            <td v-text="compra.cNumeroMes + '-' + compra.cAnio"></td>
                                                            <td v-text="compra.nOrdenCompra"></td>
                                                            <td v-text="compra.cNombreLinea"></td>
                                                            <td v-text="compra.cNombreAlmacen"></td>
                                                            <td v-text="compra.cNumeroVin"></td>
                                                            <td v-text="compra.cNombreComercial"></td>
                                                            <td v-text="compra.nAnioFabricacion"></td>
                                                            <td v-text="compra.nAnioVersion"></td>
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
                                                                    <a @click.prevent="cambiarPaginaVin(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaVin(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaVin(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

            <!-- MODAL VEHICULO PLACA -->
            <div class="modal fade" v-if="accionmodal==6" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">BUSQUEDA VEHICULO POR PLACA</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nro Placa</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillVehiculoPlaca.cdescripcion" @keyup.enter="listarPorPlaca(1)" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" title="Buscar Vehiculos" class="btn btn-info btn-corner btn-sm" @click="listarPorPlaca(1);">
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
                                        <template v-if="arrayVehiculoPlaca.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Placa</th>
                                                            <th>Nombre Comercial</th>
                                                            <th>Año / Mes</th>
                                                            <th>Linea</th>
                                                            <th>Forma de Pago</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="vehiculo in arrayVehiculoPlaca" :key="vehiculo.cPlaca">
                                                            <td>
                                                                <a href="#" @click="asignarPlaca(vehiculo)" data-toggle="tooltip">
                                                                    <i class='fa-md fa fa-check-circle'></i>
                                                                </a>
                                                            </td>
                                                            <td v-text="vehiculo.cPlaca"></td>
                                                            <td v-text="vehiculo.cNombreComercial"></td>
                                                            <td> {{ vehiculo.cAnio }} / {{ vehiculo.cMes }} </td>
                                                            <td v-text="vehiculo.cNombreLinea"></td>
                                                            <td v-text="vehiculo.cFormaPago"></td>
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
                                                                    <a @click.prevent="cambiarPaginaPlaca(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaPlaca(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaPlaca(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

            <!-- MODAL PLANILLA -->
            <div class="modal fade" v-if="accionmodal==7" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">PLANTILLA</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Área</label>
                                                        <div class="col-sm-8">
                                                            <el-select v-model="formPlantilla.nidflag" filterable clearable placeholder="SELECCIONE" >
                                                                <el-option
                                                                v-for="item in arrayFlag"
                                                                :key="item.nIdPar"
                                                                :label="item.cParNombre"
                                                                :value="item.nIdPar">
                                                                </el-option>
                                                            </el-select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!--<div class="row">
                                                        <label class="col-sm-4 form-control-label">Agregar Item</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="formPlantilla.citemnombre" disabled="disabled" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Item </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('item','buscar')">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarSeccion()">
                                                        <i class="fa fa-search"></i> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arraySeccion.length">
                                            <li v-for="seccion in arraySeccion" :key="seccion.nIdSeccion">{{ seccion.cSeccionNombre }}
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <tbody>
                                                            <tr v-for="(item, index) in arrayItems" :key="item.nIdPlantillaInspeccionSeccionItem">
                                                                <td v-if="item.nIdSeccion==seccion.nIdSeccion" v-text="item.cItemNombre"></td>
                                                                <td v-if="item.nIdSeccion==seccion.nIdSeccion">
                                                                    <span v-text="arrayPlantillaFlagMarca[item.nIdPlantillaInspeccionSeccionItem] ? 'CONFORME' : 'NO CONFORME'"></span>
                                                                    <span class="switch">
                                                                        <el-switch v-model="arrayPlantillaFlagMarca[item.nIdPlantillaInspeccionSeccionItem]">
                                                                        </el-switch>
                                                                    </span>
                                                                </td>
                                                                <td v-if="item.nIdSeccion==seccion.nIdSeccion">
                                                                    <input type="text" v-if="!arrayPlantillaFlagMarca[item.nIdPlantillaInspeccionSeccionItem]" v-model="arrayPlantillaDescripcion[index]" class="form-control form-control-sm">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </li>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-6">
                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="aceptarPlantilla()">
                                                        <i class="fa fa-save"></i> Aceptar
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="!arraySeccion.length" class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL ACCESORIO -->
            <div class="modal fade" v-if="accionmodal==8" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">ACCESORIOS</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <div class="row" v-if="nflagalmacen!=0">
                                                        <label class="col-sm-4 form-control-label">Buscar Accesorio</label>
                                                        <div class="col-sm-8">
                                                            <el-autocomplete
                                                                    class=""
                                                                    clearable
                                                                    v-model="fillAccesorio.cnombre"
                                                                    :fetch-suggestions="querySearch"
                                                                    placeholder=""
                                                                    :trigger-on-focus="false"
                                                                    @select="asignarAccesorio">
                                                            </el-autocomplete>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayAccesorio.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acciones</th>
                                                            <th>Tipo</th>
                                                            <th>Nombre</th>
                                                            <th>Cantidad</th>
                                                            <th>Conformidad</th>
                                                            <th></th>
                                                            <th>Almacen</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(a, index) in arrayAccesorio" :key="a.nIdElemento">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Eliminar {{ a.cElemenNombre }}</div>
                                                                    <i @click="removerAccesorio(index)" :style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="a.cTipoElemenNombre"></td>
                                                            <td v-text="a.cElemenNombre"></td>
                                                            <td><input type="number" v-model="a.nCantidad" @keyup.enter="listarAccesorio(1)" class="form-control form-control-sm"></td>
                                                            <td>
                                                                <span v-text="a.cFlagMarca ? 'CONFORME' : 'NO CONFORME'"></span>
                                                                <span class="switch">
                                                                    <el-switch  v-model="a.cFlagMarca"
                                                                                @change="verificarConformidad">
                                                                    </el-switch>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <input type="text" v-if="!a.cFlagMarca" v-model="a.cDescripcion" class="form-control form-control-sm">
                                                            </td>
                                                            <td v-if="nflagalmacen==0" v-text="a.cWhsName"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-6">
                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="aceptarAccesorio()">
                                                        <i class="fa fa-save"></i> Aceptar
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="!arrayAccesorio.length" class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL ALMACENES -->
            <div class="modal fade" v-if="accionmodal==9" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA DE ALMACENES</h3>
                                    </div>
                                    <div class="card-body">
                                        <template v-if="arrayAlmacen.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Código Almacén</th>
                                                            <th>Nombre Almacén</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="almacen in arrayAlmacen" :key="almacen.cWhsCode">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ almacen.cWhsName }}</div>
                                                                    <i @click="asignarAlmacen(almacen)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td>{{almacen.cWhsCode}}</td>
                                                            <td>{{almacen.cWhsName}}</td>
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
                                                                    <a @click.prevent="cambiarPaginaAlmacen(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaAlmacen(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaAlmacen(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

        </main>
    </transition>
</template>

<script>
    export default {
        props:['ruta'],
        data(){
            return {
                ccustomercode: '',
                nIdServiceCallCompra: 0,
                nIdServiceCallVenta: 0,
                nactivitycode: 0,
                nDocEntryOrdenVenta: 0,
                nDocNumOrdenVenta: 0,
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                // ============================================
                // ============ BUSQUEDA PDI =================
                fillPdi:{
                    ncriterio: '1',
                    cdescripcioncriterio: '',
                    dfechainicio: '',
                    dfechafin: '',
                    nidestadopdi: ''
                },
                arrayEstatoPdi: [],
                arrayTipoBusquedaVehiculo: [
                    { value: '1', text: 'VIN'},
                    { value: '2', text: 'PLACA'}
                ],
                arrayPdi: [],
                // ============ Variables Flag Tipo Inspeccion =================
                nflagalmacen: 0,
                nflagaccesorio: 0,
                nflagtestdrive: 0,
                nflagseccioninspeccion: 0,
                nflagvalidarfichatecnica: 0,
                // ============ Variables Valida Flag Tipo Inspeccion =================
                nflagalmacenValida: 0,
                nflagaccesorioValida: 0,
                nflagtestdriveValida: 0,
                nflagseccioninspeccionValida: 0,
                nflagvalidarfichatecnicaValida: 0,
                // ============================================
                // ============ REGISTRO PDI =================
                formPdi:{
                    nidcabecerainspeccion: 0,
                    nidsolicitud: 0,
                    cnombresolicitud: '',
                    nidflagvinplaca: 1,
                    cnumerovin: '',
                    cvinplacanombre: '',
                    nidcompra: 0,
                    nidvehiculoplaca: 0,
                    nidpuntoinspeccion: 0,
                    cnombrepuntoinspeccion: '',
                    nidtipoinspeccion: '',
                    nidflagmovimiento: 1,
                    cnumeroinspeccion: '',
                    nidalmacen: '',
                    dfechainspeccion: '',
                    chorainspeccion: '',
                    dfechamovimientoalmacen: '',
                    nflagconformidad: 0,
                    cflagconformidaddescripcion: '',
                    cFlagVinPlaca: '',
                    cobservacion: '',
                    nidconformidad: 0
                },
                arraySolicitud: [],
                arrayPuntoInspeccion: [],
                arrayTipoInspeccion: [],
                arrayAlmacen: [],
                arrayFlagVinPlaca: [
                    { value: '1', text: 'Nro Vin'},
                    { value: '2', text: 'Placa'}
                ],
                arrayFlagTipoMovimiento: [
                    { value: '1', text: 'Ingreso'},
                    { value: '2', text: 'Salida'}
                ],
                // ============================================
                // ============ MODAL COMPRA =================
                fillCompra:{
                    dfechainicio: '',
                    dfechafin: '',
                    nordencompra: '',
                    cnumerovin: '',
                    nidmarca: '',
                    nidmodelo: ''
                },
                arrayCompra: [],
                arrayMarca: [],
                arrayModelo: [],
                // ===================================================
                // ============ MODAL VEHICULO PLACA =================
                fillVehiculoPlaca:{
                    cdescripcion: ''
                },
                arrayVehiculoPlaca: [],
                // ============================================
                // ============ MODAL PLANILLA =================
                formPlantilla:{
                    nidflag: '',
                    cdescripcion: ''
                },
                arrayPlantilla: [],
                arraySeccion: [],
                arrayItems: [],
                arrayFlag: [],
                arrayPlantillaFlagMarca: [],
                arrayPlantillaDescripcion: [],
                // ============ MODAL ACCESORIO =================
                fillAccesorio:{
                    cnombre: ''
                },
                state2: '',
                links: [],
                arrayAccesorio: [],
                arrayAccesorioFlag: [],
                arrayTempAccesorio: [],
                // arrayAccesorioCantidad: [],
                // arrayAccesorioFlagMarca:  [],
                // arrayAccesorioDescripcion: [],
                //===========================================================
                // =============  VARIABLES ALMACEN ========================
                formAlmacen:{
                    nidlocalidad: 0,
                    cwhscode: '',
                    cwhsname: '',
                    cacctcodeentrada: '',
                    cacctcodesalida: ''
                },
                arrayAlmacen: [],
                //===========================================================
                // =============  VARIABLES SAP ========================
                arraySapArticulo: [],
                arraySapItemCode: [],
                //
                arraySapRespuesta: [],
                jsonRespuesta: '',
                arraySapUpdSgc: [],
                arraySapMercancia: [],
                arrayCodSAPPDI: [],
                arraySapLlamadaServicio: [],
                arraySapActividad: [],
                // ============================================
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
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                vistaFormulario: 1,
                attachment: null,
                form: new FormData,
                textFile: '',
                validaAccionModal: 0
            }
        },
        mounted(){
            this.llenarComboEstadoPdi();
            this.llenarTipoInspeccion();
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
            }
        },
        methods:{
            //===================================================================
            //================= BUSCAR PROCESO DE INSPECCION ====================
            llenarComboEstadoPdi(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110092
                    }
                }).then(response => {
                    this.arrayEstatoPdi = response.data;
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
            cambiarBusquedaPorCriterio(){
                this.fillPdi.cdescripcioncriterio = '';
            },
            listarPdi(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/pdi/GetListPdi';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'ncriterio': this.fillPdi.ncriterio,
                        'cdescripcioncriterio': this.fillPdi.cdescripcioncriterio,
                        'dfechainicio': this.fillPdi.dfechainicio,
                        'dfechafin': this.fillPdi.dfechafin,
                        'nidestadopdi': this.fillPdi.nidestadopdi,
                        'page': page
                    }
                }).then(response => {
                    this.arrayPdi = response.data.arrayPdi.data;
                    this.pagination.current_page =  response.data.arrayPdi.current_page;
                    this.pagination.total = response.data.arrayPdi.total;
                    this.pagination.per_page    = response.data.arrayPdi.per_page;
                    this.pagination.last_page   = response.data.arrayPdi.last_page;
                    this.pagination.from        = response.data.arrayPdi.from;
                    this.pagination.to           = response.data.arrayPdi.to;
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
                this.listarPdi(page);
            },
            generarPDF(nIdCabeceraInspeccion){
                var config = {
                    responseType: 'blob'
                };
                var url = this.ruta + '/pdi/GetDetallePDI';
                axios.post(url, {
                    'nIdEmpresa'            :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal'           :   parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nIdCabeceraInspeccion' :   parseInt(nIdCabeceraInspeccion),
                    'ncriterio'             :   this.fillPdi.ncriterio
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
            //=============================================================
            //==================== NUEVA INSPECCION =======================
            listarSolicitud(page){
                var url = this.ruta + '/pdi/GetListSolicitudByEstado';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidestadosolicitud' : 1300240,
                        'page' : page
                    }
                }).then(response => {
                    this.arraySolicitud = response.data.arraySolicitud.data;
                    this.paginationModal.current_page =  response.data.arraySolicitud.current_page;
                    this.paginationModal.total = response.data.arraySolicitud.total;
                    this.paginationModal.per_page    = response.data.arraySolicitud.per_page;
                    this.paginationModal.last_page   = response.data.arraySolicitud.last_page;
                    this.paginationModal.from        = response.data.arraySolicitud.from;
                    this.paginationModal.to           = response.data.arraySolicitud.to;
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
            cambiarPaginaSolicitud(page){
                this.paginationModal.current_page=page;
                this.listarSolicitud(page);
            },
            asignarSolicitud(nIdSolicitudAutorizacion, cNumeroSolicitud, cTipoSolicitud){
                this.formPdi.nidsolicitud = nIdSolicitudAutorizacion;
                this.formPdi.cnombresolicitud = cTipoSolicitud + ' - ' + cNumeroSolicitud;
                this.cerrarModal();
            },
            //=============== PUNTO INSPECCION ===================
            listarPuntoInspeccion(page){
                var url = this.ruta + '/pdi/GetListPuntoInspeccion';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cnombre': '',
                        'page' : page
                    }
                }).then(response => {
                    this.arrayPuntoInspeccion = response.data.arrayPuntoInspeccion.data;
                    this.paginationModal.current_page =  response.data.arrayPuntoInspeccion.current_page;
                    this.paginationModal.total = response.data.arrayPuntoInspeccion.total;
                    this.paginationModal.per_page    = response.data.arrayPuntoInspeccion.per_page;
                    this.paginationModal.last_page   = response.data.arrayPuntoInspeccion.last_page;
                    this.paginationModal.from        = response.data.arrayPuntoInspeccion.from;
                    this.paginationModal.to           = response.data.arrayPuntoInspeccion.to;
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
            cambiarPaginaPuntoInspeccion(page){
                this.paginationModal.current_page=page;
                this.listarPuntoInspeccion(page);
            },
            asignarPuntoInspeccion(nIdPuntoInspeccion, cNombrePuntoInspeccion){
                this.formPdi.nidpuntoinspeccion = nIdPuntoInspeccion;
                this.formPdi.cnombrepuntoinspeccion = cNombrePuntoInspeccion;
                this.cerrarModal();
            },
            //=============== TIPO INSPECCION ===================
            llenarTipoInspeccion(page){
                var url = this.ruta + '/tipoinspeccion/GetListTipoInspeccion';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'cnombre': '',
                        'page': page
                    }
                }).then(response => {
                    this.arrayTipoInspeccion = response.data.arrayTipoInspeccion.data;
                    this.pagination.current_page =  response.data.arrayTipoInspeccion.current_page;
                    this.pagination.total = response.data.arrayTipoInspeccion.total;
                    this.pagination.per_page    = response.data.arrayTipoInspeccion.per_page;
                    this.pagination.last_page   = response.data.arrayTipoInspeccion.last_page;
                    this.pagination.from        = response.data.arrayTipoInspeccion.from;
                    this.pagination.to           = response.data.arrayTipoInspeccion.to;
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
            changeTipoInspeccion(){
                this.limpiarTipoInspeccion();
                this.obtenerDetalleTipoInspeccionById();
            },
            limpiarTipoInspeccion(){
                this.nflagalmacen               = 0,
                this.nflagaccesorio             = 0,
                this.nflagtestdrive             = 0,
                this.nflagseccioninspeccion     = 0,
                this.nflagvalidarfichatecnica   = 0,
                //Modal Accesorio
                this.nflagaccesorioValida  = 0;//Valida que se aceptaron los accesorios
                this.arrayAccesorio = [];
                this.arrayAccesorioFlag = [];
                this.arrayTempAccesorio = [];
            },
            obtenerDetalleTipoInspeccionById(){
                var url = this.ruta + '/pdi/GetDetalleTipoInspeccionById';

                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidtipoinspeccion' : this.formPdi.nidtipoinspeccion
                    }
                }).then(response => {
                    if(response.data.length > 0) {
                        this.nflagalmacen               = response.data[0].nFlagAlmacen;    //Mostrar Objeto Almacen
                        this.nflagaccesorio             = response.data[0].nFlagAccesorio;  //Mostrar Objeto Accesorio
                        this.nflagtestdrive             = response.data[0].nFlagTestDrive;  //Mostrar Objeto TestDrive
                        this.nflagseccioninspeccion     = response.data[0].nFlagSeccionInspeccion;//Mostrar Objeto Inspección
                        this.nflagvalidarfichatecnica   = response.data[0].nFlagValidarFichaTecnica;//Mostrar Objeto Ficha Tecnica
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
            obtenerLocalidadBySucursal(){
                var url = this.ruta + '/parparametro/GetParParametro';

                axios.get(url, {
                    params: {
                        'nparsrccodigo': 0,
                        'nparsrcgrupoarametro': 110102,
                        'npardstcodigo': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'npardstgrupoarametro': 110022,
                        'opcion': 1
                    }
                }).then(response => {
                    if(response.data.arrayParParametro.length){
                        this.formAlmacen.nidlocalidad = response.data.arrayParParametro[0].nParSrcCodigo;
                        //this.obtenerAlmacenByLocalidad();
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
            // =============  LISTAR ALMACEN ======================
            listarAlmacen(page){
                var url = this.ruta + '/almacen/GetAlmacenByLocalidad';

                axios.get(url, {
                    params: {
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'page' : page
                    }
                }).then(response => {
                    this.arrayAlmacen = response.data.arrayAlmacen.data;
                    this.paginationModal.current_page =  response.data.arrayAlmacen.current_page;
                    this.paginationModal.total = response.data.arrayAlmacen.total;
                    this.paginationModal.per_page    = response.data.arrayAlmacen.per_page;
                    this.paginationModal.last_page   = response.data.arrayAlmacen.last_page;
                    this.paginationModal.from        = response.data.arrayAlmacen.from;
                    this.paginationModal.to           = response.data.arrayAlmacen.to;
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
            cambiarPaginaAlmacen(page){
                this.paginationModal.current_page=page;
                this.listarAlmacen(page);
            },
            asignarAlmacen(objAlmacen){
                this.formAlmacen.cwhscode = objAlmacen.cWhsCode;
                this.formAlmacen.cwhsname = objAlmacen.cWhsName;
                this.formAlmacen.cacctcodeentrada = objAlmacen.cAcctCode;
                this.formAlmacen.cacctcodesalida = objAlmacen.cAcctCodeSalida;
                this.cerrarModal();
            },
            //=============== LISTAR MODAL POR VIN ===================
            listarPorVin(page){
                var url = this.ruta + '/pdi/GetListCompra';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'dfechainicio' : this.fillCompra.dfechainicio,
                        'dfechafin' : this.fillCompra.dfechafin,
                        'nordencompra' : this.fillCompra.nordencompra == '' ? 0 : this.fillCompra.nordencompra,
                        'cnumerovin' : this.fillCompra.cnumerovin,
                        'nidmarca': this.fillCompra.nidmarca,
                        'nidmodelo': this.fillCompra.nidmodelo,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayCompra = response.data.arrayCompra.data;
                    this.paginationModal.current_page =  response.data.arrayCompra.current_page;
                    this.paginationModal.total = response.data.arrayCompra.total;
                    this.paginationModal.per_page    = response.data.arrayCompra.per_page;
                    this.paginationModal.last_page   = response.data.arrayCompra.last_page;
                    this.paginationModal.from        = response.data.arrayCompra.from;
                    this.paginationModal.to           = response.data.arrayCompra.to;
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
            cambiarPaginaVin(page){
                this.paginationModal.current_page=page;
                this.listarPorVin(page);
            },
            asignarVin(objCompra){
                this.formPdi.nidcompra          = objCompra.nIdCompra;
                this.formPdi.cvinplacanombre    = objCompra.cNumeroVin;
                this.formPdi.cnumerovin         = objCompra.cNumeroVin;
                this.ccustomercode              = objCompra.cCustomerCode;
                this.nIdServiceCallCompra       = objCompra.nServiceCallIDCompra;
                this.nIdServiceCallVenta        = objCompra.nServiceCallIDVenta;
                this.formPdi.nidvehiculoplaca   = 0;
                this.cerrarModal();
            },
            llenarComboMarca(){
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
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';

                axios.get(url,{
                    params: {
                        'nidmarca' : this.fillCompra.nidmarca,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayModelo = response.data.arrayModelo;
                    this.fillCompra.nidmodelo = '';
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
            changeFlagVinPlaca(){
                this.formPdi.nidcompra          = 0;
                this.formPdi.cvinplacanombre    = '';
                this.formPdi.cnumerovin         = '';
                this.ccustomercode              = '';
                this.nIdServiceCallCompra       = '';
                this.nIdServiceCallVenta        = '';
                this.formPdi.nidvehiculoplaca   = 0;
            },
            //=============== LISTAR MODAL POR PLACA ===================
            listarPorPlaca(page){
                var url = this.ruta + '/pdi/GetLstVehiculosByCriterio';
                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cnrovehiculo' : this.fillVehiculoPlaca.cdescripcion.toString(),
                        'criterio': 2,
                        'page' : page,
                    }
                }).then(response => {
                    let info = response.data.arrayVehiculosByCriterio;
                    this.arrayVehiculoPlaca           = info.data;
                    this.paginationModal.current_page =  info.current_page;
                    this.paginationModal.total        = info.total;
                    this.paginationModal.per_page     = info.per_page;
                    this.paginationModal.last_page    = info.last_page;
                    this.paginationModal.from         = info.from;
                    this.paginationModal.to           = info.to;
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
            cambiarPaginaPlaca(page){
                this.paginationModal.current_page=page;
                this.listarPorPlaca(page);
            },
            asignarPlaca(objVehiculo){
                this.formPdi.nidcompra          = 0;
                this.formPdi.cvinplacanombre    = objVehiculo.cPlaca;
                this.formPdi.nidvehiculoplaca   = objVehiculo.nIdVehiculoPlaca;
                this.cerrarModal();
            },
            //===========
            obtenerOrdenVenta(){
                var url = this.ruta + '/pedido/GetOrdenVenta';

                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'       : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'ncriterio'         : this.formPdi.nidcompra == 0 ? '2' : '1',
                        'cvinplacanombre'   : this.formPdi.cvinplacanombre
                    }
                }).then(response => {
                    let me = this;
                    me.nDocEntryOrdenVenta = response.data[0].nDocEntryOrdenVenta;
                    me.nDocNumOrdenVenta = response.data[0].nDocNumOrdenVenta;
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
            //=============== LISTAR MODAL PLANTILLA ===================
            listarSeccion(){
                var url = this.ruta + '/pdi/GetListSeccion';
                axios.get(url, {
                    params: {
                        'nidempresa' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidtipoinspeccion' : this.formPdi.nidtipoinspeccion,
                        'nidflag': this.formPlantilla.nidflag
                    }
                }).then(response => {
                    this.arraySeccion = response.data;
                    this.listarItems();
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
            listarItems(){
                var url = this.ruta + '/pdi/GetListItem';
                axios.get(url, {
                    params: {
                        'nidempresa' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidtipoinspeccion' : this.formPdi.nidtipoinspeccion,
                        'nidflag': this.formPlantilla.nidflag
                    }
                }).then(response => {
                    let me = this;
                    me.arrayItems = response.data;
                    me.arrayItems.map(function(value, key){
                        me.arrayPlantillaFlagMarca[value.nIdPlantillaInspeccionSeccionItem] = false;
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
            },
            llenarFlag(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110080
                    }
                }).then(response => {
                    this.arrayFlag = response.data;
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
            aceptarPlantilla(){
                let me = this;
                me.arrayPlantilla = [];
                me.arrayItems.map(function(value, key){
                    me.arrayPlantilla.push({
                        nIdPlantillaInspeccionSeccionItem: value.nIdPlantillaInspeccionSeccionItem,
                        cFlagMarca: me.arrayPlantillaFlagMarca[value.nIdPlantillaInspeccionSeccionItem]==false ? 'N' : 'C',
                        cDescripcionNoConformidad: me.arrayPlantillaDescripcion[key]==null ? '' : me.arrayPlantillaDescripcion[key]
                    });
                });
                this.nflagseccioninspeccionValida = 1;
                this.cerrarModal();
            },
            //=============== LISTAR MODAL ACCESORIO ===================
            listarAccesorio(){
                var url = this.ruta + '/pdi/GetElementoByTipo';

                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidtipoelemen'     :   0,
                        'celementonombre'   :   ''
                    }
                }).then(response => {
                    let me = this;
                    me.links = [];
                    me.links = response.data.arrayElementoVenta;
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
            querySearch(queryString, cb) {
                var links = this.links;
                var results = queryString ? links.filter(this.createFilter(queryString)) : links;
                // call callback function to return suggestions
                cb(results);
            },
            createFilter(queryString) {
                return (obj) => {
                    //Busca coincidencias del string escrito con algun Nombre del Objeto del Arreglo
                    return (obj.value.indexOf(queryString.toUpperCase()) >= 0);
                 };
            },
            asignarAccesorio(item) {
                let me = this;
                if(me.encontrarAccesorio(item.nIdElemento)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'El accesorio ya se encuentra agregado!',
                    })
                } else {
                    me.arrayAccesorio.push({
                        'nIdElemento'               :   item.nIdElemento,
                        'nIdTipoElemento'           :   item.nIdTipoElemento,
                        'cTipoElemenNombre'         :   item.cTipoElemenNombre,
                        'nIdProveedor'              :   item.nIdProveedor,
                        'cProveedorNombre'          :   item.cProveedorNombre,
                        'cElemenNombre'             :   item.cElemenNombre,
                        'value'                     :   item.value,
                        'nIdMoneda'                 :   item.nIdMoneda,
                        'cMonedaNombre'             :   item.cMonedaNombre,
                        'cCodigoERP'                :   item.cCodigoERP,
                        'fElemenValorVenta'         :   item.fElemenValorVenta,
                        'fElemenValorMinimoVenta'   :   item.fElemenValorMinimoVenta,
                        'fElementValorCosto'        :   item.fElementValorCosto,
                        'cElementoEstado'           :   item.cElementoEstado,
                        'nCantidad'                 :   1,
                        'cFlagMarca'                :   true,
                        'cDescripcion'              :   '',
                        'cWhsCode'                  :   '19',
                        'cWhsName'                  :   ''
                    });

                    toastr.success('Se agregó accesorio');
                }
            },
            verificarConformidad(){
                let me = this;
                me.arrayAccesorio.map(function(value, key){
                    if(value.cFlagMarca == false){
                        value.cDescripcion = '';
                    }
                });
            },
            aceptarAccesorio(){
                let me = this;

                this.nflagaccesorioValida  = 1;//Valida que se aceptaron los accesorios
                this.fillAccesorio.cnombre = '';
                this.cerrarModal();
            },
            encontrarAccesorio(nIdElemento){
                var sw=0;
                this.arrayAccesorio.map(function (x) {
                    if(x.nIdElemento == nIdElemento){
                        sw = true;
                    }
                });
                return sw;
            },
            removerAccesorio(index){
                this.$delete(this.arrayAccesorio, index);
            },
            //================================================================
            listarAccesorioPdiEntrada(){
                let me = this;
                var url = me.ruta + '/pdi/GetElementoByTipoBsq';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'tipoBsq'           :   me.formPdi.nidflagvinplaca,
                        'codVehiculo'       :   (me.formPdi.nidflagvinplaca == 1) ? me.formPdi.cnumerovin : me.formPdi.nidvehiculoplaca
                    }
                }).then(response => {
                    me.arrayAccesorioFlag = [];
                    me.arrayAccesorioFlag = response.data.arrayElementoVenta;
                    me.llenarAccesorios();
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
            listarAccesoriosPdiEntregaVehiculo(){
                let me = this;
                var url = me.ruta + '/pdi/GetAccesoriosPdiEntregaVehiculo';
                axios.get(url, {
                    params: {
                        'nidempresa'        :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'tipoBsq'           :   me.formPdi.nidflagvinplaca,
                        'codVehiculo'       :   (me.formPdi.nidflagvinplaca == 1) ? me.formPdi.cnumerovin : me.formPdi.nidvehiculoplaca
                    }
                }).then(response => {
                    console.log(response.data);
                    me.arrayAccesorioFlag = [];
                    me.arrayAccesorioFlag = response.data.arrayElementoVenta;
                    me.llenarAccesorios();
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
            llenarAccesorios(){
                let me = this;
                me.arrayAccesorioFlag.map(function(value, key){
                    me.arrayAccesorio.push({
                        'nIdElemento'               : value.nIdElemento,
                        'nIdTipoElemento'           : value.nIdTipoElemento,
                        'cTipoElemenNombre'         : value.cTipoElemenNombre,
                        'nIdProveedor'              : value.nIdProveedor,
                        'cProveedorNombre'          : value.cProveedorNombre,
                        'cElemenNombre'             : value.cElemenNombre,
                        'value'                     : value.value,
                        'nIdMoneda'                 : value.nIdMoneda,
                        'cMonedaNombre'             : value.cMonedaNombre,
                        'cCodigoERP'                : value.cCodigoERP,
                        'fElemenValorVenta'         : value.fElemenValorVenta,
                        'fElemenValorMinimoVenta'   : value.fElemenValorMinimoVenta,
                        'fElementValorCosto'        : value.fElementValorCosto,
                        'cElementoEstado'           : value.cElementoEstado,
                        'nCantidad'                 : value.nCantidad,
                        'cFlagMarca'                : true,
                        'cDescripcion'              : '',
                        'cWhsCode'                  : !value.cWhsCode ? '' : value.cWhsCode,
                        'cWhsName'                  : !value.cWhsName ? '' : value.cWhsName,
                        'cAcctCodeEntrada'          : !value.cAcctCodeEntrada ? '' : value.cAcctCodeEntrada,
                        'cAcctCodeSalida'           : !value.cAcctCodeSalida ? '' : value.cAcctCodeSalida
                    });
                });
            },
            //=============== ADJUNTAR DOCUMENTO ===================
            getFile(e){
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
            },
            //================= REGISTRO =======================
            registrar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();

                var url = this.ruta + '/pdi/SetCabeceraInspeccion';
                axios.post(url, {
                    'nIdEmpresa'                : parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal'               : parseInt(sessionStorage.getItem("nIdSucursal")),
                    'nIdPuntoInspeccion'        : this.formPdi.nidpuntoinspeccion,
                    'nIdSolicitudAutorizacion'  : this.formPdi.nidsolicitud,
                    'nIdCompra'                 : this.formPdi.nidcompra,
                    'nIdVehiculoPlaca'          : this.formPdi.nidvehiculoplaca,
                    'nIdTipoInspeccion'         : this.formPdi.nidtipoinspeccion,
                    'cIdAlmacen'                : this.formAlmacen.cwhscode,
                    'cNumeroInspeccion'         : this.formPdi.cnumeroinspeccion,
                    'dFechaInspeccion'          : this.formPdi.dfechainspeccion,
                    'cHoraInspeccion'           : this.formPdi.chorainspeccion,
                    'cFlagTipoMovimiento'       : this.formPdi.nidflagmovimiento == 1 ? 'I' : 'S',
                    'cFlagVinPlaca'             : this.formPdi.nidcompra == 0 ? 'P' : 'V',
                    'cNumeroMovimientoAlmacen'  : '',
                    'dFechaMovimientoAlmacen'   : this.formPdi.dfechamovimientoalmacen,
                    'cFlagEstadoAprobacion'     : this.formPdi.nidconformidad == 1 ? 'C' : 'N',
                    'cObservacion'              : this.formPdi.cobservacion
                }).then(response => {
                    let me = this;
                    if(response.data[0].nFlagMsje == 1)
                    {
                        //Obtener el ID de la Cabecera Inspeccion Registrada
                        this.formPdi.nidcabecerainspeccion = response.data[0].nIdCabeceraInspeccion;

                        if(this.nflagseccioninspeccionValida==1){
                            if(this.arrayPlantilla.length){
                                this.registrarPlantilla();
                            }
                        }
                        // Si se Sube imagen
                        if(this.attachment){
                            this.subirArchivo();
                        }

                        //Validar que se aceptaron los accesorios
                        if(this.nflagaccesorioValida==1){
                            this.registrarAccesorios();
                        }

                        //this.generaSapActividadPdiEntrada();
                        //this.generaSapMercanciaEntry();
                    }
                    else{
                        swal('ERROR EN LA INSPECCIÓN');
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
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.formPdi.nidpuntoinspeccion){
                    this.mensajeError.push('Debes Seleccionar Punto Inspección');
                };
                if(this.accion==2){
                    if(this.formPdi.nidsolicitud==0 || this.formPdi.nidsolicitud==''){
                        this.mensajeError.push('Debes ingresar una Solicitud Autorización');
                    };
                }
                if(this.formPdi.cvinplacanombre ==''){
                    this.mensajeError.push('Debes ingresar un Nro Vin o Placa');
                };
                if(this.formPdi.nidtipoinspeccion == 0){
                    this.mensajeError.push('Debes Seleccionar Tipo Inspección');
                };
                if(this.formPdi.nidflagmovimiento == 0){
                    this.mensajeError.push('Debes Seleccionar Tipo Movimiento');
                };
                /*if(this.formPdi.cnumeroinspeccion ==''){
                    this.mensajeError.push('Debes Ingresar Número Inspección');
                };*/
                if(this.formPdi.dfechainspeccion ==''){
                    this.mensajeError.push('Debes Ingresar Fecha Inspección');
                };
                if(this.formPdi.chorainspeccion ==''){
                    this.mensajeError.push('Debes Ingresar Hora Inspección');
                };
                if(this.nflagseccioninspeccion == 1 && this.nflagseccioninspeccionValida == 0){
                    this.mensajeError.push('Debes Validar Plantilla');
                };
                if(this.nflagaccesorio == 1 && this.nflagaccesorioValida == 0){
                    this.mensajeError.push('Debes Validar Accesorios');
                };
                if(this.nflagalmacen == 1 && this.nflagalmacenValida == 0){
                    if(!this.formAlmacen.cwhscode){
                        this.mensajeError.push('Debes Seleccionar Almacén');
                    };
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            activar(nIdPuntoInspeccion){
                swal({
                    title: 'Estas seguro de activar este Punto Inspección?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/puntoinspeccion/activar';
                        axios.put(url , {
                            nIdPuntoInspeccion: nIdPuntoInspeccion
                        }).then(response => {
                            swal(
                            'Activado!',
                            'El registro fue activado.'
                            );
                            this.listarPuntoInspeccion(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            desactivar(nIdPuntoInspeccion){
                swal({
                    title: 'Estas seguro de desactivar este Punto Inspección?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/puntoinspeccion/desactivar';
                        axios.put(url , {
                            nIdPuntoInspeccion: nIdPuntoInspeccion
                        }).then(response => {
                            swal(
                            'Desactivado!',
                            'El registro fue desactivado.'
                            );
                            this.listarPuntoInspeccion(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            actualizar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/pdi/UpdCabeceraInspeccion';
                axios.post(url, {
                    'nIdCabeceraInspeccion'     : this.formPdi.nidcabecerainspeccion,
                    'nIdEmpresa'                : parseInt(sessionStorage.getItem("nIdEmpresa")),
                    'nIdSucursal'               : parseInt(sessionStorage.getItem("nIdSucursal")),
                    'cIdAlmacen'                : this.formAlmacen.cwhscode,
                    'cNumeroInspeccion'         : this.formPdi.cnumeroinspeccion,
                    'dFechaInspeccion'          : this.formPdi.dfechainspeccion,
                    'cHoraInspeccion'           : this.formPdi.chorainspeccion,
                    'cNumeroMovimientoAlmacen'  : '',
                    'dFechaMovimientoAlmacen'   : this.formPdi.dfechamovimientoalmacen,
                    'cFlagEstadoAprobacion'     : this.formPdi.nidconformidad == 1 ? 'C' : 'N',
                    'cObservacion'              : this.formPdi.cobservacion
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        if(this.nflagseccioninspeccionValida==1){
                            if(this.arrayPlantilla.length){
                                this.registrarPlantilla();
                            }
                        }

                        if(this.attachment){
                            this.subirArchivo();
                        }

                        if(this.nflagaccesorioValida==1){
                            this.registrarAccesorios();
                        }
                    }
                    else{
                        swal('ERROR EN LA INSPECCIÓN');
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
            registrarPlantilla(){
                var url = this.ruta + '/pdi/SetPlantillaPdi';
                axios.post(url, {
                    nIdCabeceraInspeccion: this.formPdi.nidcabecerainspeccion,
                    data: this.arrayPlantilla
                }).then(response => {
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
            registrarAccesorios(){
                let me = this;

                me.arrayTempAccesorio = [];
                me.arrayAccesorio.map(function(value, key){
                    me.arrayTempAccesorio.push({
                        'nIdAccesorio'      : value.nIdElemento,
                        'cCodigoERP'        : value.cCodigoERP,
                        'nCantidad'         : value.nCantidad,
                        'fMonto'            : value.fElemenValorVenta,
                        'cFlagMarca'        : (value.cFlagMarca == false) ? 'N' : 'C',
                        'cDescripcionNoConformidad': (value.cDescripcion == null) ? '' : value.cDescripcion,
                        'cElemenNombre'     : value.cElemenNombre,
                        'cWhsCode'          : !value.cWhsCode ? me.formAlmacen.cwhscode : value.cWhsCode,
                        'cAcctCodeEntrada'  : !value.cAcctCodeEntrada ? '' : value.cAcctCodeEntrada,
                        'cAcctCodeSalida'   : !value.cAcctCodeSalida ? '' : value.cAcctCodeSalida
                    });
                });

                var url = me.ruta + '/pdi/SetAccesorioPdi';
                axios.post(url, {
                    'nIdCabeceraInspeccion' : me.formPdi.nidcabecerainspeccion,
                    'data'                  : me.arrayTempAccesorio
                }).then(response => {
                    //Si es Pdi Entrada
                    if(me.formPdi.nidtipoinspeccion == 4){
                        setTimeout(function() {
                            me.generaSapMercanciaEntry();
                        }, 1600);
                    }
                    //Si es Pdi Entrega Vehiculo
                    else if(me.formPdi.nidtipoinspeccion == 5){
                        setTimeout(function() {
                            me.generaSapMercanciaExit();
                        }, 1600);
                    }
                    else{
                        me.confirmaPdi();
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
            /*
            generaSapLlamadaServicioPdiEntrada(){
                let me = this;

                var sapUrl = me.ruta + '/llamadaservicio/SapSetLlamadaServicio';
                axios.post(sapUrl, {
                    'data': me.arraySapLlamadaServicio
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(x);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.ItemCode){
                            me.arraySapItemCode.push(me.jsonRespuesta.ItemCode); //PARA DEPURAR

                            me.arraySapUpdSgc.push({
                                'nServiceCallID'    : me.jsonRespuesta.ServiceCallID.toString(),
                                'cFlagTipo'         : 'S', //LLAMADA SERVICIO PDI SERVICIOS
                                'nActivityCode'     : me.jsonRespuesta.ServiceCallActivities[0].ActivityCode.toString(),
                                'cInternalSerialNum': me.jsonRespuesta.InternalSerialNum.toString(),
                                'cItemCode'         : me.jsonRespuesta.ItemCode.toString(),
                                'cLogRespuesta'     : response.data.toString()
                            });

                            //=========================================================================
                            //============ ACTUALIZO TABLA INTEGRACION LLAMADA SERVICIO SGC ===========
                            setTimeout(function() {
                                me.generaSgcLlamadaServicioPdiEntrada();
                            }, 1600);
                        }
                    });
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Llamada Servicio SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            generaSgcLlamadaServicioPdiEntrada(){
                let me = this;
                var sapUrl = me.ruta + '/llamadaservicio/SetIntegraLlamadaServicio';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    me.confirmaPdi();
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
            //================Generar Sap Entrada Mercancia ============
            generaSapMercanciaEntry(){
                let me = this;

                me.arrayTempAccesorio.map(function(value, key) {
                    me.arraySapMercancia.push({
                        'ItemCode'          :   value.cCodigoERP,
                        'ItemDescription'   :   value.cElemenNombre,
                        'WarehouseCode'     :   me.formAlmacen.cwhscode,
                        'Quantity'          :   value.nCantidad,
                        'UnitPrice'         :   0.01,
                        'AccountCode'       :   me.formAlmacen.cacctcodeentrada
                    });
                });
                //==============================================================
                //================== REGISTRO MERCANCIA EN SAP ===============
                me.loadingProgressBar("INTEGRANDO ENTRADA DE MERCANCÍAS CON SAP BUSINESS ONE...");

                var sapUrl = me.ruta + '/mercancia/SapSetMercanciaEntry';
                axios.post(sapUrl, {
                    'fDocDate'      : moment().format('YYYY-MM-DD'),
                    'fDocDueDate'   : moment().add(30, 'days').format('YYYY-MM-DD'),
                    'data'          : me.arraySapMercancia
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc    = [];
                    me.arraySapActividad = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(x);
                        //Verifico que devuelva DocEntry
                        if(me.jsonRespuesta.DocEntry){
                            console.log("Integración SAP Mercancia : OK");

                            //Generar varias lineas de la misma Entrada Mercancia para actualizar DOCENTRY en cada detalle de la Entrada Mercancia en SQL SERVER
                            let arrayDocumentLines = me.jsonRespuesta.DocumentLines;

                            arrayDocumentLines.map(function(linea) {
                                //console.log(linea);
                                //Guardo el Codigo SAP de los Elemento Venta
                                me.arrayCodSAPPDI.push({
                                    'nDocEntry' :   parseInt(me.jsonRespuesta.DocEntry),
                                    'cItemCode' :   linea.ItemCode.toString()
                                });

                                me.arraySapUpdSgc.push({
                                    'nTipo'             :   "59",
                                    'cTipoDescripcion'  :   "EntradaMercancia",
                                    'nIdCabeceraInspec' :   me.formPdi.nidcabecerainspeccion,
                                    'cItemCode'         :   linea.ItemCode.toString(),
                                    'nDocEntry'         :   parseInt(me.jsonRespuesta.DocEntry),
                                    'nDocNum'           :   parseInt(me.jsonRespuesta.DocNum),
                                    'cDocType'          :   me.jsonRespuesta.DocType.toString(),
                                    'cLogRespuesta'     :   response.data.toString(),
                                });
                            });

                            me.arraySapActividad.push({
                                'dActivityDate' :   moment().format('YYYY-MM-DD'),
                                'hActivityTime' :   moment().format('HH:mm:ss'),
                                'cCardCode'     :   me.ccustomercode,
                                'cNotes'        :   'PdiEntrada',
                                'nDocEntry'     :   parseInt(me.jsonRespuesta.DocEntry),
                                'nDocNum'       :   parseInt(me.jsonRespuesta.DocNum),
                                'nDocType'      :   '59',
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

                    //==============================================================
                    //================== ACTUALIZAR DOCENTRY ===============
                    setTimeout(function() {
                        me.generaSgcMercanciaEntry();
                    }, 1600);
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Entrada Mercancía SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            generaSgcMercanciaEntry(){
                let me = this;
                var sapUrl = me.ruta + '/mercancia/SetIntegraMercancia';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if (response.data[0].nFlagMsje == 1) {
                        setTimeout(function() {
                            me.generaSapActividadPdiEntrada();
                        }, 1200);
                    } else {
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Error en el registro de Mercancias!',
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
            generaSapActividadPdiEntrada(){
                let me = this;
                //==============================================================
                //================== REGISTRO ACTIVIDAD EN SAP ===============
                var sapUrl = me.ruta + '/actividad/SapSetActividadMercancia';
                axios.post(sapUrl, {
                    'data': me.arraySapActividad
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(x);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.ActivityCode){
                            me.arraySapUpdSgc.push({
                                'nServiceCallID'    : me.nIdServiceCallCompra,
                                'nActivityCode'     : parseInt(me.jsonRespuesta.ActivityCode),
                                'nActividadTipo'    : 4,
                                'cActividadTipo'    : 'PdiEntrada',
                                'cCardCode'         : me.jsonRespuesta.CardCode.toString(),
                                'nDocEntry'         : me.jsonRespuesta.DocEntry.toString(),
                                'nDocNum'           : me.jsonRespuesta.DocNum.toString(),
                                'cLogRespuesta'     : response.data.toString()
                            });

                            /*me.arraySapLlamadaServicio = [];
                            me.arraySapLlamadaServicio.push({
                                'nActivityCode'     : me.jsonRespuesta.ActivityCode,
                                'cCustomerCode'     : me.ccustomercode,
                                'cInternalSerialNum': me.formPdi.cnumerovin,
                                'cItemCode'         : me.formPdi.cnumerovin,
                                'cSubject'          : 'PDI ENTRADA'
                            });*/

                            //================================================================
                            //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                            //me.nactivitycode = me.jsonRespuesta.ActivityCode;
                            setTimeout(function() {
                                me.generaSgcActividadPdiEntrada();
                            }, 1600);
                        }
                    });
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Actividad SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            generaSgcActividadPdiEntrada(){
                let me = this;
                var sapUrl = me.ruta + '/actividad/SetIntegraActividad';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        //================================================================================
                        //================== REGISTRO EN TABLA SCL5 DE LA LLAMADA SERVICIO ===============
                        // setTimeout(function() {
                        //     me.generaSapActividadServiceCallEntry();
                        // }, 1600);
                        me.loading.close();
                        me.confirmaPdi();
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
            //================Generar Sap Entrega Vehiculo ==================
            generaSapMercanciaExit(){
                let me = this;

                me.arrayTempAccesorio.map(function(value, key) {
                    me.arraySapMercancia.push({
                        'ItemCode'       : value.cCodigoERP,
                        'WarehouseCode'  : value.cWhsCode,
                        'Quantity'       : value.nCantidad,
                        'AccountCode'    : value.cAcctCodeSalida
                    });
                });
                //==============================================================
                //================== REGISTRO MERCANCIA EN SAP ===============
                me.loadingProgressBar("INTEGRANDO SALIDA DE MERCANCÍAS CON SAP BUSINESS ONE...");

                var sapUrl = me.ruta + '/mercancia/SapSetMercanciaExit';
                axios.post(sapUrl, {
                    'fDocDate'      : moment().format('YYYY-MM-DD'),
                    'fDocDueDate'   : moment().add(30, 'days').format('YYYY-MM-DD'),
                    'data'          : me.arraySapMercancia
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc    = [];
                    me.arraySapActividad = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(x);
                        //Verifico que devuelva DocEntry
                        if(me.jsonRespuesta.DocEntry){
                            console.log("Integración SAP Mercancia : OK");

                            //Generar varias lineas de la misma Entrada Mercancia para actualizar DOCENTRY en cada detalle de la Entrada Mercancia en SQL SERVER
                            let arrayDocumentLines = me.jsonRespuesta.DocumentLines;

                            arrayDocumentLines.map(function(linea) {
                                //console.log(linea);
                                //Guardo el Codigo SAP de los Elemento Venta
                                me.arrayCodSAPPDI.push({
                                    'nDocEntry' :   parseInt(me.jsonRespuesta.DocEntry),
                                    'cItemCode' :   linea.ItemCode.toString()
                                });

                                me.arraySapUpdSgc.push({
                                    'nTipo'             :   "60",
                                    'cTipoDescripcion'  :   "SalidaMercancia",
                                    'nIdCabeceraInspec' :   me.formPdi.nidcabecerainspeccion,
                                    'cItemCode'         :   linea.ItemCode.toString(),
                                    'nDocEntry'         :   parseInt(me.jsonRespuesta.DocEntry),
                                    'nDocNum'           :   parseInt(me.jsonRespuesta.DocNum),
                                    'cDocType'          :   me.jsonRespuesta.DocType.toString(),
                                    'cLogRespuesta'     :   response.data.toString(),
                                });
                            });

                            me.arraySapActividad.push({
                                'dActivityDate' :   moment().format('YYYY-MM-DD'),
                                'hActivityTime' :   moment().format('HH:mm:ss'),
                                'cCardCode'     :   me.ccustomercode,
                                'cNotes'        :   'PdiSalida',
                                'nDocEntry'     :   parseInt(me.jsonRespuesta.DocEntry),
                                'nDocNum'       :   parseInt(me.jsonRespuesta.DocNum),
                                'nDocType'      :   '60',
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

                    //==============================================================
                    //================== ACTUALIZAR DOCENTRY ===============
                    setTimeout(function() {
                        me.generaActualizarMercanciaExit();
                    }, 1600);
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Salida Mercancía SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            generaActualizarMercanciaExit(){
                let me = this;
                var sapUrl = me.ruta + '/mercancia/SetIntegraMercancia';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    setTimeout(function() {
                        me.generaSapActividadPdiSalida();
                    }, 1600);
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
            generaSapActividadPdiSalida(){
                let me = this;
                //==============================================================
                //================== REGISTRO ACTIVIDAD EN SAP ===============
                var sapUrl = me.ruta + '/actividad/SapSetActividadMercancia';
                axios.post(sapUrl, {
                    'data': me.arraySapActividad
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(x);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.ActivityCode){
                            me.arraySapUpdSgc.push({
                                'nServiceCallID'    : me.nIdServiceCallVenta,
                                'nActivityCode'     : parseInt(me.jsonRespuesta.ActivityCode),
                                'nActividadTipo'    : 6,
                                'cActividadTipo'    : 'PdiSalida',
                                'cCardCode'         : me.jsonRespuesta.CardCode.toString(),
                                'nDocEntry'         : me.jsonRespuesta.DocEntry.toString(),
                                'nDocNum'           : me.jsonRespuesta.DocNum.toString(),
                                'cLogRespuesta'     : response.data.toString()
                            });

                            /*me.arraySapLlamadaServicio = [];
                            me.arraySapLlamadaServicio.push({
                                'nActivityCode'     : me.jsonRespuesta.ActivityCode,
                                'cCustomerCode'     : me.ccustomercode,
                                'cInternalSerialNum': me.formPdi.cnumerovin,
                                'cItemCode'         : me.formPdi.cnumerovin,
                                'cSubject'          : 'PDI SALIDA'
                            });*/

                            //================================================================
                            //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                            //me.nactivitycode = me.jsonRespuesta.ActivityCode;
                            setTimeout(function() {
                                me.generaSgcActividadPdiSalida();
                            }, 1600);
                        }
                    });
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Actividad SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            generaSgcActividadPdiSalida(){
                let me = this;
                var sapUrl = me.ruta + '/actividad/SetIntegraActividad';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        //================================================================================
                        //=========== GENERAR ACTIVIDAD ENTREGA VINCULADA A ORDEN DE VENTA ===============
                        setTimeout(function() {
                            me.generaSapActividadPdiEntrega();
                        }, 1600);
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
            generaSapActividadPdiEntrega(){
                let me = this;

                me.arraySapActividad = [];
                me.arraySapActividad.push({
                    'dActivityDate' :   moment().format('YYYY-MM-DD'),
                    'hActivityTime' :   moment().format('HH:mm:ss'),
                    'cCardCode'     :   me.ccustomercode,
                    'cNotes'        :   'EntregaVehiculo',
                    'nDocEntry'     :   me.nDocEntryOrdenVenta.toString(),
                    'nDocNum'       :   me.nDocNumOrdenVenta.toString(),
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

                //==============================================================
                //================== REGISTRO ACTIVIDAD EN SAP ===============
                var sapUrl = me.ruta + '/actividad/SapSetActividad';
                axios.post(sapUrl, {
                    'data': me.arraySapActividad
                }).then(response => {
                    me.arraySapRespuesta = [];
                    me.arraySapUpdSgc = [];

                    me.arraySapRespuesta = response.data;
                    me.arraySapRespuesta.map(function(x){
                        me.jsonRespuesta = '';
                        me.jsonRespuesta= JSON.parse(x);
                        //Si el valor de respuesta Code tiene un valor
                        if(me.jsonRespuesta.ActivityCode){
                            me.arraySapUpdSgc.push({
                                'nServiceCallID'    : me.nIdServiceCallVenta,
                                'nActivityCode'     : parseInt(me.jsonRespuesta.ActivityCode),
                                'nActividadTipo'    : 5,
                                'cActividadTipo'    : 'PdiEntregaVehiculo',
                                'cCardCode'         : me.jsonRespuesta.CardCode.toString(),
                                'nDocEntry'         : me.jsonRespuesta.DocEntry.toString(),
                                'nDocNum'           : me.jsonRespuesta.DocNum.toString(),
                                'cLogRespuesta'     : response.data.toString()
                            });

                            //================================================================
                            //=========== ACTUALIZO TABLA INTEGRACION ACTIVIDAD SGC ==========
                            setTimeout(function() {
                                me.generaSgcActividadPdiEntrega();
                            }, 1600);
                        }
                    });
                }).catch(error => {
                    me.limpiarPorError("Error en la Integración Actividad SapB1!");
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            generaSgcActividadPdiEntrega(){
                let me = this;
                var sapUrl = me.ruta + '/actividad/SetIntegraActividad';
                axios.post(sapUrl, {
                    'data': me.arraySapUpdSgc
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        me.loading.close();
                        me.confirmaPdi();
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
            //=======================================================
            subirArchivo(){
                this.form.append('file', this.attachment);
                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };
                var url = this.ruta + '/documentoadjunto/subirArchivoPDI';

                axios.post(url, this.form, config).then(response=>{
                    this.registrarCabeceraInspeccionDocumento(response.data[0].nIdDocumentoAdjunto);
                }).then(function (response) {
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
            registrarCabeceraInspeccionDocumento(nIdDocumentoAdjunto){
                var url = this.ruta + '/pdi/SetCabeceraInspeccionDocumento';
                axios.post(url, {
                    nIdCabeceraInspeccion: this.formPdi.nidcabecerainspeccion,
                    nIdDocumentoAdjunto: nIdDocumentoAdjunto
                }).then(response => {
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
            confirmaPdi(){
                swal('Inspección realizada con éxito');
                this.limpiarFormulario();
                this.vistaFormulario = 1;
                this.listarPdi(1);
            },
            abrirFormulario(modelo, accion, data =[]){
                switch(modelo){
                    case 'pdi':
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 1;
                                this.tituloFormulario = 'NUEVO PROCESO DE INSPECCIÓN';
                                this.llenarTipoInspeccion();
                                this.limpiarFormulario();
                                break;
                            }
                            case 'actualizar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.tituloFormulario = 'ACTUALIZAR PUNTO DE INSPECCIÓN';
                                this.formPdi.nidcabecerainspeccion = data['nIdCabeceraInspeccion'];
                                this.formPdi.nidtipoinspeccion = data['nIdTipoInspeccion'];
                                this.formPdi.nidpuntoinspeccion = data['nIdPuntoInspeccion'];
                                this.formPdi.cnombrepuntoinspeccion = data['cNombrePuntoInspeccion'];
                                this.formPdi.nidsolicitud = data['nIdSolicitudAutorizacion'];
                                this.formPdi.cnombresolicitud = data['cNombreSolicitud'] + ' - ' + data['cNumeroSolicitud'];
                                this.formPdi.cvinplacanombre = data['cVinPlaca'];
                                this.formPdi.nidflagmovimiento = data['nFlagMovimiento'];
                                this.formPdi.cFlagVinPlaca = data['cFlagVinPlaca'];
                                this.formPdi.nidcompra = data['nIdCompra'];
                                this.formPdi.cnumerovin = data['cNumeroVin'];
                                this.formPdi.nidvehiculoplaca = data['nIdVehiculoPlaca'];
                                this.formPdi.nidflagvinplaca = data['nIdFlagVinPlaca'];
                                this.obtenerOrdenVenta();
                                this.obtenerDetalleTipoInspeccionById();
                                break;
                            }
                        }
                    }
                }
            },
            cerrarModal(){
                this.modal = 0
                this.error = 0,
                this.mensajeError = ''
            },
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'pdi':
                    {
                        switch(accion){
                            case 'solicitud':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarSolicitud(1);
                                break;
                            }
                            case 'puntoinspeccion':
                            {
                                this.accionmodal=4;
                                this.modal = 1;
                                this.listarPuntoInspeccion(1);
                                break;
                            }
                            case 'vinplaca':
                            {
                                this.changeFlagVinPlaca();
                                this.limpiarFormulario();
                                //Si es VIN
                                if(this.formPdi.nidflagvinplaca == 1){
                                    this.accionmodal    = 5;
                                    this.modal          = 1;
                                    this.llenarComboMarca();
                                    this.llenarComboModelo();
                                    //this.listarPorVin(1);
                                }
                                //Si es Placa
                                else{
                                    this.accionmodal    = 6;
                                    this.modal          = 1;
                                    //this.listarPorPlaca(1);
                                }
                                break;
                            }
                            case 'plantilla':
                            {
                                this.validaAccionModal = 7;

                                if(this.validarMostrarModal()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }

                                this.accionmodal=7;
                                this.modal = 1;
                                this.llenarFlag();
                                break;
                            }
                            case 'accesorio':
                            {
                                this.accionmodal = 8;
                                this.modal = 1;

                                this.listarAccesorio();
                                //Solo si es Entrada
                                if(this.formPdi.nidtipoinspeccion == 4 && !this.arrayAccesorio.length) {
                                    this.listarAccesorioPdiEntrada();
                                };
                                //Si es Entrega Vehiculo
                                if(this.formPdi.nidtipoinspeccion == 5 && !this.arrayAccesorio.length){
                                    this.listarAccesoriosPdiEntregaVehiculo();
                                };
                                break;
                            }
                        }
                    }
                    break;
                    case 'almacen':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=9;
                                this.modal = 1;
                                this.listarAlmacen(1);
                                break;
                            }
                        }
                    }
                    break;
                }
            },
            validarMostrarModal(){
                this.error = 0;
                this.mensajeError =[];

                //================ MODAL PLANILLA ==================
                if(this.validaAccionModal == 7){
                    if(this.formPdi.nidtipoinspeccion == 0 || this.formPdi.nidtipoinspeccion == 0){
                        this.mensajeError.push('Debes Seleccionar Tipo Inspección');
                    }
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarFormulario(){
                this.formPdi.cnumerovin = '',
                this.formPdi.nidcompra = '',
                this.formPdi.nidflagmovimiento = 1,
                //this.formPdi.nidflagvinplaca = 1
                this.formPdi.nidpuntoinspeccion = 0,
                this.formPdi.cnombrepuntoinspeccion = '',
                this.formPdi.nidsolicitud = 0,
                this.formPdi.cnombresolicitud = '',
                this.formPdi.cvinplacanombre = '',
                this.formPdi.nidtipoinspeccion= '',
                this.nflagalmacen= 0,
                this.nflagaccesorio= 0,
                this.nflagtestdrive= 0,
                this.nflagseccioninspeccion= 0,
                this.nflagvalidarfichatecnica= 0,
                this.nflagalmacenValida= 0,
                this.nflagaccesorioValida= 0,
                this.nflagtestdriveValida= 0,
                this.nflagseccioninspeccionValida= 0,
                this.nflagvalidarfichatecnicaValida= 0,
                this.nidflagmovimiento = 1,
                this.formPdi.cnumeroinspeccion = '',
                this.formPdi.dfechainspeccion = '',
                this.formPdi.chorainspeccion = '',
                this.formPdi.nidalmacen = '',
                this.formPdi.dfechamovimientoalmacen = '',
                this.formPdi.cobservacion = '',
                this.arraySeccion=[],
                this.arrayItems=[],
                this.arrayPlantilla =[],
                this.arrayAccesorio =[],
                this.arrayTempAccesorio =[],
                //this.arrayAccesorioCantidad=[],
                this.formAlmacen.nidlocalidad = '';
                this.formAlmacen.cwhscode = '';
                this.formAlmacen.cwhsname = '';
                this.formAlmacen.cacctcode = '';

                //========= VARIABLES SAP =============
                //Limpiar variables Sap Articulo
                this.arraySapArticulo= [],
                this.arraySapItemCode= [],
                this.arraySapRespuesta= [],
                this.jsonRespuesta= '',
                this.arraySapUpdSgc= [],
                this.arraySapMercancia= [],
                this.arraySapLlamadaServicio= [],
                this.arraySapActividad= [],
                this.nactivitycode= 0,
                this.nIdServiceCallCompra= 0,
                this.nIdServiceCallVenta= 0,
                this.arrayCodSAPPDI= []
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
                this.listarPdi(1);
            },
            cambiarVistaFormulario(){
                this.vistaFormulario = 1;
                this.limpiarFormulario();
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
    }
    .disabled{
        opacity: 0.65;
        cursor: not-allowed;
        pointer-events:none;
    }
    .el-autocomplete{
        width: 100%;
    }
</style>