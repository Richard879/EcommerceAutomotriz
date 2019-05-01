<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">
                        <vs-divider color="dark">MODULO CARTA DE CARACTERISTICAS - ASESOR COMERCIAL</vs-divider>
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
                                        <a class="nav-link active" id="tab01" href="#TabMisCartas" @click="tabMisCartas" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> MIS CARTAS
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab02" href="#TabAnularSCC" @click="tabAnularSCC" role="tab" data-toggle="tab">
                                            <i class="fa fa-times-circle"></i> ANULAR SCC
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab03" href="#TabRegistrarSCC" @click="tabNuevaSCC" role="tab" data-toggle="tab">
                                            <i class="fa fa-list-alt"></i> GENERAR SCC
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabMisCartas">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR MIS CARTAS</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillCartaCaracteristica.dfechainicio"
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
                                                                            <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillCartaCaracteristica.dfechafin"
                                                                                    value-format="yyyy-MM-dd"
                                                                                    format="dd/MM/yyyy"
                                                                                    type="date"
                                                                                    placeholder="dd/mm/aaaa">
                                                                                </el-date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">VIN</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="fillCartaCaracteristica.cnumerovin" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Vin</div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('compra','buscar')">
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
                                                                            <label class="col-sm-4 form-control-label">Cotización</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="fillCartaCaracteristica.cnombrecontacto" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Contacto</div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('contacto','buscar')">
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
                                                                            <label class="col-sm-4 form-control-label">Estado</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillCartaCaracteristica.nidestado"
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
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="buscarMisCartas(1)">
                                                                            <i class="fa fa-search"></i> Buscar
                                                                        </button>
                                                                        <button type="button" class="btn btn-default btn-corner btn-sm" @click.prevent="limpiarMisCartas()">
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
                                                                    <template v-if="arrayCartaCaracteristicas.length">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Fecha Inicio</th>
                                                                                        <th>Fecha Fin</th>
                                                                                        <th>N° Carta</th>
                                                                                        <th>Contacto</th>
                                                                                        <th>VIN</th>
                                                                                        <th>Estado</th>
                                                                                        <th>Evaluacion</th>
                                                                                        <th>Acciones</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="carta in arrayCartaCaracteristicas" :key="carta.nIdSolicitudCartaCaracteristica">
                                                                                        <td v-text="carta.dFechaInicioCarta"></td>
                                                                                        <td v-text="carta.dFechaVencimientoCarta"></td>
                                                                                        <td v-text="carta.cNumeroCartaCaracteristica"></td>
                                                                                        <td v-text="carta.cContacto"></td>
                                                                                        <td v-text="carta.cNumeroVin"></td>
                                                                                        <td v-text="carta.cEstado"></td>
                                                                                        <td v-text="carta.cEvaluacion"></td>
                                                                                        <td>
                                                                                            <el-tooltip class="item" :content="'Ver Pdf ' + carta.cNumeroCartaCaracteristica" effect="dark" placement="top-start">
                                                                                                <a :href="carta.cRutaDocumento" v-if="carta.cFlagEstadoAprobacion =='CO' || carta.cFlagEstadoAprobacion =='AP'" target="_blank">
                                                                                                    <i class='fa-md fa fa-file'></i>
                                                                                                </a>
                                                                                            </el-tooltip>&nbsp;
                                                                                            <el-tooltip class="item" :content="'Aprobar/Desaprobar ' + carta.cNumeroCartaCaracteristica" effect="dark" placement="top-start">
                                                                                                <a href="#" v-if="carta.cFlagEstadoAprobacion !='PE' && carta.cFlagEstadoAprobacion !='NC' && carta.cFlagEstadoAprobacion !='AP' && carta.cFlagEstadoAprobacion !='DE'"  @click="abrirModal('aprobar', 'abrir', carta.nIdSolicitudCartaCaracteristica);">
                                                                                                    <i class='fa-md fa fa-check-circle'></i>
                                                                                                </a>
                                                                                            </el-tooltip>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-7">
                                                                                        <nav>
                                                                                            <ul class="pagination">
                                                                                                <li v-if="pagination.current_page > 1" class="page-item">
                                                                                                    <a @click.prevent="cambiarPaginaMisCC(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                                </li>
                                                                                                <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                                :class="[page==isActived?'active':'']">
                                                                                                    <a class="page-link"
                                                                                                    href="#" @click.prevent="cambiarPaginaMisCC(page)"
                                                                                                    v-text="page"></a>
                                                                                                </li>
                                                                                                <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                    <a @click.prevent="cambiarPaginaMisCC(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </nav>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                                                                    </div>
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
                                    <div role="tabpanel" class="tab-pane fade" id="TabAnularSCC">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">ANULAR MIS CARTAS.</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillCartaCaracteristica.dfechainicio"
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
                                                                            <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillCartaCaracteristica.dfechafin"
                                                                                    value-format="yyyy-MM-dd"
                                                                                    format="dd/MM/yyyy"
                                                                                    type="date"
                                                                                    placeholder="dd/mm/aaaa">
                                                                                </el-date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">VIN</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="fillCartaCaracteristica.cnumerovin" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Vin</div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('compra','buscar')">
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
                                                                            <label class="col-sm-4 form-control-label">Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="fillCartaCaracteristica.cnombrecontacto" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Contacto</div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('contacto','buscar')">
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
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="buscarMisCartasAnuladas(1)">
                                                                            <i class="fa fa-search"></i> Buscar
                                                                        </button>
                                                                        <button type="button" class="btn btn-default btn-corner btn-sm" @click.prevent="limpiarMisCartas()">
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
                                                                    <template v-if="arrayCartasAnuladas.length">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Fecha Inicio</th>
                                                                                        <th>Fecha Fin</th>
                                                                                        <th>N° Carta</th>
                                                                                        <th>Contacto</th>
                                                                                        <th>VIN</th>
                                                                                        <th>Estado</th>
                                                                                        <th>Evaluacion</th>
                                                                                        <th>Acciones</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="carta in arrayCartasAnuladas" :key="carta.nIdSolicitudCartaCaracteristica">
                                                                                        <td v-text="carta.dFechaInicioCarta"></td>
                                                                                        <td v-text="carta.dFechaVencimientoCarta"></td>
                                                                                        <td v-text="carta.cNumeroCartaCaracteristica"></td>
                                                                                        <td v-text="carta.cContacto"></td>
                                                                                        <td v-text="carta.cNumeroVin"></td>
                                                                                        <td v-text="carta.cEstado"></td>
                                                                                        <td v-text="carta.cEvaluacion"></td>
                                                                                        <td>
                                                                                            <el-tooltip class="item" :content="'Ver Pdf ' + carta.cNumeroCartaCaracteristica" effect="dark" placement="top-start">
                                                                                                <a :href="carta.cRutaDocumento" v-if="carta.cFlagEstadoAprobacion =='DE' && carta.cEstado == 'ANULADO'" target="_blank">
                                                                                                    <i class='fa-md fa fa-file'></i>
                                                                                                </a>
                                                                                            </el-tooltip>&nbsp;
                                                                                            <el-tooltip class="item" :content="'Anular ' + carta.cNumeroCartaCaracteristica" effect="dark" placement="top-start">
                                                                                                <a href="#" v-if="carta.cFlagEstadoAprobacion =='DE' && carta.cEstado != 'ANULADO'"  @click="abrirModal('desaprobar', 'abrir', carta.nIdSolicitudCartaCaracteristica);">
                                                                                                    <i :style="'color:red'" class='fa-md fa fa-times-circle'></i>
                                                                                                </a>
                                                                                            </el-tooltip>
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
                                                                                                    <a @click.prevent="cambiarPaginaMisCCAnuladas(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                                </li>
                                                                                                <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                                :class="[page==isActived?'active':'']">
                                                                                                    <a class="page-link"
                                                                                                    href="#" @click.prevent="cambiarPaginaMisCCAnuladas(page)"
                                                                                                    v-text="page"></a>
                                                                                                </li>
                                                                                                <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                    <a @click.prevent="cambiarPaginaMisCCAnuladas(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                    <div role="tabpanel" class="tab-pane fade" id="TabRegistrarSCC">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">NUEVA CARTA DE CARACTERISTICAS.</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* N° Carta</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="number" min="1" v-model="fillCartaCaracteristica.cnumcarta" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <el-input placeholder="Atendió" v-model="fillCartaCaracteristica.catencion" class="input-with-select col-sm-12">
                                                                                <el-select v-model="fillCartaCaracteristica.nidref" slot="prepend" placeholder="Ref.">
                                                                                    <el-option v-for="referencia in arrayReferencia" :key="referencia.nIdPar" :label="referencia.cParAbreviatura" :value="referencia.nIdPar"></el-option>
                                                                                </el-select>
                                                                            </el-input>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillCartaCaracteristica.dfechainicio"
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
                                                                            <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                                            <div class="col-sm-8">
                                                                                <el-date-picker
                                                                                    v-model="fillCartaCaracteristica.dfechafin"
                                                                                    value-format="yyyy-MM-dd"
                                                                                    format="dd/MM/yyyy"
                                                                                    type="date"
                                                                                    placeholder="dd/mm/aaaa">
                                                                                </el-date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* VIN</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="fillCartaCaracteristica.cnumerovin" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Vin</div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('compra','buscar')">
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
                                                                            <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" v-model="fillCartaCaracteristica.cnombrecontacto" disabled="disabled" class="form-control form-control-sm">
                                                                                    <div class="input-group-prepend">
                                                                                        <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                            <div slot="content">Buscar Contacto</div>
                                                                                            <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('contacto','buscar')">
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
                                                                            <label class="col-sm-4 form-control-label">*Banco</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillCartaCaracteristica.nidbanco"
                                                                                        filterable
                                                                                        clearable
                                                                                        loading-text
                                                                                        placeholder="SELECCIONE BANCO"
                                                                                        @change="llenarSucursalesByBanco()">
                                                                                    <el-option
                                                                                        v-for="banco in arrayBanco"
                                                                                        :key="banco.nIdPar"
                                                                                        :label="banco.cParNombre"
                                                                                        :value="banco.nIdPar">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">*Sucursal</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillCartaCaracteristica.nidsucursal"
                                                                                        filterable
                                                                                        clearable
                                                                                        loading-text
                                                                                        placeholder="SELECCIONE SUCURSAL">
                                                                                    <el-option
                                                                                        v-for="sucursal in arraySucursalBanco"
                                                                                        :key="sucursal.nIdPar"
                                                                                        :label="sucursal.cParNombre"
                                                                                        :value="sucursal.nIdPar">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Precio Final Dolar</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="number" min="1" v-model="fillCartaCaracteristica.fpreciodolar" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Cuota Inicial</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="number" min="1" v-model="fillCartaCaracteristica.fcuotainicial" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Monto a Desembolsar</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="number" min="1" v-model="fillCartaCaracteristica.fmontodesembolar" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="registrarSCC">
                                                                            <i class="fa fa-save"></i> Registrar
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

            <!-- Modal Buscar Compras -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO COMPRAS</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Vin</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillVIN.cvin" @keyup.enter="buscaCompra()" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Vin </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscaCompra">
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
                                        <template v-if="arrayCompra.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>VIN</th>
                                                            <th>Nombre Comercial</th>
                                                            <th>Año / Mes</th>
                                                            <th>Linea</th>
                                                            <th>Forma de Pago</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="vin in arrayCompra" :key="vin.nIdCompra">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ vin.cNumeroVin }}</div>
                                                                    <i @click="asignarCompra(vin)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="vin.cNumeroVin"></td>
                                                            <td v-text="vin.cNombreComercial"></td>
                                                            <td> {{ vin.cAnio }} / {{ vin.cMes }} </td>
                                                            <td v-text="vin.cNombreLinea"></td>
                                                            <td v-text="vin.cFormaPago"></td>
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
                                                                    <a @click.prevent="cambiarPaginaCompra(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaCompra(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaCompra(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                        <div class="col-sm-8">
                                                            <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.id">
                                                                <input type="radio" class="radio-template" v-model="fillMisContactos.ntipopersona" :value="tipo.value" v-on:change="cambiarTipoPersonaMisContactos()">
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
                                                            <input type="text" v-model="fillMisContactos.cnrodocumento" @keyup.enter="listarContactos(1)" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Apellidos</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="fillMisContactos.cfiltrodescripcion" @keyup.enter="listarContactos(1)" class="form-control form-control-sm">
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
                                                    <template v-if="fillMisContactos.ntipopersona == 1">
                                                        <thead>
                                                            <tr>
                                                                <th>Acciones</th>
                                                                <th>Nro Cotización</th>
                                                                <th>Contacto</th>
                                                                <th>Nro Documento</th>
                                                                <th>Telefono</th>
                                                                <th>Dirección</th>
                                                                <th>Email</th>
                                                                <th>Vendedor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="c in arrayContacto" :key="c.cNumeroCotizacion">
                                                                <td>
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Seleccionar {{ c.cContacto }}</div>
                                                                        <i @click="asignarContacto(c)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                    </el-tooltip>
                                                                </td>
                                                                <td v-text="c.cNumeroCotizacion"></td>
                                                                <td v-text="c.cContacto"></td>
                                                                <td v-text="c.cNumeroDocumento"></td>
                                                                <td v-text="c.nTelefonoMovil"></td>
                                                                <td v-text="c.cDireccion"></td>
                                                                <td v-text="c.cEmail"></td>
                                                                <td v-text="c.cVendedor"></td>
                                                            </tr>
                                                        </tbody>
                                                    </template>
                                                    <template v-else>
                                                        <thead>
                                                            <tr>
                                                                <th>Acciones</th>
                                                                <th>Nro Cotización</th>
                                                                <th>Razon Social</th>
                                                                <th>Nro Documento</th>
                                                                <th>Telefono</th>
                                                                <th>Email</th>
                                                                <th>Persona Contacto</th>
                                                                <th>Vendedor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="c in arrayContacto" :key="c.cNumeroCotizacion">
                                                                <td>
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Seleccionar {{ c.cRazonSocial }}</div>
                                                                        <i @click="asignarContacto(c)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                    </el-tooltip>
                                                                </td>
                                                                <td v-text="c.cNumeroCotizacion"></td>
                                                                <td v-text="c.cRazonSocial"></td>
                                                                <td v-text="c.cNumeroDocumento"></td>
                                                                <td v-text="c.nTelefonoMovil"></td>
                                                                <td v-text="c.cEmail"></td>
                                                                <td v-text="c.cContacto"></td>
                                                                <td v-text="c.cVendedor"></td>
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
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Generar Carta -->
            <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body menosPadding">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">DETALLE</h3>
                                            <button type="button" data-dismiss="modal" aria-label="Close" class="close" @click.prevent="cerrarModalSolicitud">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="card-header d-flex align-items-center subCabecera">
                                            <h3 class="h4">Carta de Características</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <form class="form-horizontal">
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <div class="text-center">
                                                                <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-5 offset-md-7">
                                                            <label class="form-control-label"> {{ fillCartaDetalleSolicitud.fecha }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-6">
                                                            <label>Señores</label>
                                                            <label class="form-control-label-readonly">
                                                                <strong v-text="fillCartaDetalleSolicitud.cNombreBanco"></strong>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-6">
                                                            <label>Presente.-</label>
                                                            <label class="form-control-label-readonly">
                                                                Atención : <strong>{{ fillCartaDetalleSolicitud.cAtencion}}</strong>
                                                            </label>
                                                            <label class="form-control-label-readonly">
                                                                Referencia - Cliente : <strong>{{ fillCartaDetalleSolicitud.cContacto}}</strong>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <label>Estimados Señores</label>
                                                            <label class="form-control-label-readonly">
                                                                Mediante la presente, les informamos que nuestro mutuo cliente <strong>{{ fillCartaDetalleSolicitud.cContacto}}</strong> con RUC <strong>{{ fillCartaDetalleSolicitud.cNumDocumento}}</strong> realizó la separación por el siguiente Vehículo Asignado:
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Marca</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong v-text="fillCartaDetalleSolicitud.cNombreMarca"></strong>
                                                                </label>
                                                            </div>
                                                            <label class="col-sm-4 form-control-label">Modelo</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong v-text="fillCartaDetalleSolicitud.cNombreModelo"></strong>
                                                                </label>
                                                            </div>
                                                            <label class="col-sm-4 form-control-label">Año Fabricación</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong v-text="fillCartaDetalleSolicitud.nAnioFabricacion"></strong>
                                                                </label>
                                                            </div>
                                                            <label class="col-sm-4 form-control-label">Año del Modelo</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong v-text="fillCartaDetalleSolicitud.nAnioModelo"></strong>
                                                                </label>
                                                            </div>
                                                            <label class="col-sm-4 form-control-label">Número de Chasis/Serie</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong v-text="fillCartaDetalleSolicitud.cNumeroChasis"></strong>
                                                                </label>
                                                            </div>
                                                            <label class="col-sm-4 form-control-label">Número de Motor</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong v-text="fillCartaDetalleSolicitud.cNumeroMotor"></strong>
                                                                </label>
                                                            </div>
                                                            <label class="col-sm-4 form-control-label">Color</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong v-text="fillCartaDetalleSolicitud.cNombreColor"></strong>
                                                                </label>
                                                            </div>
                                                            <label class="col-sm-4 form-control-label">Clase</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong v-text="fillCartaDetalleSolicitud.cNombreClase"></strong>
                                                                </label>
                                                            </div>
                                                            <label class="col-sm-4 form-control-label">Carrocería</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong v-text="fillCartaDetalleSolicitud.cNombreSubClase"></strong>
                                                                </label>
                                                            </div>
                                                            <hr>
                                                            <div class="flexLeft">
                                                                <h4 class="col-sm-4 form-control-label">VALORES</h4>
                                                            </div>
                                                            <hr>
                                                            <label class="col-sm-4 form-control-label">Precio del Vehículo</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong> {{ fillCartaDetalleSolicitud.cMoneda }}  {{fillCartaDetalleSolicitud.fPrecioBase}} </strong>
                                                                </label>
                                                            </div>
                                                            <label class="col-sm-4 form-control-label">Cuota Inicial</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong>{{ fillCartaDetalleSolicitud.cMoneda }} {{ fillCartaDetalleSolicitud.fCuotaInicial}} </strong>
                                                                </label>
                                                            </div>
                                                            <label class="col-sm-4 form-control-label">Monto a Desembolsar</label>
                                                            <div class="col-sm-8">
                                                                <label class="form-control-label-readonly">
                                                                    <strong>{{ fillCartaDetalleSolicitud.cMoneda }} {{fillCartaDetalleSolicitud.fMontoDesembolsado}} </strong>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <label class="form-control-label-readonly">
                                                                Nos compremetemos a gestionar la Tarjeta de Propiedad del Vehículo a nombre de:
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <label class="form-control-label-readonly">
                                                                <strong v-text="fillCartaDetalleSolicitud.cNombreBanco"></strong>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <label class="form-control-label-readonly" >A la espera del desembolso correspondiente, quedamos de ustedes</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <label class="form-control-label-readonly" >Atentamente,</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <label class="form-control-label-readonly" >Subir Archivo del Banco (Correo Electronico de aprobación)</label>
                                                            <input type="file" id="file-upload" @change="getFile" accept="image/*" class="form-control form-control-sm"/>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="accionAprobacionNoAprobacion(1)">APROBAR</button>
                            <button type="button" class="btn btn-default btn-corner btn-sm" @click="accionAprobacionNoAprobacion(2)">NO APROBAR</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Anulación -->
            <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form v-on:submit.prevent class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">Anulación Carta de Caracteristicas</h3>
                                            <button type="button" class="close" @click="cerrarModalSolicitud()" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="card-body">
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
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 form-control-label">*Motivo</label>
                                                        <div class="col-md-8 widthFull">
                                                            <el-select v-model="fillCartaCaracteristica.nidmotivo"
                                                                    filterable
                                                                    clearable
                                                                    loading-text
                                                                    placeholder="SELECCIONE">
                                                                <el-option
                                                                    v-for="motivo in arrayMotivo"
                                                                    :key="motivo.nIdPar"
                                                                    :label="motivo.cParNombre"
                                                                    :value="motivo.nIdPar">
                                                                </el-option>
                                                            </el-select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 form-control-label">*Descripción</label>
                                                        <div class="col-md-8 widthFull">
                                                            <el-input
                                                                type="textarea"
                                                                autosize
                                                                placeholder="Ingrese descripción de la anulación"
                                                                v-model="fillCartaCaracteristica.cdescripcion">
                                                            </el-input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarAnulación()">Aceptar</button>
                            <button type="button" class="btn btn-default btn-corner btn-sm" @click="cerrarModalSolicitud()">Cancelar</button>
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
                // =============================================================
                // VARIABLES TAB NUEVO SCC
                // =============================================================
                fillCartaCaracteristica: {
                    cnumcarta: 1,
                    nidref: '',
                    catencion: '',
                    dfechainicio: '',
                    dfechafin: '',
                    nidcompra: 0,
                    cnumerovin: '',
                    nidcontacto: 0,
                    cnombrecontacto: '',
                    fpreciodolar: 1,
                    fcuotainicial: 1,
                    fmontodesembolar: 1,
                    nidbanco: '',
                    nidsucursal: '',
                    nidestado: '',
                    nidmotivo: '',
                    cdescripcion: ''
                },
                arrayReferencia: [],
                fillVIN:{
                    cvin: ''
                },
                arrayCompra: [],
                fillMisContactos:{
                    ntipopersona: 1,
                    cnrodocumento: '',
                    cfiltrodescripcion: '',
                },
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
                arrayContacto: [],
                arrayBanco: [],
                arraySucursalBanco: [],
                // =============================================================
                // VARIABLES MIS CARTAS C
                // =============================================================
                arrayEstado: [],
                arrayCartaCaracteristicas: [],
                fillCartaDetalleSolicitud: {
                    nIdSCC: 0,
                    fecha: '',
                    cNumCarta: '',
                    nIdBanco: 0,
                    cNombreBanco: '',
                    cAtencion: '',
                    nIdContacto: 0,
                    cContacto: '',
                    cNumDocumento: 0,
                    nIdVersionVeh: 0,
                    cNombreLinea: '',
                    cNombreMarca: '',
                    cNombreModelo: '',
                    cNombreComercial: '',
                    nAnioFabricacion: 0,
                    nAnioModelo: 0,
                    cNumeroChasis: '',
                    cNumeroMotor: '',
                    cNombreColor: '',
                    cNombreClase: '',
                    cNombreSubClase: '',
                    cMoneda: '',
                    fPrecioBase: 0,
                    fCuotaInicial: 0,
                    fMontoDesembolsado: 0
                },
                attachment: null,
                form: new FormData,
                // =============================================================
                // VARIABLES MIS CARTAS ANULADAS
                // =============================================================
                arrayCartasAnuladas: [],
                arrayMotivo: [],
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
        mounted() {
            this.llenarBancos();
            this.llenarReferencias();
            this.llenarEstados();
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
            tabNuevaSCC(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link ');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link active');

                $('#TabMisCartas').removeClass('in active show');
                $('#TabAnularSCC').removeClass("in active show");
                $('#TabRegistrarSCC').addClass("in active show");
                this.limpiarProcesoRegistrarCC();
            },
            llenarBancos(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110042
                    }
                }).then(response => {
                    this.arrayBanco = response.data;
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
            llenarSucursalesByBanco(){
                var url = this.ruta + '/asigVendedorTurno/GetParametroByParParent';
                axios.get(url, {
                    params: {
                        'nidpar' : this.fillCartaCaracteristica.nidbanco,
                        'nidgrupar' : 110098,
                        'opcionPaginate': 0
                    }
                }).then(response => {
                    this.arraySucursalBanco = response.data;
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
            llenarReferencias(){
                var url = this.ruta + '/getComision/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110072,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayReferencia = response.data;
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
            llenarEstados(){
                var url = this.ruta + '/getComision/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110071,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayEstado = response.data;
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
            // ======================
            // MODAL BUSCAR COMPRAS
            // ======================
            buscaCompra(){
                this.listarCompra(1);
            },
            listarCompra(page){
                var url = this.ruta + '/cartacaracteristica/GeLstCompras';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cnumberovin' : this.fillVIN.cvin.toString(),
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayCompra;
                    this.arrayCompra = info.data;
                    this.paginationModal.current_page   = info.current_page;
                    this.paginationModal.total          = info.total;
                    this.paginationModal.per_page       = info.per_page;
                    this.paginationModal.last_page      = info.last_page;
                    this.paginationModal.from           = info.from;
                    this.paginationModal.to             = info.to;
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
            cambiarPaginaCompra(page){
                this.paginationModal.current_page=page;
                this.listarCompra(page);
            },
            asignarCompra(compra){
                this.fillCartaCaracteristica.nidcompra = compra.nIdCompra;
                this.fillCartaCaracteristica.cnumerovin = compra.cNumeroVin;
                this.cerrarModal();
            },
            // ======================
            // MODAL BUSCAR CONTACTOS
            // ======================
            cambiarTipoPersonaMisContactos(){
                this.arrayContacto = [];
            },
            cambiarPaginaMisContactos(page){
                this.paginationModal.current_page=page;
                this.listarContactos(page);
            },
            listarContactos(page){
                var url = this.ruta + '/cartacaracteristica/GetLstCotizacionAprobadas';
                axios.get(url, {
                    params: {
                        'nidempresa' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidcronograma' : 220016,
                        'ntipopersona' : this.fillMisContactos.ntipopersona,
                        'cnrodocumento' : String(this.fillMisContactos.cnrodocumento.toString()),
                        'cfiltrodescripcion' : this.fillMisContactos.cfiltrodescripcion.toString(),
                        'tipoRol': 1,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayContactosByCotizacionAprobada;
                    this.arrayContacto                = info.data;
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
            asignarContacto(contacto){
                if(this.fillMisContactos.ntipopersona == 1){
                    this.fillCartaCaracteristica.nidcontacto = contacto.nIdContacto;
                    this.fillCartaCaracteristica.cnombrecontacto = contacto.cContacto;
                } else {
                    this.fillCartaCaracteristica.nidcontacto = contacto.nIdContacto;
                    this.fillCartaCaracteristica.cnombrecontacto = contacto.cRazonSocial;
                }
                this.fillMisContactos.ntipopersona = 1;
                this.fillMisContactos.cnrodocumento = '';
                this.fillMisContactos.cfiltrodescripcion = '';
                this.cerrarModal();
            },
            // ======================
            // FORMULARIO - REGISTRAR SCC
            // ======================
            registrarSCC(){
                if(this.validarRegistrarSCC()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/cartacaracteristica/SetRegistrarSCC';
                axios.post(url, {
                    'cNumeroCarta'          :   this.fillCartaCaracteristica.cnumcarta,
                    'cAtencion'             :   this.fillCartaCaracteristica.catencion,
                    'nIdRef'                :   this.fillCartaCaracteristica.nidref,
                    'dFechaInicio'          :   this.fillCartaCaracteristica.dfechainicio,
                    'dFechaVencimiento'     :   this.fillCartaCaracteristica.dfechafin,
                    'nIdCompra'             :   this.fillCartaCaracteristica.nidcompra,
                    'nIdContacto'           :   this.fillCartaCaracteristica.nidcontacto,
                    'fPrecioFinalDolar'     :   this.fillCartaCaracteristica.fpreciodolar,
                    'fCuotaInicial'         :   this.fillCartaCaracteristica.fcuotainicial,
                    'fMontoDesembolsado'    :   this.fillCartaCaracteristica.fmontodesembolar,
                    'nIdBanco'              :   this.fillCartaCaracteristica.nidbanco,
                    'nIdSucursal'           :   this.fillCartaCaracteristica.nidsucursal,
                    'nIdEstadoCarta'        :   1300194,
                    'FlagEstadoApro'        :   'PE'
                }).then(response => {
                    swal('Solicitud Carta de Caracteristica registrada exitosamente');
                    this.tabMisCartas();
                }).catch(error => {
                    this.errors = error
                });
            },
            validarRegistrarSCC(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillCartaCaracteristica.cnumcarta <= 0){
                    this.mensajeError.push('El número de carta debe ser mayor a 0');
                }
                if(!this.fillCartaCaracteristica.cnumcarta){
                    this.mensajeError.push('El número de carta es obligatorio');
                }
                if(this.fillCartaCaracteristica.nidref == 0 || !this.fillCartaCaracteristica.nidref){
                    this.mensajeError.push('Debe seleccionar una referencia');
                }
                if(!this.fillCartaCaracteristica.catencion){
                    this.mensajeError.push('El nombre de la persona que se atendió es obligatorio');
                }
                let fecha_ini = moment(this.fillCartaCaracteristica.dfechainicio);
                let fecha_fin = moment(this.fillCartaCaracteristica.dfechafin);

                if(fecha_fin.diff(fecha_ini, 'days') < 0){
                    this.mensajeError.push('La Fecha de Fin no puede ser menor a la fecha de inicio');
                }
                if(!this.fillCartaCaracteristica.dfechainicio){
                    this.mensajeError.push('Debe seleccionar una fecha de inicio');
                }
                if(!this.fillCartaCaracteristica.dfechafin){
                    this.mensajeError.push('Debe seleccionar una fecha de fin');
                }
                if(this.fillCartaCaracteristica.nidcompra == 0 && !this.fillCartaCaracteristica.cnumerovin){
                    this.mensajeError.push('Debe seleccionar un VIN');
                }
                if(this.fillCartaCaracteristica.nidcontacto == 0 && !this.fillCartaCaracteristica.cnombrecontacto){
                    this.mensajeError.push('Debe seleccionar un Contacto');
                }
                if(this.fillCartaCaracteristica.fpreciodolar <= 0){
                    this.mensajeError.push('El precio del dolar no puede ser menor a 0');
                }
                if(this.fillCartaCaracteristica.fcuotainicial <= 0){
                    this.mensajeError.push('La cuota inicial no puede ser menor a 0');
                }
                if(this.fillCartaCaracteristica.fmontodesembolar <= 0){
                    this.mensajeError.push('El monto a desembolar no puede ser menor a 0');
                }
                if(this.fillCartaCaracteristica.nidbanco == 0 || !this.fillCartaCaracteristica.nidbanco){
                    this.mensajeError.push('Debe seleccionar un Banco');
                }
                if(this.fillCartaCaracteristica.nidsucursal == 0 || !this.fillCartaCaracteristica.nidsucursal){
                    this.mensajeError.push('Debe seleccionar unas Sucursal');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            limpiarProcesoRegistrarCC(){
                this.fillCartaCaracteristica.cnumcarta = 1;
                this.fillCartaCaracteristica.catencion = '';
                this.fillCartaCaracteristica.nidref = '';
                this.fillCartaCaracteristica.dfechainicio = '';
                this.fillCartaCaracteristica.dfechafin = '';
                this.fillCartaCaracteristica.nidcompra = 0;
                this.fillCartaCaracteristica.cnumerovin = '';
                this.fillCartaCaracteristica.nidcontacto = 0;
                this.fillCartaCaracteristica.cnombrecontacto = '';
                this.fillCartaCaracteristica.fpreciodolar = 1;
                this.fillCartaCaracteristica.fcuotainicial = 1;
                this.fillCartaCaracteristica.fmontodesembolar = 1;
                this.fillCartaCaracteristica.nidbanco = '';
                this.fillCartaCaracteristica.nidsucursal = '';
            },
            // ======================
            // TAB MIS CARTAS
            // ======================
            tabMisCartas(){
                this.limpiarProcesoRegistrarCC();
                $('#tab01').removeClass('nav-link ');
                $('#tab01').addClass('nav-link active');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link');

                $('#TabMisCartas').addClass('in active show');
                $('#TabAnularSCC').removeClass("in active show");
                $('#TabRegistrarSCC').removeClass("in active show");
                this.limpiarFormulario();
            },
            buscarMisCartas(page){
                var url = this.ruta + '/cartacaracteristica/GetLstCartaCaracteristica';
                axios.get(url, {
                    params: {
                        'cNumeroVin' : this.fillCartaCaracteristica.cnumerovin,
                        'nIdContacto' : this.fillCartaCaracteristica.nidcontacto,
                        'dFechaInicio' : this.fillCartaCaracteristica.dfechainicio,
                        'dFechaFin' : this.fillCartaCaracteristica.dfechafin,
                        'nIdEstado' : this.fillCartaCaracteristica.nidestado,
                        'tipoRol': 1,
                        'flagEstado' : '',
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayCartaCaracteristicas;
                    this.arrayCartaCaracteristicas    = info.data;
                    this.pagination.current_page =  info.current_page;
                    this.pagination.total        = info.total;
                    this.pagination.per_page     = info.per_page;
                    this.pagination.last_page    = info.last_page;
                    this.pagination.from         = info.from;
                    this.pagination.to           = info.to;
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
            cambiarPaginaMisCC(page){
                this.pagination.current_page=page;
                this.buscarMisCartas(page);
            },
            limpiarMisCartas(){
                this.fillCartaCaracteristica.nidcompra = 0;
                this.fillCartaCaracteristica.cnumerovin = '';
                this.fillCartaCaracteristica.nidcontacto = 0;
                this.fillCartaCaracteristica.cnombrecontacto = '';
                this.fillCartaCaracteristica.dfechainicio = '';
                this.fillCartaCaracteristica.dfechafin = '';
                this.fillCartaCaracteristica.nidestado = '';
            },
            getDetalleSolicitud(nIdSCartaC){
                var url = this.ruta + '/cartacaracteristica/GetDetalleSolicitud';
                axios.get(url, {
                    params: {
                        'nIdScartaC' : nIdSCartaC
                    }
                }).then(response => {
                    this.fillCartaDetalleSolicitud.nIdSCC             = response.data[0].nIdSCC;
                    this.fillCartaDetalleSolicitud.fecha              = response.data[0].Fecha;
                    this.fillCartaDetalleSolicitud.cNumCarta          = response.data[0].cNumCarta;
                    this.fillCartaDetalleSolicitud.nIdBanco           = response.data[0].nIdBanco;
                    this.fillCartaDetalleSolicitud.cAtencion          = response.data[0].cRef + ' ' + response.data[0].cAtencion;
                    this.fillCartaDetalleSolicitud.cNombreBanco       = response.data[0].cNombreBanco;
                    this.fillCartaDetalleSolicitud.nIdContacto        = response.data[0].nIdContacto;
                    this.fillCartaDetalleSolicitud.cContacto          = response.data[0].cContacto;
                    this.fillCartaDetalleSolicitud.cNumDocumento      = response.data[0].cNumDocumento;
                    this.fillCartaDetalleSolicitud.nIdVersionVeh      = response.data[0].nIdVersionVeh;
                    this.fillCartaDetalleSolicitud.cNombreLinea       = response.data[0].cNombreLinea;
                    this.fillCartaDetalleSolicitud.cNombreMarca       = response.data[0].cNombreMarca;
                    this.fillCartaDetalleSolicitud.cNombreModelo      = response.data[0].cNombreModelo;
                    this.fillCartaDetalleSolicitud.cNombreComercial   = response.data[0].cNombreComercial;
                    this.fillCartaDetalleSolicitud.nAnioFabricacion   = response.data[0].nAnioFabricacion
                    this.fillCartaDetalleSolicitud.nAnioModelo        = response.data[0].nAnioModelo;
                    this.fillCartaDetalleSolicitud.cNumeroChasis      = response.data[0].cNumeroChasis;
                    this.fillCartaDetalleSolicitud.cNumeroMotor       = response.data[0].cNumeroMotor;
                    this.fillCartaDetalleSolicitud.cNombreColor       = response.data[0].cNombreColor;
                    this.fillCartaDetalleSolicitud.cNombreClase       = response.data[0].cNombreClase;
                    this.fillCartaDetalleSolicitud.cNombreSubClase    = response.data[0].cNombreSubClase;
                    this.fillCartaDetalleSolicitud.cMoneda            = response.data[0].cMoneda;
                    this.fillCartaDetalleSolicitud.fPrecioBase        = response.data[0].fPrecioBase;
                    this.fillCartaDetalleSolicitud.fCuotaInicial      = response.data[0].fCuotaInicial;
                    this.fillCartaDetalleSolicitud.fMontoDesembolsado = response.data[0].fMontoDesembolsado;
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
            getFile(e){
                //console.log(e);
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
            },
            accionAprobacionNoAprobacion(data){
                if(this.validarAprobacionNoAprobacionSCC()){
                    return;
                }
                this.form.append('file', this.attachment);

                this.form.append('nIdScartaC', this.fillCartaDetalleSolicitud.nIdSCC);
                this.form.append('nIdEstadoCarta', (data == 1) ? 1300195 : 1300195);
                this.form.append('FlagEstadoApro', (data == 1) ? 'AP' : 'DE');
                this.form.append('nombre', this.fillCartaDetalleSolicitud.cNumCarta + '-' + this.fillCartaDetalleSolicitud.cContacto);

                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };
                var url = this.ruta + '/cartacaracteristica/SetAprobadoNoAprobado';
                axios.post(url, this.form, config).then(response => {
                    console.log(response);
                    this.buscarMisCartas(1);
                    this.cerrarModalSolicitud();
                    this.limpiarProcesoRegistrarCC();
                    this.attachment = '';
                    this.form = new FormData;
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
            validarAprobacionNoAprobacionSCC(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.attachment){
                    this.mensajeError.push('Debe subir una imagen antes de dar la Aprobación/Desaprobación');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ======================
            // TAB - MIS CARTAS ANULADAS
            // ======================
            tabAnularSCC(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link active');
                $('#tab03').removeClass('nav-link active');
                $('#tab03').addClass('nav-link ');

                $('#TabMisCartas').removeClass('in active show');
                $('#TabAnularSCC').addClass("in active show");
                $('#TabRegistrarSCC').removeClass("in active show");
                this.limpiarFormulario();
                this.limpiarProcesoRegistrarCC();
            },
            buscarMisCartasAnuladas(page){
                var url = this.ruta + '/cartacaracteristica/GetLstCartaCaracteristica';
                axios.get(url, {
                    params: {
                        'cNumeroVin' : this.fillCartaCaracteristica.cnumerovin,
                        'nIdContacto' : this.fillCartaCaracteristica.nidcontacto,
                        'dFechaInicio' : this.fillCartaCaracteristica.dfechainicio,
                        'dFechaFin' : this.fillCartaCaracteristica.dfechafin,
                        'nIdEstado' : this.fillCartaCaracteristica.nidestado,
                        'tipoRol': 1,
                        'flagEstado' : 'DE',
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayCartaCaracteristicas;
                    this.arrayCartasAnuladas     = info.data;
                    this.pagination.current_page =  info.current_page;
                    this.pagination.total        = info.total;
                    this.pagination.per_page     = info.per_page;
                    this.pagination.last_page    = info.last_page;
                    this.pagination.from         = info.from;
                    this.pagination.to           = info.to;
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
            cambiarPaginaMisCCAnuladas(page){
                this.pagination.current_page=page;
                this.buscarMisCartasAnuladas(page);
            },
            llenarMotivos(idSCC){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110073
                    }
                }).then(response => {
                    this.arrayMotivo = response.data;
                    this.fillCartaDetalleSolicitud.nIdSCC = idSCC;
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
            registrarAnulación(){
                if(this.validarRegistrarAnulacion()){
                    return;
                }
                var url = this.ruta + '/cartacaracteristica/SetAnularSCC';
                axios.put(url, {
                    'nIdScartaC' : this.fillCartaDetalleSolicitud.nIdSCC,
                    'nIdEstadoCarta': 1300199,
                    'FlagEstadoApro': 'DE',
                    'nIdMotivo' : this.fillCartaCaracteristica.nidmotivo,
                    'cDescripcion' : this.fillCartaCaracteristica.cdescripcion
                }).then(response => {
                    this.cerrarModalSolicitud();
                    this.buscarMisCartasAnuladas(1);
                    this.fillCartaCaracteristica.nidmotivo = '',
                    this.fillCartaCaracteristica.cdescripcion = ''
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
            validarRegistrarAnulacion(){
                this.error = 0;
                this.mensajeError =[];

                if(this.fillCartaCaracteristica.nidmotivo == 0 || this.fillCartaCaracteristica.nidmotivo == ''){
                    this.mensajeError.push('Debe seleccionar un Motivo');
                }
                if(!this.fillCartaCaracteristica.cdescripcion){
                    this.mensajeError.push('La descripción no puede estar vacía');
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
                    case "compra":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.listarCompra(1);
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
                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarContactos(1);
                                break;
                            }
                        }
                    }
                    break;
                    case "aprobar":
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.getDetalleSolicitud(data);
                                this.accionmodal=4;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case "desaprobar":
                    {
                        switch(accion){
                            case 'abrir':
                            {
                                this.llenarMotivos(data);
                                this.accionmodal=5;
                                this.modal = 1;
                                break;
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
            limpiarFormulario(){
                this.arrayCartaCaracteristicas = [];
                this.arrayCartasAnuladas = [];
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
    .input-with-select .el-input-group__prepend
    {
            width: 30%;
    }
</style>
